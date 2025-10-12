<div class="insights-article  <?php if (get_sub_field('bottom_spacing')): ?> insights-article-bottom-spacing<?php endif; ?>">
    <div class="insights-article-wrapper">
        <div class="insights-article-media-wrapper" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
            <?php $image1 = get_sub_field('main_image'); ?>
            <?php if ($image1): ?>
                <img src="<?php echo esc_url($image1['url']); ?>" class="article-hero-image" alt="<?php echo esc_attr($image1['alt']); ?>">
            <?php endif; ?>
            <?php
            $hero_video = get_sub_field('main_video');
            if ($hero_video): ?>
                <video autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($hero_video['url']); ?>" class="article-hero-video" type="<?php echo esc_attr($hero_video['mime_type']); ?>">
                </video>
            <?php endif; ?>
        </div>
        <div class="insights-article-content-wrapper" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
            <h2 class="insights-article-title">
                <?php the_sub_field('article_title'); ?>
            </h2>
            <div class="insights-article-excerpt">
                <?php
                $pid = get_queried_object_id();
                $excerpt = get_the_excerpt($pid);
                if ('' === trim((string) $excerpt)) {
                    $raw = get_post_field('post_content', $pid);
                    $excerpt = wp_trim_words(wp_strip_all_tags($raw), 30, '…');
                }
                echo esc_html($excerpt);
                ?>
            </div>
            <?php
            $url        = get_permalink();
            $title      = wp_strip_all_tags(get_the_title());

            $u = rawurlencode($url);
            $t = rawurlencode($title);

            $linkedin = "https://www.linkedin.com/sharing/share-offsite/?url={$u}";
            $facebook = "https://www.facebook.com/sharer/sharer.php?u={$u}";
            $x        = "https://twitter.com/intent/tweet?text={$t}&url={$u}";
            ?>
            <div class="insights-article-share-wrapper" data-share-url="<?php echo esc_url($url); ?>">
                <span class="insights-article-share-label">Share</span>
                <div class="insights-article-share-icons">
                <!-- Copy link -->
                <button type="button" class="share-btn share-copy" aria-label="Copy link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10" fill="none">
                        <path d="M6.75 8.75H5.25C4.25544 8.75 3.30161 8.35491 2.59835 7.65165C1.89509 6.94839 1.5 5.99456 1.5 5C1.5 4.00544 1.89509 3.05161 2.59835 2.34835C3.30161 1.64509 4.25544 1.25 5.25 1.25H6.75" stroke="#2B2B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.25 1.25H12.75C13.7446 1.25 14.6984 1.64509 15.4017 2.34835C16.1049 3.05161 16.5 4.00544 16.5 5C16.5 5.99456 16.1049 6.94839 15.4017 7.65165C14.6984 8.35491 13.7446 8.75 12.75 8.75H11.25" stroke="#2B2B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6 5H12" stroke="#2B2B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <!-- LinkedIn -->
                <a class="share-btn share-linkedin" href="<?php echo esc_url($linkedin); ?>"
                    target="_blank" rel="noopener" aria-label="Share on LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18.8156 4H5.18125C4.52812 4 4 4.51563 4 5.15313V18.8438C4 19.4813 4.52812 20 5.18125 20H18.8156C19.4688 20 20 19.4813 20 18.8469V5.15313C20 4.51563 19.4688 4 18.8156 4ZM8.74687 17.6344H6.37188V9.99687H8.74687V17.6344ZM7.55938 8.95625C6.79688 8.95625 6.18125 8.34062 6.18125 7.58125C6.18125 6.82188 6.79688 6.20625 7.55938 6.20625C8.31875 6.20625 8.93437 6.82188 8.93437 7.58125C8.93437 8.3375 8.31875 8.95625 7.55938 8.95625ZM17.6344 17.6344H15.2625V13.9219C15.2625 13.0375 15.2469 11.8969 14.0281 11.8969C12.7937 11.8969 12.6062 12.8625 12.6062 13.8594V17.6344H10.2375V9.99687H12.5125V11.0406H12.5437C12.8594 10.4406 13.6344 9.80625 14.7875 9.80625C17.1906 9.80625 17.6344 11.3875 17.6344 13.4438V17.6344Z" fill="#2B2B2B" />
                    </svg>
                </a>

                <!-- Facebook -->
                <a class="share-btn share-facebook" href="<?php echo esc_url($facebook); ?>"
                    target="_blank" rel="noopener" aria-label="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                        <path d="M8.99814 0.956055C4.56367 0.956055 0.96875 4.55097 0.96875 8.98544C0.96875 12.7509 3.56128 15.9106 7.05856 16.7784V11.4392H5.4029V8.98544H7.05856V7.92813C7.05856 5.19525 8.29541 3.92853 10.9785 3.92853C11.4872 3.92853 12.365 4.02842 12.7241 4.12798V6.35212C12.5346 6.33221 12.2054 6.32225 11.7965 6.32225C10.48 6.32225 9.9713 6.82104 9.9713 8.11763V8.98544H12.594L12.1434 11.4392H9.9713V16.9561C13.9471 16.4759 17.0278 13.0907 17.0278 8.98544C17.0275 4.55097 13.4326 0.956055 8.99814 0.956055Z" fill="#2B2B2B" />
                    </svg>
                </a>

                <!-- X (Twitter) -->
                <a class="share-btn share-x" href="<?php echo esc_url($x); ?>"
                    target="_blank" rel="noopener" aria-label="Share on X (Twitter)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M16.6009 4.61523H19.0544L13.6943 10.7414L20 19.0778H15.0627L11.1957 14.0218L6.77087 19.0778H4.31595L10.049 12.5251L4 4.61523H9.06262L12.5581 9.23657L16.6009 4.61523ZM15.7399 17.6093H17.0993L8.32392 6.0066H6.86506L15.7399 17.6093Z" fill="#2B2B2B" />
                    </svg>
                </a>
                </div>
            </div>
            <div class="insights-article-large-paragraph">
                <?php the_sub_field('large_paragraph'); ?>
            </div>
        </div>

    </div>
