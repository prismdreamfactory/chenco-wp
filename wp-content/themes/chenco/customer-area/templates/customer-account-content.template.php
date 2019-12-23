<?php

/**
 * Template version: 4.0.0
 * Template zone: frontend
 *
 * -= 4.0.0 =-
 * - Added field groups
 *
 * -= 3.2.0 =-
 * - Added translation for 'Profile'
 *
 * -= 3.1.0 =-
 * - Replace clearfix CSS classes with cuar-clearfix
 *
 * -= 3.0.0 =-
 * - Improve UI for new master-skin
 *
 * -= 1.2.0 =-
 * - Added addresses
 *
 * -= 1.1.0 =-
 * - Added updated message
 *
 * -= 1.0.0 =-
 * - Initial version
 *
 */

$current_user = $this->get_current_user();
?>

<div class="page-heading">
  <div class="media-body va-m" style="width: 100%;">

    <?php
    if (isset($_GET['updated']) && $_GET['updated'] == 1) {
      printf('<p class="alert alert-info mt15 mbn">%s</p>', __('Your profile has been updated', 'cuar'));
    }
    ?>

    <h1><?php echo $current_user->display_name; ?>
      <small> - <?php _e('Account Details', 'cuar'); ?></small>
    </h1>

  </div>
</div>

<?php $this->print_account_fields(); ?>