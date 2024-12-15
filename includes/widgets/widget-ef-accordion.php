<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Widget_EF_Accordion extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     */
    public function get_name() {
        return 'ef-accordion';
    }

    /**
     * Get widget title.
     */
    public function get_title() {
        return __( 'EF Accordion', 'elements-fusion' );
    }

    /**
     * Get widget icon.
     */
    public function get_icon() {
        return 'eicon-accordion';
    }

    /**
     * Get widget categories.
     */
    public function get_categories() {
        return ['elements-fusion'];
    }

    /**
     * Register controls for the accordion widget.
     */
    protected function register_controls() {

        // Repeater setup
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => __( 'Title', 'elements-fusion' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Accordion Title', 'elements-fusion' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label'      => __( 'Content', 'elements-fusion' ),
                'type'       => \Elementor\Controls_Manager::TEXTAREA,
                'default'    => __( 'Accordion Content', 'elements-fusion' ),
                'show_label' => true,
            ]
        );

        // General section
        $this->start_controls_section(
            'section_general',
            [
                'label' => __( 'General', 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'accordion_icon',
            [
                'label'   => __( 'Accordion Icon', 'elements-fusion' ),
                'type'    => \Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-chevron-down',
            ]
        );

        $this->end_controls_section();

        // Accordion Items Section
        $this->start_controls_section(
            'section_items',
            [
                'label' => __( 'Accordion Items', 'elements-fusion' ),
            ]
        );

        $this->add_control(
            'items',
            [
                'label'       => __( 'Accordion Items', 'elements-fusion' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'   => __( 'Accordion Item', 'elements-fusion' ),
                        'content' => __( 'This is the content for item.', 'elements-fusion' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Typography Customization Section
        $this->start_controls_section(
            'section_typography',
            [
                'label' => __( 'Typography', 'elements-fusion' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-accordion-title',
            ]
        );

        // Content Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => __( 'Content Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-accordion-content',
            ]
        );

        // Icon Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'icon_typography',
                'label'    => __( 'Icon Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-accordion-icon',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the front end.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the template file for the accordion
        include plugin_dir_path( __FILE__ ) . '../../templates/widget-template-ef-accordion.php';
    }
}