<?php

/**
 * Plugin Name: Core Functions
 * Plugin URI: https://almeida.gr
 * Description: This plugin contains site's core functions so that it is theme independent. It should always be activated.
 * Version: 1.0.0
 * Author: Monoscopic Studio
 * Author URI: https://monoscopic.net
 * Text Domain: core-functions
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) exit;

/**
 * Disable Gutenberg.
 */

// Disable Gutenberg on the back end.
add_filter('use_block_editor_for_post', '__return_false');

// Disable Gutenberg for widgets.
add_filter('use_widgets_block_editor', '__return_false');

// // Disable Scripts and Styles
// function disable_scripts_and_styles()
// {
//     // Remove CSS on the front end.
//     wp_dequeue_style('wp-block-library');

//     // Remove Gutenberg theme.
//     wp_dequeue_style('wp-block-library-theme');

//     // Remove inline global CSS on the front end.
//     wp_dequeue_style('global-styles');

//     // Remove Select 2
//     wp_dequeue_style('select2');
//     wp_deregister_style('select2');

//     wp_dequeue_script('selectWoo');
//     wp_deregister_script('selectWoo');
// }
// add_action('wp_enqueue_scripts', 'disable_scripts_and_styles', 100);

// // Disable WC Blocks Scripts and Styles
// function disable_wc_blocks()
// {
//     $styles = array("wc-blocks-style", "wc-blocks-style-active-filters", "wc-blocks-style-add-to-cart-form", "wc-blocks-packages-style", "wc-blocks-style-all-products", "wc-blocks-style-all-reviews", "wc-blocks-style-attribute-filter", "wc-blocks-style-breadcrumbs", "wc-blocks-style-catalog-sorting", "wc-blocks-style-customer-account", "wc-blocks-style-featured-category", "wc-blocks-style-featured-product", "wc-blocks-style-mini-cart", "wc-blocks-style-price-filter", "wc-blocks-style-product-add-to-cart", "wc-blocks-style-product-button", "wc-blocks-style-product-categories", "wc-blocks-style-product-image", "wc-blocks-style-product-image-gallery", "wc-blocks-style-product-query", "wc-blocks-style-product-results-count", "wc-blocks-style-product-reviews", "wc-blocks-style-product-sale-badge", "wc-blocks-style-product-search", "wc-blocks-style-product-sku", "wc-blocks-style-product-stock-indicator", "wc-blocks-style-product-summary", "wc-blocks-style-product-title", "wc-blocks-style-rating-filter", "wc-blocks-style-reviews-by-category", "wc-blocks-style-reviews-by-product", "wc-blocks-style-product-details", "wc-blocks-style-single-product", "wc-blocks-style-stock-filter", "wc-blocks-style-cart", "wc-blocks-style-checkout", "wc-blocks-style-mini-cart-contents", "classic-theme-styles-inline");

//     foreach ($styles as $style) {
//         wp_deregister_style($style);
//     }

//     $scripts = array("wc-blocks-middleware", "wc-blocks-data-store");
//     foreach ($scripts as $script) {
//         wp_deregister_script($script);
//     }
// }
// add_action("init", "disable_wc_blocks", 100);

/**
 * Setup Images.
 */

// Avoid thumbnails regeneration on theme change
add_filter('woocommerce_background_image_regeneration', '__return_false');

// Disable the scaling of big images.
add_filter('big_image_size_threshold', '__return_false');

// Disable srcset on frontend
function disable_wp_responsive_images()
{
    return 1;
}
add_filter('max_srcset_image_width', 'disable_wp_responsive_images');

/**
 * Admin setup.
 */

// // Remove the main text editor from WooCommerce product edit page.
// function remove_product_editor()
// {
//     remove_post_type_support('product', 'editor');
// }
// add_action('init', 'remove_product_editor');

// // Remove posts menu.
// function remove_posts_menu()
// {
//     remove_menu_page('edit.php');
// }
// add_action('admin_menu', 'remove_posts_menu');
