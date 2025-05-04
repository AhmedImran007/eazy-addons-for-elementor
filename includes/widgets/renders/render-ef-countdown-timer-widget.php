<?php

namespace ElementsFusion\Widgets\Renders;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function render_ef_countdown_timer_widget( $settings ) {
    $target_date = $settings['countdown_date'];
    $show_labels = $settings['show_labels'];
    $custom_labels = $settings['custom_labels'];
    $label_days = $settings['label_days'];
    $label_hours = $settings['label_hours'];
    $label_minutes = $settings['label_minutes'];
    $label_seconds = $settings['label_seconds'];
    $expiry_action = $settings['expiry_action'];
    $expiry_message = $settings['expiry_message'];
    $expiry_redirect = $settings['expiry_redirect_url']['url'] ?? '';

    if ( empty( $target_date ) ) {
        return;
    }

    ?>

<div class="ef-countdown-timer" data-date="<?php echo esc_attr( $target_date ); ?>"
  data-expiry-action="<?php echo esc_attr( $expiry_action ); ?>"
  data-expiry-message="<?php echo esc_attr( $expiry_message ); ?>"
  data-expiry-redirect="<?php echo esc_url( $expiry_redirect ); ?>">
  <div class="ef-countdown-item">
    <span class="ef-countdown-number" id="days">0</span>
    <?php if ( 'yes' === $show_labels ): ?>
    <span class="ef-countdown-label"><?php echo esc_html( $custom_labels === 'yes' ? $label_days : 'Days' ); ?></span>
    <?php endif; ?>
  </div>
  <div class="ef-countdown-item">
    <span class="ef-countdown-number" id="hours">0</span>
    <?php if ( 'yes' === $show_labels ): ?>
    <span class="ef-countdown-label"><?php echo esc_html( $custom_labels === 'yes' ? $label_hours : 'Hours' ); ?></span>
    <?php endif; ?>
  </div>
  <div class="ef-countdown-item">
    <span class="ef-countdown-number" id="minutes">0</span>
    <?php if ( 'yes' === $show_labels ): ?>
    <span
      class="ef-countdown-label"><?php echo esc_html( $custom_labels === 'yes' ? $label_minutes : 'Minutes' ); ?></span>
    <?php endif; ?>
  </div>
  <div class="ef-countdown-item">
    <span class="ef-countdown-number" id="seconds">0</span>
    <?php if ( 'yes' === $show_labels ): ?>
    <span
      class="ef-countdown-label"><?php echo esc_html( $custom_labels === 'yes' ? $label_seconds : 'Seconds' ); ?></span>
    <?php endif; ?>
  </div>
</div>

<?php
}