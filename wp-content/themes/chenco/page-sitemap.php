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
              <h4>TAIWAN</h4>
              <p>SF, #248, Sec. 3</p>
              <p>Nanjing E. Rd</p>
              <p>Taipei 105, Taiwan</p>
            </div>
            <div class="sitemap-side-item">
              <h4>BEIJING</h4>
              <p>Suite 1901, China World</p>
              <p>Office 2</p>
              <p>No. 1 Jian Guo Men Wai Ave.,</p>
              <p>Chaoyang District,</p>
              <p>Beijing 1000004, China</p>
            </div>
            <div class="sitemap-side-item">
              <h4>SHANGHAI</h4>
              <p>Suite 1702A, 17/F,</p>
              <p>Lippo Plaza, No. 222 Huaihai Middle Road,</p>
              <p>Huangpu District,</p>
              <p>Shanghai 200021, China</p>
            </div>
            <div class="sitemap-side-item">
              <h4>SEOUL</h4>
              <p>19/F, 159-9
                <p>Samseong-dong, Gangnam-gu,</p>
                <p>Seoul, South Korea</p>
            </div>
            <div class="sitemap-side-item">
              <h4>HONG KONG</h4>
              <p>On hold for now</p>
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