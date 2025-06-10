<?php

namespace EazyAddonsForElementor\Admin;

class Dashboard {

    public function init() {
        add_action( 'admin_menu', [$this, 'add_admin_menu'] );
    }

    public function add_admin_menu() {
        add_menu_page(
            __( 'Eazy Addons For Elementor', 'eazy-addons-for-elementor' ),
            __( 'Eazy Addons For Elementor', 'eazy-addons-for-elementor' ),
            'manage_options',
            'eazy-addons-for-elementor',
            [$this, 'render_dashboard'],
            'dashicons-admin-generic'
        );
    }

    public function render_dashboard() {
        require_once __DIR__ . '/views/dashboard.php';
    }
}
