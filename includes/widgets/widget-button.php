<?php

//widget-buuton.php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Ensure the Widget_Base class is loaded
require_once plugin_dir_path( __FILE__ ) . '/../class-widget-base.php';

class Widget_Button extends Widget_Base {

    /**
     * Get widget name
     *
     * @return string
     */
    public function get_name() {
        return 'button_widget';
    }

    /**
     * Get widget title
     *
     * @return string
     */
    public function get_title() {
        return __( 'Custom Button', 'elements-fusion' );
    }

    /**
     * Get widget icon
     *
     * @return string
     */
    public function get_icon() {
        return 'eicon-button';
    }

    /**
     * Register widget controls
     */
    protected function _register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'custom-button-widget' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'   => __( 'Button Text', 'custom-button-widget' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Click Me', 'custom-button-widget' ),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'       => __( 'Button Link', 'custom-button-widget' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://example.com', 'custom-button-widget' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'custom-button-widget' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => __( 'Button Color', 'custom-button-widget' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __( 'Text Color', 'custom-button-widget' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-button' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        // Move Typography Control Here Inside the Style Section
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __( 'Typography', 'custom-button-widget' ),
                'selector' => '{{WRAPPER}} .custom-button',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the front end
     */
    protected function render() {
        // Use template for rendering
        include plugin_dir_path( __FILE__ ) . '../../templates/widget-template-button.php';
    }

    /**
     * Render the widget output in the editor
     */
    protected function _content_template() {
        ?>
<# var buttonAttributes={
  class: 'custom-button inline-block px-5 py-3 text-center rounded-lg transition-all duration-300 ease-in-out' , href:
  settings.button_link.url }; if ( settings.button_link.is_external ) { buttonAttributes.target='_blank' ; } if (
  settings.button_link.nofollow ) { buttonAttributes.rel='nofollow' ; } if ( settings.button_color ) {
  buttonAttributes.style='background-color:' + settings.button_color + ';' ; } if ( settings.button_text_color ) {
  buttonAttributes.style +='color:' + settings.button_text_color + ';' ; } #>
  <a {{{ view.getRenderAttributeString( buttonAttributes ) }}}>
    {{{ settings.button_text }}}
  </a>

  <?php
}
}