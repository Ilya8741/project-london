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
    <div class="instafeed-swiper-shortcode">
        <?php echo do_shortcode( get_sub_field('shortcodes') ); ?>
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
                    paceBetween: 20,
                    slidesPerView: 4,
                    centeredSlides: true,
                }
            },
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const track = document.querySelector('#sbi_images');
  if (!track) return;

  const origItems = Array.from(track.querySelectorAll('.sbi_item'));
  if (!origItems.length) return;

  const before = document.createDocumentFragment();
  const after  = document.createDocumentFragment();

  for (let i = origItems.length - 1; i >= 0; i--) {
    before.appendChild(origItems[i].cloneNode(true));
  }
  origItems.forEach(el => after.appendChild(el.cloneNode(true)));

  track.insertBefore(before, track.firstChild);
  track.appendChild(after);

  let originalWidth = 0;
  let jumping = false;

  const computeOriginalWidth = () => {
    originalWidth = track.scrollWidth / 3;
  };

  const init = () => {
    computeOriginalWidth();
    track.scrollLeft = originalWidth;
  };

  const imgs = track.querySelectorAll('img');
  let loaded = 0;
  if (imgs.length) {
    imgs.forEach(img => {
      if (img.complete) loaded++;
      else img.addEventListener('load', () => {
        loaded++;
        if (loaded === imgs.length) init();
      }, { once: true });
    });
    if (loaded === imgs.length) init();
  } else {
    init();
  }

  track.addEventListener('scroll', () => {
    if (!originalWidth || jumping) return;
    const x = track.scrollLeft;
    const leftEdge  = originalWidth * 0.25;
    const rightEdge = originalWidth * 1.75;

    if (x < leftEdge) {
      jumping = true;
      track.scrollLeft = x + originalWidth;
      jumping = false;
    } else if (x > rightEdge) {
      jumping = true;
      track.scrollLeft = x - originalWidth;
      jumping = false;
    }
  }, { passive: true });

  window.addEventListener('resize', () => {
    const current = track.scrollLeft;
    computeOriginalWidth();
    track.scrollLeft = originalWidth + (current % originalWidth);
  });

  let isDown = false;
  let startX;
  let scrollLeft;

  const startDrag = (e) => {
    isDown = true;
    track.classList.add('dragging');
    startX = e.pageX || e.touches[0].pageX;
    scrollLeft = track.scrollLeft;
  };
  const moveDrag = (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX || e.touches[0].pageX;
    const walk = (x - startX) * 1.2; 
    track.scrollLeft = scrollLeft - walk;
  };
  const stopDrag = () => {
    isDown = false;
    track.classList.remove('dragging');
  };

  track.addEventListener('mousedown', startDrag);
  track.addEventListener('touchstart', startDrag, { passive: true });
  track.addEventListener('mousemove', moveDrag);
  track.addEventListener('touchmove', moveDrag, { passive: false });
  track.addEventListener('mouseleave', stopDrag);
  track.addEventListener('mouseup', stopDrag);
  track.addEventListener('touchend', stopDrag);
  track.addEventListener('touchcancel', stopDrag);

  track.style.overscrollBehavior = 'contain';
});
</script>
