<?php

namespace ElementsFusion\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EF_Countdown_Timer_Widget extends Widget_Base {

    public function get_name() {
        return ELEMENTS_FUSION_WIDGET_PREFIX . 'countdown_timer';
    }

    public function get_title() {
        return __( 'Countdown Timer', 'elements-fusion' );
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return ['elements-fusion-category'];
    }

    protected function _register_controls() {
        // Timer Settings Section
        $this->start_controls_section(
            'countdown_settings',
            [
                'label' => __( 'Countdown Settings', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'countdown_date',
            [
                'label'          => __( 'Target Date', 'elements-fusion' ),
                'type'           => Controls_Manager::DATE_TIME,
                'default' => gmdate( 'Y-m-d H:i:s', (int) strtotime( '+1 week' ) ?: time() ),
                'picker_options' => [
                    'enableTime' => true,
                ],
            ]
        );

        $this->add_control(
            'show_labels',
            [
                'label'        => __( 'Show Labels', 'elements-fusion' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'elements-fusion' ),
                'label_off'    => __( 'No', 'elements-fusion' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'custom_labels',
            [
                'label'        => __( 'Custom Labels', 'elements-fusion' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'elements-fusion' ),
                'label_off'    => __( 'No', 'elements-fusion' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition'    => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_days',
            [
                'label'     => __( 'Days Label', 'elements-fusion' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Days', 'elements-fusion' ),
                'condition' => [
                    'show_labels'   => 'yes',
                    'custom_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_hours',
            [
                'label'     => __( 'Hours Label', 'elements-fusion' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Hours', 'elements-fusion' ),
                'condition' => [
                    'show_labels'   => 'yes',
                    'custom_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_minutes',
            [
                'label'     => __( 'Minutes Label', 'elements-fusion' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Minutes', 'elements-fusion' ),
                'condition' => [
                    'show_labels'   => 'yes',
                    'custom_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_seconds',
            [
                'label'     => __( 'Seconds Label', 'elements-fusion' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Seconds', 'elements-fusion' ),
                'condition' => [
                    'show_labels'   => 'yes',
                    'custom_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'expiry_action',
            [
                'label'   => __( 'On Expiry', 'elements-fusion' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'     => __( 'None', 'elements-fusion' ),
                    'message'  => __( 'Show Message', 'elements-fusion' ),
                    'redirect' => __( 'Redirect to URL', 'elements-fusion' ),
                ],
            ]
        );

        $this->add_control(
            'expiry_message',
            [
                'label'     => __( 'Expiry Message', 'elements-fusion' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => __( 'The countdown has ended!', 'elements-fusion' ),
                'condition' => [
                    'expiry_action' => 'message',
                ],
            ]
        );

        $this->add_control(
            'expiry_redirect_url',
            [
                'label'       => __( 'Redirect URL', 'elements-fusion' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'elements-fusion' ),
                'condition'   => [
                    'expiry_action' => 'redirect',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'countdown_style',
            [
                'label' => __( 'Style', 'elements-fusion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     => __( 'Number Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .ef-countdown-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => __( 'Label Color', 'elements-fusion' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .ef-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'label'    => __( 'Number Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-countdown-number',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'label'    => __( 'Label Typography', 'elements-fusion' ),
                'selector' => '{{WRAPPER}} .ef-countdown-label',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-ef-countdown-timer-widget.php';
        \ElementsFusion\Widgets\Renders\render_ef_countdown_timer_widget( $settings );
    }
}