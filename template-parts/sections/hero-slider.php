<style>
    .hero-slider-header {
        padding: 0 20px 60px 20px;
        display: flex;
        align-items: flex-end;
        gap: 20px;
        justify-content: space-between;
        width: 100%;
    }

    .hero-slider-wrapper {
        max-width: 1440px;
        margin: 0 auto;
    }

  
    .hero-slider-swiper {
        padding: 0 20px;
    }

    .hero-slider-header-main {
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-width: 850px;

    }

    .hero-slider-text {
        color: #717171;
        font-family: "Public Sans";
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 155%;
        letter-spacing: -0.4px;
    }


    .hero-slider-title {
        color: #2B2B2B;
        font-family: "Test Newzald";
        font-size: 32px;
        font-style: normal;
        font-weight: 400;
        line-height: 124%;
        letter-spacing: -0.4px;
    }

    .hero-slider-item {
        display: flex;
        position: relative;
    }

    .hero-slider-icon {
        position: absolute;
        right: 0;
        bottom: 0;
        padding: 0;
        height: 50px;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #2B2B2B;
        border: 1px solid #2B2B2B;
        transition: all .3s ease;
    }

    .hero-slider-icon svg {
        min-width: 16px;
        width: 16px;
        height: 16px;
    }

    .hero-slider-icon svg path{
        transition: all .3s ease;
    }

    .hero-slider-swiper .swiper-slide img {
        aspect-ratio: 453 / 630;
        height: auto;
        width: 100%;
        object-fit: cover;
    }

    .slide-text {
        color: #2B2B2B;
        font-family: "Test Newzald";
        font-size: 24px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
        letter-spacing: -0.4px;
        margin-top: 16px;
    }

    .hero-slider {
        padding: 160px 0;
    }

    .slider-section-button {
       border: 1px solid rgba(113, 113, 113, 0.25);
    }

    .hero-slider-swiper .swiper-slide:hover .hero-slider-icon{
        background: #fff;
    }

    .hero-slider-swiper .swiper-slide:hover .hero-slider-icon svg path{
        stroke: #2B2B2B;
    }

    @media(max-width: 992px) {
        .hero-slider-swiper {
            padding: 0 0 0 24px;
        }

        .hero-slider-header {
            padding: 0 24px 48px 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            padding-bottom: 48px;
        }

        .hero-slider-text {
            font-size: 16px;
        }

        .hero-slider {
            padding: 80px 0;
        }

        .hero-slider-title {
            font-size: 28px;
        }

        .slide-text {
            font-size: 20px;
            line-height: 110%;
        }
    }
</style>

<div class="hero-slider">
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
            slidesPerView: 1.1,
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