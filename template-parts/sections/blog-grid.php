<?php
$post_type   = get_sub_field('post_type') ?: 'post';
$orderby     = get_sub_field('orderby') ?: 'date';

$raw_exclude = get_sub_field('exclude_posts') ?: [];
$exclude_ids = [];
foreach ((array)$raw_exclude as $item) {
  $exclude_ids[] = is_object($item) ? (int)$item->ID : (int)$item;
}
$exclude_ids = array_filter(array_unique($exclude_ids));

$args = [
  'post_type'           => $post_type,
  'post_status'         => 'publish',
  'posts_per_page'      => -1,
  'orderby'             => $orderby,
  'order'               => 'ASC',
  'ignore_sticky_posts' => true,
];
if (!empty($exclude_ids)) {
  $args['post__not_in'] = $exclude_ids;
}

$q = new WP_Query($args);

function pl_get_img_alt($attachment_id) {
  $alt = trim(get_post_meta($attachment_id, '_wp_attachment_image_alt', true));
  if ($alt !== '') return $alt;
  $img_post = get_post($attachment_id);
  return $img_post ? $img_post->post_title : '';
}
?>
<section class="section-posts-grid <?php if ( get_sub_field('version') ) : ?> insights-posts-grid <?php endif; ?>">
  <?php if ($q->have_posts()) : ?>
    <div class="<?php if ( get_sub_field('version') ) : ?> insights-posts-grid-items <?php else : ?> section-posts-grid-items <?php endif; ?>">
      <?php while ($q->have_posts()) : $q->the_post();
        $pid   = get_the_ID();
        $url   = get_permalink($pid);
        $title = get_the_title($pid);
        $excerpt = get_the_excerpt($pid);
        $img_html = '';
        if (has_post_thumbnail($pid)) {
          $thumb_id = get_post_thumbnail_id($pid);
          $src      = get_the_post_thumbnail_url($pid, 'large');
          $alt      = pl_get_img_alt($thumb_id);
          $img_html = '<img src="'.esc_url($src).'" alt="'.esc_attr($alt).'" loading="lazy" decoding="async">';
        }
      ?>
        <div class="grid-section-item blog-grid-item" data-aos="fade-up">
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
            <div class="grid-section-text blog-grid-section-text"><?php echo esc_html($title); ?></div>
            <?php if ( get_sub_field('version') ) : ?> 
              <div class="blog-grid-section-excerpt"><?php echo esc_html($excerpt); ?></div>
            <?php endif; ?>
          </a>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  <?php else : ?>
    <p class="grid-section-empty">No posts found.</p>
  <?php endif; ?>
</section>
