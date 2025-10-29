<div class="careers-hero-sec">
  <div class=" careers-hero-sec-wrapper">
    <div class="main-container">
      <h1 class="careers-hero-sec-title" data-aos="fade-right"  data-aos-offset="200" data-aos-delay="200">
        <?php the_sub_field('hero_title'); ?>
      </h1>
    </div>

    <div class="careers-hero-sec-image-wrapper">
      <?php
      $hero_video = get_sub_field('video'); 
      ?>

      <?php if ($hero_video): ?>
        <video autoplay muted loop playsinline>
          <source src="<?php echo esc_url($hero_video['url']); ?>" type="<?php echo esc_attr($hero_video['mime_type']); ?>">
        </video>
      <?php endif; ?>
    </div>
  </div>
</div>
