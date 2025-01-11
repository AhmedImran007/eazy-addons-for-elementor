<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Testimonial_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'testimonial';
    }

    public function get_title() {
        return __( 'Testimonial', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return ['elements-fusion-category'];
    }

    protected function _register_controls() {
        // Testimonial Content Section
        $this->start_controls_section(
            'testimonial_content_section',
            [
                'label' => __( 'Testimonial Content', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testimonial_image',
            [
                'label'   => __( 'Image', 'elements-fusion' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'testimonial_name',
            [
                'label'       => __( 'Name', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'John Doe', 'elements-fusion' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonial_designation',
            [
                'label'   => __( 'Designation', 'elements-fusion' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'CEO, Company Name', 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'testimonial_text',
            [
                'label'   => __( 'Testimonial', 'elements-fusion' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => __( 'This is a great product! Highly recommended.', 'elements-fusion' ),
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'testimonial_style_section',
            [
                'label' => __( 'Style', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __( 'Background Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f9f9f9',
                'selectors' => [
                    '{{WRAPPER}} .ef-testimonial' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Text Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .ef-testimonial-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => __( 'Text Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-testimonial-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ef-testimonial-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_testimonial_widget( $settings );
    }
}