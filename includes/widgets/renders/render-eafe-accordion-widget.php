<?php

namespace EazyAddonsForElementor\Widgets\Renders;

use Elementor\Icons_Manager;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Render function for EAFE_Accordion_Widget
 *
 * @param array $settings The widget settings passed from the main widget class.
 */
function render_eafe_accordion_widget( $settings ) {
    if ( empty( $settings['accordion_items'] ) ) {
        return; // If no items are set, do nothing
    }

    echo '<div class="eazy-addons-for-elementor-accordion">';

    foreach ( $settings['accordion_items'] as $index => $item ) {
        $item_id = 'accordion-item-' . $index;
        $is_active = $index === 0 ? 'active' : '';

        $icon_html = '';
        $active_icon_html = '';

        // Check if icons are enabled
        if ( 'yes' === $settings['show_icons'] ) {
            // Render normal icon
            if ( !empty( $settings['icon_normal'] ) ) {
                ob_start();
                Icons_Manager::render_icon( $settings['icon_normal'], ['aria-hidden' => 'true'] );
                $icon_html = ob_get_clean();
            }

            // Render active icon
            if ( !empty( $settings['icon_active'] ) ) {
                ob_start();
                Icons_Manager::render_icon( $settings['icon_active'], ['aria-hidden' => 'true'] );
                $active_icon_html = ob_get_clean();
            }
        }

        echo '<div class="accordion-item ' . esc_attr( $is_active ) . '">';
        echo '<div class="accordion-title" id="' . esc_attr( $item_id ) . '">';
        echo '<span>' . esc_html( $item['accordion_title'] ) . '</span>';

        // Render icons
        if ( 'yes' === $settings['show_icons'] ) {
            echo '<span class="accordion-icon accordion-icon-closed">' . wp_kses_post( $icon_html ) . '</span>';
            echo '<span class="accordion-icon accordion-icon-open">' . wp_kses_post( $active_icon_html ) . '</span>';
        }

        echo '</div>';

        echo '<div class="accordion-content">' . wp_kses_post( $item['accordion_content'] ) . '</div>';
        echo '</div>';
    }

    echo '</div>';
}