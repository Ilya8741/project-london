<div class="careers-slider">
 <?php if (get_sub_field('title')): ?>
  <div class="careers-slider-title-wrapper"
       data-aos="fade-right"
       data-aos-duration="600"
       data-aos-delay="100"
       data-aos-easing="ease-out">
    <div class="careers-slider-title">
      <?php the_sub_field('title'); ?>
    </div>
  </div>
<?php endif; ?>


    <div class="careers-slider-wrapper"
        data-aos="fade-up"
        data-aos-duration="600"
        data-aos-delay="300"
        data-aos-easing="ease-out"
        style="opacity: 0; transform: translateY(30px); transition: opacity .6s ease, transform .6s ease;">

        <div class="careers-slider-swiper swiper">
            <?php
            $slides = [];

            if (have_rows('images')) :
                while (have_rows('images')) : the_row();
                    $image = get_sub_field('image');
                    if ($image) {
                        $slides[] = $image;
                    }
                endwhile;
            endif;
            ?>

            <div class="swiper-wrapper">
                <?php for ($i = 0; $i < 2; $i++): ?>
                    <?php foreach ($slides as $image): ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiperEl = document.querySelector(".careers-slider-swiper");
            const wrapperEl = document.querySelector(".careers-slider-wrapper");

            if (!swiperEl) return;

            const images = swiperEl.querySelectorAll("img");
            let loadedCount = 0;

            images.forEach(img => {
                if (img.complete) {
                    loadedCount++;
                } else {
                    img.addEventListener("load", () => {
                        loadedCount++;
                        if (loadedCount === images.length) initSwiper();
                    });
                    img.addEventListener("error", () => {
                        loadedCount++;
                        if (loadedCount === images.length) initSwiper();
                    });
                }
            });

            if (loadedCount === images.length) initSwiper();

            function initSwiper() {
                new Swiper(".careers-slider-swiper", {
                    loop: true,
                    spaceBetween: 8,
                    slidesPerView: 1.1,
                    breakpoints: {
                        992: {
                            spaceBetween: 20,
                            slidesPerView: 2.3,
                        },
                    },
                });

                requestAnimationFrame(() => {
                    wrapperEl.style.opacity = "1";
                    wrapperEl.style.transform = "translateY(0)";
                });

                if (typeof AOS !== "undefined") {
                    AOS.refresh();
                }
            }
        });
    </script>
</div>