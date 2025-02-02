<?php

namespace ElementsFusion\Widgets\Renders;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function render_ef_service_list_widget( $settings ) {
    $services = $settings['services'];
    $layout = $settings['layout'];
    $icon_position = $settings['icon_position'];
    $hover_effect = $settings['hover_effect'];

    if ( empty( $services ) ) {
        return;
    }

    ?>

<div class="ef-service-list ef-service-layout-<?php echo esc_attr( $layout ); ?>">
  <?php foreach ( $services as $service ): ?>
  <div
    class="ef-service-item ef-icon-position-<?php echo esc_attr( $icon_position ); ?> ef-hover-effect-<?php echo esc_attr( $hover_effect ); ?>">
    <?php if ( $icon_position !== 'inline' ): ?>
    <div class="ef-service-icon">
      <?php \Elementor\Icons_Manager::render_icon( $service['icon'], ['aria-hidden' => 'true'] ); ?>
    </div>
    <?php endif; ?>
    <div class="ef-service-content">
      <?php if ( $icon_position === 'inline' ): ?>
      <div class="ef-service-icon">
        <?php \Elementor\Icons_Manager::render_icon( $service['icon'], ['aria-hidden' => 'true'] ); ?>
      </div>
      <?php endif; ?>
      <h3 class="ef-service-title"><?php echo esc_html( $service['title'] ); ?></h3>
      <p class="ef-service-description"><?php echo esc_html( $service['description'] ); ?></p>
      <?php if ( !empty( $service['button_text'] ) ): ?>
      <a href="<?php echo esc_url( $service['link']['url'] ); ?>" class="ef-service-button">
        <?php echo esc_html( $service['button_text'] ); ?>
      </a>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<?php
}