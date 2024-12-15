<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

abstract class Widget_Base extends \Elementor\Widget_Base {

    /**
     * Get widget categories
     *
     * @return array
     */
    public function get_categories() {
        return ['elements-fusion'];
    }

    /**
     * Get widget stylesheet dependencies
     *
     * @return array
     */
    public function get_style_depends() {
        return ['elements-fusion-style'];
    }

    /**
     * Get widget script dependencies
     *
     * @return array
     */
    public function get_script_depends() {
        return ['elements-fusion-script'];
    }
}