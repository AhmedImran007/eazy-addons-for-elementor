<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Callout_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'callout';
    }

    public function get_title() {
        return __( 'Callout Section', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-alert';
    }

    public function get_categories() {
        return ['elements-fusion-category']; // Assign to custom category
    }

    protected function _register_controls() {
        // Callout Content Section
        $this->start_controls_section(
            'callout_content_section',
            [
                'label' => __( 'Callout Content', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'callout_title',
            [
                'label'       => __( 'Title', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Callout Title', 'elements-fusion' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'callout_content',
            [
                'label'      => __( 'Content', 'elements-fusion' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'Callout content goes here...', 'elements-fusion' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'callout_button_text',
            [
                'label'       => __( 'Button Text', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Learn More', 'elements-fusion' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'callout_button_url',
            [
                'label'       => __( 'Button URL', 'elements-fusion' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'elements-fusion' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Callout Settings Section
        $this->start_controls_section(
            'callout_settings_section',
            [
                'label' => __( 'Settings', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'callout_background_color',
            [
                'label'     => __( 'Background Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .callout-section' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'callout_text_color',
            [
                'label'     => __( 'Text Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .callout-section .callout-title, {{WRAPPER}} .callout-section .callout-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ef-callout-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_callout_widget( $settings );
    }
}