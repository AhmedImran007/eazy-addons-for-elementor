<?php if ( isset( $settings['items'] ) && is_array( $settings['items'] ) ): ?>
<div class="space-y-4" id="efAccordion">
  <?php foreach ( $settings['items'] as $index => $item ): ?>
  <?php
$item_id = 'efAccordionItem' . $index;
$heading_id = 'efAccordionHeading' . $index;
$icon = !empty( $settings['accordion_icon'] ) ? $settings['accordion_icon'] : 'fa fa-chevron-down';
?>
  <div class="border rounded-md shadow-sm">
    <!-- Accordion Header -->
    <h2 class="w-full" id="<?php echo esc_attr( $heading_id ); ?>">
      <button
        class="flex justify-between items-center w-full px-4 py-3 text-left bg-gray-100 hover:bg-gray-200 focus:outline-none"
        type="button" onclick="toggleAccordion('<?php echo esc_attr( $item_id ); ?>', this)" aria-expanded="false"
        aria-controls="<?php echo esc_attr( $item_id ); ?>">
        <span class="ef-accordion-title font-normal text-gray-700">
          <?php echo esc_html( $item['title'] ); ?>
        </span>
        <!-- Accordion Icon -->
        <i class="ef-accordion-icon <?php echo esc_attr( $icon ); ?> transition-transform duration-500 transform"></i>
      </button>
    </h2>
    <!-- Accordion Content -->
    <div id="<?php echo esc_attr( $item_id ); ?>"
      class="accordion-content ef-accordion-content hidden px-4 py-3 bg-white text-gray-600"
      aria-labelledby="<?php echo esc_attr( $heading_id ); ?>">
      <?php echo esc_html( $item['content'] ); ?>
    </div>
  </div>
  <?php endforeach;?>
</div>

<script>
function toggleAccordion(itemId, buttonElement) {
  const content = document.getElementById(itemId);
  const icon = buttonElement.querySelector('i');

  if (content.classList.contains('hidden')) {
    content.classList.remove('hidden');
    icon.classList.add('rotate-180');
  } else {
    content.classList.add('hidden');
    icon.classList.remove('rotate-180');
  }
}
</script>
<?php endif;?>