<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function elements_fusion_admin_menu() {
    add_menu_page(
        __( 'Elements Fusion Settings', 'elements-fusion' ), // Page title
        __( 'Elements Fusion', 'elements-fusion' ), // Menu title
        'manage_options', // Capability
        'elements-fusion-settings', // Menu slug
        'elements_fusion_settings_page', // Callback function
        'dashicons-admin-generic', // Icon
        100// Position
    );
}
add_action( 'admin_menu', 'elements_fusion_admin_menu' );

function elements_fusion_settings_page() {
    ?>
<div class="wrap">
  <h1><?php _e( 'Elements Fusion Settings', 'elements-fusion' );?></h1>
  <form method="post" action="options.php">
    <?php
settings_fields( 'elements_fusion_settings_group' );
    do_settings_sections( 'elements-fusion-settings' );
    submit_button();
    ?>
  </form>
</div>
<?php
}

function elements_fusion_register_settings() {
    register_setting(
        'elements_fusion_settings_group', // Option group
        'elements_fusion_enable_bootstrap' // Option name
    );

    add_settings_section(
        'elements_fusion_settings_section', // ID
        __( 'General Settings', 'elements-fusion' ), // Title
        '__return_null', // Callback
        'elements-fusion-settings' // Page
    );

    add_settings_field(
        'elements_fusion_enable_bootstrap', // ID
        __( 'Enable Bootstrap', 'elements-fusion' ), // Title
        'elements_fusion_enable_bootstrap_field', // Callback
        'elements-fusion-settings', // Page
        'elements_fusion_settings_section' // Section
    );
}
add_action( 'admin_init', 'elements_fusion_register_settings' );

function elements_fusion_enable_bootstrap_field() {
    $value = get_option( 'elements_fusion_enable_bootstrap', 1 ); // Default is enabled
    ?>
<input type="checkbox" name="elements_fusion_enable_bootstrap" value="1" <?php checked( 1, $value, true );?>>
<label
  for="elements_fusion_enable_bootstrap"><?php _e( 'Enable Bootstrap (disable if already included by theme)', 'elements-fusion' );?></label>
<?php
}