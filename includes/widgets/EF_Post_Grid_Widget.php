<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Post_Grid_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'post_grid';
    }

    public function get_title() {
        return __( 'Post Grid', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['elements-fusion-category'];
    }

    protected function _register_controls() {
        // Query Section
        $this->start_controls_section(
            'query_section',
            [
                'label' => __( 'Query', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label'   => __( 'Post Type', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'post' => __( 'Post', 'elements-fusion' ),
                    'page' => __( 'Page', 'elements-fusion' ),
                ],
                'default' => 'post',
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'       => __( 'Posts Per Page', 'elements-fusion' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 6,
                'placeholder' => 6,
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __( 'Order', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => __( 'Ascending', 'elements-fusion' ),
                    'DESC' => __( 'Descending', 'elements-fusion' ),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => __( 'Order By', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'date'       => __( 'Date', 'elements-fusion' ),
                    'title'      => __( 'Title', 'elements-fusion' ),
                    'menu_order' => __( 'Menu Order', 'elements-fusion' ),
                    'rand'       => __( 'Random', 'elements-fusion' ),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'category',
            [
                'label'    => __( 'Category', 'elements-fusion' ),
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
                'label' => __( 'Layout', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Inside _register_controls() method
        $this->add_responsive_control(
            'columns',
            [
                'label'     => __( 'Columns', 'elements-fusion' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
                'min'       => 1,
                'max'       => 6,
                'selectors' => [
                    '{{WRAPPER}} .ef-post-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);', // Use CSS Grid
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-post-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ef-post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_effect',
            [
                'label'   => __( 'Hover Effect', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none'   => __( 'None', 'elements-fusion' ),
                    'zoom'   => __( 'Zoom', 'elements-fusion' ),
                    'fade'   => __( 'Fade', 'elements-fusion' ),
                    'shadow' => __( 'Shadow', 'elements-fusion' ),
                ],
                'default' => 'none',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ef-post-grid-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_post_grid_widget( $settings );
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