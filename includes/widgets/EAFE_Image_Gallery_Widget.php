<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Image_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'image_gallery';
    }

    public function get_title() {
        return __( 'Image Gallery', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category'];
    }

    protected function _register_controls() {

        // Gallery Section
        $this->start_controls_section(
            'gallery_content_section',
            [
                'label' => __( 'Gallery', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_images',
            [
                'label'   => __( 'Add Images', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail', // Usage: thumbnail_size
                'default'   => 'medium',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        // Layout Options
        $this->start_controls_section(
            'gallery_layout_section',
            [
                'label' => __( 'Layout', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_layout',
            [
                'label'   => __( 'Gallery Layout', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'grid'    => __( 'Grid', 'eazy-addons-for-elementor' ),
                    'masonry' => __( 'Masonry', 'eazy-addons-for-elementor' ),
                ],
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'   => __( 'Columns', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '2' => __( '2 Columns', 'eazy-addons-for-elementor' ),
                    '3' => __( '3 Columns', 'eazy-addons-for-elementor' ),
                    '4' => __( '4 Columns', 'eazy-addons-for-elementor' ),
                ],
                'default' => '3',
            ]
        );

        $this->add_control(
            'gap',
            [
                'label'     => __( 'Gap Between Images', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 10,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eafe-gallery-item'      => 'margin: calc({{SIZE}}px / 2);',
                    '{{WRAPPER}} .eafe-gallery-container' => 'margin: calc(-{{SIZE}}px / 2);',
                ],
            ]
        );

        $this->end_controls_section();

        // Lightbox Options
        $this->start_controls_section(
            'gallery_lightbox_section',
            [
                'label' => __( 'Lightbox', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_lightbox',
            [
                'label'        => __( 'Enable Lightbox', 'eazy-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'eazy-addons-for-elementor' ),
                'label_off'    => __( 'No', 'eazy-addons-for-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-image-gallery-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_image_gallery_widget( $settings );
    }
}