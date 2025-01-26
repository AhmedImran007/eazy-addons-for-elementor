<?php

namespace ElementsFusion\Widgets\Renders;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function render_ef_pricing_table_widget( $settings ) {
    $title = $settings['title'];
    $price = $settings['price'];
    $currency_symbol = $settings['currency_symbol'];
    $pricing_period = $settings['pricing_period'];
    $features = explode( "\n", $settings['features'] );
    $button_text = $settings['button_text'];
    $button_link = $settings['button_link']['url'];
    $is_featured = $settings['is_featured'] === 'yes' ? 'featured' : '';

    ?>

<div class="ef-pricing-table <?php echo esc_attr( $is_featured ); ?>">
  <div class="ef-pricing-table-title"><?php echo esc_html( $title ); ?></div>
  <div class="ef-pricing-table-price">
    <span class="ef-pricing-table-currency"><?php echo esc_html( $currency_symbol ); ?></span>
    <span class="ef-pricing-table-amount"><?php echo esc_html( $price ); ?></span>
    <span class="ef-pricing-table-period"><?php echo esc_html( $pricing_period ); ?></span>
  </div>
  <ul class="ef-pricing-table-features">
    <?php foreach ( $features as $feature ): ?>
    <li><?php echo esc_html( $feature ); ?></li>
    <?php endforeach; ?>
  </ul>
  <a href="<?php echo esc_url( $button_link ); ?>" class="ef-pricing-table-button">
    <?php echo esc_html( $button_text ); ?>
  </a>
</div>

<?php
}