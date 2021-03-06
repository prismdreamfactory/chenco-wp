<?php

/* Template Name: Contact Page */

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

    <div class="contact container">
      <div class="page__header">
        <h1 class="heading"><?php the_title(); ?></h1>
      </div>

      <div class="contact-people-container">
        <?php while (have_rows('person')) : the_row(); ?>
        <div class="contact-people-item">
          <img class="contact-img" src="<?php the_sub_field('image'); ?>" />
          <div class="contact-people-info">
            <strong><?php the_sub_field('region'); ?></strong>
            <p><?php the_sub_field('name'); ?></p>
            <?php if (get_sub_field('phone')) : ?>
            <p>+<?php the_sub_field('phone'); ?> #<?php the_sub_field('extension'); ?></p>
            <?php endif; ?>

          </div>
        </div>
        <?php endwhile; ?>
      </div>


      <?php while (have_rows('contact_locations')) : the_row(); ?>
      <div class="contact__location">
        <h2 class="heading"><?php the_sub_field('region'); ?></h2>
        <div class="contact-location-container">
          <?php while (have_rows('region_info')) : the_row(); ?>
          <div class="contact-location-item">
            <strong><?php the_sub_field('location'); ?></strong>
            <p class="contact-address"><?php the_sub_field('address'); ?></p>
            <?php if (get_sub_field('phone')) : ?>
            <p>+<?php the_sub_field('phone'); ?></p>
            <?php endif; ?>
            <p><?php the_sub_field('website'); ?></p>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
      <?php endwhile; ?>
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