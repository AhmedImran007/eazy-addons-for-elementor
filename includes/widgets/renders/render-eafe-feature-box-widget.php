<?php

namespace EazyAddonsForElementor\Widgets\Renders;

use Elementor\Icons_Manager;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Render function for EAFE_Feature_Box_Widget
 *
 * @param array $settings The widget settings passed from the main widget class.
 */
function render_eafe_feature_box_widget( $settings ) {
    echo '<div class="eafe-feature-box">';

    // Render Icon
    if ( !empty( $settings['icon'] ) && is_array( $settings['icon'] ) ) {
        $icon_style = '';

        // Check for custom size
        if ( !empty( $settings['icon_size']['size'] ) ) {
            $icon_size = $settings['icon_size']['size'];
            $icon_style = 'width: ' . esc_attr( $icon_size ) . 'px; height: ' . esc_attr( $icon_size ) . 'px; font-size: ' . esc_attr( $icon_size ) . 'px;';
        }

        echo '<div class="eafe-feature-box-icon" style="' . esc_attr( $icon_style ) . '">';
        \Elementor\Icons_Manager::render_icon( $settings['icon'], ['aria-hidden' => 'true'] );
        echo '</div>';
    }

    // Render Title
    if ( !empty( $settings['title'] ) ) {
        echo '<h4 class="eafe-feature-box-title">' . esc_html( $settings['title'] ) . '</h4>';
    }

    // Render Description
    if ( !empty( $settings['description'] ) ) {
        echo '<p class="eafe-feature-box-description">' . esc_html( $settings['description'] ) . '</p>';
    }

    // Render Button
    if ( !empty( $settings['button_text'] ) ) {
        $target = $settings['button_url']['is_external'] ? ' target="_blank"' : '';
        echo '<a href="' . esc_url( $settings['button_url']['url'] ) . '" class="eafe-feature-box-button"' . esc_attr( $target ) . '>';
        echo esc_html( $settings['button_text'] );
        echo '</a>';
    }

    echo '</div>';
}