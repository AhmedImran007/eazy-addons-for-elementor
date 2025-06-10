<?php

namespace EazyAddonsForElementor\Widgets\Renders;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function render_eafe_content_toggle_widget( $settings ) {
    if ( empty( $settings['toggle_items'] ) ) {
        return;
    }

    ?>

<div class="eafe-content-toggle">
  <div class="eafe-toggle-switch">
    <?php foreach ( $settings['toggle_items'] as $index => $item ): ?>
    <button class="toggle-btn" data-toggle="toggle-<?php echo esc_attr( $index ); ?>"
      aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>">
      <?php echo esc_html( $item['toggle_label'] ); ?>
    </button>
    <?php endforeach; ?>
  </div>

  <div class="eafe-toggle-content">
    <?php foreach ( $settings['toggle_items'] as $index => $item ): ?>
    <div class="toggle-panel toggle-<?php echo esc_attr( $index ); ?> <?php echo $index === 0 ? 'active' : ''; ?>">
      <?php echo wp_kses_post( $item['toggle_content'] ); ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php
}