<div class="grid-section">
    <?php
    $grid_image = get_sub_field('grid_image_bg');
    if ($grid_image): ?>
        <img src="<?php echo esc_url($grid_image['url']); ?>" class="grid-image-bg" alt="<?php echo esc_attr($grid_image['alt']); ?>">
    <?php endif; ?>
    <div class="grid-section-wrapper">
        <div class="grid-section-wrapper-top">
            <!-- Item 1 -->
            <div class="grid-section-item grid-section-item-1" data-aos="fade-right">
                <a href="<?php the_sub_field('item1_link'); ?>" class="grid-section-link">
                    <div class="grid-section-image-wrapper">
                        <?php $image1 = get_sub_field('item1_image'); ?>
                        <?php if ($image1): ?>
                            <img src="<?php echo esc_url($image1['url']); ?>" alt="<?php echo esc_attr($image1['alt']); ?>">
                        <?php endif; ?>
                        <span class="grid-section-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M0.771484 1H17.2286V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M0.771484 17L17.2286 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>

                    <div class="grid-section-text"><?php the_sub_field('item1_text'); ?></div>
                </a>
            </div>

            <!-- Item 2 -->
            <div class="grid-section-item grid-section-item-2" data-aos="fade-left">
                <a href="<?php the_sub_field('item2_link'); ?>" class="grid-section-link">
                    <div class="grid-section-image-wrapper">
                            <?php $image2 = get_sub_field('item2_image'); ?>
                    <?php if ($image2): ?>
                        <img src="<?php echo esc_url($image2['url']); ?>" alt="<?php echo esc_attr($image2['alt']); ?>">
                    <?php endif; ?>
  <span class="grid-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M0.771484 1H17.2286V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M0.771484 17L17.2286 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                    </span>
                    </div>
                
                    <div class="grid-section-text"><?php the_sub_field('item2_text'); ?></div>
                  
                </a>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="grid-section-item grid-section-item-3" data-aos="fade-up">
            <a href="<?php the_sub_field('item3_link'); ?>" class="grid-section-link">
                <div class="grid-section-image-wrapper">
<?php $image3 = get_sub_field('item3_image'); ?>
                <?php if ($image3): ?>
                    <img src="<?php echo esc_url($image3['url']); ?>" alt="<?php echo esc_attr($image3['alt']); ?>">
                <?php endif; ?>
                    <span class="grid-section-icon">
                   <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M0.771484 1H17.2286V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M0.771484 17L17.2286 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                </span>
                </div>
                
                <div class="grid-section-text"><?php the_sub_field('item3_text'); ?></div>
            
            </a>
        </div>
    </div>
</div>
