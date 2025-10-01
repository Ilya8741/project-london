<?php
/**
 * Template Name: Services Index
 */

get_header();
?>
<main id="primary" class="site-main services-index">
  <?php
  if (have_posts()) :
    while (have_posts()) : the_post();

      // Тот же Flexible Content, что в front-page.php
      if (have_rows('page_content')) :
        while (have_rows('page_content')) : the_row();
          $layout = get_row_layout();
          get_template_part('template-parts/sections/' . $layout);
        endwhile;
      else :
        get_template_part('template-parts/content', get_post_type());
      endif;

    endwhile;
  else :
    get_template_part('template-parts/content', 'none');
  endif;
  ?>
</main>
<?php get_footer();
