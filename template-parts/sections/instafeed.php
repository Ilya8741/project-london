<style>
    .instafeed-text {
        color: #2B2B2B;
        text-align: right;
        font-family: "Public Sans";
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 155%; 
        letter-spacing: -0.4px;
    }

    .instafeed-header {
        display: flex;
        align-items: flex-end;
        gap: 8px;
        padding: 0 20px 32px 20px;
        justify-content: space-between;
    }

    .instafeed-text a {
        text-decoration: none;
        color: #717171;
    }

    .instafeed-title {
        color: #2B2B2B;
        font-family: "Test Newzald";
        font-size: 32px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%; 
        letter-spacing: -0.4px;
    }

    .instafeed-swiper .swiper-slide img {
         aspect-ratio: 335 / 418;
         object-fit: cover;
         width: 100%;
         height: 100%;
    }

    @media(max-width: 992px) {
        .instafeed-header {
            padding: 0 24px;
        }
        
        .instafeed-title {
            font-size: 28px;
        }

        .instafeed-text {
            font-size: 16px;
            line-height: 175%; 
        }
    }
</style>

<div class="instafeed">
    <div class="instafeed-header">
        <h2 class="instafeed-title">
            <?php the_sub_field('instafeed_title'); ?>
        </h2>
        <p class="instafeed-text">
            <?php the_sub_field('instafeed_text'); ?>
            <?php if (get_sub_field('instafeed_button_text')): ?>
                <span><?php the_sub_field('instafeed_follow_text'); ?></span>
                <a href="<?php the_sub_field('instafeed_button_url'); ?>" class="">
                    <?php the_sub_field('instafeed_button_text'); ?>
                </a>
            <?php endif; ?>
        </p>
    </div>

    <div class="instafeed-swiper swiper">
   <?php
$slides = [];

if (have_rows('instafeed_slides')) :
    while (have_rows('instafeed_slides')) : the_row();
        $image = get_sub_field('slide_image');
        if ($image) {
            $slides[] = $image;
        }
    endwhile;
endif;
?>

<div class="swiper-wrapper">
    <?php for ($i = 0; $i < 2; $i++):  ?>
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
    document.addEventListener("DOMContentLoaded", function () {
  new Swiper(".instafeed-swiper", {
    loop: true,
    spaceBetween: 8,
   slidesPerView: 2.5,
        centeredSlides: false,
    breakpoints: {

      992: {
        paceBetween: 20,
        slidesPerView: 4,
        centeredSlides: true,
      }
    },
  });
});

</script>