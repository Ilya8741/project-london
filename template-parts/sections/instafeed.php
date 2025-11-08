<div class="instafeed" data-aos="fade-up" data-aos-offset="160">
  <div class="instafeed-header">
    <h2 class="instafeed-title">
      <?php the_sub_field('instafeed_title'); ?>
    </h2>
    <p class="instafeed-text">
      <?php the_sub_field('instafeed_text'); ?>
      <?php if (get_sub_field('instafeed_button_text')): ?>
        <span><?php the_sub_field('instafeed_follow_text'); ?></span>
        <?php
        $insta_text = get_sub_field('instafeed_button_text') ?: 'Follow us on Instagram';
        $insta_url  = get_sub_field('instafeed_button_url');
        $default_url = 'https://www.instagram.com/proj_london/';
        ?>

        <a href="<?php echo esc_url($insta_url ?: $default_url); ?>"
          class="instafeed-button"
          target="_blank" rel="noopener">
          <?php echo esc_html($insta_text); ?>
        </a>

      <?php endif; ?>
    </p>
  </div>
    <div class="instafeed-swiper-shortcode">
      <?php echo do_shortcode('[instagram-feed feed=3]'); ?>
    </div>
</div>