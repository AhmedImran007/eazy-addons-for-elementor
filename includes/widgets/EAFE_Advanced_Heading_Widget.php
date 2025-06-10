<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Advanced_Heading_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'advanced_heading';
    }

    public function get_title() {
        return __( 'Advanced Heading', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category']; // Assign to custom category
    }

    protected function _register_controls() {

        // Heading Section
        $this->start_controls_section(
            'advanced_heading_content_section',
            [
                'label' => __( 'Content', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label'       => __( 'Heading Text', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Advanced Heading', 'eazy-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'heading_tag',
            [
                'label'   => __( 'HTML Tag', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'  => 'H1',
                    'h2'  => 'H2',
                    'h3'  => 'H3',
                    'h4'  => 'H4',
                    'h5'  => 'H5',
                    'h6'  => 'H6',
                    'div' => 'DIV',
                ],
                'default' => 'h2',
            ]
        );

        // Add a gradient option only if Elementor Pro is not available
        if ( !class_exists( 'Elementor\Group_Control_Text_Gradient' ) ) {
            $this->add_control(
                'heading_gradient',
                [
                    'label'     => __( 'Text Gradient (CSS Fallback)', 'eazy-addons-for-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ff7e5f',
                    'selectors' => [
                        '{{WRAPPER}} .eafe-advanced-heading' => 'background: linear-gradient(to right, {{VALUE}}, #feb47b); -webkit-background-clip: text; color: transparent;',
                    ],
                ]
            );
        }

        $this->add_control(
            'heading_icon',
            [
                'label'   => __( 'Icon', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'heading_image',
            [
                'label'   => __( 'Image', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'   => __( 'Icon/Image Position', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'left'  => __( 'Left', 'eazy-addons-for-elementor' ),
                    'right' => __( 'Right', 'eazy-addons-for-elementor' ),
                ],
                'default' => 'left',
            ]
        );

        $this->end_controls_section();

        // Typography Section
        $this->start_controls_section(
            'advanced_heading_style_section',
            [
                'label' => __( 'Typography', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => __( 'Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-advanced-heading',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-advanced-heading-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_advanced_heading_widget( $settings );
    }
}