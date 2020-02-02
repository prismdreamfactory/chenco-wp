<?php

/* Template Name: Team Page */

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

    <div class="team container">
      <div class="page__header">
        <h1>Our Team</h1>
        <span class="front-line"></span>
        <p><?php the_content(); ?></p>
      </div>
      <div class="team-container">
        <?php
        $loop = new WP_Query(
          array(
            'post_type' => 'teammembers',
            'posts_per_page' => -1,
          )
        );
        while ($loop->have_posts()) : $loop->the_post(); ?>

        <div class="team__item">
          <a href="#modal--<?= get_the_ID(); ?>" rel="modal:open">
            <?php the_post_thumbnail(); ?>
          </a>
          <a href="javascript:">
            <h5><?php the_title(); ?></h5>
          </a>
          <h6><?php the_field('role'); ?></h6>
        </div>

        <?php endwhile; ?>
      </div>
    </div>

    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
    <div class="modal" style="display: none;" id="modal--<?= get_the_ID(); ?>">
      <div class="team__modal">
        <div class="team__modal-left">
          <?php the_post_thumbnail(); ?>
          <a href="javascript:">Connect with me</a>
          <div class="team__modal-left-info">
            <p>Joined in <?php the_field('join_date'); ?></p>
          </div>
        </div>
        <div class="team__modal-right">
          <h3><?php the_title(); ?></h3>
          <h4><?php the_field('role'); ?></h4>
          <p><?php the_content(); ?></p>
        </div>
      </div>
    </div>
    <?php endwhile; ?>

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
