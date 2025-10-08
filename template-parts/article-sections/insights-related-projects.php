<?php
$posts_selected = get_sub_field('blog_posts');
$posts_selected = is_array($posts_selected) ? array_filter($posts_selected) : [];

function pl_get_thumb_alt($post_id){
  $thumb_id = get_post_thumbnail_id($post_id);
  if(!$thumb_id) return '';
  $alt = trim(get_post_meta($thumb_id, '_wp_attachment_image_alt', true));
  return $alt !== '' ? $alt : get_the_title($post_id);
}
?>

<div class="insights-related-projects" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
  <div class="insights-related-projects-wrapper insights-posts-grid-items">
    <?php if (!empty($posts_selected)) : ?>
      <?php foreach ($posts_selected as $p) :
        $post_id   = is_object($p) ? $p->ID : (int)$p;
        if (!$post_id) continue;

        $permalink = get_permalink($post_id);
        $title     = get_the_title($post_id);
        $thumb_url = get_the_post_thumbnail_url($post_id, 'large');
        $thumb_alt = pl_get_thumb_alt($post_id);
        $excerpt = get_the_excerpt($post_id);
      ?>
      <div class="insights-related-projects__item grid-section-item blog-grid-item">
        <a class="grid-section-link" href="<?php echo esc_url($permalink); ?>">
          <div class="insights-related-projects__media grid-section-image-wrapper">
            <?php if ($thumb_url): ?>
              <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($thumb_alt); ?>" loading="lazy" decoding="async">
              <span class="insights-related-projects__icon grid-section-icon blog-grid-section-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                  <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round"/>
                  <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round"/>
                </svg>
              </span>
            <?php else: ?>
              <div class="insights-related-projects__placeholder" aria-hidden="true"></div>
            <?php endif; ?>
          </div>
          <p class="insights-related-projects__title grid-section-text blog-grid-section-text"><?php echo esc_html($title); ?></p>
           <div class="blog-grid-section-excerpt"><?php echo esc_html($excerpt); ?></div>
        </a>
      </div>
        
      <?php endforeach; ?>
    <?php else: ?>
      <p class="insights-related-projects__empty">No related posts selected.</p>
    <?php endif; ?>

  </div>
</div>
