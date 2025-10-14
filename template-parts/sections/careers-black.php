<div class="careers-black" data-theme="dark">
    <div class="careers-black-wrapper" data-aos="fade-up"
        data-aos-duration="600"
        data-aos-delay="300"
        data-aos-easing="ease-out">
        <div class="careers-black-top">
            <h2 class="careers-black-title">
                <?php the_sub_field('title'); ?>
            </h2>
            <div class="careers-black-text">
                <?php the_sub_field('text'); ?>
            </div>
        </div>
        <div class="careers-black-bottom">
            <p class="careers-black-emal-text">
                <?php the_sub_field('email_text'); ?>
            </p>
            <a class="main-button mail-button" href="mailto:<?php the_sub_field('email'); ?>">
                <span>
                    <?php the_sub_field('email'); ?>
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M18.3307 5.83203L10.8382 10.6045C10.584 10.7522 10.2952 10.83 10.0011 10.83C9.70712 10.83 9.41832 10.7522 9.16406 10.6045L1.66406 5.83203" stroke="#2B2B2B" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.6641 3.33203H3.33073C2.41025 3.33203 1.66406 4.07822 1.66406 4.9987V14.9987C1.66406 15.9192 2.41025 16.6654 3.33073 16.6654H16.6641C17.5845 16.6654 18.3307 15.9192 18.3307 14.9987V4.9987C18.3307 4.07822 17.5845 3.33203 16.6641 3.33203Z" stroke="#2B2B2B" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
</div>