<?php
$selected = get_sub_field('blog_post');
if (!$selected) {
  $selected = get_field('blog_post');
}

if (is_array($selected)) {
  $selected = reset($selected);
}

$post_obj = null;
if (is_numeric($selected)) {
  $post_obj = get_post((int)$selected);
} elseif ($selected instanceof WP_Post) {
  $post_obj = $selected;
}

$url = $title = $img_html = '';

if ($post_obj && $post_obj instanceof WP_Post) {
  $url   = get_permalink($post_obj);
  $title = get_the_title($post_obj);

  $thumb_id = get_post_thumbnail_id($post_obj);
  if ($thumb_id) {
    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
    if ($alt === '') { $alt = $title; }
    $img_html = wp_get_attachment_image(
      $thumb_id,
      'large',
      false,
      ['class' => 'grid-section-image', 'alt' => esc_attr($alt), 'loading' => 'lazy', 'decoding' => 'async']
    );
  }
}
?>

<div class="blog-hero">
    <div class="blog-hero-wrapper">
        <h1 class="blog-hero-title" data-aos="fade-left">
              <?php the_sub_field('title'); ?>
        </h1>
        <div class="grid-section-item blog-hero-item" data-aos="fade-right">
  <a href="<?php echo esc_url($url); ?>" class="grid-section-link">
    <div class="grid-section-image-wrapper">
      <?php echo $img_html ? $img_html : '<div class="grid-section-image-placeholder" aria-hidden="true"></div>'; ?>
      <span class="grid-section-icon blog-grid-section-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true" focusable="false">
          <path d="M0.771484 1H17.2286V17" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M0.771484 17L17.2286 1" stroke="white" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </span>
    </div>
    <div class="grid-section-text blog-grid-section-text" ><?php echo esc_html($title); ?></div>
  </a>
</div>
    <div class="blog-hero-text" data-aos="fade-left">
        <?php the_sub_field('text'); ?>
    </div>

    </div>
</div>