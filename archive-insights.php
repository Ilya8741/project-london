<?php
/** Archive: Insights */
get_header(); ?>

<main id="primary" class="site-main archive-insights">
<?php
  $builder_page = get_page_by_path('insights'); // Pages → Insights
  $builder_id   = $builder_page ? $builder_page->ID : 0;

  if ( $builder_id && have_rows('page_content', $builder_id) ) {
    while ( have_rows('page_content', $builder_id) ) { the_row();
      $layout = get_row_layout();
      get_template_part('template-parts/sections/' . $layout);
    }
  } else {
    if ( have_posts() ) {
      echo '<section class="archive-grid">';
      while ( have_posts() ) { the_post();
        get_template_part('template-parts/content', 'insight-card');
      }
      echo '</section>';
      the_posts_pagination();
    } else {
      get_template_part('template-parts/content', 'none');
    }
  }
?>
</main>

<?php get_footer();
