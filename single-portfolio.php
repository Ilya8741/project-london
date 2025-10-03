<?php
/** Single: Portfolio */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<main id="primary" class="site-main single-portfolio">
  <article <?php post_class(); ?>>
    <?php
    if ( have_rows('article_content') ) {
      while ( have_rows('article_content') ) { the_row();
        $layout = get_row_layout();
        get_template_part('template-parts/article-sections/' . $layout);
      }
    } else {
      get_template_part('template-parts/content', 'single');
    }
    ?>
  </article>
</main>
<?php endwhile; endif; get_footer();
