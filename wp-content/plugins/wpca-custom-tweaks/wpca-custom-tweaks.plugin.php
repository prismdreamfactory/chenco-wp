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

function custom_cuar_add_search_acf_fields($args, $criteria)
{
  echo '<pre>', var_dump($args), '</pre>';
  echo '<pre>', var_dump($criteria), '</pre>';

  // $args['meta_query'] = array(
  //   'relation'      => 'AND',
  //   $args['meta_query'],
  //   array(
  //     'key'       => 'document_type',
  //     'value'     => 'Monthly Report',
  //     'compare'   => 'LIKE'
  //   ),
  // );
  return $args;
}
add_filter('cuar/search/content/query-args', 'custom_cuar_add_search_acf_fields', 2, 90);

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