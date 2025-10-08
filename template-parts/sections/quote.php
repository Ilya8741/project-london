<div class="quote-section <?php if (get_sub_field('spacing')): ?>spacing<?php endif; ?> <?php if (get_sub_field('medium_width')): ?> quote-medium-width<?php endif; ?>" data-aos="fade-right">
    <div class="quote-wrapper main-container">
            <?php if (get_sub_field('quote_subtitle')): ?>
                <span class="quote-subtitle">
                    <?php the_sub_field('quote_subtitle'); ?>
                </span>
            <?php endif; ?>
       
        <h2 class="quote-title">
            <?php the_sub_field('quote_title'); ?>
        </h2>
           <?php if (get_sub_field('quote_text')): ?>
                <span class="quote-text">
                    <?php the_sub_field('quote_text'); ?>
                </span>
            <?php endif; ?>
            <a href="<?php the_sub_field('quote_button_url'); ?>" class="quote-button main-button">
                <span><?php the_sub_field('quote_button_text'); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
                    <path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
                </svg>
            </a>
    </div>
</div>
