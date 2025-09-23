<style>
    .quote-right {
        max-width: 1440px;
        margin: 0 auto;
        padding: 160px 20px;
    }

    .quote-right-wrapper {
        max-width: 1050px;
        margin-left: auto;
        display: flex;
        align-items: flex-end;
        gap: 220px;
        padding-bottom: 48px;
        border-bottom: 1px solid #717171;
    }

    .quote-right-name {
        color: #717171;
        font-family: "Public Sans";
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: 175%;
        letter-spacing: -0.4px;
        margin-left: auto;
    }

    .quote-right-title {
       color: #2B2B2B;
        font-family: "Test Newzald";
        font-size: 32px;
        font-style: normal;
        font-weight: 400;
        line-height: 120%;
        max-width: 567px;
        letter-spacing: -0.4px;
    }

    .quote-right-text {
        color: #2B2B2B;
        font-family: "Public Sans";
        font-size: 16px;
        font-style: normal;
        font-weight: 300;
        line-height: 140%;
        letter-spacing: -0.4px;
        opacity: 0.8;
    }

    .quote-right-content {
        display: flex;
        flex-direction: column;
        gap: 16px;
        max-width: 690px;
    }

    @media(max-width: 1200px) {
        .quote-right-wrapper {
            gap: 100px;
        }
    }

    @media(max-width: 992px) {
        .quote-right-title {
            font-size: 28px;
            line-height: 120%;
        }

        .quote-right {
            padding: 80px 20px;
        }

        .quote-right-wrapper {
            gap: 30px;
            flex-direction: column;
        }
    }
</style>

<div class="quote-right">
    <div class="quote-right-wrapper">
        <div class="quote-right-content">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="27" viewBox="0 0 40 27" fill="none">
                <path d="M21.2174 27L22.8406 16.0189L35.0145 0H40L31.5362 14.2075L36.4058 14.4906L34.5507 27H21.2174ZM0 27L1.68116 16.0189L13.7971 0H18.7826L10.3188 14.2075L15.2464 14.4906L13.3333 27H0Z" fill="#717171" />
            </svg>
            <h3 class="quote-right-title">
                <?php the_sub_field('quote_title'); ?>
            </h3>
            <p class="quote-right-text">
                <?php the_sub_field('quote_text'); ?>
            </p>
        </div>
        <span class="quote-right-name">
            <?php the_sub_field('quote_name'); ?>
        </span>
    </div>
</div>
