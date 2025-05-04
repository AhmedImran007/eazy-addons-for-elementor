<?php

namespace ElementsFusion\Widgets\Renders;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Render function for EF_Advanced_Heading_Widget
 *
 * @param array $settings The widget settings passed from the main widget class.
 */
function render_ef_advanced_heading_widget( $settings ) {
    $icon_html = '';
    $image_html = '';

    if ( !empty( $settings['heading_icon'] ) ) {
        // Render the icon
        ob_start();
        \Elementor\Icons_Manager::render_icon( $settings['heading_icon'], ['aria-hidden' => 'true'] );
        $icon_html = ob_get_clean();
    }

    if ( !empty( $settings['heading_image']['url'] ) ) {
        // Render the image
        $image_html = '<img src="' . esc_url( $settings['heading_image']['url'] ) . '" alt="' . esc_attr( $settings['heading_image']['alt'] ) . '" />'; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
    }

    // Set the tag dynamically
    $tag = !empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h2';

    echo '<' . esc_attr( $tag ) . ' class="ef-advanced-heading">';
    if ( 'left' === $settings['icon_position'] ) {
        echo wp_kses_post( $icon_html ) . wp_kses_post( $image_html );
    }
    echo esc_html( $settings['heading_text'] );
    if ( 'right' === $settings['icon_position'] ) {
        echo wp_kses_post( $icon_html ) . wp_kses_post( $image_html );
    }
    echo '</' . esc_attr( $tag ) . '>';
}