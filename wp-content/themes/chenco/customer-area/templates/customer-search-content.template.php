<?php

/** Template version: 3.0.0
 *
 * -= 3.0.0 =-
 * - Updated markup for the new master-skin UI
 *
 * -= 1.0.0 =-
 * - Initial version
 *
 */ ?>
<?php
global $current_user;
?>

<div class="investor__header">
  <h1><?= $current_user->display_name; ?></h1>
  <h2>Chenco Holdings - Fund Administration</h2>
</div>

<h3>Search</h3>

<?php $this->print_search_form(); ?>

<?php $this->print_search_results(); ?>

<?php /*<div class="search-section panel">
  <div class="panel-heading">
    <span class="panel-title"><?php _e('Query', 'cuarse'); ?></span>
</div>
<div class="panel-menu dark">
  <?php $this->print_search_form_minimal(); ?>
</div>
<div class="panel-body">
  <?php $this->print_search_results(); ?>
</div>
</div>*/ ?>