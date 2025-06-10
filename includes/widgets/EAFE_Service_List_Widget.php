<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Service_List_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'service_list';
    }

    public function get_title() {
        return __( 'Service List', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category'];
    }

    protected function _register_controls() {
        // Service List Content Section
        $this->start_controls_section(
            'service_list_content',
            [
                'label' => __( 'Service List', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => __( 'Layout', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'list',
                'options' => [
                    'list' => __( 'List', 'eazy-addons-for-elementor' ),
                    'grid' => __( 'Grid', 'eazy-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'     => __( 'Columns', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
                'min'       => 1,
                'max'       => 6,
                'condition' => [
                    'layout' => 'grid',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eafe-service-layout-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_control(
            'services',
            [
                'label'       => __( 'Services', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => [
                    [
                        'name'    => 'icon',
                        'label'   => __( 'Icon', 'eazy-addons-for-elementor' ),
                        'type'    => Controls_Manager::ICONS,
                        'default' => [
                            'value'   => 'fas fa-star',
                            'library' => 'solid',
                        ],
                    ],
                    [
                        'name'        => 'title',
                        'label'       => __( 'Title', 'eazy-addons-for-elementor' ),
                        'type'        => Controls_Manager::TEXT,
                        'default'     => __( 'Service Title', 'eazy-addons-for-elementor' ),
                        'label_block' => true,
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],
                    [
                        'name'        => 'description',
                        'label'       => __( 'Description', 'eazy-addons-for-elementor' ),
                        'type'        => Controls_Manager::TEXTAREA,
                        'default'     => __( 'Service description goes here.', 'eazy-addons-for-elementor' ),
                        'label_block' => true,
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],
                    [
                        'name'        => 'link',
                        'label'       => __( 'Link', 'eazy-addons-for-elementor' ),
                        'type'        => Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'eazy-addons-for-elementor' ),
                        'default'     => [
                            'url'         => '#',
                            'is_external' => false,
                            'nofollow'    => false,
                        ],
                    ],
                    [
                        'name'        => 'button_text',
                        'label'       => __( 'Button Text', 'eazy-addons-for-elementor' ),
                        'type'        => Controls_Manager::TEXT,
                        'default'     => __( 'Learn More', 'eazy-addons-for-elementor' ),
                        'label_block' => true,
                    ],
                ],
                'default'     => [
                    [
                        'icon'        => [
                            'value'   => 'fas fa-star',
                            'library' => 'solid',
                        ],
                        'title'       => __( 'Service 1', 'eazy-addons-for-elementor' ),
                        'description' => __( 'Description for Service 1.', 'eazy-addons-for-elementor' ),
                        'button_text' => __( 'Learn More', 'eazy-addons-for-elementor' ),
                    ],
                    [
                        'icon'        => [
                            'value'   => 'fas fa-star',
                            'library' => 'solid',
                        ],
                        'title'       => __( 'Service 2', 'eazy-addons-for-elementor' ),
                        'description' => __( 'Description for Service 2.', 'eazy-addons-for-elementor' ),
                        'button_text' => __( 'Learn More', 'eazy-addons-for-elementor' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'service_list_style',
            [
                'label' => __( 'Style', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'   => __( 'Icon Position', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'   => __( 'Left', 'eazy-addons-for-elementor' ),
                    'right'  => __( 'Right', 'eazy-addons-for-elementor' ),
                    'top'    => __( 'Top', 'eazy-addons-for-elementor' ),
                    'inline' => __( 'Inline with Title', 'eazy-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4CAF50',
                'selectors' => [
                    '{{WRAPPER}} .eafe-service-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'     => __( 'Icon Size', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default'   => [
                    'size' => 24,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eafe-service-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .eafe-service-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-service-title',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __( 'Description Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .eafe-service-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'label'    => __( 'Description Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-service-description',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'service_background',
                'label'    => __( 'Background', 'eazy-addons-for-elementor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eafe-service-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'service_border',
                'label'    => __( 'Border', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-service-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'service_box_shadow',
                'label'    => __( 'Box Shadow', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-service-item',
            ]
        );

        $this->add_control(
            'hover_effect',
            [
                'label'   => __( 'Hover Effect', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'   => __( 'None', 'eazy-addons-for-elementor' ),
                    'shadow' => __( 'Shadow', 'eazy-addons-for-elementor' ),
                    'scale'  => __( 'Scale', 'eazy-addons-for-elementor' ),
                    'fade'   => __( 'Fade', 'eazy-addons-for-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-service-list-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_service_list_widget( $settings );
    }
}