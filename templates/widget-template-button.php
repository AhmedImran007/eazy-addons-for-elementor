<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Fetch the widget settings
$settings = $this->get_settings_for_display();

// Add render attributes for the button
$this->add_render_attribute( 'button', 'class', 'custom-button inline-block px-5 py-3 text-center rounded-lg transition-all duration-300 ease-in-out' );

// Dynamic background color and text color using Elementor controls
if ( !empty( $settings['button_color'] ) ) {
    $this->add_render_attribute( 'button', 'style', 'background-color:' . esc_attr( $settings['button_color'] ) . ';' );
}

if ( !empty( $settings['button_text_color'] ) ) {
    $this->add_render_attribute( 'button', 'style', 'color:' . esc_attr( $settings['button_text_color'] ) . ';' );
}

// Add button link attributes
if ( !empty( $settings['button_link']['url'] ) ) {
    $this->add_render_attribute( 'button', 'href', esc_url( $settings['button_link']['url'] ) );
    if ( $settings['button_link']['is_external'] ) {
        $this->add_render_attribute( 'button', 'target', '_blank' );
    }
    if ( $settings['button_link']['nofollow'] ) {
        $this->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
?>

<!-- Render the Button -->
<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
  <?php echo esc_html( $settings['button_text'] ); ?>
</a>