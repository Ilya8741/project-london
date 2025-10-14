<div class="policy-page">
    <div class="policy-page-wrapper">
        <h1 class="policy-page-title"  data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out"><?php the_sub_field('title'); ?></h1>
                <div class="policy-page-subtitle" data-aos="fade-left" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out"><?php the_sub_field('subtitle'); ?></div>
                   <?php if ( have_rows('content_repeater') ) : ?>
                    <div class="policy-page-content-wrapper" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
      <?php while ( have_rows('content_repeater') ) : the_row(); ?>
        <?php $text = get_sub_field('text'); ?>
        <?php if ( !empty($text) ) : ?>
          <div class="policy-page-content">
            <?php echo wp_kses_post( $text ); ?>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
      </div>
    <?php endif; ?>
    </div>
</div>