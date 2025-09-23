<style>
    /* main-button */

    .main-button {
        display: flex;
        gap: 12px;
        align-items: center;
        padding: 14px 24px;
        color: #2B2B2B;
        font-family: "Public Sans";
        font-size: 16px;
        font-style: normal;
        font-weight: 300;
        line-height: 140%;
        background: #fff;
        transition: all .3s ease;
        text-decoration: none;
    }

    .hero-section-button.main-button {
        position: absolute;
        right: 20px;
        bottom: 20px;
        background: #fff;
        color: #2B2B2B;
    }

    .main-button svg {
        min-width: 12px;
        width: 12px;
        height: 12px;
    }

    .main-button svg path {
        transition: all .3s ease;
    }

    .main-button:hover svg path {
        stroke: #fff;
    }

    .main-button:hover {
        background: #2B2B2B;
        color: #fff;
    }

    /* main-button */

    .hero-section-title {
        max-width: 830px;
        color: #2B2B2B;
        font-family: "Test Newzald";
        font-size: 72px;
        font-style: normal;
        font-weight: 400;
        line-height: 90%;
        padding: 80px 0;
        margin: 0 0 0 auto;
    }

    .hero-section-image-wrapper {
        position: relative;
        display: flex;

    }

    .hero-section-image-wrapper video {
        aspect-ratio: 16/9;
        width: 100%;
        height: auto;
        object-fit: cover;
        max-width: 100%;
    }

    .hero-section-wrapper .main-container{
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media(max-width: 992px) {
        .hero-section-wrapper .main-container{

        padding: 0 24px;
    }
       .hero-section-button.main-button span {
            display: none;
        }

        .hero-section-title {
            padding: 80px 0 48px 0;
            font-size: 48px;
            line-height: 100%;
        }

        .hero-section-image-wrapper video {
            aspect-ratio: 430 / 264;
        }

        .hero-section-button.main-button {
            padding: 19px;
            right: 0;
            bottom: 0;
        }
    }
</style>

<div class="hero-section">
    <div class="hero-section-wrapper">
        <div class="main-container">
            <h1 class="hero-section-title">
                <?php the_sub_field('hero_title'); ?>
            </h1>
        </div>
        <div class="hero-section-image-wrapper">
            <?php
            $hero_video = get_sub_field('hero_video');
            if ($hero_video): ?>
                <video autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($hero_video['url']); ?>" type="<?php echo esc_attr($hero_video['mime_type']); ?>">
                </video>
            <?php endif; ?>

            <?php if (get_sub_field('hero_button_text')): ?>
                <a href="<?php the_sub_field('hero_button_url'); ?>" class="hero-section-button main-button">
                    <span><?php the_sub_field('hero_button_text'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
                        <path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
