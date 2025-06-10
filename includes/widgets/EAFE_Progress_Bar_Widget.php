<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Progress_Bar_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'progress_bar';
    }

    public function get_title() {
        return __( 'Progress Bar', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-skill-bar';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category'];
    }

    protected function _register_controls() {
        // Progress Bar Content Section
        $this->start_controls_section(
            'progress_bar_content',
            [
                'label' => __( 'Progress Bar', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'My Skill', 'eazy-addons-for-elementor' ),
                'placeholder' => __( 'Enter skill or milestone name', 'eazy-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'percentage',
            [
                'label'   => __( 'Percentage', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 70,
                    'unit' => '%',
                ],
                'range'   => [
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $this->add_control(
            'show_percentage',
            [
                'label'     => __( 'Show Percentage', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => __( 'Show', 'eazy-addons-for-elementor' ),
                'label_off' => __( 'Hide', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label'   => __( 'Animation Speed (ms)', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1000,
                'min'     => 100,
                'max'     => 5000,
                'step'    => 100,
            ]
        );

        $this->end_controls_section();

        // Progress Bar Style Section
        $this->start_controls_section(
            'progress_bar_style',
            [
                'label' => __( 'Style', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bar_height',
            [
                'label'     => __( 'Bar Height', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'range'     => [
                    'px' => [
                        'min'  => 5,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eafe-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bar_color',
            [
                'label'     => __( 'Bar Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4CAF50',
                'selectors' => [
                    '{{WRAPPER}} .eafe-progress-bar-fill' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bar_style',
            [
                'label'   => __( 'Bar Style', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid'    => __( 'Solid', 'eazy-addons-for-elementor' ),
                    'striped'  => __( 'Striped', 'eazy-addons-for-elementor' ),
                    'gradient' => __( 'Gradient', 'eazy-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __( 'Background Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e0e0e0',
                'selectors' => [
                    '{{WRAPPER}} .eafe-progress-bar' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-progress-bar-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eafe-progress-bar-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-progress-bar-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_progress_bar_widget( $settings );
    }
}