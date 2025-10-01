<?php
/** Archive: Portfolio */
get_header(); ?>

<main id="primary" class="site-main archive-portfolio">
<?php
  // Находим страницу-«билдер» по слагу (или возьми ID, если удобнее)
  $builder_page = get_page_by_path('portfolio'); // Pages → Portfolio
  $builder_id   = $builder_page ? $builder_page->ID : 0;

  // 1) Рендер секций со страницы (как на обычных страницах)
  if ( $builder_id && have_rows('page_content', $builder_id) ) {
    while ( have_rows('page_content', $builder_id) ) { the_row();
      $layout = get_row_layout();
      get_template_part('template-parts/sections/' . $layout);
    }
  } else {
    // Фолбэк: если секций нет — покажем сетку архивных постов
    if ( have_posts() ) {
      echo '<section class="archive-grid">';
      while ( have_posts() ) { the_post();
        get_template_part('template-parts/content', 'portfolio-card');
      }
      echo '</section>';
      the_posts_pagination();
    } else {
      get_template_part('template-parts/content', 'none');
    }
  }

  // 2) Если в твоих секциях есть «Секция-лента постов» с собственным WP_Query —
  // не забудь внутри неё делать wp_reset_postdata().
?>
</main>

<?php get_footer();
