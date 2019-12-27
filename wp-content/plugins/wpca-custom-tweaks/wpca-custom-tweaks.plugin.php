<?php
/*
Plugin Name: WPCA Custom Tweaks
Plugin URI:
Description: Code snippets for customer area
Version:     1.0.0
Author:      Thomas Lartaud
Author URI:  https://wp-customerarea.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined('ABSPATH') or die('Nope, not accessing this');

/**
 * REDIRECTS
 */
function cuar_change_default_customer_page($redirect_to)
{
  return 'customer-private-files';
}
add_filter('cuar/routing/redirect/root-page-to-slug?slug=' . 'customer-home', 'cuar_change_default_customer_page');

function cuar_change_default_dashboard_page($redirect_to)
{
  return 'customer-home';
}
add_filter('cuar/routing/redirect/root-page-to-slug?slug=' . 'customer-dashboard', 'cuar_change_default_dashboard_page');

function cuar_get_custom_logout_redirect_url($current_url = null, $redirect_slug = 'customer-dashboard', $redirect_url = null)
{
  return '/';
}
add_filter('cuar/routing/logout-url', 'cuar_get_custom_logout_redirect_url', 10, 3);

function remove_some_profile_fields($fields)
{
  unset($fields['user_url']);
  unset($fields['description']);
  return $fields;
}
add_filter('cuar/core/user-profile/get_profile_fields', 'remove_some_profile_fields');


// function custom_cuar_add_search_acf_fields($args, $criteria)
// {
//   echo '<pre>', var_dump($args), '</pre>';
//   echo '<pre>', var_dump($criteria), '</pre>';

//   // $args['meta_query'] = array(
//   //   'relation'      => 'AND',
//   //   $args['meta_query'],
//   //   array(
//   //     'key'       => 'document_type',
//   //     'value'     => 'Monthly Report',
//   //     'compare'   => 'LIKE'
//   //   ),
//   // );

//   return $args;
// }
// add_filter('cuar/search/content/query-args', 'custom_cuar_add_search_acf_fields', 2, 90);

function cuar_custom_search($args)
{
  // echo '<pre>', var_dump($args), '</pre>';
  // echo '<pre>', var_dump($_POST), '</pre>';

  $new_args = $args;

  if (!empty($_POST)) {
    if (isset($_POST['document_name'])) {
      $new_args['s'] = $_POST['document_name'];
    }

    if (isset($_POST['sortby'])) {
      $new_args['orderby'] = $_POST['sortby'];
      $_SESSION['selected_sortby'] = $_POST['sortby'];
    }

    if (isset($_POST['order'])) {
      $new_args['order'] = $_POST['order'];
      $_SESSION['selected_order'] = $_POST['order'];
    }

    if ($_POST['document_type'] !== 'all') {
      $new_args['tax_query'] = array(
        array(
          'taxonomy' => 'cuar_private_file_category',
          'field' => 'slug',
          'terms'    => $_POST['document_type']
        ),
      );
    }
    $_SESSION['selected_document_type'] = $_POST['document_type'];
    // $new_args['posts_per_page'] = $_POST['posts_per_page'] * 1;




    if (!empty($_POST['file_date'])) {
      $date_range = $_POST['file_date'];

      preg_match('/^\d+-\d+-\d+/', $date_range, $start_date_match);
      preg_match('/^\d+-\d+-\d+\s-\s(\d+-\d+-\d+)$/', $date_range, $end_date_match);

      $start_date = $start_date_match[0];
      $end_date = !empty($end_date_match) ? $end_date_match[1] : date('d-m-Y');

      $new_args['date_query'] = array(
        array(
          'column' => 'post_published',
          'after'     => $start_date,
          'before'    => $end_date,
          'inclusive' => true,
        ),
      );
    }
  }

  return $new_args;
}

// You can change the page slug to another one, for instance 'customer-private-pages' or 'customer-conversations'
$page_slug = 'customer-private-files';
add_filter('cuar/core/page/query-args?slug=' . $page_slug, 'cuar_custom_search');