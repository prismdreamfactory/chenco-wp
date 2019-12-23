<?php

/**
 * Template version: 4.0.0
 * Template zone: frontend
 *
 * -= 4.0.0 =-
 * - Added field groups
 *
 * -= 3.1.0 =-
 * - Replace clearfix CSS classes with cuar-clearfix
 *
 * -= 3.0.0 =-
 * - Improve UI for new master-skin
 *
 * -= 1.1.0 =-
 * - Added addresses
 *
 * -= 1.0.0 =-
 * - Initial version
 */

$current_user = get_userdata(get_current_user_id());
?>

<?php $this->print_form_header(); ?>

<div class="page-heading">

  <h1><?php echo $current_user->display_name; ?>
    <small> - Edit Account</small>
  </h1>

</div>

<?php $this->print_account_fields(); ?>

<?php $this->print_submit_button(__('Submit', 'cuar')); ?>

<?php $this->print_form_footer(); ?>