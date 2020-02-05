<?php

/**
 * The template for displaying posts within the loop.
 */
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
?>
<div class="container">

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata('article'); ?>>
    <div class="inside-article inside-article--news">
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
        ?>

        <h4 class="heading"><?php the_date(); ?></h4>

        <div class="entry">
          <?php

          the_title(sprintf('<h2 class="entry-title post__title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
          ?>

          <!-- <a href="<?php the_permalink(); ?>">Read More</a> -->
        </div>


        <!-- /*
             * generate_after_entry_title hook.
             *
             * @since 0.1
             *
             * @hooked generate_post_meta - 10
             */
            // do_action('generate_after_entry_title'); -->
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

      if (generate_show_excerpt()) : ?>

      <?php /* <div class="entry-summary" itemprop="text">
     <?php the_excerpt(); ?>
    </div><!-- .entry-summary --> */ ?>

    <?php else : ?>

    <div class="entry-content" itemprop="text">
      <?php
          the_content();

          wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'generatepress'),
            'after' => '</div>',
          ));
          ?>
    </div><!-- .entry-content -->

    <?php endif;

      // /**
      //  * generate_after_entry_content hook.
      //  *
      //  * @since 0.1
      //  *
      //  * @hooked generate_footer_meta - 10
      //  */
      // do_action( 'generate_after_entry_content' );

      // /**
      //  * generate_after_content hook.
      //  *
      //  * @since 0.1
      //  */
      // do_action( 'generate_after_content' );
      ?>
</div><!-- .inside-article -->
</article><!-- #post-## -->

</div>