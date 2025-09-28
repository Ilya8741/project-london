(function () {
  const root = document.querySelector(".services-slider");
  if (!root) {
    console.warn("[services] root not found");
    return;
  }

  const isMobile = () => window.matchMedia("(max-width:1000px)").matches;

  const contentCards = Array.from(
    root.querySelectorAll(".services-content-card")
  );
  const track = root.querySelector(".services-slider-image-track");

  const images = Array.from(root.querySelectorAll(".services-image"));
  const grid = root.querySelector(".services-slider-grid");
  const stage = root.querySelector(".services-image-stage");
  const contentCol = root.querySelector(".services-slider-content-col");
  gsap && gsap.set && gsap.set(track, { yPercent: 0 });
  console.log("[services] init start", {
    cards: contentCards.length,
    images: images.length,
    hasTrack: !!track,
    hasGrid: !!grid,
    hasStage: !!stage,
    hasContentCol: !!contentCol,
    gsap: !!window.gsap,
    ScrollTrigger: !!window.ScrollTrigger,
  });

  if (
    !track ||
    !grid ||
    !stage ||
    !contentCol ||
    images.length === 0 ||
    contentCards.length === 0
  ) {
    console.warn("[services] required DOM missing -> abort");
    return;
  }

  let stDesktopCtx = null;
  let stMobile = null;
  let mobileMode = null;
  let lastSnap = 0;

  function adjustContentHeight() {
    if (!mobileMode) return;
    const active =
      contentCards.find((c) => c.classList.contains("is-active")) ||
      contentCards[0];
    if (active && contentCol) {
      const h = active.offsetHeight;
      contentCol.style.height = h + "px";
    }
  }

  function setActive(idx) {
    contentCards.forEach((c, i) => c.classList.toggle("is-active", i === idx));
    images.forEach((im, i) => im.classList.toggle("is-active", i === idx));
    lastSnap = idx;
    adjustContentHeight();
  }

  function safeShowFirst() {
    setActive(0);
  }

  // ---------- DESKTOP ----------
  function setupDesktop() {
    if (!window.gsap || !window.ScrollTrigger) {
      console.warn("[services] no GSAP on desktop");
      safeShowFirst();
      return;
    }
    gsap.registerPlugin(ScrollTrigger);

    const steps = images.length;
    console.log("[services] setupDesktop", { steps });

    contentCol.style.height = "";

    stDesktopCtx = gsap.context(() => {
      ScrollTrigger.create({
        trigger: root,
        start: "top top+=150",
        end: () => `+=${steps * window.innerHeight}`,
        pin: grid,
        pinSpacing: true,
        scrub: true,
        snap: {
          snapTo: (v) =>
            steps > 1 ? Math.round(v * (steps - 1)) / (steps - 1) : 0,
          duration: 0.25,
          ease: "power1.out",
        },
        onUpdate: (self) => {
          const idx =
            steps > 1
              ? Math.min(steps - 1, Math.round(self.progress * (steps - 1)))
              : 0;
          setActive(idx);
        },
      });
      setActive(0);
    }, root);

    if (window.ScrollTrigger) ScrollTrigger.refresh();
  }

  function teardownDesktop() {
    if (stDesktopCtx) {
      stDesktopCtx.revert();
      stDesktopCtx = null;
      console.log("[services] teardownDesktop");
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

    console.log("[services] setupMobile (pin + translateY + snap1 + fade)", {
      steps,
    });

    setActive(0);

    stMobile = ScrollTrigger.create({
      trigger: root,
      start: "top top+=100",
      end: () => `+=${steps * window.innerHeight}`,
      pin: grid,
      pinSpacing: true,
      scrub: true,
      snap: {
        snapTo: (value) => {
          if (steps <= 1) return 0;
          const raw = value * (steps - 1);
          const dir = raw > lastSnap ? 1 : raw < lastSnap ? -1 : 0;
          const target = Math.max(
            0,
            Math.min(steps - 1, lastSnap + (dir === 0 ? 0 : dir))
          );
          return target / (steps - 1);
        },
        duration: { min: 0.15, max: 0.28 },
        ease: "power1.out",
        inertia: false,
      },
      onUpdate: (self) => {
        const p = self.progress;
        const yPercent = -p * (steps - 1) * 100;
        gsap.set(track, { yPercent, force3D: true });

        const idx =
          steps > 1 ? Math.min(steps - 1, Math.round(p * (steps - 1))) : 0;
        setActive(idx);
      },
      onSnapComplete: (self) => {
        const idx = steps > 1 ? Math.round(self.progress * (steps - 1)) : 0;
        lastSnap = idx;
        gsap.set(track, { yPercent: -idx * 100, force3D: true });
        setActive(idx);
      },
    });

    if (window.ScrollTrigger) ScrollTrigger.refresh();
  }

  function teardownMobile() {
    if (stMobile) {
      stMobile.kill();
      stMobile = null;
      console.log("[services] teardownMobile");
    }

    contentCol.style.height = "";
    if (window.ScrollTrigger) ScrollTrigger.refresh();
  }

  // ---------- INIT / SWITCH ----------
  function init() {
    const now = isMobile();
    if (mobileMode === now) return;
    mobileMode = now;
    console.log("[services] init mode", now ? "mobile" : "desktop");

    if (now) {
      teardownDesktop();
      setupMobile();
    } else {
      teardownMobile();
      setupDesktop();
    }
  }

  if (
    document.readyState === "complete" ||
    document.readyState === "interactive"
  ) {
    init();
  } else {
    document.addEventListener("DOMContentLoaded", init, { once: true });
  }

  window.addEventListener(
    "resize",
    () => {
      init();
      if (mobileMode) {
        setTimeout(() => {
          const evt = new Event("scroll");
          window.dispatchEvent(evt);
        }, 50);
      }
    },
    { passive: true }
  );
})();
