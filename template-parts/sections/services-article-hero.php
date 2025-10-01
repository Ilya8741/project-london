<div class="services-article-hero">
    <div class="services-article-hero-wrapper">
        <div class="services-article-hero-content"  data-aos="fade-right">
            <div class="services-article-hero-top">
                <p class="services-article-hero-subtitle">
                    <?php the_sub_field('subtitle'); ?>
                </p>
                <h2 class="services-article-hero-title <?php if (get_sub_field('medium_width')): ?> small-box<?php endif; ?>">
                    <?php the_sub_field('title'); ?>
                </h2>
            </div>

            <div class="services-article-hero-content-bottom services-article-hero-content-bottom-desktop">
                <p class="services-article-hero-bold-text">
                    <?php the_sub_field('bold_text'); ?>
                </p>
                <p class="services-article-hero-text">
                    <?php the_sub_field('text'); ?>
                </p>
            </div>
        </div>
        <div class="services-article-hero-image-wrapper"  data-aos="fade-left">
            <?php $image1 = get_sub_field('image'); ?>
            <?php if ($image1): ?>
                <img src="<?php echo esc_url($image1['url']); ?>" class="services-article-hero-image" alt="<?php echo esc_attr($image1['alt']); ?>">
            <?php endif; ?>
        </div>
        <div class="services-article-hero-content-bottom services-article-hero-content-bottom-mobile">
            <p class="services-article-hero-bold-text">
                <?php the_sub_field('bold_text'); ?>
            </p>
            <p class="services-article-hero-text">
                <?php the_sub_field('text'); ?>
            </p>
        </div>
    </div>
</div>