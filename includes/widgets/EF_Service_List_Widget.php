<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Service_List_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'service_list';
    }

    public function get_title() {
        return __( 'Service List', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return ['elements-fusion-category'];
    }

    protected function _register_controls() {
        // Service List Content Section
        $this->start_controls_section(
            'service_list_content',
            [
                'label' => __( 'Service List', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => __( 'Layout', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'list',
                'options' => [
                    'list' => __( 'List', 'elements-fusion' ),
                    'grid' => __( 'Grid', 'elements-fusion' ),
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'     => __( 'Columns', 'elements-fusion' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
                'min'       => 1,
                'max'       => 6,
                'condition' => [
                    'layout' => 'grid',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ef-service-layout-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_control(
            'services',
            [
                'label'       => __( 'Services', 'elements-fusion' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => [
                    [
                        'name'    => 'icon',
                        'label'   => __( 'Icon', 'elements-fusion' ),
                        'type'    => Controls_Manager::ICONS,
                        'default' => [
                            'value'   => 'fas fa-star',
                            'library' => 'solid',
                        ],
                    ],
                    [
                        'name'        => 'title',
                        'label'       => __( 'Title', 'elements-fusion' ),
                        'type'        => Controls_Manager::TEXT,
                        'default'     => __( 'Service Title', 'elements-fusion' ),
                        'label_block' => true,
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],
                    [
                        'name'        => 'description',
                        'label'       => __( 'Description', 'elements-fusion' ),
                        'type'        => Controls_Manager::TEXTAREA,
                        'default'     => __( 'Service description goes here.', 'elements-fusion' ),
                        'label_block' => true,
                        'dynamic'     => [
                            'active' => true,
                        ],
                    ],
                    [
                        'name'        => 'link',
                        'label'       => __( 'Link', 'elements-fusion' ),
                        'type'        => Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'elements-fusion' ),
                        'default'     => [
                            'url'         => '#',
                            'is_external' => false,
                            'nofollow'    => false,
                        ],
                    ],
                    [
                        'name'        => 'button_text',
                        'label'       => __( 'Button Text', 'elements-fusion' ),
                        'type'        => Controls_Manager::TEXT,
                        'default'     => __( 'Learn More', 'elements-fusion' ),
                        'label_block' => true,
                    ],
                ],
                'default'     => [
                    [
                        'icon'        => [
                            'value'   => 'fas fa-star',
                            'library' => 'solid',
                        ],
                        'title'       => __( 'Service 1', 'elements-fusion' ),
                        'description' => __( 'Description for Service 1.', 'elements-fusion' ),
                        'button_text' => __( 'Learn More', 'elements-fusion' ),
                    ],
                    [
                        'icon'        => [
                            'value'   => 'fas fa-star',
                            'library' => 'solid',
                        ],
                        'title'       => __( 'Service 2', 'elements-fusion' ),
                        'description' => __( 'Description for Service 2.', 'elements-fusion' ),
                        'button_text' => __( 'Learn More', 'elements-fusion' ),
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
                'label' => __( 'Style', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'   => __( 'Icon Position', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'   => __( 'Left', 'elements-fusion' ),
                    'right'  => __( 'Right', 'elements-fusion' ),
                    'top'    => __( 'Top', 'elements-fusion' ),
                    'inline' => __( 'Inline with Title', 'elements-fusion' ),
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4CAF50',
                'selectors' => [
                    '{{WRAPPER}} .ef-service-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'     => __( 'Icon Size', 'elements-fusion' ),
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
                    '{{WRAPPER}} .ef-service-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .ef-service-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-service-title',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __( 'Description Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .ef-service-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'label'    => __( 'Description Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-service-description',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'service_background',
                'label'    => __( 'Background', 'elements-fusion' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ef-service-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'service_border',
                'label'    => __( 'Border', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-service-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'service_box_shadow',
                'label'    => __( 'Box Shadow', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-service-item',
            ]
        );

        $this->add_control(
            'hover_effect',
            [
                'label'   => __( 'Hover Effect', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'   => __( 'None', 'elements-fusion' ),
                    'shadow' => __( 'Shadow', 'elements-fusion' ),
                    'scale'  => __( 'Scale', 'elements-fusion' ),
                    'fade'   => __( 'Fade', 'elements-fusion' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ef-service-list-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_service_list_widget( $settings );
    }
}