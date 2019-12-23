<?php

/** Template version: 3.0.0
 *
 * -= 3.0.0 =-
 * - Initial version
 *
 */ ?>

<?php
global $post;
$date = sprintf("<em>%s</em>", get_the_date());
$author = sprintf("<em>%s</em>", get_the_author_meta('display_name'));
$recipients = sprintf("<em>%s</em>", cuar_get_the_owner());
?>

<aside class="investor__sidebar">
  <?php
  wp_nav_menu(array(
    'theme_location' => 'cuar_main_menu',
    'container_class' => 'investor__nav'
  ));
  ?>
</aside>

<?php /* <div class="cuar-search-form">
  <?php $this->print_search_form(); ?>
</div> */ ?>