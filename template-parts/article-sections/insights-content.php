<div class="insights-content <?php if (get_sub_field('none_top_spacing')): ?>insights-content-top<?php endif; ?> <?php if (get_sub_field('none_bottom_spacing')): ?> insights-content-bottom<?php endif; ?>">
  <div class="insights-content-wrapper">
    <?php if ( have_rows('content_repeater') ) : ?>
      <?php while ( have_rows('content_repeater') ) : the_row(); ?>
        <?php $text = get_sub_field('text'); ?>
        <?php if ( !empty($text) ) : ?>
          <div class="insights-content__block"  data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
            <?php echo wp_kses_post( $text ); ?>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
