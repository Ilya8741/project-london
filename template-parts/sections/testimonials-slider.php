<?php
$slides = get_sub_field('hero_slides');
$slides_count = is_array($slides) ? count($slides) : 0;
?>
<div class="hero-slider testimonials-hero-slider <?php if (get_sub_field('spacing_top')): ?> hero-slider-top-none<?php endif; ?>" data-aos="fade-up" data-aos-offset="200" data-aos-delay="200">
    <div class="hero-slider-wrapper">
       
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
                        $title  = get_sub_field('slide_title');
                        $subtitle  = get_sub_field('slide_subtitle');
                        $text  = get_sub_field('slide_text');
                    ?>
                        <div class="swiper-slide">
                           
                                <div class="hero-slider-item">
                                    <?php if ($image): ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    <?php endif; ?>
                                </div>
                                <?php if ($title): ?><p class="slide-text slide-text-testimonials"><?php echo esc_html($title); ?></p><?php endif; ?>
                                <?php if ($subtitle): ?><p class="slide-subtitle"><?php echo esc_html($subtitle); ?></p><?php endif; ?>
                                     <?php if ($text): ?><p class="slide-bottom-text"><?php echo esc_html($text); ?></p><?php endif; ?>

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