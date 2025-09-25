// document.addEventListener("DOMContentLoaded", () => {
//   const overlay = document.getElementById("pl-overlay");
//   if (!overlay) return;

//   const dur = parseInt(overlay.dataset.duration || "3000", 10);

//   overlay.style.setProperty("--pl-dur", dur + "ms");

//   setTimeout(() => {
//     overlay.classList.add("is-done");
//     document.documentElement.classList.remove("pl-lock");
//     document.body.classList.remove("pl-lock");
//     setTimeout(() => overlay.remove(), 550);
//   }, dur);

//   document.body.classList.add("pl-lock");
// });

document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".hb-menu__link[data-img-id]");
  const imgs = document.querySelectorAll(".hb-media__img");
  const list = document.querySelector(".hb-menu__list");

  if (!links.length || !list) return;

  function showById(id) {
    imgs.forEach((img) => img.classList.toggle("is-active", img.id === id));
  }

  function activate(link, id) {
    showById(id);
    list.classList.add("dim");
    links.forEach((l) => l.classList.toggle("is-current", l === link));
  }

  function reset() {
    list.classList.remove("dim");
    links.forEach((l) => l.classList.remove("is-current"));
  }

  links.forEach((link) => {
    const id = link.getAttribute("data-img-id");
    link.addEventListener("mouseenter", () => activate(link, id));
    link.addEventListener("focus", () => activate(link, id));
    link.addEventListener("mouseleave", reset);
    link.addEventListener("blur", reset);
  });
});

// assets/js/burger.js
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.querySelector(".header-open");
  const wrap = document.querySelector(".site-header-wrapper");
  const panel = document.querySelector(".header-burger-menu");

  if (!btn || !wrap || !panel) return;

  btn.addEventListener("click", () => {
    const willOpen = !panel.classList.contains("active");

    btn.classList.toggle("active");
    wrap.classList.toggle("active");
    panel.classList.toggle("active");

    document.body.style.overflow = willOpen ? "hidden" : "";
  });
});
