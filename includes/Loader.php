<?php

namespace EazyAddonsForElementor;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Loader {

    public function init() {
        // Register the custom widget category
        $this->register_widget_category();

        // Hook to register widgets once Elementor is initialized
        add_action( 'elementor/widgets/register', [$this, 'register_widgets'] );

        // Hook for admin-specific functionality (if any)
        if ( is_admin() ) {
            $this->init_admin();
        }
    }

    private function register_widget_category() {
        add_action( 'elementor/elements/categories_registered', function ( $elements_manager ) {
            $elements_manager->add_category(
                'eazy-addons-for-elementor-category', // Unique slug for the category
                [
                    'title' => __( 'Eazy Addons For Elementor', 'eazy-addons-for-elementor' ),
                    'icon'  => 'fa fa-plug', // Optional icon
                ]
            );
        } );
    }

    public function register_widgets( $widgets_manager ) {
        // Dynamically load all widget files from the "widgets" directory
        $widget_files = glob( __DIR__ . '/widgets/*.php' );

        foreach ( $widget_files as $file ) {
            require_once $file;

            // Get the class name from the file path
            $class_name = $this->get_class_name_from_file( $file );

            if ( class_exists( $class_name ) ) {
                // Register the widget with Elementor
                $widgets_manager->register( new $class_name() );

                // Enqueue assets for this widget
                $this->enqueue_widget_assets( $class_name );
            }
        }
    }

    private function enqueue_widget_assets( $class_name ) {
        // Convert class name to widget name (Widget_One → widget-one)
        $widget_name = strtolower( str_replace( '_', '-', $this->get_widget_name( $class_name ) ) );

        // Define the URL paths (web-accessible)
        $css_url = EAFE_URL . "assets/css/{$widget_name}.css";
        $js_url = EAFE_URL . "assets/js/{$widget_name}.js";

        // Define the file paths (for existence checks)
        $css_file_path = EAFE_PATH . "assets/css/{$widget_name}.css";
        $js_file_path = EAFE_PATH . "assets/js/{$widget_name}.js";

        // Load assets only when Elementor frontend is rendering
        add_action( 'elementor/frontend/after_enqueue_scripts', function () use ( $widget_name, $css_file_path, $js_file_path, $css_url, $js_url ) {
            if ( file_exists( $css_file_path ) ) {
                wp_enqueue_style( 'eazy-addons-for-elementor-' . $widget_name, $css_url, [], '1.0.0' );
            }

            if ( file_exists( $js_file_path ) ) {
                wp_enqueue_script( 'eazy-addons-for-elementor-' . $widget_name, $js_url, ['jquery'], '1.0.0', true );
            }
        } );

        // Load assets in Elementor editor
        add_action( 'elementor/editor/after_enqueue_scripts', function () use ( $widget_name, $css_file_path, $js_file_path, $css_url, $js_url ) {
            if ( file_exists( $css_file_path ) ) {
                wp_enqueue_style( 'eazy-addons-for-elementor-' . $widget_name, $css_url, [], '1.0.0' );
            }

            if ( file_exists( $js_file_path ) ) {
                wp_enqueue_script( 'eazy-addons-for-elementor-' . $widget_name, $js_url, ['jquery'], '1.0.0', true );
            }
        } );

        // Load swiper.js only if the widget requires it
        $this->conditionally_enqueue_swiper( $widget_name );
    }

    private function conditionally_enqueue_swiper( $widget_name ) {
        $widgets_using_swiper = [
            'post-carousel',
            'image-carousel',
            'testimonials-slider',
            'eafe-service-list-widget',
        ];

        if ( in_array( $widget_name, $widgets_using_swiper, true ) ) {
            // Register assets once
            wp_register_style(
                'eazy-addons-for-elementor-swiper-css',
                EAFE_URL . 'assets/libs/css/swiper-bundle.min.css',
                [],
                '8.0.0'
            );

            wp_register_script(
                'eazy-addons-for-elementor-swiper-js',
                EAFE_URL . 'assets/libs/js/swiper-bundle.min.js',
                [],
                '8.0.0',
                true
            );

            // Enqueue for frontend and Elementor editor
            $enqueue = function () {
                wp_enqueue_style( 'eazy-addons-for-elementor-swiper-css' );
                wp_enqueue_script( 'eazy-addons-for-elementor-swiper-js' );
            };

            add_action( 'elementor/frontend/after_enqueue_scripts', $enqueue );
            add_action( 'elementor/editor/after_enqueue_scripts', $enqueue );
        }
    }

    /**
     * Extract the widget name from the class name.
     * For example: 'EazyAddonsForElementor\Widgets\Widget_One' → 'widget-one'.
     */
    private function get_widget_name( $class_name ) {
        // Get the base class name (strip namespaces)
        $base_class_name = substr( strrchr( $class_name, '\\' ), 1 ); // Extracts 'Widget_One'

        // Convert to a slug (e.g., 'Widget_One' → 'widget-one')
        return strtolower( str_replace( '_', '-', $base_class_name ) );
    }

    private function init_admin() {
        require_once __DIR__ . '/../admin/Dashboard.php';
        $dashboard = new Admin\Dashboard();
        $dashboard->init();
    }

    private function get_class_name_from_file( $file ) {
        $base_name = basename( $file, '.php' );
        return 'EazyAddonsForElementor\\Widgets\\' . $base_name;
    }
}