</div>

<script>
(function () {
  function copyFallback(text) {
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.setAttribute('readonly', '');
    ta.style.position = 'fixed';
    ta.style.top = '-9999px';
    document.body.appendChild(ta);
    ta.select();
    try { document.execCommand('copy'); } catch(e) {}
    document.body.removeChild(ta);
  }

  async function copyUrl(url) {
    try {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(url);
      } else {
        copyFallback(url);
      }
      return true;
    } catch (e) {
      copyFallback(url);
      return false;
    }
  }

  function showCopied(btn) {
    let tip = btn.querySelector('.share-tip');
    if (!tip) {
      tip = document.createElement('span');
      tip.className = 'share-tip';
      tip.textContent = 'Copied!';
      btn.appendChild(tip);
      requestAnimationFrame(() => tip.classList.add('is-visible'));
    } else {
      tip.classList.add('is-visible');
    }
    clearTimeout(btn._copiedTimer);
    btn._copiedTimer = setTimeout(() => {
      tip.classList.remove('is-visible');
    }, 1500);
  }

  document.addEventListener('click', async function(e) {
    const copyBtn = e.target.closest('.share-copy');
    if (copyBtn) {
      const wrap = copyBtn.closest('.insights-article-share-wrapper');
      const url  = (wrap && wrap.dataset.shareUrl) ? wrap.dataset.shareUrl : location.href;

      if (navigator.share && /Mobi|Android/i.test(navigator.userAgent)) {
        try {
          await navigator.share({ title: document.title, url });
          return;
        } catch(_) {}
      }

      const ok = await copyUrl(url);
      if (ok) showCopied(copyBtn);
      return;
    }

    const a = e.target.closest('.share-linkedin, .share-facebook, .share-x');
    if (a) {
      e.preventDefault();
      const w = 600, h = 550;
      const y = window.top.outerHeight/2 + window.top.screenY - (h/2);
      const x = window.top.outerWidth/2 + window.top.screenX - (w/2);
      window.open(a.href, 'share', `width=${w},height=${h},left=${x},top=${y},noopener`);
    }
  });
})();
</script>
