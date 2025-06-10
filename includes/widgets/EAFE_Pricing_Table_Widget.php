<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Pricing_Table_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'pricing_table';
    }

    public function get_title() {
        return __( 'Pricing Table', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category'];
    }

    protected function _register_controls() {
        // Pricing Table Content Section
        $this->start_controls_section(
            'pricing_table_content',
            [
                'label' => __( 'Content', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Basic Plan', 'eazy-addons-for-elementor' ),
                'placeholder' => __( 'Enter pricing table title', 'eazy-addons-for-elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'price',
            [
                'label'       => __( 'Price', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '19.99', 'eazy-addons-for-elementor' ),
                'placeholder' => __( 'Enter price', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'currency_symbol',
            [
                'label'       => __( 'Currency Symbol', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '$', 'eazy-addons-for-elementor' ),
                'placeholder' => __( 'Enter currency symbol', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'pricing_period',
            [
                'label'       => __( 'Pricing Period', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( '/month', 'eazy-addons-for-elementor' ),
                'placeholder' => __( 'Enter pricing period', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'features',
            [
                'label'       => __( 'Features (one per line)', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => "Feature 1\nFeature 2\nFeature 3",
                'placeholder' => __( "Enter features (one per line)", 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Get Started', 'eazy-addons-for-elementor' ),
                'placeholder' => __( 'Enter button text', 'eazy-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'         => __( 'Button Link', 'eazy-addons-for-elementor' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'eazy-addons-for-elementor' ),
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
                'label'        => __( 'Mark as Featured', 'eazy-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'eazy-addons-for-elementor' ),
                'label_off'    => __( 'No', 'eazy-addons-for-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->end_controls_section();

        // Pricing Table Style Section
        $this->start_controls_section(
            'pricing_table_style',
            [
                'label' => __( 'Style', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => __( 'Background Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eafe-pricing-table' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'highlight_color',
            [
                'label'     => __( 'Highlight Border Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFD700',
                'selectors' => [
                    '{{WRAPPER}} .eafe-pricing-table.featured' => 'border-color: {{VALUE}};',
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
                'label'    => __( 'Title Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-pricing-table-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'table_border',
                'label'    => __( 'Table Border', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-pricing-table',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-pricing-table-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_pricing_table_widget( $settings );
    }
}