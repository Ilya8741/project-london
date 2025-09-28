<div class="services-hero">
    <div class="services-hero-wrapper">
        <div class="services-hero-header">
            <h1 class="services-hero-title" data-aos="fade-right">
                <?php the_sub_field('title'); ?>
            </h1>
            <p class="services-hero-text" data-aos="fade-left">
                <?php the_sub_field('text'); ?>
            </p>
        </div>
        <div class="services-hero-repeater">
            <div class="services-hero-repeater-grid">
                <?php if (have_rows('services_repeater')): ?>
                <?php $delay = 100; ?>
                <?php while (have_rows('services_repeater')): the_row();
                    $text = get_sub_field('subtitle');
                    $number = get_sub_field('number');
                ?>
                    <div class="services-hero-item" data-aos="fade-right" data-aos-delay="<?php echo esc_attr($delay); ?>">
                        <p class="services-key"><?php echo esc_html($text); ?></p>
                        <p class="services-number"><?php echo esc_html($number); ?></p>
                    </div>
                    <?php $delay += 100; ?>
                <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
