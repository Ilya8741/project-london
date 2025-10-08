<div class="article-hero">
    <div class="article-hero-wrapper">
        <div class="article-hero-media-wrapper" data-theme="dark">
            <?php $image1 = get_sub_field('featured_image'); ?>
            <?php if ($image1): ?>
                <img src="<?php echo esc_url($image1['url']); ?>" class="article-hero-image" alt="<?php echo esc_attr($image1['alt']); ?>">
            <?php endif; ?>
            <?php
            $hero_video = get_sub_field('featured_video');
            if ($hero_video): ?>
                <video autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($hero_video['url']); ?>" class="article-hero-video" type="<?php echo esc_attr($hero_video['mime_type']); ?>">
                </video>
            <?php endif; ?>
        </div>
        <div class="article-hero-content">
            <div class="article-hero-content-left"  data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                <h1 class="article-hero-title"><?php echo esc_html(get_the_title()); ?></h1>
            <?php $excerpt = get_the_excerpt(); ?>
            <?php if ($excerpt) : ?>
                <div class="article-hero-excerpt"><?php echo wp_kses_post($excerpt); ?></div>
            <?php endif; ?>
            </div>
            <div class="article-spoiler" data-open="false"  data-aos="fade-left" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
                <button class="article-spoiler__toggle" type="button" aria-expanded="false">
                    <span>Services provided</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <line x1="8.5" y1="0.5" x2="8.5" y2="15.5" stroke="black" stroke-linecap="round"/>
                    <line x1="0.5" y1="7.5" x2="15.5" y2="7.5" stroke="black" stroke-linecap="round"/>
                    </svg>
                </button>
                <div class="article-spoiler__panel" aria-hidden="true">
                    <div class="article-tags-grid">
                        <?php $tags = get_the_tags(); ?>
                        <?php if ($tags) : foreach ($tags as $tag) : ?>
                                <span class="article-tag">
                                    <?php echo esc_html($tag->name); ?>
                                </span>
                            <?php endforeach;
                        else : ?>
                            <span class="article-tag article-tag--empty">No tags</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<script>
    (function() {
        var sp = document.querySelector('.article-spoiler');
        if (!sp) return;
        var btn = sp.querySelector('.article-spoiler__toggle');
        var panel = sp.querySelector('.article-spoiler__panel');

        function open() {
            panel.style.height = panel.scrollHeight + 'px';
            panel.style.opacity = '1';
            sp.dataset.open = 'true';
            btn.setAttribute('aria-expanded', 'true');
            panel.setAttribute('aria-hidden', 'false');
            panel.addEventListener('transitionend', function setAutoHeight(e) {
                if (e.propertyName === 'height') {
                    panel.style.height = 'auto';
                    panel.removeEventListener('transitionend', setAutoHeight);
                }
            });
        }

        function close() {
            panel.style.height = panel.scrollHeight + 'px';
            requestAnimationFrame(function() {
                panel.style.height = '0px';
                panel.style.opacity = '0';
                sp.dataset.open = 'false';
                btn.setAttribute('aria-expanded', 'false');
                panel.setAttribute('aria-hidden', 'true');
            });
        }

        btn.addEventListener('click', function() {
            sp.dataset.open === 'true' ? close() : open();
        });
    })();
</script>