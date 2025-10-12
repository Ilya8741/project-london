<?php
$version = strtolower( trim( (string) get_sub_field('version') ) );
$allowed = ['left','center','right'];
if (!in_array($version, $allowed, true)) { $version = 'center'; }

$classes = [
  'one-column-image',
  'one-column-' . $version,
];

if ( get_sub_field('padding_top') )    { $classes[] = 'padding-top-none'; }
if ( get_sub_field('padding_bottom') ) { $classes[] = 'padding-bottom-none'; }

?>
<div class="<?php echo esc_attr( implode(' ', $classes) ); ?> one-column-image-main">
  <div class="one-column-image-wrapper one-column-image-wrapper" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
    <?php $image1 = get_sub_field('image'); ?>
    <?php if ($image1): ?>
      <div class="one-column-media-wrapper">
         <a class="js-lightbox" href="<?php echo esc_url($image1['url']); ?>">
        <img src="<?php echo esc_url($image1['url']); ?>" class="one-column-media-image" alt="<?php echo esc_attr($image1['alt']); ?>">
        </a>
      </div>
    <?php endif; ?>

    <?php if ( get_sub_field('button_text') ): ?>
      <a href="<?php the_sub_field('button_url'); ?>" class="one-column-image-button lightbox-button main-button">
        <span><?php the_sub_field('button_text'); ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
          <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
          <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
        </svg>
      </a>
    <?php endif; ?>
  </div>
</div>
