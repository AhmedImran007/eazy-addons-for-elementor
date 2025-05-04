<?php

namespace ElementsFusion\Widgets\Renders;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Render function for EF_Callout_Widget
 *
 * @param array $settings The widget settings passed from the main widget class.
 */
function render_ef_callout_widget( $settings ) {
    // Default button link if none is provided
    $button_url = !empty( $settings['callout_button_url']['url'] ) ? $settings['callout_button_url']['url'] : '#';

    echo '<div class="callout-section">';

    echo '<div class="callout-left">';
    echo '<div class="callout-title">' . esc_html( $settings['callout_title'] ) . '</div>';
    echo '<div class="callout-content">' . wp_kses_post( $settings['callout_content'] ) . '</div>';
    echo '</div>';

    echo '<a href="' . esc_url( $button_url ) . '" class="callout-button">' . esc_html( $settings['callout_button_text'] ) . '</a>';

    echo '</div>';
}