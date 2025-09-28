<div class="black-slider" data-theme="dark">
  <div class="black-slider-wrapper" data-aos="fade-right"  data-aos-offset="200" data-aos-delay="200"> 
    <div class="black-slider-swiper swiper">
      <div class="swiper-wrapper">
        <?php if (have_rows('black_slider')): ?>
          <?php while (have_rows('black_slider')): the_row(); ?>
            <?php $img = get_sub_field('image'); if (!$img) continue; ?>
            <div class="swiper-slide">
              <?= wp_get_attachment_image(
                    $img['ID'],
                    'large',
                    false,
                    ['class' => 'black-slide-image', 'loading' => 'lazy', 'alt' => esc_attr($img['alt'] ?? '')]
                  ); ?>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
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
    slidesPerView: 1.2,
    breakpoints: {
      768: {
        slidesPerView: 2.2,   
        spaceBetween: 20
      }
    },
    autoplay: {
      delay: 2000,
      disableOnInteraction: false
    }
  });

});

</script>