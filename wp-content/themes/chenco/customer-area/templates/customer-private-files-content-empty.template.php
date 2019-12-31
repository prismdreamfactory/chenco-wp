<?php

/** Template version: 3.0.0
 *
 * -= 3.0.0 =-
 * - Improve UI for new master-skin
 *
 * -= 1.0.0 =-
 * - Initial version
 *
 */
?>

<?php
global $current_user;

$current_addon_slug = 'customer-private-files';
$current_addon_icon = apply_filters('cuar/private-content/view/icon?addon=' . $current_addon_slug, 'fa fa-file');
$current_addon = cuar_addon($current_addon_slug);
$post_type = $current_addon->get_friendly_post_type();
?>

<div class="investor__header">
  <h1><?= $current_user->display_name; ?></h1>
  <h2>Chenco Holdings - Fund Administration</h2>
</div>

<h3>Documents</h3>

<?php include(dirname(__DIR__) . '/partials/custom-search.php'); ?>

<div class="collection panel cuar-empty <?php echo $post_type; ?>">
  <div class="collection-content">
    <p class="mn"><?php _e('Sorry, we could not find any documents matching your search.', 'cuar'); ?></p>
  </div>
</div>