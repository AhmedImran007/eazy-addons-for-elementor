<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Accordion_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'accordion';
    }

    public function get_title() {
        return __( 'Accordion', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category']; // Assign to custom category
    }

    protected function _register_controls() {
        // Accordion Items Section
        $this->start_controls_section(
            'accordion_content_section',
            [
                'label' => __( 'Accordion', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'accordion_title',
            [
                'label'       => __( 'Title', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Accordion Title', 'eazy-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_content',
            [
                'label'      => __( 'Content', 'eazy-addons-for-elementor' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'Accordion content goes here...', 'eazy-addons-for-elementor' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'accordion_items',
            [
                'label'       => __( 'Items', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'accordion_title'   => __( 'Accordion #1', 'eazy-addons-for-elementor' ),
                        'accordion_content' => __( 'Content for accordion item #1', 'eazy-addons-for-elementor' ),
                    ],
                    [
                        'accordion_title'   => __( 'Accordion #2', 'eazy-addons-for-elementor' ),
                        'accordion_content' => __( 'Content for accordion item #2', 'eazy-addons-for-elementor' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->end_controls_section();

        // Additional Settings Section
        $this->start_controls_section(
            'accordion_settings_section',
            [
                'label' => __( 'Settings', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_icons',
            [
                'label'        => __( 'Show Title Icon', 'eazy-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'eazy-addons-for-elementor' ),
                'label_off'    => __( 'No', 'eazy-addons-for-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'icon_normal',
            [
                'label'     => __( 'Icon', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-plus',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_icons' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_active',
            [
                'label'     => __( 'Active Icon', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-minus',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_icons' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-accordion-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_accordion_widget( $settings );
    }
}