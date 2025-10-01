<div class="article-hero">
    <div class="article-hero-wrapper">
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
</div>