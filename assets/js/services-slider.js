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
    if (!window.gsap || !window.ScrollTrigger) {
      console.warn("[services] no GSAP on mobile");
      safeShowFirst();
      return;
    }
    gsap.registerPlugin(ScrollTrigger);

    const steps = images.length;

    track.style.display = "flex";
    track.style.flexDirection = "column";
    images.forEach((el) => {
      el.style.flex = "0 0 100%";
      el.style.height = "100%";
    });

    commitActive(0);

    let lastDirFallback = 0;
    let touchStartY = null;

    root.addEventListener("touchstart", (e) => {
      touchStartY = e.touches && e.touches[0] ? e.touches[0].clientY : null;
    }, { passive: true });

    root.addEventListener("touchmove", (e) => {
      if (touchStartY == null) return;
      const y = e.touches && e.touches[0] ? e.touches[0].clientY : touchStartY;
      const dy = y - touchStartY;
      lastDirFallback = dy < 0 ? 1 : dy > 0 ? -1 : lastDirFallback;
    }, { passive: true });

    root.addEventListener("wheel", (e) => {
      if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) lastDirFallback = e.deltaY > 0 ? 1 : -1;
    }, { passive: true });

    stMobile = ScrollTrigger.create({
      trigger: root,
      start: "top top+=100",
      end: () => `+=${steps * window.innerHeight}`,
      pin: grid,
      pinSpacing: true,
      scrub: true,
      anticipatePin: 1,

      snap: {
        snapTo: (value, self) => {
          if (steps <= 1) return 0;
          const total = steps - 1;

          const d = (self && typeof self.direction === "number")
            ? self.direction
            : (window.ScrollTrigger && ScrollTrigger.direction) || lastDirFallback || 0;

          let targetIdx = lastSnap + (d > 0 ? 1 : d < 0 ? -1 : 0);
          if (targetIdx < 0) targetIdx = 0;
          if (targetIdx > steps - 1) targetIdx = steps - 1;

          return targetIdx / total;
        },
        delay: 0,
        duration: 0.2,
        ease: "power2.out",
        inertia: false
      },

      onUpdate: (self) => {
        const p = self.progress;
        gsap.set(track, { yPercent: -p * (steps - 1) * 100, force3D: true });

        const idx = steps > 1 ? Math.min(steps - 1, Math.round(p * (steps - 1))) : 0;
        setActiveVisual(idx);
      },

      onSnapComplete: (self) => {
        const idx = steps > 1 ? Math.round(self.progress * (steps - 1)) : 0;
        commitActive(idx);
        gsap.set(track, { yPercent: -idx * 100, force3D: true });
      }
    });

    if (window.ScrollTrigger) ScrollTrigger.refresh();
  }

  function teardownMobile() {
    if (stMobile) {
      stMobile.kill();
      stMobile = null;
    }
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
