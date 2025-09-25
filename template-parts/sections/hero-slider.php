<div class="hero-slider" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">
    <div class="hero-slider-wrapper">
        <div class="hero-slider-header">
            <div class="hero-slider-header-main">
                <p class="hero-slider-text">
                    <?php the_sub_field('slider_text'); ?>
                </p>
                <p class="hero-slider-title">
                    <?php the_sub_field('slider_title'); ?>
                </p>
            </div>
            <?php if (get_sub_field('hero_button_text')): ?>
                <a href="<?php the_sub_field('hero_button_url'); ?>" class="slider-section-button main-button">
                    <span><?php the_sub_field('hero_button_text'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round"/>
                        <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>

        <div class="hero-slider-swiper swiper _swiper">
            <div class="swiper-wrapper">
                <?php if (have_rows('hero_slides')): ?>
                    <?php while (have_rows('hero_slides')): the_row();
                        $image = get_sub_field('slide_image');
                        $link  = get_sub_field('slide_link');
                        $text  = get_sub_field('slide_text');
                    ?>
                        <div class="swiper-slide">
                            <?php if ($link): ?><a href="<?php echo esc_url($link); ?>"><?php endif; ?>
                                <div class="hero-slider-item">
                                    <?php if ($image): ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    <?php endif; ?>
                                    <span class="hero-slider-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                                            <path d="M1.43945 1H17.8966V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1.43945 17L17.8966 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                <?php if ($text): ?>
                                    <p class="slide-text"><?php echo esc_html($text); ?></p>
                                <?php endif; ?>
                            <?php if ($link): ?></a><?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".hero-slider-swiper", {
            loop: true,
            slidesPerView: 1.05,
            spaceBetween: 8,

            breakpoints: {
                768: {
                    slidesPerView: 2.1,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
            },
        });
    });
</script>