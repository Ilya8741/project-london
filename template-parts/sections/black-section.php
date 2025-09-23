<style>
    .black-section-wrapper {
        display: grid;
        grid-template-columns: repeat(2, 1fr);

    }

    .black-section {
        max-width: 100%;
    }

    .black-section-content {
        padding: 80px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        background: #2B2B2B;
        gap: 20px;
    }

    .main-button.black-section-button {
        background: transparent;
        color: #fff;
        width: fit-content;
    }

    .main-button.black-section-button:hover svg path {
        stroke: #2B2B2B;
    }

    .main-button.black-section-button {
        border: 1px solid #fff;
    }

    .main-button.black-section-button:hover {
        color: #2B2B2B;
        background: #fff;
    }

    .black-title {
        color: #FFF;
        font-family: "Test Newzald";
        font-size: 32px;
        font-style: normal;
        font-weight: 400;
        line-height: 115%;
        letter-spacing: -0.4px;
    }

    .black-right-text {
        color: #FFF;
        font-family: "Public Sans";
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 135%;
        letter-spacing: -0.4px;
    }

    .black-section-content-bottom {
        display: flex;
        flex-direction: column;
        gap: 32px;
        max-width: 550px;
        margin-right: auto;
    }

    .black-section-image {
        object-fit: cover;
        height: auto;
        width: 100%;
        aspect-ratio: 710 / 960;
    }

    @media(max-width: 992px) {
        .black-section-wrapper {
            grid-template-columns: repeat(1, 1fr);
        }

        .black-title {
            font-size: 28px;
            line-height: 115%;
        }

        .black-section-content {
            gap: 64px;
            padding: 80px 24px 48px 24px;

        }

        .black-section-image {
            aspect-ratio: 430 / 304;
        }

        .black-right-text {
            font-size: 16px;
            line-height: 135%;
        }
    }
</style>

<div class="black-section">
    <div class="black-section-wrapper">
        <div class="black-section-content">
            <h3 class="black-title">
                <?php the_sub_field('black_title'); ?>
            </h3>
            <div class="black-section-content-bottom">
                <p class="black-right-text">
                    <?php the_sub_field('black_text'); ?>
                </p>
                <?php if (get_sub_field('black_button_text')): ?>
                    <a href="<?php the_sub_field('black_button_url'); ?>" class="black-section-button main-button">
                        <span><?php the_sub_field('black_button_text'); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                            <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="black-section-image-wrapper">
            <?php $image1 = get_sub_field('black_image'); ?>
            <?php if ($image1): ?>
                <img src="<?php echo esc_url($image1['url']); ?>" class="black-section-image" alt="<?php echo esc_attr($image1['alt']); ?>">
            <?php endif; ?>
        </div>
    </div>
</div>
