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
        <h1 class="heading">Sitemap</h1>
      </div>

      <?php while (have_posts()) : the_post(); ?>
      <div class="sitemap-side-container">
        <aside class="sitemap-aside">
          <h4 class="sitemap-side-title">Global Offices</h4>
          <div class="sitemap-side">
            <div class="sitemap-side-item">
              <h4>Irvine</h4>
              <p>26 Corporate Park Drive</p>
              <p>Suite 200</p>
              <p>Irvine, California 92606, USA</p>
            </div>
            <div class="sitemap-side-item">
              <h4>Irvine</h4>
              <p>26 Corporate Park Drive</p>
              <p>Suite 200</p>
              <p>Irvine, California 92606, USA</p>
            </div>
            <div class="sitemap-side-item">
              <h4>Irvine</h4>
              <p>26 Corporate Park Drive</p>
              <p>Suite 200</p>
              <p>Irvine, California 92606, USA</p>
            </div>
            <div class="sitemap-side-item">
              <h4>Irvine</h4>
              <p>26 Corporate Park Drive</p>
              <p>Suite 200</p>
              <p>Irvine, California 92606, USA</p>
            </div>
          </div>
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
