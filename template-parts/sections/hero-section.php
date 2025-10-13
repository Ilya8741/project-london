<div class="hero-section">
    <div class="hero-section-wrapper">
        <div class="main-container">
            <h1 class="hero-section-title">
                <?php the_sub_field('hero_title'); ?>
            </h1>
        </div>
        <div class="hero-section-image-wrapper">
            <?php
            $hero_video = get_sub_field('hero_video');
            if ($hero_video): ?>
                <video autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($hero_video['url']); ?>" type="<?php echo esc_attr($hero_video['mime_type']); ?>">
                </video>
            <?php endif; ?>

            <?php if (get_sub_field('hero_button_text')): ?>
                <button class="hero-section-button main-button">
                    <span><?php the_sub_field('hero_button_text'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
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
  if (!trigger || !inlineVideo) return;

  function getVideoSrc(v) {
    var s = v.querySelector('source');
    return (s && s.src) || v.currentSrc || v.src || '';
  }

  function openFullscreenVideo(url) {
    if (!url) return;

    var v = document.createElement('video');
    v.src = url;
    v.controls = true;
    v.autoplay = true;
    v.muted = false;
    v.playsInline = false;
    v.preload = 'auto';
    v.style.position = 'fixed';
    v.style.inset = '0';
    v.style.width = '100%';
    v.style.height = '100%';
    v.style.background = '#000';
    v.style.zIndex = '2147483647'; 
    document.body.appendChild(v);

    function cleanup() {
      try { v.pause(); } catch(e){}
      v.remove();
      document.removeEventListener('keydown', onEsc);
      document.removeEventListener('webkitfullscreenchange', onFsChange, true);
      document.removeEventListener('fullscreenchange', onFsChange, true);
    }
    function onEsc(e) {
      if (e.key === 'Escape') {
        if (document.fullscreenElement) document.exitFullscreen();
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

    var reqFS = v.requestFullscreen || v.webkitRequestFullscreen || v.msRequestFullscreen;
    if (reqFS) {
      try { reqFS.call(v); } catch(e){}
    } else if (v.webkitEnterFullscreen) {
      try { v.webkitEnterFullscreen(); } catch(e){}
    }

    v.play().catch(function(){  });
  }

  trigger.addEventListener('click', function(e){
    e.preventDefault();
    openFullscreenVideo(getVideoSrc(inlineVideo));
  });
})();
</script>
