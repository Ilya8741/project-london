<?php 
$shortcode = get_sub_field('shortcodes');
?>

<div class="instafeed" data-aos="fade-up" data-aos-offset="160">
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

  <?php if ( !empty($shortcode) ) : ?>
    <div class="instafeed-swiper-shortcode">
      <?php echo do_shortcode( $shortcode ); ?>
    </div>

  <?php else : ?>
    <div class="instafeed-swiper swiper">
      <?php
      $slides = [];

      if ( have_rows('instafeed_slides') ) :
        while ( have_rows('instafeed_slides') ) : the_row();
          $image = get_sub_field('slide_image');
          if ( $image ) {
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

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".instafeed-swiper", {
          loop: true,
          spaceBetween: 8,
          slidesPerView: 2.5,
          centeredSlides: false,
          breakpoints: {
            992: {
              spaceBetween: 20,
              slidesPerView: 4,
              centeredSlides: true,
            }
          },
        });
      });
    </script>

  <?php endif; ?>
</div>
