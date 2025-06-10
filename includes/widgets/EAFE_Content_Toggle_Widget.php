<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Content_Toggle_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'content_toggle';
    }

    public function get_title() {
        return __( 'Content Toggle', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-toggle';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category']; // Assign to custom category
    }

    protected function _register_controls() {
        // Toggle Items Section
        $this->start_controls_section(
            'content_toggle_section',
            [
                'label' => __( 'Content Toggle', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'toggle_label',
            [
                'label'       => __( 'Toggle Label', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Toggle Label', 'eazy-addons-for-elementor' ),
                'placeholder' => __( 'Enter toggle label', 'eazy-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'toggle_content',
            [
                'label'   => __( 'Toggle Content', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => __( 'Content for this toggle goes here.', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'toggle_items',
            [
                'label'       => __( 'Toggle Items', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'toggle_label'   => __( 'Monthly', 'eazy-addons-for-elementor' ),
                        'toggle_content' => __( 'This is content for the monthly plan.', 'eazy-addons-for-elementor' ),
                    ],
                    [
                        'toggle_label'   => __( 'Yearly', 'eazy-addons-for-elementor' ),
                        'toggle_content' => __( 'This is content for the yearly plan.', 'eazy-addons-for-elementor' ),
                    ],
                ],
                'title_field' => '{{{ toggle_label }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'content_toggle_style_section',
            [
                'label' => __( 'Style', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_background_color',
            [
                'label'     => __( 'Toggle Background Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f5f5f5',
                'selectors' => [
                    '{{WRAPPER}} .eafe-toggle-switch' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_text_color',
            [
                'label'     => __( 'Toggle Text Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333',
                'selectors' => [
                    '{{WRAPPER}} .eafe-toggle-switch button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-content-toggle-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_content_toggle_widget( $settings );
    }
}