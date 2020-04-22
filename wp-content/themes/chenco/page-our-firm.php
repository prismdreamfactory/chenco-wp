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

    <div class="container">
      <div class="page__header">
        <h1 class="heading"><?php the_title(); ?></h1>
      </div>
    </div>

    <div class="tabs tabs--firm">
      <div class="container">
        <ul class="tabs-nav">
          <?php if (have_rows('our_firm_tabs')) : ?>
          <?php while (have_rows('our_firm_tabs')) : the_row(); ?>
          <li class="tab" data-tab-name="firm">
            <a href="#<?= get_row_index(); ?>" class="smooth-scroll">
              <img src="<?php the_sub_field('image'); ?>" class="tab__icon" />
              <span><?php the_sub_field('label'); ?></span>
            </a>
          </li>
          <?php endwhile; ?>
          <?php endif; ?>
        </ul>
      </div>

      <div class="tab-container">

        <div class="container">
          <section class="firm__section">
            <div class="overview__section">
              <h2 class="firm__heading heading">OVERVIEW</h2>

              <?php the_content(); ?>
            </div>
          </section>

          <section class="vision__section" id="1">
            <h2 class="firm__heading heading">Our Vision</h2>

            <div class="firm__section--top">
              <div class="firm__subheading highlight">
                <?php the_field('our_vision_text'); ?>
              </div>

              <img src="<?php the_field('our_vision_image'); ?>" />
            </div>

          </section>
        </div>

        <section class="edge__section" id="2">
          <div class="container">
            <h2 class="firm__heading heading center">Our Performance</h2>


            <div class="edge__row edge__top">

              <p class="highlight"><?php the_field('heading'); ?></h2>

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
              <div class="edge__items">
                <?php if (have_rows('our_edge_middle_row')) : ?>
                <?php while (have_rows('our_edge_middle_row')) : the_row(); ?>
                <div class="edge__stat">

                  <div class="edge__circle" style="background-image: url(/wp-content/uploads/2020/02/stat-circle.png);">
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
        </section>

        <section class="businesses__section" id="3"
          style="background-image:url(<?= the_field('our_businesses_image'); ?>);">
          <div class="container">
            <div class="our_businesses__item">
              <h2 class="firm__heading heading alt"><?php the_field('our_businesses_heading'); ?></h2>

              <?php the_field('our_businesses_text'); ?>
            </div>
          </div>
        </section>

        <section class="fund__section" id="4">
          <div class="container fund__section__content">
            <?php if (get_field('our_funds_image')) : ?>
            <img src="<?php the_field('our_funds_image'); ?>" />
            <?php endif; ?>
            <div class="fund__section__text">
              <h2 class="firm__heading heading">Our Funds</h2>
              <p class="highlight">
                <?php the_field('our_funds_highlight'); ?>
              </p>
              <?php the_field('our_funds_text'); ?>
            </div>

          </div>
        </section>

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