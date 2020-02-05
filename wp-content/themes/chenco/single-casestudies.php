<?php

/**
 * The Template for displaying all single posts.
 */
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" <?php generate_do_element_classes('content'); ?>>
  <main id="main" <?php generate_do_element_classes('main'); ?>>

    <div class="single-width">
      <div class="container">
        <?php
        /**
         * generate_before_main_content hook.
         *
         * @since 0.1
         */
        do_action('generate_before_main_content');

        while (have_posts()) : the_post();

        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata('article'); ?>>
          <div class="inside-article">
            <?php
              /**
               * generate_before_content hook.
               *
               * @since 0.1
               *
               * @hooked generate_featured_page_header_inside_single - 10
               */
              do_action('generate_before_content');
              ?>

            <header class="entry-header">
              <?php
                /**
                 * generate_before_entry_title hook.
                 *
                 * @since 0.1
                 */
                do_action('generate_before_entry_title');

                if (generate_show_title()) {
                  the_title('<h1 class="entry-title" itemprop="headline">', '</h1>');
                }

                /**
                 * generate_after_entry_title hook.
                 *
                 * @since 0.1
                 *
                 * @hooked generate_post_meta - 10
                 */
                do_action('generate_after_entry_title');
                ?>
            </header><!-- .entry-header -->

            <?php
              /**
               * generate_after_entry_header hook.
               *
               * @since 0.1
               *
               * @hooked generate_post_image - 10
               */
              do_action('generate_after_entry_header');
              ?>

            <div class="entry-content" itemprop="text">
              <?php
                the_content();

                wp_link_pages(array(
                  'before' => '<div class="page-links">' . __('Pages:', 'generatepress'),
                  'after'  => '</div>',
                ));
                ?>
            </div><!-- .entry-content -->

            <?php
              /**
               * generate_after_entry_content hook.
               *
               * @since 0.1
               *
               * @hooked generate_footer_meta - 10
               */
              do_action('generate_after_entry_content');

              /**
               * generate_after_content hook.
               *
               * @since 0.1
               */
              do_action('generate_after_content');
              ?>
          </div><!-- .inside-article -->
        </article><!-- #post-## -->


        <?php

        endwhile;

        /*
                * generate_after_main_content hook.
                *
                * @since 0.1
                */
        do_action('generate_after_main_content');
        ?>
      </div>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
/**
 * generate_after_primary_content_area hook.
 *
 * @since 2.0
 */
do_action('generate_after_primary_content_area');

generate_construct_sidebars();

get_footer();