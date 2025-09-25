<div class="studio-hero">
    <div class="studio-hero-wrapper">
        <h1 class="studio-hero-title" data-aos="fade-left">
            <?php the_sub_field('title'); ?>
        </h1>
        <div class="studio-hero-grid" data-aos="fade-right">
               <?php $image1 = get_sub_field('image1'); ?>
            <?php if ($image1): ?>
                <img src="<?php echo esc_url($image1['url']); ?>" class="studio-hero-image" alt="<?php echo esc_attr($image1['alt']); ?>">
            <?php endif; ?>
               <?php $image2 = get_sub_field('image2'); ?>
            <?php if ($image2): ?>
                <img src="<?php echo esc_url($image2['url']); ?>" class="studio-hero-image" alt="<?php echo esc_attr($image2['alt']); ?>">
            <?php endif; ?>
        </div>
    </div>
</div>