<?php

/* Template Name: Our Firm Page */

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



    <div class="tabs tabs--firm">
      <div class="container">
        <ul class="tabs-nav">
          <?php if (have_rows('our_firm_tabs')) : ?>
          <?php while (have_rows('our_firm_tabs')) : the_row(); ?>
          <li class="tab <?= get_row_index() == 1 ? 'active' : '' ?>" data-tab="<?= get_row_index(); ?>"
            data-tab-name="firm">
            <img src="<?php the_sub_field('image'); ?>" class="tab__icon" />
            <span><?php the_sub_field('label'); ?></span>
          </li>
          <?php endwhile; ?>
          <?php endif; ?>
        </ul>
      </div>

      <div class="tab-container">
        <div class="tab-content active" data-content="1">
          <div class="container">
            <section class="firm__section">
              <?php the_content(); ?>
            </section>
          </div>
        </div>
        <div class="tab-content tab-content--alt" data-content="2">
          <section class="edge__section">
            <div class="container">

              <div class="edge__row edge__top">
                <div class="edge__row">
                  <div class="edge__items">

                    <?php if (have_rows('our_edge_top_row')) : ?>
                    <?php while (have_rows('our_edge_top_row')) : the_row(); ?>
                    <div class="edge__stat">

                      <div class="edge__circle"
                        style="background-image: url(/wp-content/uploads/2020/02/stat-circle.png);">
                        <span class="edge__circle-number"><?php the_sub_field('stat_number'); ?></span>
                        <span class="edge__circle-label"><?php the_sub_field('stat_label'); ?></span>
                      </div>

                      <h2>
                        <?php the_sub_field('text'); ?>
                      </h2>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>

                  </div>
                </div>
              </div>

              <div class="edge__row edge__middle">
                <h2 class="heading center sans"><?php the_field('our_edge_middle_row_heading'); ?></h2>
                <div class="edge__items">

                  <?php if (have_rows('our_edge_middle_row')) : ?>
                  <?php while (have_rows('our_edge_middle_row')) : the_row(); ?>

                  <div class="edge__stat">
                    <h3>
                      <?php the_sub_field('large_text'); ?>
                      <span><?php the_sub_field('text'); ?> </span>
                    </h3>
                  </div>
                  <?php endwhile; ?>
                  <?php endif; ?>

                </div>
              </div>

              <div class="edge__row edge__bottom">
                <h2 class="heading center sans"><?php the_field('our_edge_bottom_row_heading'); ?></h2>
                <div class="edge__items">

                  <?php if (have_rows('our_edge_bottom_row')) : ?>
                  <?php while (have_rows('our_edge_bottom_row')) : the_row(); ?>

                  <div class="edge__stat">
                    <?php if (get_sub_field('image')) : ?>
                    <img src="<?php the_sub_field('image'); ?>" />
                    <?php endif; ?>
                    <h2><?php the_sub_field('heading'); ?></h2>
                    <p><?php the_sub_field('text'); ?></p>
                  </div>

                  <?php endwhile; ?>
                  <?php endif; ?>
                </div>
              </div>

            </div>
          </section>
        </div>
        <div class="tab-content tab-content--alt" data-content="3">
          <section class="fund__section">
            <div class="container">
              <?php if (get_field('our_funds_image')) : ?>
              <img src="<?php the_field('our_funds_image'); ?>" />
              <?php endif; ?>
              <div class="fund__section__text">
                <p class="highlight">
                  <?php the_field('our_funds_highlight'); ?>
                </p>
                <?php the_field('our_funds_text'); ?>
              </div>
            </div>
          </section>
        </div>
        <div class="tab-content" data-content="4">
          <section class="businesses__section" style="background-image:url(<?= the_field('our_businesses_image'); ?>);">
            <div class="container">
              <div class="our_businesses__item">
                <h2 class="firm__heading heading alt center"><?php the_field('our_businesses_heading'); ?></h2>

                <?php the_field('our_businesses_text'); ?>
              </div>
            </div>
          </section>
        </div>
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