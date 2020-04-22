<?php

/* Template Name: Sitemap Page */

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

    <div class="container sitemap-main">
      <div class="page__header">
        <h1 class="heading"><?php the_title(); ?></h1>
      </div>

      <?php while (have_posts()) : the_post(); ?>
      <div class="sitemap-side-container">
        <aside class="sitemap-aside">
          <!-- <h4 class="sitemap-side-title">Global Offices</h4> -->
          <?php while (have_rows('contact_locations')) : the_row(); ?>
          <div class="contact__location">
            <h4 class="sitemap-side-title"><?php the_sub_field('region'); ?></h2>
              <div class="sitemap-side">

                <?php while (have_rows('region_info')) : the_row(); ?>
                <div class="sidemap-side-item">
                  <h4><?php the_sub_field('location'); ?></h4>
                  <p class="contact-address"><?php the_sub_field('address'); ?></p>
                </div>
                <?php endwhile; ?>

              </div>
          </div>

          <?php endwhile; ?>


        </aside>



        <?php
          wp_nav_menu(array(
            'menu' => 'sitemap',
            'container_class' => 'sitemap',
          ));
          ?>
      </div>
    </div>


    <?php endwhile;

      /*
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