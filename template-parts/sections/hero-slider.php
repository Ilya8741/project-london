<?php
$slides = get_sub_field('hero_slides');
$slides_count = is_array($slides) ? count($slides) : 0;
?>
<div class="hero-slider <?php if (get_sub_field('spacing_top')): ?> hero-slider-top-none<?php endif; ?>" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">
    <div class="hero-slider-wrapper">
        <?php if (get_sub_field('slider_title')): ?> <div class="hero-slider-header">
                <div class="hero-slider-header-main">
                    <p class="hero-slider-text"> <?php the_sub_field('slider_text'); ?> </p>
                    <p class="hero-slider-title"> <?php the_sub_field('slider_title'); ?> </p>
                </div> <?php if (get_sub_field('hero_button_text')): ?> <a href="<?php the_sub_field('hero_button_url'); ?>" class="slider-section-button main-button"> <span><?php the_sub_field('hero_button_text'); ?></span> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                            <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                        </svg> </a> <?php endif; ?>
            </div> <?php endif; ?>
        <div class="hero-slider-swiper swiper _swiper" data-slides-count="<?php echo (int)$slides_count; ?>">
            <div class="swiper-wrapper">

                <?php if ($slides_count === 2): ?>
                    <div class="swiper-slide swiper-slide--ghost" aria-hidden="true">
                        <div class="hero-slider-item hero-slider-item--ghost"></div>
                        <p class="slide-text" hidden></p>
                    </div>
                <?php endif; ?>

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
                                    <span class="hero-slider-icon"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                                            <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                                        </svg> </span>
                                </div>
                                <?php if ($text): ?><p class="slide-text"><?php echo esc_html($text); ?></p><?php endif; ?>
                                <?php if ($link): ?>
                                </a><?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var el = document.querySelector(".hero-slider-swiper");
        if (!el) return;

        var count = parseInt(el.getAttribute("data-slides-count") || "0", 10);
        var onlyTwo = count === 2;

        new Swiper(el, {
            loop: !onlyTwo,
            slidesPerView: 1.05,
            spaceBetween: 8,
            watchOverflow: true,

            breakpoints: {
                768: {
                    slidesPerView: 2.1,
                    spaceBetween: 20
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 20
                } 
            }
        });
    });
</script>