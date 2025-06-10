<?php

namespace EazyAddonsForElementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class EAFE_Countdown_Timer_Widget extends Widget_Base {

    public function get_name() {
        return EAFE_WIDGET_PREFIX . 'countdown_timer';
    }

    public function get_title() {
        return __( 'Countdown Timer', 'eazy-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return ['eazy-addons-for-elementor-category'];
    }

    protected function _register_controls() {
        // Timer Settings Section
        $this->start_controls_section(
            'countdown_settings',
            [
                'label' => __( 'Countdown Settings', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'countdown_date',
            [
                'label'          => __( 'Target Date', 'eazy-addons-for-elementor' ),
                'type'           => Controls_Manager::DATE_TIME,
                'default'        => gmdate( 'Y-m-d H:i:s', (int) strtotime( '+1 week' ) ?: time() ),
                'picker_options' => [
                    'enableTime' => true,
                ],
            ]
        );

        $this->add_control(
            'show_labels',
            [
                'label'        => __( 'Show Labels', 'eazy-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'eazy-addons-for-elementor' ),
                'label_off'    => __( 'No', 'eazy-addons-for-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'custom_labels',
            [
                'label'        => __( 'Custom Labels', 'eazy-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'eazy-addons-for-elementor' ),
                'label_off'    => __( 'No', 'eazy-addons-for-elementor' ),
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
                'label'     => __( 'Days Label', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Days', 'eazy-addons-for-elementor' ),
                'condition' => [
                    'show_labels'   => 'yes',
                    'custom_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_hours',
            [
                'label'     => __( 'Hours Label', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Hours', 'eazy-addons-for-elementor' ),
                'condition' => [
                    'show_labels'   => 'yes',
                    'custom_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_minutes',
            [
                'label'     => __( 'Minutes Label', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Minutes', 'eazy-addons-for-elementor' ),
                'condition' => [
                    'show_labels'   => 'yes',
                    'custom_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_seconds',
            [
                'label'     => __( 'Seconds Label', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Seconds', 'eazy-addons-for-elementor' ),
                'condition' => [
                    'show_labels'   => 'yes',
                    'custom_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'expiry_action',
            [
                'label'   => __( 'On Expiry', 'eazy-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'     => __( 'None', 'eazy-addons-for-elementor' ),
                    'message'  => __( 'Show Message', 'eazy-addons-for-elementor' ),
                    'redirect' => __( 'Redirect to URL', 'eazy-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'expiry_message',
            [
                'label'     => __( 'Expiry Message', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => __( 'The countdown has ended!', 'eazy-addons-for-elementor' ),
                'condition' => [
                    'expiry_action' => 'message',
                ],
            ]
        );

        $this->add_control(
            'expiry_redirect_url',
            [
                'label'       => __( 'Redirect URL', 'eazy-addons-for-elementor' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'eazy-addons-for-elementor' ),
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
                'label' => __( 'Style', 'eazy-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     => __( 'Number Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eafe-countdown-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => __( 'Label Color', 'eazy-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .eafe-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'label'    => __( 'Number Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-countdown-number',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'label'    => __( 'Label Typography', 'eazy-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .eafe-countdown-label',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Include the render file and call the render function
        require_once __DIR__ . '/renders/render-eafe-countdown-timer-widget.php';
        \EazyAddonsForElementor\Widgets\Renders\render_eafe_countdown_timer_widget( $settings );
    }
}