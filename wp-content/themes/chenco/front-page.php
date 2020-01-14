<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */
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

    <div class="front">
      <?php if (have_rows('hero')) : ?>
      <?php while (have_rows('hero')) : the_row(); ?>

      <div class="front-hero" style="background-image: url(<?php the_sub_field('image'); ?>);">
        <div class="front-hero-content">

          <div class="container">

            <h1><?php the_sub_field('heading'); ?></h1>
            <h3><?php the_sub_field('text'); ?></h3>
            <a href="<?php the_sub_field('link'); ?>" class="btn">Learn More</a>

          </div>

        </div>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>


      <div class="front-summary">
        <div class="front-summary-text">

          <h4 class="heading alt">Value-Based Investing</h4>
          <h2>
            <?php the_field('tagline'); ?>
          </h2>

          <div class="front-summary-link">
            <div class="link">
              <a href="/our-firm">Value-Based Investing</a>
            </div>
            <div class="link">
              <a href="/partners">Reliabe Partners</a>
            </div>
            <div class="link">
              <a href="/portfolio">Investment Portfolio</a>
            </div>
            <div class="link">
              <a href="/team">A Balanced Team</a>
            </div>
          </div>
        </div>
      </div>

      <div class="front-news">

        <div class="front__news__section">
          <h4 class="heading">Corporate Releases</h4>
          <?php
          $loop = new WP_Query(
            array(
              'category_name' => 'corporate-releases',
              'posts_per_page' => 2,
            )
          );
          while ($loop->have_posts()) : $loop->the_post(); ?>
          <div class="front-news-item">
            <p><?php the_date(); ?></p>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </div>
          <span></span>

          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        </div>

        <div class="front__news__section">
          <h4 class="heading">Recent News</h4>
          <?php
          $loop = new WP_Query(
            array(
              'category_name' => 'uncategorized',
              'posts_per_page' => 2,
            )
          );
          while ($loop->have_posts()) : $loop->the_post(); ?>

          <div class="front-news-item">
            <p><?php the_date(); ?></p>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </div>
          <span></span>

          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        </div>

      </div>

      <?php if (have_rows('project')) : ?>
      <?php while (have_rows('project')) : the_row(); ?>

      <div class="front-project-image" style="background-image: url(<?php the_sub_field('image'); ?>"></div>
      <div class="front-project">

        <h4 class="heading">Project Profile</h4>
        <h2><?php the_sub_field('text'); ?></h2>
        <a class="btn" href="<?php the_sub_field('link'); ?>">Learn More</a>

      </div>
      <?php endwhile; ?>
      <?php endif; ?>

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