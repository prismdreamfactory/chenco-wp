<?php

/** Template version: 3.1.0
 *
 * -= 3.1.0 =-
 * - Added collection title
 *
 * -= 3.0.0 =-
 * - Improve UI for new master-skin
 *
 * -= 1.1.0 =-
 * - Updated markup
 *
 * -= 1.0.0 =-
 * - Initial version
 *
 */ ?>

<?php /** @var WP_Query $content_query */ ?>
<?php /** @var string $item_template */ ?>
<?php /** @var string $page_subtitle */ ?>
<?php /** @var int $current_page */ ?>

<?php
global $current_user;
global $post;

// $current_addon_slug = 'customer-private-files';
// $current_addon_icon = apply_filters('cuar/private-content/view/icon?addon=' . $current_addon_slug, 'fa fa-file');
// $current_addon = cuar_addon($current_addon_slug);
// $post_type = $current_addon->get_friendly_post_type();

$search = cuar_addon('customer-search');
?>

<div class="investor__header">
  <h1><?= $current_user->display_name; ?></h1>
  <h2>Chenco Holdings - Fund Administration</h2>
</div>

<h3>Documents</h3>

<?php include(dirname(__DIR__) . '/partials/custom-search.php'); ?>

<div class="table__scroll">
  <table class="investor__files" summary="Investments">
    <thead>
      <tr>
        <th>Date</th>
        <th>Investor</th>
        <th>Investment</th>
        <th>Document Name</th>
        <th>Document Type</th>
        <th>Download</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($content_query->have_posts()) {
        $content_query->the_post();
        global $post;

        include($item_template);
      }
      ?>
    </tbody>
  </table>
</div>


<?php /* <div class="cuar-collection-title page-heading">
  <div class="cuar-title h2">
    <small class="pull-right">
      <?php echo wp_sprintf(__('Page %1$s/%2$s', 'cuar'), $current_page, $content_query->max_num_pages); ?>
</small>
<?php echo $page_subtitle; ?>
</div>
</div>

<div class="collection <?php echo $post_type; ?>">
  <div id="cuar-js-collection-gallery" class="collection-content" data-type="<?php echo $post_type; ?>">
    <div class="fail-message alert alert-warning">
      <?php _e('No items were found matching the selected filters', 'cuar'); ?>
    </div>
    <?php /*
    while ($content_query->have_posts()) {
      $content_query->the_post();
      global $post;

      include($item_template);
    }
    ?>
    <div class="gap"></div>
    <div class="gap"></div>
    <div class="gap"></div>
    <div class="gap"></div>
  </div>
</div> */ ?>