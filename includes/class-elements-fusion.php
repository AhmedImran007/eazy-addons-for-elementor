<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Elements_Fusion {

    /**
     * Singleton instance
     *
     * @var Elements_Fusion|null
     */
    private static $instance = null;

    /**
     * Get the singleton instance
     *
     * @return Elements_Fusion
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->load_dependencies();
        $this->define_hooks();
    }

    /**
     * Load all required files
     */
    private function load_dependencies() {
        // Include required files
        require_once plugin_dir_path( __FILE__ ) . 'enqueue.php'; // Enqueue scripts and styles
        require_once plugin_dir_path( __FILE__ ) . 'helper-functions.php'; // Helper functions
        require_once plugin_dir_path( __FILE__ ) . 'admin-settings.php'; // Admin settings
    }

    /**
     * Define hooks and actions
     */
    private function define_hooks() {
        // Add custom Elementor category
        add_action( 'elementor/elements/categories_registered', [$this, 'register_elementor_category'] );

        // Register custom widgets
        add_action( 'elementor/widgets/register', [$this, 'register_widgets'] );
    }

    /**
     * Register a custom Elementor widget category
     *
     * @param \Elementor\Elements_Manager $elements_manager
     */
    public function register_elementor_category( $elements_manager ) {
        $elements_manager->add_category(
            'elements-fusion',
            [
                'title' => __( 'Elements Fusion', 'elements-fusion' ),
                'icon'  => 'fa fa-plug',
            ]
        );
    }

    /**
     * Register custom widgets
     *
     * @param \Elementor\Widgets_Manager $widgets_manager
     */
    public function register_widgets( $widgets_manager ) {
        // Include widget files
        require_once plugin_dir_path( __FILE__ ) . 'widgets/widget-button.php';
        require_once plugin_dir_path( __FILE__ ) . 'widgets/widget-ef-accordion.php';

        // require_once plugin_dir_path( __FILE__ ) . 'widgets/widget-image.php';
        // require_once plugin_dir_path( __FILE__ ) . 'widgets/widget-testimonial.php';

        // Register widgets
        $widgets_manager->register( new \Widget_Button() );
        $widgets_manager->register( new \Widget_EF_Accordion() );

        // $widgets_manager->register( new \Widget_Image() );
        // $widgets_manager->register( new \Widget_Testimonial() );
    }
}