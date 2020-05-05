<?php

/**
 * Chenco Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package chenco
 */

/* Enqueue scripts/styles */
add_action('wp_enqueue_scripts', 'generatepress_parent_theme_enqueue_styles');

/**
 * Enqueue scripts and styles.
 * wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
 */
function generatepress_parent_theme_enqueue_styles()
{
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Domine:400,700|Maven+Pro:400,500,700&display=swap', false);
  wp_enqueue_style('select2-style', '//cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css', '4.0.12', false);
  wp_enqueue_style('slick-style', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css', '1.8.1', false);
  wp_enqueue_style('slick-theme', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css', '1.8.1', false);
  wp_enqueue_style('datepicker-style', '//cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css', '2.2.3', false);
  wp_enqueue_style('modal-style', '//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css', '0.9.1', false);
  wp_enqueue_style('generatepress-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('chenco-style', get_stylesheet_directory_uri() . '/style.css', 'all', true);


  // wp_enqueue_script('google-maps-clusterer', '//developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js', array(), false, false);
  wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=' . getenv('GOOGLE_API_KEY'), array(), false, false);
  wp_enqueue_script('select2', '//cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js', array('jquery'), false, false);
  wp_enqueue_script('slick', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js', array('jquery'), false, false);
  wp_enqueue_script('countto', '//cdnjs.cloudflare.com/ajax/libs/jquery-countto/1.2.0/jquery.countTo.min.js', array('jquery'), false, false);
  wp_enqueue_script('datepicker', '//cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js', array(), false, false);
  wp_enqueue_script('datepicker-english', '//cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.min.js', array(), false, false);
  wp_enqueue_script('modal', '//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js', array(), false, false);
  wp_enqueue_script('chenco-js', get_stylesheet_directory_uri() . '/script.js', array('datepicker', 'countto', 'google-maps', 'slick', 'modal'));
}

/**
 * Remove bottom footer bar & copyright
 */
add_action('after_setup_theme', 'chenco_remove_footer_area');
function chenco_remove_footer_area()
{
  remove_action('generate_footer', 'generate_construct_footer');
}
/*
add_filter('generate_copyright', 'chenco_custom_copyright');
function chenco_custom_copyright()
{
?>
© 2020 Chenco Holdings. All Rights Reserved.
<?php
}*/

add_filter('generate_footer_widget_1_width', function () {
  return '40';
});

add_filter('generate_footer_widget_2_width', function () {
  return '60';
});

/**
 * Load Google Maps API for ACF
 */
add_action('acf/init', 'chenco_acf_init');
function chenco_acf_init()
{
  acf_update_setting('google_api_key', getenv('GOOGLE_API_KEY'));
}

add_theme_support('customer-area.stylesheet');
// add_theme_support('customer-area.navigation-menu');
add_theme_support('customer-area.contextual-toolbar');
add_theme_support('customer-area.library.jquery.select2', array('files', 'markup'));
add_theme_support('customer-area.library.bootstrap.dropdown');
add_theme_support('customer-area.library.bootstrap.transition');
add_theme_support('customer-area.library.bootstrap.collapse');

/**
 * WP All Import hook to geocode provided address into lat and lng
 */
add_action('pmxi_saved_post', 'save_custom_field_address', 10, 3);
// add_action('save_post', 'save_custom_field_address', 10, 3);
function save_custom_field_address($post_id, $xml_data, $is_update)
{
  $address_custom_field = 'location_address'; // The custom field you imported the address into
  $api_key = getenv('GOOGLE_API_KEY');
  $lat_cf = 'location_latitude'; // The custom field you want the latitude imported into
  $lng_cf = 'location_longitude'; // The custom field you want the longitude imported into


  if ($address = get_post_meta($post_id, $address_custom_field, true)) {
    $google_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . rawurlencode($address) . '&key=' . $api_key;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $google_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $json = curl_exec($curl);
    curl_close($curl);

    if (!empty($json)) {
      $details = json_decode($json, true);
      $lat = $details['results'][0]['geometry']['location']['lat'];
      $lng = $details['results'][0]['geometry']['location']['lng'];

      update_post_meta($post_id, $lat_cf, $lat);
      update_post_meta($post_id, $lng_cf, $lng);
    }
  }
}

/**
 * Custom navigation menu description
 */
add_filter('walker_nav_menu_start_el', 'chenco_menu_item_description', 10, 4);
function chenco_menu_item_description($item_output, $item, $depth, $args)
{
  if ('primary' == $args->theme_location || 'secondary' == $args->theme_location || 'slideout' == $args->theme_location) {
    $item_output = str_replace($args->link_after . '</a>', $args->link_after . '</span><span class="description">' . $item->description . '</span></a>', $item_output);
  }

  return $item_output;
}

// function custom_rewrite_basic()
// {
// add_rewrite_rule('investor-portal/(.*)/', 'customer-area/$matches[1]/index.php', 'top');
// }
// add_action('init', 'custom_rewrite_basic');

/**
 * https: //snippets.webaware.com.au/snippets/wordpress-login-link-with-a-popup-form/
 */

if (!is_admin()) {

  /**
   * filter menu items to replace login link with logout link when user is logged in
   * if Login with Ajax is installed, use it for the login link
   * @param string $item_output
   * @param WP_Post $item
   * @return string
   */
  add_filter('walker_nav_menu_start_el', function ($item_output, $item) {
    if ($item->type === 'custom' && strpos($item->url, 'wp-login.php') !== false) {
      if (is_user_logged_in()) {
        $item_output = sprintf('<a href="%s">%s</a>', wp_logout_url(get_permalink()), pll__('Logout'));
      } else {
        if (class_exists('LoginWithAjax')) {
          $item_output = sprintf('<a class="login-link" href="%s">%s</a>', esc_url(wp_login_url(get_permalink())), esc_html($item->title));
          add_action('wp_print_footer_scripts', 'load_lwa_login_template');
        } else {
          $item_output = sprintf('<a href="%s">%s</a>', wp_login_url(get_permalink()), esc_html($item->title));
        }
      }
    }

    return $item_output;
  }, 10, 2);
}

/**
 * load the Login with Ajax modal script for the menu link
 * called from wp_print_footer_scripts
 */
function load_lwa_login_template()
{
  $script = \LoginWithAjax::shortcode([
    'template'      => 'login',
    'profile_link'  => false,
    'registration'  => false,
  ]);

  // strip extraneous whitespace to reduce size
  $script = preg_replace('#^\s*#m', '', $script);

  echo $script;
}


add_filter('if_menu_conditions', 'wpb_new_menu_conditions');
function wpb_new_menu_conditions($conditions)
{
  $conditions[] = array(
    'name'    =>  'If it is Custom Post Type archive', // name of the condition
    'condition' =>  function ($item) {          // callback - must return TRUE or FALSE
      return is_post_type_archive();
    }
  );

  return $conditions;
}

add_filter('generate_back_to_top_scroll_speed', 'chenco_back_to_top_scroll_speed');
function chenco_back_to_top_scroll_speed()
{
  return 10; // milliseconds
}

if (function_exists('pll_register_string')) {
  pll_register_string('login', 'Log In');
  pll_register_string('login', 'Logout');
  pll_register_string('login', 'Email or Username');
  pll_register_string('login', 'Password');
  pll_register_string('login', 'Remember Me');
  pll_register_string('login', 'Lost your password');

  pll_register_string('investor', 'Investor Login');

  pll_register_string('map', 'Global');
  pll_register_string('map', 'U.S. Properties');
  pll_register_string('map', 'Greater China Properties');

  pll_register_string('map', 'United States');
  pll_register_string('map', 'Sq. Ft.');
  pll_register_string('map', 'Units');
  pll_register_string('map', 'Acres');
  pll_register_string('map', 'Commercial Properties');
  pll_register_string('map', 'Multifamily Properties');
  pll_register_string('map', 'Land Acres');
  pll_register_string('map', 'Industrial Properties');

  pll_register_string('map', 'Legend');
  pll_register_string('map', 'Office');
  pll_register_string('map', 'Multifamily');
  pll_register_string('map', 'Land');
  pll_register_string('map', 'Industrial');
  pll_register_string('map', 'SF');

  pll_register_string('map', 'Location');
  pll_register_string('map', 'Property Type');

  pll_register_string('map', 'Current');
  pll_register_string('map', 'Historical');

  pll_register_string('about', 'Overview');
  pll_register_string('about', 'Our Vision');
  pll_register_string('about', 'Our Performance');
  pll_register_string('about', 'Our Funds');
}