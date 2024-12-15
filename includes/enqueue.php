<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue front-end assets
 */
function elements_fusion_enqueue_frontend_assets() {

    wp_enqueue_style(
        'tailwindcss',
        plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/tailwind.css',
        [],
        file_exists( plugin_dir_path( dirname( __FILE__ ) ) . 'assets/css/tailwind.css' )
        ? filemtime( plugin_dir_path( dirname( __FILE__ ) ) . 'assets/css/tailwind.css' )
        : '1.0.0',
        'all'
    );

    wp_enqueue_style(
        'elements-fusion-style',
        plugin_dir_url( __DIR__ ) . 'assets/css/style.css',
        [],
        '1.0.0'
    );

    wp_enqueue_script(
        'elements-fusion-script',
        plugin_dir_url( __DIR__ ) . 'assets/js/script.js',
        ['jquery'],
        '1.0.0',
        true
    );
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
        [],
        '5.15.4',
        'all'
    );
}
add_action( 'wp_enqueue_scripts', 'elements_fusion_enqueue_frontend_assets', 20 );

/**
 * Enqueue admin assets (if needed)
 */
function elements_fusion_enqueue_admin_assets() {
    wp_enqueue_style(
        'elements-fusion-admin-style',
        elements_fusion_asset_url( 'css/admin-style.css' ),
        [],
        ELEMENTS_FUSION_VERSION
    );

    wp_enqueue_script(
        'elements-fusion-admin-script',
        elements_fusion_asset_url( 'js/admin-script.js' ),
        ['jquery'],
        ELEMENTS_FUSION_VERSION,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'elements_fusion_enqueue_admin_assets' );