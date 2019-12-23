<?php

/* Template Name: Portfolio Page */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" <?php generate_do_element_classes('content'); ?>>
  <main id="main" <?php generate_do_element_classes('main'); ?>>
    <?php
    /**
     * generate_before_main_content hook.
     *
     * @since 0.1
     */
    do_action('generate_before_main_content'); ?>

    <div class="container">

      <?php while (have_posts()) : the_post(); ?>

      <div class="page__header">
        <h1><?php the_title(); ?></h1>
        <span class="front-line"></span>
        <p><?php the_content(); ?></p>
      </div>

      <?php endwhile; ?>

    </div>

    <?php
    // while (have_posts()) : the_post();

    get_template_part('partials/map');

    // endwhile;

    /**
     * generate_after_main_content hook.
     *
     * @since 0.1
     */
    do_action('generate_after_main_content');
    ?>
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