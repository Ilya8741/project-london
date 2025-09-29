<div class="black-slider" data-theme="dark">
  <div class="black-slider-wrapper" data-aos="fade-right"  data-aos-offset="200" data-aos-delay="200"> 
  <?php
  $black_slides = [];
  if (have_rows('black_slider')):
    while (have_rows('black_slider')): the_row();
      $img = get_sub_field('image');
      if ($img) { $black_slides[] = $img; }
    endwhile;
  endif;
?>

<div class="black-slider-swiper swiper">
  <div class="swiper-wrapper">
    <?php for ($i = 0; $i < 2; $i++): ?>
      <?php foreach ($black_slides as $img): 
        $meta = wp_get_attachment_metadata($img['ID']);
        if (!$meta || empty($meta['width']) || empty($meta['height'])) {
          $size = @getimagesize($img['url']);
          $w = $size ? $size[0] : 0;
          $h = $size ? $size[1] : 0;
        } else {
          $w = (int)$meta['width'];
          $h = (int)$meta['height'];
        }
        $is_portrait = $h > $w;
        $shape_class = $is_portrait ? 'slide--narrow' : 'slide--wide';
      ?>
        <div class="swiper-slide <?php echo esc_attr($shape_class); ?>" data-idx="<?php echo esc_attr($img['ID']); ?>">
          <?= wp_get_attachment_image(
                $img['ID'],
                'large',
                false,
                [
                  'class'   => 'black-slide-image',
                  'loading' => 'lazy',
                  'alt'     => esc_attr($img['alt'] ?? '')
                ]
              ); ?>
        </div>
      <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const el = document.querySelector('.black-slider-swiper');
  if (!el) return;

  const swiper = new Swiper(el, {
    loop: true,
    speed: 600,
    spaceBetween: 8,
    slidesPerView: 'auto', 
    observeParents: true,
    observer: true,
    breakpoints: {
      768: { spaceBetween: 20 }
    },
    autoplay: {
      delay: 2000,
      disableOnInteraction: false
    }
  });
});
</script>
