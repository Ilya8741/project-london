<div class="quote-section">
    <div class="quote-wrapper main-container">
        <div class="quote-title">
            <?php the_sub_field('quote_title'); ?>
        </div>
        <a href="<?php the_sub_field('quote_button_url'); ?>" class="quote-button main-button">
            <span><?php the_sub_field('quote_button_text'); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
                <path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
            </svg>
        </a>
    </div>
</div>