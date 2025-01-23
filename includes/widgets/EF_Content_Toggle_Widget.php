<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Content_Toggle_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'content_toggle';
    }

    public function get_title() {
        return __( 'Content Toggle', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-toggle';
    }

    public function get_categories() {
        return ['elements-fusion-category']; // Assign to custom category
    }

    protected function _register_controls() {
        // Toggle Items Section
        $this->start_controls_section(
            'content_toggle_section',
            [
                'label' => __( 'Content Toggle', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'toggle_label',
            [
                'label'       => __( 'Toggle Label', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Toggle Label', 'elements-fusion' ),
                'placeholder' => __( 'Enter toggle label', 'elements-fusion' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'toggle_content',
            [
                'label'   => __( 'Toggle Content', 'elements-fusion' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => __( 'Content for this toggle goes here.', 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'toggle_items',
            [
                'label'       => __( 'Toggle Items', 'elements-fusion' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'toggle_label'   => __( 'Monthly', 'elements-fusion' ),
                        'toggle_content' => __( 'This is content for the monthly plan.', 'elements-fusion' ),
                    ],
                    [
                        'toggle_label'   => __( 'Yearly', 'elements-fusion' ),
                        'toggle_content' => __( 'This is content for the yearly plan.', 'elements-fusion' ),
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
                'label' => __( 'Style', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_background_color',
            [
                'label'     => __( 'Toggle Background Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f5f5f5',
                'selectors' => [
                    '{{WRAPPER}} .ef-toggle-switch' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_text_color',
            [
                'label'     => __( 'Toggle Text Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333',
                'selectors' => [
                    '{{WRAPPER}} .ef-toggle-switch button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ef-content-toggle-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_content_toggle_widget( $settings );
    }
}