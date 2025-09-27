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
                <a href="<?php the_sub_field('hero_button_url'); ?>" class="hero-section-button main-button">
                    <span><?php the_sub_field('hero_button_text'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
                        <path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
