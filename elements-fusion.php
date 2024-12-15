<?php
/**
 * Plugin Name: Elements Fusion
 * Plugin URI:  https://example.com
 * Description: A custom plugin to add unique widgets to Elementor.
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://example.com
 * Text Domain: elements-fusion
 * Domain Path: /languages
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Define plugin constants
 */
define( 'ELEMENTS_FUSION_VERSION', '1.0.0' );
define( 'ELEMENTS_FUSION_PATH', plugin_dir_path( __FILE__ ) );
define( 'ELEMENTS_FUSION_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load the plugin text domain for translations
 */
function elements_fusion_load_textdomain() {
    load_plugin_textdomain( 'elements-fusion', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'elements_fusion_load_textdomain' );

/**
 * Check if Elementor is active
 */
function elements_fusion_check_dependencies() {
    if ( !did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'elements_fusion_missing_elementor_notice' );
        return false;
    }
    return true;
}

function elements_fusion_missing_elementor_notice() {
    ?>
<div class="notice notice-error">
  <p>
    <?php esc_html_e( 'Elements Fusion requires Elementor to be active. Please install and activate Elementor.', 'elements-fusion' );?>
  </p>
</div>
<?php
}

/**
 * Initialize the plugin
 */
function elements_fusion_init() {
    if ( !elements_fusion_check_dependencies() ) {
        return;
    }

    // Include the main plugin class
    require_once ELEMENTS_FUSION_PATH . 'includes/class-elements-fusion.php';

    // Initialize the plugin
    Elements_Fusion::instance();
}
add_action( 'plugins_loaded', 'elements_fusion_init' );

/**
 * Enqueue plugin assets
 */
function elements_fusion_enqueue_assets() {
    wp_enqueue_style( 'elements-fusion-style', ELEMENTS_FUSION_URL . 'assets/css/style.css', [], ELEMENTS_FUSION_VERSION );
    wp_enqueue_script( 'elements-fusion-script', ELEMENTS_FUSION_URL . 'assets/js/script.js', ['jquery'], ELEMENTS_FUSION_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'elements_fusion_enqueue_assets' );