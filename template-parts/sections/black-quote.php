

<div class="black-quote" data-theme="dark">
    <div class="black-quote-wrapper">
        <div class="black-quote-top" data-aos="fade-right">
   <?php if (get_sub_field('quote_subtitle')): ?>
                <span class="black-quote-subtitle">
                    <?php the_sub_field('quote_subtitle'); ?>
                </span>
            <?php endif; ?>
       
        <h2 class="black-quote-title">
            <?php the_sub_field('quote_title'); ?>
        </h2>
           <?php if (get_sub_field('quote_text')): ?>
                <div class="black-quote-text">
                    <?php the_sub_field('quote_text'); ?>
                </div>
            <?php endif; ?>
        <a href="<?php the_sub_field('quote_button_url'); ?>" class="black-quote-button main-button">
            <span><?php the_sub_field('quote_button_text'); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
            </svg>
        </a>
        </div>
        <div class="black-quote-image-wrapper" data-aos="fade-left">
            <?php $image1 = get_sub_field('image'); ?>
            <?php if ($image1): ?>
                <img src="<?php echo esc_url($image1['url']); ?>" class="black-quote-image" alt="<?php echo esc_attr($image1['alt']); ?>">
            <?php endif; ?>
        </div>
    </div>
</div>