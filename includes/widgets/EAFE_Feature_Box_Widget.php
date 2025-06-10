<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Feature_Box_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'feature_box';
    }

    public function get_title() {
        return __( 'Feature Box', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category'];
    }

    protected function _register_controls() {
        // Content Section
        $this->start_controls_section(
            'feature_box_content_section',
            [
                'label' => __( 'Content', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
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
            'title',
            [
                'label'       => __( 'Title', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Feature Box Title', 'eazy-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => __( 'Description', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => __( 'Add a short description for the feature box.', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'   => __( 'Button Text', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Learn More', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label'       => __( 'Button URL', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'eazy-addons-for-elementor' ),
                'default'     => [
                    'url'         => '#',
                    'is_external' => false,
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'feature_box_style_section',
            [
                'label' => __( 'Style', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'      => __( 'Icon Size (px)', 'eazy-addons-for-elementor' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eafe-feature-box-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eafe-feature-box-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ff6f61',
                'selectors' => [
                    '{{WRAPPER}} .eafe-feature-box-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eafe-feature-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __( 'Description Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .eafe-feature-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => __( 'Button Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eafe-feature-box-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background',
            [
                'label'     => __( 'Button Background', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ff6f61',
                'selectors' => [
                    '{{WRAPPER}} .eafe-feature-box-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-feature-box-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_feature_box_widget( $settings );
    }
}