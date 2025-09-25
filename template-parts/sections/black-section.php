<div class="black-section">
    <div class="black-section-wrapper">
        <div class="black-section-content">
            <h3 class="black-title">
                <?php the_sub_field('black_title'); ?>
            </h3>
            <div class="black-section-content-bottom">
                <p class="black-right-text">
                    <?php the_sub_field('black_text'); ?>
                </p>
                <?php if (get_sub_field('black_button_text')): ?>
                    <a href="<?php the_sub_field('black_button_url'); ?>" class="black-section-button main-button">
                        <span><?php the_sub_field('black_button_text'); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                            <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="black-section-image-wrapper">
            <?php $image1 = get_sub_field('black_image'); ?>
            <?php if ($image1): ?>
                <img src="<?php echo esc_url($image1['url']); ?>" class="black-section-image" alt="<?php echo esc_attr($image1['alt']); ?>">
            <?php endif; ?>
        </div>
    </div>
</div>
