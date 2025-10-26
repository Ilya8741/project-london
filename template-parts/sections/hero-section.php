<div class="hero-section <?php if (get_sub_field('no_home')): ?> hero-section-no-home <?php endif; ?>">
  <div class="hero-section-wrapper">
    <div class="main-container">
      <h1 class="hero-section-title">
        <?php the_sub_field('hero_title'); ?>
      </h1>
    </div>

    <div class="hero-section-image-wrapper">
      <?php
      $hero_video       = get_sub_field('hero_video'); 
      $hero_video_main  = get_sub_field('hero_video_main'); 

      $hero_main_url  = is_array($hero_video_main) ? ($hero_video_main['url'] ?? '') : (is_string($hero_video_main) ? $hero_video_main : '');
      $hero_main_type = is_array($hero_video_main) ? ($hero_video_main['mime_type'] ?? '') : '';
      ?>

      <?php if ($hero_video): ?>
        <video autoplay muted loop playsinline>
          <source src="<?php echo esc_url($hero_video['url']); ?>" type="<?php echo esc_attr($hero_video['mime_type']); ?>">
        </video>
      <?php endif; ?>

      <?php if (get_sub_field('hero_button_text')): ?>
        <button
          class="hero-section-button main-button"
          <?php if ($hero_main_url): ?>
            data-fs-src="<?php echo esc_url($hero_main_url); ?>"
            <?php if ($hero_main_type): ?>data-fs-type="<?php echo esc_attr($hero_main_type); ?>"<?php endif; ?>
          <?php endif; ?>
        >
          <span><?php the_sub_field('hero_button_text'); ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true" focusable="false">
            <path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
            <path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
          </svg>
        </button>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
(function () {
  var wrapper = document.querySelector('.hero-section-image-wrapper');
  if (!wrapper) return;

  var trigger = document.querySelector('.hero-section-button');
  var inlineVideo = wrapper.querySelector('video');
  if (!trigger) return;

  function getVideoSrc(v) {
    if (!v) return '';
    var s = v.querySelector('source');
    return (s && s.src) || v.currentSrc || v.src || '';
  }

  function openFullscreenVideo(url, type) {
    if (!url) return;

    var overlay = document.createElement('div');
    Object.assign(overlay.style, {
      position: 'fixed',
      inset: '0',
      background: '#000',
      zIndex: '2147483647',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      transform: 'translateY(-10vh)',
      opacity: '0',
      transition: 'transform 1.5s ease, opacity 1.5s ease',
      willChange: 'transform, opacity'
    });

    var v = document.createElement('video');
    if (type) {
      var srcEl = document.createElement('source');
      srcEl.src = url;
      srcEl.type = type;
      v.appendChild(srcEl);
    } else {
      v.src = url;
    }
    v.controls = true;
    v.autoplay = true;
    v.muted = false;
    v.playsInline = true;
    v.preload = 'auto';
    Object.assign(v.style, {
      width: '100%',
      height: '100%',
      objectFit: 'contain',
      visibility: 'hidden'
    });

    var showVideoOnce = function () {
      v.style.visibility = 'visible';
      v.removeEventListener('loadeddata', showVideoOnce);
      v.removeEventListener('canplay', showVideoOnce);
    };
    v.addEventListener('loadeddata', showVideoOnce);
    v.addEventListener('canplay', showVideoOnce);

    overlay.appendChild(v);
    document.body.appendChild(overlay);

    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        overlay.style.transform = 'translateY(0)';
        overlay.style.opacity = '1';
      });
    });

    var wentFullscreen = false;
    function requestFS() {
      if (wentFullscreen) return;
      wentFullscreen = true;
      var reqFS = v.requestFullscreen || v.webkitRequestFullscreen || v.msRequestFullscreen;
      if (reqFS) {
        try { reqFS.call(v); } catch (e) {}
      } else if (v.webkitEnterFullscreen) {
        try { v.webkitEnterFullscreen(); } catch (e) {}
      }
    }
    overlay.addEventListener('transitionend', function (e) {
      if (e.propertyName === 'opacity' || e.propertyName === 'transform') {
        requestFS();
      }
    }, { once: true });

    function cleanup() {
      try { v.pause(); } catch(e){}
      overlay.remove();
      document.removeEventListener('keydown', onEsc);
      document.removeEventListener('webkitfullscreenchange', onFsChange, true);
      document.removeEventListener('fullscreenchange', onFsChange, true);
    }
    function onEsc(e) {
      if (e.key === 'Escape') {
        if (document.fullscreenElement) document.exitFullscreen().catch(function(){});
        else cleanup();
      }
    }
    function onFsChange() {
      if (!document.fullscreenElement && !document.webkitFullscreenElement) {
        cleanup();
      }
    }
    document.addEventListener('keydown', onEsc);
    document.addEventListener('fullscreenchange', onFsChange, true);
    document.addEventListener('webkitfullscreenchange', onFsChange, true);

    v.play().catch(function(){});
  }

  trigger.addEventListener('click', function(e){
    e.preventDefault();
    var fsUrl  = trigger.getAttribute('data-fs-src') || '';
    var fsType = trigger.getAttribute('data-fs-type') || '';
    if (!fsUrl) fsUrl = getVideoSrc(inlineVideo);
    openFullscreenVideo(fsUrl, fsType);
  });
})();
</script>
