<?php

/**
 * Plugin Name:       Elements Fusion
 * Plugin URI:        https://elements-fusion.com
 * Description:       A custom Elementor widget bundle for WordPress, including creative design components and advanced UI elements.
 * Version:           1.0.0
 * Requires at least: 5.5
 * Requires PHP:      7.4
 * Author:            Ahmed Imran
 * Author URI:        https://elements-fusion.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       elements-fusion
 * Domain Path:       /languages
 */


if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Require the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Initialize the plugin
use ElementsFusion\Loader;

define( 'ELEMENTS_FUSION_URL', plugin_dir_url( __FILE__ ) );
define( 'ELEMENTS_FUSION_PATH', plugin_dir_path( __FILE__ ) );
define( 'ELEMENTS_FUSION_WIDGET_PREFIX', 'ef_' ); // Prefix for all widgets


function elements_fusion_init() {
    $loader = new Loader();
    $loader->init();
}
add_action( 'plugins_loaded', 'elements_fusion_init' );