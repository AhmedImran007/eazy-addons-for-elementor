<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Testimonial_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'testimonial';
    }

    public function get_title() {
        return __( 'Testimonial', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category'];
    }

    protected function _register_controls() {
        // Testimonial Content Section
        $this->start_controls_section(
            'testimonial_content_section',
            [
                'label' => __( 'Testimonial Content', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testimonial_image',
            [
                'label'   => __( 'Image', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'testimonial_name',
            [
                'label'       => __( 'Name', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'John Doe', 'eazy-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonial_designation',
            [
                'label'   => __( 'Designation', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'CEO, Company Name', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'testimonial_text',
            [
                'label'   => __( 'Testimonial', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => __( 'This is a great product! Highly recommended.', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'testimonial_style_section',
            [
                'label' => __( 'Style', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __( 'Background Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f9f9f9',
                'selectors' => [
                    '{{WRAPPER}} .eafe-testimonial' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Text Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eafe-testimonial-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => __( 'Text Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-testimonial-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-testimonial-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_testimonial_widget( $settings );
    }
}