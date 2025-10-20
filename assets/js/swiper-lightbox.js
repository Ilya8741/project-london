
(function () {
  function $all(sel, ctx) {
    return Array.prototype.slice.call((ctx || document).querySelectorAll(sel));
  }

  function ensureOverlay() {
    var ex = document.querySelector(".plb-overlay");
    if (ex) return ex;
    var el = document.createElement("div");
    el.className = "plb-overlay";
    el.innerHTML =
      '<button class="plb-btn plb-close" aria-label="Close"><div class="plb-close-line"></div><div class="plb-close-line"></div></button>' +
      '<div class="plb-swiper swiper"><div class="swiper-wrapper"></div></div>' +
      '<div class="plb-bottombar">' +
        '<button class="plb-btn plb-prev" aria-label="Previous"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none"><path d="M9.48438 17.9707L0.999093 9.48542L9.48437 1.00014" stroke="white" stroke-width="0.5" stroke-linejoin="round"/><path d="M17.9697 9.48542L0.999093 9.48542" stroke="white" stroke-width="0.5" stroke-linejoin="round"/></svg></button>' +
        '<div class="plb-counter"><span class="plb-current">1</span> <p>of</p> <span class="plb-total">1</span></div>' +
        '<button class="plb-btn plb-next" aria-label="Next"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none"><path d="M8.48438 1L16.9697 9.48528L8.48438 17.9706" stroke="white" stroke-width="0.5" stroke-linejoin="round"/><path d="M-0.000906229 9.48528H16.9697" stroke="white" stroke-width="0.5" stroke-linejoin="round"/></svg></button>' +
      '</div>';
    document.body.appendChild(el);
    return el;
  }

  var overlay   = ensureOverlay();
  var wrapper   = overlay.querySelector(".swiper-wrapper");
  var btnClose  = overlay.querySelector(".plb-close");
  var btnPrev   = overlay.querySelector(".plb-prev");
  var btnNext   = overlay.querySelector(".plb-next");
  var curEl     = overlay.querySelector(".plb-current");
  var totalEl   = overlay.querySelector(".plb-total");
  var swiper    = null;

  var itemsCache = [];

  function getKey(a) {
    return (
      a.getAttribute("data-img-id") ||
      (a.closest(".swiper-slide") && a.closest(".swiper-slide").getAttribute("data-idx")) ||
      a.getAttribute("href")
    );
  }

  function collectItems() {
    var links = Array.prototype.slice.call(document.querySelectorAll("a.js-lightbox"));

    var seen = new Set();
    var uniq = [];

    links.forEach(function (a) {
      if (a.closest(".swiper-slide-duplicate")) return;

      var key = getKey(a);
      if (!key || seen.has(key)) return;
      seen.add(key);
      uniq.push(a);
    });

    itemsCache = uniq.map(function (a) {
      var img = a.querySelector("img");
      return {
        key:  getKey(a),
        href: a.getAttribute("href"),
        alt:  img ? (img.getAttribute("alt") || "") : ""
      };
    });

    return uniq;
  }

  function openAt(startIndex) {
    var count = itemsCache.length;
    if (!count) return;

    wrapper.innerHTML = "";
    itemsCache.forEach(function (it) {
      var slide = document.createElement("div");
      slide.className = "swiper-slide";
      slide.innerHTML = '<img class="plb-slide-img" src="' + it.href + '" alt="' + (it.alt || "") + '">';
      wrapper.appendChild(slide);
    });

    totalEl.textContent = String(count);

    if (swiper) {
      swiper.destroy(true, true);
      swiper = null;
    }

    swiper = new Swiper(".plb-swiper", {
      initialSlide: Math.max(0, startIndex || 0),
      centeredSlides: true,
      slidesPerView: "auto",
      spaceBetween: 20,
      loop: false,
      watchSlidesProgress: true,
      observer: true,
      observeParents: true,
      updateOnWindowResize: true,
      keyboard: { enabled: true },
      breakpoints: {
        0:   { slidesPerView: 1,      centeredSlides: true, spaceBetween: 20 },
        768: { slidesPerView: "auto", centeredSlides: true, spaceBetween: 17 }
      },
      on: {
        init: function (sw) {
          curEl.textContent = String(sw.activeIndex + 1);
          $all(".plb-slide-img", overlay).forEach(function (img) {
            if (img.complete) return;
            img.addEventListener("load", function () { sw.update(); }, { once: true });
          });
          setTimeout(function () { sw.update(); }, 0);
        },
        slideChange: function (sw) {
          curEl.textContent = String(sw.activeIndex + 1);
        }
      }
    });

    overlay.classList.add("is-open");
    document.documentElement.style.overflow = "hidden";
  }

  function close() {
    overlay.classList.remove("is-open");
    if (swiper) {
      swiper.destroy(true, true);
      swiper = null;
    }
    document.documentElement.style.overflow = "";
  }

  btnClose.addEventListener("click", close);
  btnPrev.addEventListener("click", function () { if (swiper) swiper.slidePrev(); });
  btnNext.addEventListener("click", function () { if (swiper) swiper.slideNext(); });

  document.addEventListener("keydown", function (e) {
    if (!overlay.classList.contains("is-open")) return;
    if (e.key === "Escape") close();
  });

  document.addEventListener("click", function (e) {
    var link = e.target.closest("a.js-lightbox");
    if (!link) return;

    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || link.target === "_blank") return;

    e.preventDefault();

    collectItems();
    var clickedKey = getKey(link);
    var startIndex = Math.max(0, itemsCache.findIndex(function (it) { return it.key == clickedKey; }));

    openAt(startIndex);
  });

  document.addEventListener("click", function (e) {
    var btn = e.target.closest(".lightbox-button");
    if (!btn) return;
    e.preventDefault();
    collectItems();
    if (itemsCache.length) openAt(0);
  });
})();
