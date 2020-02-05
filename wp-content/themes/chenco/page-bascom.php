<?php

/* Template Name: Bascom Operators Page */

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

    <?php while (have_posts()) : the_post(); ?>

    <div class="grid-container"></div>

    <?php endwhile; ?>

    <div class="bascom container">
      <div class="page__header">
        <h1 class="heading"><?php the_title(); ?></h1>
        <p><?php the_content(); ?></p>
        <div class="bascom-filter-container">
          <p>Filter by</p>
          <input placeholder="Sector: All">
          <input placeholder="Option">
          <input placeholder="Option">
        </div>
      </div>
      <div class="bascom-container">

        <?php while (have_rows('bascom')) : the_row(); ?>
        <div class="bascom__item">
          <img src="<?php the_sub_field('image'); ?>" alt="img" />
          <h3><?php the_sub_field('company'); ?></h3>
          <div class="bascom__item__description">
            <p><?php the_sub_field('description'); ?></p>
            <div class="bascom-info">
              <a href="https://<?php the_sub_field('website'); ?>" target="_blank" rel=”noopener”
                rel=”noreferrer”><?php the_sub_field('website'); ?></a>
            </div>
          </div>
        </div>
        <?php endwhile; ?>

      </div>
    </div>

    <?php
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