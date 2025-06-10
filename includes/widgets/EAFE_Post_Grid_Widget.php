<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Post_Grid_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'post_grid';
    }

    public function get_title() {
        return __( 'Post Grid', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category'];
    }

    protected function _register_controls() {
        // Query Section
        $this->start_controls_section(
            'query_section',
            [
                'label' => __( 'Query', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label'   => __( 'Post Type', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'post' => __( 'Post', 'eazy-addons-for-elementor' ),
                    'page' => __( 'Page', 'eazy-addons-for-elementor' ),
                ],
                'default' => 'post',
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'       => __( 'Posts Per Page', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 6,
                'placeholder' => 6,
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => __( 'Ascending', 'eazy-addons-for-elementor' ),
                    'DESC' => __( 'Descending', 'eazy-addons-for-elementor' ),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => __( 'Order By', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'date'       => __( 'Date', 'eazy-addons-for-elementor' ),
                    'title'      => __( 'Title', 'eazy-addons-for-elementor' ),
                    'menu_order' => __( 'Menu Order', 'eazy-addons-for-elementor' ),
                    'rand'       => __( 'Random', 'eazy-addons-for-elementor' ),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'category',
            [
                'label'    => __( 'Category', 'eazy-addons-for-elementor' ),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_post_categories(), // Updated method name
                'multiple' => true,
            ]
        );

        $this->end_controls_section();

        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __( 'Layout', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Inside _register_controls() method
        $this->add_responsive_control(
            'columns',
            [
                'label'     => __( 'Columns', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
                'min'       => 1,
                'max'       => 6,
                'selectors' => [
                    '{{WRAPPER}} .eafe-post-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);', // Use CSS Grid
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-post-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eafe-post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_effect',
            [
                'label'   => __( 'Hover Effect', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none'   => __( 'None', 'eazy-addons-for-elementor' ),
                    'zoom'   => __( 'Zoom', 'eazy-addons-for-elementor' ),
                    'fade'   => __( 'Fade', 'eazy-addons-for-elementor' ),
                    'shadow' => __( 'Shadow', 'eazy-addons-for-elementor' ),
                ],
                'default' => 'none',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-post-grid-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_post_grid_widget( $settings );
    }

    private function get_post_categories() {
        $categories = get_categories();
        $options = [];
        foreach ( $categories as $category ) {
            $options[$category->term_id] = $category->name;
        }
        return $options;
    }
}