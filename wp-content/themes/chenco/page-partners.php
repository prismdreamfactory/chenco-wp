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
              <img src="<?php the_sub_field('icon'); ?>" class="tab__icon" />
              <span class="tab__text"><?php the_sub_field('name'); ?></span>

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
                    <img src="<?php the_sub_field('logo'); ?>" />

                    <div class="partners__address">
                      <h4>HEADQUARTERS</h4>
                      <address><?php the_sub_field('address'); ?></address>
                      <?php $link = get_sub_field('website');
                          if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                          ?>
                      <a href="<?php echo esc_url($link_url); ?>" target="_blank" rel=”noopener”
                        rel=”noreferrer”><?php echo esc_html($link_title); ?></a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <?php if (get_row_index() == 1) : ?>
                <div class="partners__section--bottom">
                  <?php while (have_rows('bascom')) : the_row(); ?>
                  <h2><?php the_sub_field('bascom_heading'); ?></h2>
                  <?php endwhile; ?>
                  <div class="slick operators">
                    <?php while (have_rows('bascom_operators')) : the_row(); ?>
                    <img src="<?php the_sub_field('bascom_logo'); ?>" />
                    <?php endwhile; ?>
                  </div>
                  <?php while (have_rows('bascom')) : the_row(); ?>
                  <?php $link = get_sub_field('bascom_link'); ?>
                  <a href="<?= $link['url'] ?>" class="btn"><?= $link['title'] ?></a>
                  <?php endwhile; ?>
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