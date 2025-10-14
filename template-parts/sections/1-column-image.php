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
<div class="<?php echo esc_attr( implode(' ', $classes) ); ?> one-column-image-main one-column-image-main-sec">
  <div class="one-column-image-wrapper one-column-image-wrapper" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
    <?php $image1 = get_sub_field('image'); ?>
    <?php if ($image1): ?>
      <div class="one-column-media-wrapper">
        <img src="<?php echo esc_url($image1['url']); ?>" class="one-column-media-image" alt="<?php echo esc_attr($image1['alt']); ?>">
      </div>
    <?php endif; ?>
    <?php
            $hero_video = get_sub_field('video');
            if ($hero_video): ?>
            <div class="one-column-media-wrapper">
                <video autoplay muted loop playsinline class="one-column-media-image">
                    <source src="<?php echo esc_url($hero_video['url']); ?>"  type="<?php echo esc_attr($hero_video['mime_type']); ?>">
                </video>
                 </div>
            <?php endif; ?>
  </div>
</div>
