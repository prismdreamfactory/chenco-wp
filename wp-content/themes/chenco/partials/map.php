<?php

/**
 * The template for displaying google map on home page.
 */

?>

<section class="map">

  <div class="map__tabs">
    <div class="map__tab font--alt mod--active" data-center="global"><?php pll_e('Global'); ?>
    </div>
    <div class="map__tab font--alt" data-center="usa"><?php pll_e('U.S. Properties'); ?></div>
    <div class="map__tab font--alt" data-center="asia"><?php pll_e('Greater China Properties'); ?></div>
  </div>

  <div class="map-wrapper">
    <div id="map">

      <?php
      $loop = new WP_Query(
        array(
          'post_type' => 'properties',
          'posts_per_page' => -1,
        )
      );
      while ($loop->have_posts()) : $loop->the_post(); ?>

      <?php if (have_rows('location')) : the_row();
          $lat = get_sub_field('latitude');
          $lng = get_sub_field('longitude');
          $type = get_field('asset_type');
          $units = get_field('units');
          $sqft = get_field('sqft');
          $acres = get_field('acres');

          preg_match('/,(.*)/', get_sub_field('address'), $address);

          $current = get_field('current_property', false, false);

          if ($type['value'] == 'O') {
            $officeSqft = get_field('sqft');
            $indSqft = '';
          } elseif ($type['value'] == 'Ind') {
            $officeSqft = '';
            $indSqft = get_field('sqft');
          } else {
            $officeSqft = '';
            $indSqft = '';
          }

          $stats = $officeSqft . "," . get_field('units') . "," . get_field('acres') . "," . $indSqft;
        ?>

      <div class="marker" style="display: none;" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>"
        data-type="<?= $type['label'] ?>" data-current="<?= $current; ?>" data-stats="<?= $stats ?>">
        <div class="map__info">
          <p class="map__info__item"><span><?php pll_e('Location'); ?>:</span> <?php echo $address[1]; ?>
          </p>
          <p class="map__info__item"><span><?php pll_e('Property Type'); ?>:</span> <?php echo $type['label']; ?>
          </p>
          <p class="map__info__item">
            <?php if ($units) : ?>
            <span class="units"><span><?php pll_e('Units'); ?>:</span> <?php echo number_format($units); ?></span>
            <?php endif; ?>
            <?php if ($sqft) : ?>
            <span class="sqft"><span><?php pll_e('Sq. Ft.'); ?>:</span> <?php echo number_format($sqft); ?></span>
            <?php endif; ?>
            <?php if ($acres) : ?>
            <span class="acres"><span><?php pll_e('Acres'); ?>:</span> <?php echo number_format($acres); ?></span>
            <?php endif; ?>
          </p>

          <a href="javascript:" class="map__info__button">View Property</a>
        </div>
      </div>

      <?php endif; ?>

      <?php endwhile; ?>

    </div>

    <div class="map__legend">
      <div class="map__legend--main">
        <!-- <h3 class="map__legend-region"><?php pll_e('United States'); ?></h3> -->
        <p class="map__legend-row mod--office"><span><i>5,900,000</i>
            <?php pll_e('Sq. Ft.'); ?></span><span><?php pll_e('Commercial Properties'); ?></span>
        </p>
        <p class="map__legend-row mod--multifamily"><span><i>24,000</i>
            <?php pll_e('Units'); ?></span><span><?php pll_e('Multifamily Properties'); ?></span>
        </p>
        <p class="map__legend-row mod--land"><span><i>4,000</i>
            <?php pll_e('Acres'); ?></span><span><?php pll_e('Land Acres'); ?></span></p>
        <p class="map__legend-row mod--industrial"><span><i>3,540,000</i>
            <?php pll_e('Sq. Ft.'); ?></span><span><?php pll_e('Industrial Properties'); ?></span>
        </p>
      </div>
      <div class="map__legend--bottom">
        <label class="legend__label"><?php pll_e('Legend'); ?>:</label>
        <ul class="legend__list">
          <li class="legend__list-item mod--office"><?php pll_e('Office (SF)'); ?></li>
          <li class="legend__list-item mod--multifamily"><?php pll_e('Multifamily (Units)'); ?></li>
          <li class="legend__list-item mod--land"><?php pll_e('Land (Acres)'); ?></li>
          <li class="legend__list-item mod--industrial"><?php pll_e('Industrial (SF)'); ?></li>
        </ul>
      </div>
    </div>

    <div class="map__switch">
      <div class="map__switch-item mod--active" data-current="true"><i></i><?php pll_e('Current'); ?></div>
      <div class="map__switch-item" data-current="false"><i></i><?php pll_e('Historical'); ?></div>
    </div>

  </div>

</section>