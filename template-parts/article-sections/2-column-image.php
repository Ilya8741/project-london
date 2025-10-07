<?php
$version = strtolower( trim( (string) get_sub_field('version') ) );
$allowed = ['left','right'];
if (!in_array($version, $allowed, true)) { $version = 'center'; }

$classes = [
  'two-column-image',
  'two-column-' . $version,
];

if ( get_sub_field('padding_top') )    { $classes[] = 'padding-top-none'; }
if ( get_sub_field('padding_bottom') ) { $classes[] = 'padding-bottom-none'; }

?>
<div class="<?php echo esc_attr( implode(' ', $classes) ); ?> two-column-image-main">
  <div class="two-column-image-wrapper">
    <?php $image1 = get_sub_field('image1'); ?>
    <?php if ($image1): ?>
      <div class="two-column-media-wrapper two-column-media-wrapper-first">
      <a class="js-lightbox" href="<?php echo esc_url($image1['url']); ?>">
        <img src="<?php echo esc_url($image1['url']); ?>" class="two-column-media-image" alt="<?php echo esc_attr($image1['alt']); ?>">
    </a>
      </div>
    <?php endif; ?>
     <?php $image2 = get_sub_field('image2'); ?>
    <?php if ($image2): ?>
      <div class="two-column-media-wrapper two-column-media-wrapper-second">
           <a class="js-lightbox" href="<?php echo esc_url($image2['url']); ?>">
        <img src="<?php echo esc_url($image2['url']); ?>" class="two-column-media-image" alt="<?php echo esc_attr($image2['alt']); ?>">
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>
