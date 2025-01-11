<?php

namespace ElementsFusion\Widgets\Renders;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Render function for EF_Testimonial_Widget
 *
 * @param array $settings The widget settings passed from the main widget class.
 */
function render_ef_testimonial_widget( $settings ) {
    // Ensure all required settings are available
    if ( empty( $settings['testimonial_name'] ) || empty( $settings['testimonial_text'] ) ) {
        return; // Exit if key settings are missing
    }

    $image_url = !empty( $settings['testimonial_image']['url'] )
    ? esc_url( $settings['testimonial_image']['url'] )
    : \Elementor\Utils::get_placeholder_image_src();

    echo '<div class="ef-testimonial">';

    // Render Image
    echo '<div class="ef-testimonial-image">';
    echo '<img src="' . $image_url . '" alt="' . esc_attr( $settings['testimonial_name'] ) . '">';
    echo '</div>';

    // Render Testimonial Content
    echo '<div class="ef-testimonial-content">';
    echo '<h4 class="ef-testimonial-name">' . esc_html( $settings['testimonial_name'] ) . '</h4>';

    if ( !empty( $settings['testimonial_designation'] ) ) {
        echo '<p class="ef-testimonial-designation">' . esc_html( $settings['testimonial_designation'] ) . '</p>';
    }

    echo '<p class="ef-testimonial-text">' . esc_html( $settings['testimonial_text'] ) . '</p>';
    echo '</div>';

    echo '</div>';
}