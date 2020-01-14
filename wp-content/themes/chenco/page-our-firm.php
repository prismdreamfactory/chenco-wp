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
          <li class="tab active" data-tab="1" data-tab-name="firm">
            <img src="/wp-content/uploads/2019/12/noun_firm_2274591.png" class="tab__icon" />
            <span>Our Firm</span>
          </li>
          <li class="tab tab--alt" data-tab="2" data-tab-name="edge">
            <img src="/wp-content/uploads/2019/12/noun_performance_1650786.png" class="tab__icon" />
            <span>Our Edge</span>
          </li>
          <li class="tab tab--alt" data-tab="3" data-tab-name="funds">
            <img src="/wp-content/uploads/2019/12/noun_funds_232470.png" class="tab__icon" />
            <span>Our Funds</span>
          </li>
          <li class="tab tab--alt" data-tab="4" data-tab-name="businesses">
            <img src="/wp-content/uploads/2019/12/noun_business-to-business_2343503.png" class="tab__icon" />
            <span>Our Businesses</span>
          </li>
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
                      <?php if (get_sub_field('image')) : ?>
                      <img src="<?php the_sub_field('image'); ?>" />
                      <?php endif; ?>
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
                <h2 class="heading center sans">Our Track Record</h2>
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
                <h2 class="heading center sans">Our Strengths</h2>
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
          <section class="businesses__section">
            <div class="container">
              <h2 class="firm__heading heading alt center">Our Businesses</h2>

              <?php the_field('our_businesses_text'); ?>
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
