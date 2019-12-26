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

$terms = get_terms(array(
  'taxonomy'   => 'cuar_private_file_category',
  'orderby'    => 'count',
  'hide_empty' => false,
  'fields'     => 'all'
));

// echo '<pre>', var_dump($terms), '</pre>';

// $current_addon_slug = 'customer-private-files';
// $current_addon_icon = apply_filters('cuar/private-content/view/icon?addon=' . $current_addon_slug, 'fa fa-file');
// $current_addon = cuar_addon($current_addon_slug);
// $post_type = $current_addon->get_friendly_post_type();

$search = cuar_addon('customer-search');
// var_dump($search->criteria);
?>

<div class="investor__header">
  <h1><?= $current_user->display_name; ?></h1>
  <h2>Chenco Holdings - Fund Administration</h2>
</div>

<h3>Documents</h3>

<?php /*<div class="investor__search">

 <?php $search->print_form_header(); ?>

<div class="form-group">
  <div class="control-container">
    <div class="input-group input-hero input-hero-sm">
      <span class="input-group-addon">
        <i class="fa fa-search"></i>
      </span>
      <input type="text" name="cuar_query" id="cuar_query" class="form-control"
        placeholder="<?php esc_attr_e('Search something ...', 'cuarse'); ?>"
        value="<?php echo $search->criteria['query']; ?>" />
    </div>
  </div>
</div>

<div class="form-group hidden">
  <div class="submit-container">
    <input type="submit" name="cuar_do_search" value="<?php _e("Search", 'cuarse'); ?>"
      class="btn btn-primary pull-right" />
  </div>
</div>

<?php $search->print_form_footer(); ?>
</div> */ ?>

<div class="investor__search">
  <form name="search" method="post">
    <div class="form-group">
      <label class="control-label">Date Range</label>
      <input type="text" class="datepicker-here" data-language='en' data-range="true"
        data-multiple-dates-separator=" - " data-language="en" data-date-format="dd/mm/yyyy" name="file_date" />
    </div>

    <div class="form-group">
      <label class="control-label">Document Type</label>
      <!-- <select name="document_type">
        <option value="Monthly Report">Monthly Report</option>
        <option value="title">Document name</option>
      </select> -->
      <select name="document_type">
        <option value="All">All</option>
        <?php foreach ($terms as $term) : ?>
        <option value="<?= $term->name; ?>"><?= $term->name; ?></option>;
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label class="control-label">Document Name</label>
      <input type="text" name="document_name" />
    </div>

    <!-- <div class="form-group">
      <label class="control-label">Investment</label>
      <select name="investment"></select>
    </div> -->

    <div class="form-group">
      <label class="control-label">Sort By</label>
      <select name="orderby">
        <option value="date">Date</option>
        <option value="title">Document name</option>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label">Sort Order</label>
      <select name="order">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
      </select>
    </div>

    <!-- <div class="form-group">
      <label class="control-label">Limit</label>
      <select name="posts_per_page">
        <option value="1">1</option>
        <option value="25">25</option>
        <option value="50">50</option>
      </select>
    </div> -->

    <div class="form-group form-submit">
      <input type="submit" name="search" value="Search" class="btn" />
    </div>
  </form>
</div>

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