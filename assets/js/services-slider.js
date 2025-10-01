(function () {
  const root = document.querySelector(".services-slider");
  if (!root) {
    console.warn("[services] root not found");
    return;
  }

  const isMobile = () => window.matchMedia("(max-width:1000px)").matches;

  const contentCards = Array.from(root.querySelectorAll(".services-content-card"));
  const track = root.querySelector(".services-slider-image-track");
  const images = Array.from(root.querySelectorAll(".services-image"));
  const grid = root.querySelector(".services-slider-grid");
  const stage = root.querySelector(".services-image-stage");
  const contentCol = root.querySelector(".services-slider-content-col");

  if (window.gsap && gsap.set) gsap.set(track, { yPercent: 0 });

  if (!track || !grid || !stage || !contentCol || images.length === 0 || contentCards.length === 0) {
    console.warn("[services] required DOM missing -> abort");
    return;
  }

  let stDesktopCtx = null;
  let stMobile = null;
  let mobileMode = null;

  let lastSnap = 0;

  function adjustContentHeight() {
    if (!mobileMode) return;
    const active = contentCards.find((c) => c.classList.contains("is-active")) || contentCards[0];
    if (active && contentCol) contentCol.style.height = active.offsetHeight + "px";
  }

  function setActiveVisual(idx) {
    contentCards.forEach((c, i) => c.classList.toggle("is-active", i === idx));
    images.forEach((im, i) => im.classList.toggle("is-active", i === idx));
    adjustContentHeight();
  }

  function commitActive(idx) {
    lastSnap = idx;
    setActiveVisual(idx);
  }

  function safeShowFirst() { commitActive(0); }

  // ---------- DESKTOP ----------
  function setupDesktop() {
    if (!window.gsap || !window.ScrollTrigger) {
      console.warn("[services] no GSAP on desktop");
      safeShowFirst();
      return;
    }
    gsap.registerPlugin(ScrollTrigger);

    const steps = images.length;
    contentCol.style.height = "";

    const perStep = Math.max(0.65 * window.innerHeight, 400);

    stDesktopCtx = gsap.context(() => {
      ScrollTrigger.create({
        trigger: root,
        start: "top top+=150",
        end: () => `+=${steps * perStep}`,
        pin: grid,
        pinSpacing: true,
        scrub: true,
        snap: {
          snapTo: (v) => (steps > 1 ? Math.round(v * (steps - 1)) / (steps - 1) : 0),
          duration: 0.22,
          ease: "power1.out",
          inertia: false
        },
        onUpdate: (self) => {
          const idx = steps > 1 ? Math.min(steps - 1, Math.round(self.progress * (steps - 1))) : 0;
          setActiveVisual(idx);
        }
      });
      commitActive(0);
    }, root);

    if (window.ScrollTrigger) ScrollTrigger.refresh();
  }

  function teardownDesktop() {
    if (stDesktopCtx) {
      stDesktopCtx.revert();
      stDesktopCtx = null;
    }
    if (window.ScrollTrigger) ScrollTrigger.refresh();
  }

  function setupMobile() {
    // Без любых «прокруток трека»: только классы .is-active
    if (!window.gsap || !window.ScrollTrigger) {
      // даже без GSAP просто показываем первый
      safeShowFirst();
      return;
    }
    gsap.registerPlugin(ScrollTrigger);

    const steps = images.length;
    contentCol.style.height = "";

    // 1) Снести любые старые триггеры/инлайны, чтобы не мешали CSS-транзишны
    if (window.ScrollTrigger) {
      ScrollTrigger.getAll().forEach(t => {
        if (!t) return;
        const trg = t.vars?.trigger;
        if (trg === root || trg === grid || trg === stage) t.kill();
      });
    }
    gsap.killTweensOf(track);
    gsap.killTweensOf(images);
    gsap.set(track, { clearProps: "transform" });
    images.forEach(im => gsap.set(im, { clearProps: "transform,opacity,scale,y" }));

    // 2) Очистить мобильные стили из прежней версии (flex-колонка и т.п.)
    track.style.display = "";
    track.style.flexDirection = "";
    images.forEach((el) => {
      el.style.flex = "";
      el.style.height = "";
    });

    // 3) Показать первый кадр: дальше всё будет делать CSS по .is-active
    commitActive(0);

    // 4) Поведение как на десктопе: пинним грид, скрабим и снапим по шагам,
    //    но НЕ двигаем track вообще — только меняем .is-active.
    const perStep = Math.max(0.65 * window.innerHeight, 400);

    stMobile = ScrollTrigger.create({
      trigger: root,
      start: "top top+=100",
      end: () => `+=${Math.max(0, (steps - 1)) * perStep}`,
      pin: grid,
      pinSpacing: true,
      scrub: true,
      anticipatePin: 1,
      snap: steps > 1 ? {
        snapTo: (v) => Math.round(v * (steps - 1)) / (steps - 1),
        duration: 0.22,
        ease: "power1.out",
        inertia: false
      } : false,
      onUpdate: (self) => {
        const idx = steps > 1 ? Math.min(steps - 1, Math.round(self.progress * (steps - 1))) : 0;
        setActiveVisual(idx); // ТОЛЬКО классы — CSS сделает fade + translate
      }
    });

    ScrollTrigger.refresh();
  }

  function teardownMobile() {
    if (stMobile) {
      stMobile.kill();
      stMobile = null;
    }
    // Ничего не анимируем на выходе — просто чистим высоту
    contentCol.style.height = "";
    if (window.ScrollTrigger) ScrollTrigger.refresh();
  }


  // ---------- INIT / SWITCH ----------
  function init() {
    const now = isMobile();
    if (mobileMode === now) return;
    mobileMode = now;

    if (now) {
      teardownDesktop();
      setupMobile();
    } else {
      teardownMobile();
      setupDesktop();
    }
  }

  if (document.readyState === "complete" || document.readyState === "interactive") {
    init();
  } else {
    document.addEventListener("DOMContentLoaded", init, { once: true });
  }

  window.addEventListener("resize", () => {
    init();
    if (mobileMode) {
      setTimeout(() => {
        const evt = new Event("scroll");
        window.dispatchEvent(evt);
      }, 50);
    }
  }, { passive: true });
})();
