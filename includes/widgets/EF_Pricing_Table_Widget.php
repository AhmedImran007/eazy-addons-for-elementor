<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Pricing_Table_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'pricing_table';
    }

    public function get_title() {
        return __( 'Pricing Table', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return ['elements-fusion-category'];
    }

    protected function _register_controls() {
        // Pricing Table Content Section
        $this->start_controls_section(
            'pricing_table_content',
            [
                'label' => __( 'Content', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Basic Plan', 'elements-fusion' ),
                'placeholder' => __( 'Enter pricing table title', 'elements-fusion' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'price',
            [
                'label'       => __( 'Price', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '19.99', 'elements-fusion' ),
                'placeholder' => __( 'Enter price', 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'currency_symbol',
            [
                'label'       => __( 'Currency Symbol', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '$', 'elements-fusion' ),
                'placeholder' => __( 'Enter currency symbol', 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'pricing_period',
            [
                'label'       => __( 'Pricing Period', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '/month', 'elements-fusion' ),
                'placeholder' => __( 'Enter pricing period', 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'features',
            [
                'label'       => __( 'Features (one per line)', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => "Feature 1\nFeature 2\nFeature 3",
                'placeholder' => __( "Enter features (one per line)", 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'elements-fusion' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Get Started', 'elements-fusion' ),
                'placeholder' => __( 'Enter button text', 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'         => __( 'Button Link', 'elements-fusion' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'elements-fusion' ),
                'default'       => [
                    'url'         => '#',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
                'show_external' => true,
            ]
        );

        $this->add_control(
            'is_featured',
            [
                'label'        => __( 'Mark as Featured', 'elements-fusion' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'elements-fusion' ),
                'label_off'    => __( 'No', 'elements-fusion' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->end_controls_section();

        // Pricing Table Style Section
        $this->start_controls_section(
            'pricing_table_style',
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
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ef-pricing-table' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'highlight_color',
            [
                'label'     => __( 'Highlight Border Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFD700',
                'selectors' => [
                    '{{WRAPPER}} .ef-pricing-table.featured' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'is_featured' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-pricing-table-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'table_border',
                'label'    => __( 'Table Border', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-pricing-table',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ef-pricing-table-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_pricing_table_widget( $settings );
    }
}