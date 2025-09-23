<style>
    .quote-title {
        color: #2B2B2B;
        font-family: "Test Newzald";
        font-size: 32px;
        font-style: normal;
        font-weight: 400;
        line-height: 124%;
        letter-spacing: -0.4px;
        display: block;
        max-width: 810px;
    }

    .quote-button {
        margin-top: 32px;
        margin-right: auto;
        border: 1px solid rgba(113, 113, 113, 0.25);
        width: fit-content;
    }
    

    .quote-section {
        padding-top: 160px;
    }

    .main-container {
        padding: 0 24px;
        max-width: 1440px;
        margin: 0 auto;
    }

    @media(max-width: 992px) {
        .quote-section {
            padding-top: 80px;
        }

        .quote-title {
            font-size: 28px;
            line-height: 124%;
        }
    }
</style>

<div class="quote-section">
    <div class="quote-wrapper main-container">
        <div class="quote-title">
            <?php the_sub_field('quote_title'); ?>
        </div>
        <a href="<?php the_sub_field('quote_button_url'); ?>" class="quote-button main-button">
            <span><?php the_sub_field('quote_button_text'); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M1 1H13V13" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
                <path d="M1 13L13 1" stroke="#2B2B2B" stroke-width="0.5" stroke-linejoin="round" />
            </svg>
        </a>
    </div>
</div>