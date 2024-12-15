<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Helper function to safely print an array or object for debugging
 *
 * @param mixed $data
 */
function elements_fusion_debug( $data ) {
    echo '<pre>';
    print_r( $data );
    echo '</pre>';
}

/**
 * Retrieve the URL of an asset in the plugin
 *
 * @param string $path Path relative to the assets directory
 * @return string Full URL to the asset
 */
function elements_fusion_asset_url( $path ) {
    return plugin_dir_url( dirname( __FILE__ ) ) . 'assets/' . ltrim( $path, '/' );
}

/**
 * Check if Elementor is active
 *
 * @return bool
 */
function elements_fusion_is_elementor_active() {
    return did_action( 'elementor/loaded' ) > 0;
}