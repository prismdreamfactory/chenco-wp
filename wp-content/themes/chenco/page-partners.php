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


      <div class="tabs--index">
        <div class="tabs__sidebar">
          <select class="select2 partners__toggle" name="partners">
            <?php while (have_rows('partners')) : the_row(); ?>
            <option value="<?php echo get_row_index(); ?>"><?php the_sub_field('region'); ?></option>
            <?php endwhile; ?>
          </select>

          <?php while (have_rows('partners')) : the_row(); ?>
          <div
            class="tabs tabs--<?php echo get_row_index(); ?> <?php if (get_row_index() == 1) : ?>active<?php endif; ?>">
            <ul class="tabs-nav">
              <?php while (have_rows('companies')) : the_row(); ?>
              <li class="tab--<?php echo get_row_index(); ?> <?php if (get_row_index() == 1) : ?>active<?php endif; ?>"
                data-tab="<?php echo get_row_index(); ?>">
                <span class="tab__text"><?php the_sub_field('name'); ?></span>
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
          <?php endwhile; ?>
        </div>

        <?php while (have_rows('partners')) : the_row(); ?>
        <div
          class="tab-container tab-container--<?php echo get_row_index(); ?> <?php if (get_row_index() == 1) : ?>active<?php endif; ?>">
          <?php while (have_rows('companies')) : the_row(); ?>
          <div class="tab-content <?php if (get_row_index() == 1) : ?>active<?php endif; ?>"
            data-content="<?php echo get_row_index(); ?>">
            <section class="partners__section">
              <div class="partners__section--top">
                <div>
                  <p class="highlight"><?php the_sub_field('description'); ?></p>
                  <p><?php the_sub_field('details'); ?></p>
                </div>
                <div class="partners__contact">
                  <img src="<?php the_sub_field('logo'); ?>" />

                  <div class="partners__address">
                    <?php if (the_sub_field('description')) : ?><h4>HEADQUARTERS</h4>
                    <? endif; ?>
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

            </section>
          </div>
          <?php endwhile; ?>
        </div>
        <?php endwhile; ?>

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