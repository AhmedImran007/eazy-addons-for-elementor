<?php

namespace ElementsFusion\Widgets\Renders;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function render_ef_progress_bar_widget( $settings ) {
    $title = $settings['title'];
    $percentage = isset( $settings['percentage']['size'] ) ? intval( $settings['percentage']['size'] ) : 0;
    $show_percentage = $settings['show_percentage'];
    $animation_speed = $settings['animation_speed'];
    $bar_style = $settings['bar_style'];

    $bar_class = 'ef-progress-bar-fill';
    if ( $bar_style === 'striped' ) {
        $bar_class .= ' ef-progress-bar-striped';
    } elseif ( $bar_style === 'gradient' ) {
        $bar_class .= ' ef-progress-bar-gradient';
    }

    ?>

<div class="ef-progress-bar-wrapper">
  <?php if ( !empty( $title ) ): ?>
  <div class="ef-progress-bar-title">
    <?php echo esc_html( $title ); ?>
    <?php if ( $show_percentage === 'yes' ): ?>
    <span class="ef-progress-bar-percentage"><?php echo esc_html( $percentage ); ?>%</span>
    <?php endif; ?>
  </div>
  <?php endif; ?>
  <div class="ef-progress-bar">
    <div class="<?php echo esc_attr( $bar_class ); ?>" style="width: 0;"
      data-width="<?php echo esc_attr( $percentage ); ?>%"></div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const bars = document.querySelectorAll('.ef-progress-bar-fill');
  bars.forEach(bar => {
    const width = bar.getAttribute('data-width');
    const speed = <?php echo esc_attr( $animation_speed ); ?>;
    bar.style.transition = `width ${speed}ms ease-in-out`;
    bar.style.width = width;
  });
});
</script>

<?php
}