<?php
$posts_selected = get_sub_field('blog_posts');
$posts_selected = is_array($posts_selected) ? array_filter($posts_selected) : [];
$posts_count    = count($posts_selected);

function pl_get_thumb_alt($post_id){
  $thumb_id = get_post_thumbnail_id($post_id);
  if(!$thumb_id) return '';
  $alt = trim(get_post_meta($thumb_id, '_wp_attachment_image_alt', true));
  return $alt !== '' ? $alt : get_the_title($post_id);
}
?>
<div class="hero-slider<?php if (get_sub_field('spacing_top')): ?> hero-slider-top-none<?php endif; ?>" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
  <div class="hero-slider-wrapper">
    <div class="hero-slider-swiper swiper _swiper" data-slides-count="<?php echo (int)$posts_count; ?>">
      <div class="swiper-wrapper">

        <?php if ($posts_count === 2): ?>
          <div class="swiper-slide swiper-slide--ghost" aria-hidden="true">
            <div class="hero-slider-item hero-slider-item--ghost"></div>
            <p class="slide-text" hidden></p>
          </div>
        <?php endif; ?>

        <?php foreach ($posts_selected as $p):
          $post_id   = is_object($p) ? $p->ID : (int)$p;
          $permalink = get_permalink($post_id);
          $title     = get_the_title($post_id);
          $thumb_url = get_the_post_thumbnail_url($post_id, 'large');
          $thumb_alt = pl_get_thumb_alt($post_id);
        ?>
          <div class="swiper-slide">
            <a href="<?php echo esc_url($permalink); ?>">
              <?php if ($thumb_url): ?>
                <div class="hero-slider-item">
                  <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($thumb_alt); ?>">
                  <span class="hero-slider-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                      <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round"/>
                      <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round"/>
                    </svg>
                  </span>
                </div>
              <?php else: ?>
                <div class="hero-slider-item hero-slider-item--ghost"></div>
              <?php endif; ?>

              <p class="slide-text"><?php echo esc_html($title); ?></p>
            </a>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var el = document.querySelector(".hero-slider-swiper");
  if (!el) return;

  var count = parseInt(el.getAttribute("data-slides-count") || "0", 10);
  var onlyTwo = count === 2;

  new Swiper(el, {
    loop: !onlyTwo,
    slidesPerView: 1.05,
    spaceBetween: 8,
    watchOverflow: true,
    breakpoints: {
      768: { slidesPerView: 2.1, spaceBetween: 20 },
      992: { slidesPerView: 3,   spaceBetween: 20 }
    }
  });
});
</script>
