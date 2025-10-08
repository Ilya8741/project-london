<div class="newsletter-signup" data-theme="dark">
    <div class="newsletter-signup-wrapper" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
        <h2 class="newsletter-signup-title">
            <?php the_sub_field('title'); ?>
        </h2>
        <div class="newsletter-signup-text">
            <?php the_sub_field('text'); ?>
        </div>
        <?php if (get_sub_field('button_text')): ?>
            <a href="<?php the_sub_field('button_url'); ?>" class="insights-featured__btn newsletter-signup-btn main-button">
                <span><?php the_sub_field('button_text'); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                    <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                </svg>
            </a>
        <?php endif; ?>
    </div>
</div>