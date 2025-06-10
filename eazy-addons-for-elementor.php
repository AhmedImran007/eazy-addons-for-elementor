<?php

/**
 * Plugin Name:       Eazy Addons for Elementor
 * Plugin URI:        https://eazy-addons-for-elementor.com
 * Description:       A custom Elementor widget bundle for WordPress, including creative design components and advanced UI elements.
 * Version:           1.0.0
 * Requires at least: 5.5
 * Requires PHP:      7.4
 * Author:            Ahmed Imran
 * Author URI:        https://eazy-addons-for-elementor.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       eazy-addons-for-elementor
 * Domain Path:       /languages
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Plugin Constants
define( 'EAFE_URL', plugin_dir_url( __FILE__ ) );
define( 'EAFE_PATH', plugin_dir_path( __FILE__ ) );
define( 'EAFE_WIDGET_PREFIX', 'eafe_' ); // Prefix for all widgets

// Plugin Init
use EazyAddonsForElementor\Loader;

function eafe_init() {
    $loader = new Loader();
    $loader->init();
}
add_action( 'plugins_loaded', 'eafe_init' );