<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Image_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'image_gallery';
    }

    public function get_title() {
        return __( 'Image Gallery', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['elements-fusion-category'];
    }

    protected function _register_controls() {

        // Gallery Section
        $this->start_controls_section(
            'gallery_content_section',
            [
                'label' => __( 'Gallery', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_images',
            [
                'label'   => __( 'Add Images', 'elements-fusion' ),
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
                'label' => __( 'Layout', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_layout',
            [
                'label'   => __( 'Gallery Layout', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'grid'    => __( 'Grid', 'elements-fusion' ),
                    'masonry' => __( 'Masonry', 'elements-fusion' ),
                ],
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'   => __( 'Columns', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '2' => __( '2 Columns', 'elements-fusion' ),
                    '3' => __( '3 Columns', 'elements-fusion' ),
                    '4' => __( '4 Columns', 'elements-fusion' ),
                ],
                'default' => '3',
            ]
        );

        $this->add_control(
            'gap',
            [
                'label'     => __( 'Gap Between Images', 'elements-fusion' ),
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
                    '{{WRAPPER}} .ef-gallery-item'      => 'margin: calc({{SIZE}}px / 2);',
                    '{{WRAPPER}} .ef-gallery-container' => 'margin: calc(-{{SIZE}}px / 2);',
                ],
            ]
        );

        $this->end_controls_section();

        // Lightbox Options
        $this->start_controls_section(
            'gallery_lightbox_section',
            [
                'label' => __( 'Lightbox', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_lightbox',
            [
                'label'        => __( 'Enable Lightbox', 'elements-fusion' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'elements-fusion' ),
                'label_off'    => __( 'No', 'elements-fusion' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ef-image-gallery-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_image_gallery_widget( $settings );
    }
}