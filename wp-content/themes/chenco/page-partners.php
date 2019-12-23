<?php

/* Template Name: Partners Page */

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

    <div class="partners">
      <div class="container">
        <div class="page__header">
          <h1 class="heading"><?php the_title(); ?></h1>
          <p><?php the_content(); ?></p>
        </div>
      </div>

      <div class="tabs tabs--alt">
        <div class="container">
          <ul class="tabs-nav">
            <?php while (have_rows('company')) : the_row(); ?>
            <li
              class="tab tab--<?php echo get_row_index(); ?> <?php if (get_row_index() == 1) : ?>active<?php endif; ?>"
              data-tab="<?php echo get_row_index(); ?>">
              <div class="tab__image-wrap"><img src="<?php the_sub_field('logo'); ?>"
                  class="tab__logo tab__logo-<?php echo get_row_index(); ?>" /></div>
            </li>
            <?php endwhile; ?>
          </ul>
        </div>

        <div class="tab-container">
          <?php while (have_rows('company')) : the_row(); ?>
          <div class="tab-content <?php if (get_row_index() == 1) : ?>active<?php endif; ?>"
            data-content="<?php echo get_row_index(); ?>">
            <div class="container">
              <section class="partners__section">
                <div class="partners__section--top">
                  <div>
                    <p class="highlight"><?php the_sub_field('description'); ?></p>
                    <p><?php the_sub_field('details'); ?></p>
                  </div>
                  <div class="partners__contact">
                    <h4>TEAM LEAD</h4>
                    <p><?php the_sub_field('team_lead_name'); ?></p>

                    <div class="partners__address">
                      <address><?php the_sub_field('address'); ?> <br> +<?php the_sub_field('phone'); ?></address>
                      <a href="javascript:"><?php the_sub_field('website'); ?></a>
                    </div>
                  </div>
                </div>

                <?php if (get_row_index() == 1) : ?>
                <div class="partners__section--bottom">
                  <h2>Bascom Operators</h2>
                  <div class="slick operators">
                    <?php while (have_rows('bascom_operators')) : the_row(); ?>
                    <img src="<?php the_sub_field('bascom_logo'); ?>" />
                    <?php endwhile; ?>
                  </div>
                  <a href="/bascom-operators" class="btn">Learn More</a>
                </div>
                <?php endif; ?>

              </section>
            </div>
          </div>
          <?php endwhile; ?>
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