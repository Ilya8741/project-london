<?php
$items = get_sub_field('process_repeater');
if ($items && is_array($items) && count($items)) :
    $slides_count = count($items);
    $loop   = $slides_count > 1;
    $autoplay = $slides_count > 1;
?>
    <section class="process-slider  <?php if (get_sub_field('top_mobile_spacing')): ?> process-slider-top<?php endif; ?>">
        <div class="swiper process-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($items as $row):
                    $subtitle = !empty($row['subtitle']) ? esc_html($row['subtitle']) : '';
                    $title    = !empty($row['title'])    ? esc_html($row['title'])    : '';
                    $text_raw = !empty($row['text']) ? $row['text'] : '';
                    $text     = wpautop(wp_kses_post($text_raw));
                ?>
                    <div class="swiper-slide">
                        <div class="process-card" data-aos="fade-right" data-aos-delay="<?php echo esc_attr($delay); ?>">
                            <?php if ($subtitle): ?><div class="process-subtitle"><?php echo $subtitle; ?></div><?php endif; ?>
                            <?php if ($title):    ?><h3 class="process-title"><?php echo $title; ?></h3><?php endif; ?>
                            <?php if ($text):     ?><div class="process-text"><?php echo $text; ?></div><?php endif; ?>
                        </div>
                    </div>
                    <?php $delay += 100; ?>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <script>
       document.addEventListener('DOMContentLoaded', () => {
        const el = document.querySelector('.process-swiper');
        if (!el) return;

            const swiper = new Swiper(el, {
                loop: true,
                speed: 600,
                spaceBetween: 8,
                slidesPerView: 1.1, 
                breakpoints: {
                768: { spaceBetween: 20,slidesPerView: 2.1,  },
                992: { spaceBetween: 20,slidesPerView: 3.1,  }
                }
            });
        });
    </script>

    <style>
        .process-card {
            padding: 32px;
            background: #fff;
        }

        .process-subtitle {
            color: #717171;

            font-family: "Public Sans", sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 300;
            line-height: 140%;
            /* 22.4px */
            letter-spacing: -0.4px;
        }

        .process-title {
            color: #2B2B2B;

            /* Desktop/H7 */
            font-family: "Test Newzald", sans-serif;
            font-size: 24px;
            font-style: normal;
            font-weight: 400;
            line-height: 130%;
            /* 31.2px */
            letter-spacing: -0.4px;
            display: block;
            margin: 4px 0 8px 0;
        }

        .process-text p {
            color: #2B2B2B;

            font-family: "Public Sans", sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 300;
            line-height: 140%;
            /* 22.4px */
            letter-spacing: -0.4px;
        }

        .process-swiper .swiper-wrapper {
        align-items: stretch; 
        }

        .process-swiper .swiper-slide {
        display: flex;
        height: auto;
        }

        .process-card {
        display: flex;
        flex-direction: column;
            height: 100%;             
        }

    </style>
<?php
endif;
