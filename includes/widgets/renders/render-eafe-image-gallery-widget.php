<?php

namespace EazyAddonsForElementor\Widgets\Renders;

use Elementor\Group_Control_Image_Size;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function render_eafe_image_gallery_widget( $settings ) {
    if ( empty( $settings['gallery_images'] ) ) {
        return;
    }

    $layout = $settings['gallery_layout'];
    $columns = $settings['columns'];
    $enable_lightbox = $settings['enable_lightbox'] === 'yes' ? true : false;

    // Gallery Wrapper
    echo '<div class="eafe-gallery-container eafe-layout-' . esc_attr( $layout ) . ' eafe-columns-' . esc_attr( $columns ) . '">';

    foreach ( $settings['gallery_images'] as $image ) {
        $image_url = $image['url'];

        // Get the image thumbnail
        $thumbnail_url = Group_Control_Image_Size::get_attachment_image_src(
            $image['id'],
            'thumbnail',
            $settings
        );

        echo '<div class="eafe-gallery-item">';
        if ( $enable_lightbox ) {
            echo '<a href="' . esc_url( $image_url ) . '" class="eafe-gallery-lightbox" data-fancybox="gallery">';
        }
        echo '<img src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( $image['id'] ) . '" />'; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
        if ( $enable_lightbox ) {
            echo '</a>';
        }
        echo '</div>';
    }

    echo '</div>';
}