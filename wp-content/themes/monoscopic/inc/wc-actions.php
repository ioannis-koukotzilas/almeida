<?php

/**
 * Global Actions
 */

// Remove default WooCommerce wrapper.
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Wraps all WooCommerce content in wrappers which match the theme markup.
function monoscopic_woocommerce_wrapper_before()
{
    echo '<main class="site-main">';
}
add_action('woocommerce_before_main_content', 'monoscopic_woocommerce_wrapper_before');

// Close the wrapping div.
function monoscopic_woocommerce_wrapper_after()
{
    echo '</main>';
}
add_action('woocommerce_after_main_content', 'monoscopic_woocommerce_wrapper_after');

// Site main container open.
function archive_site_main_wrapper_open()
{
    if (!is_singular()) : echo '<div class="container">';
    endif;
}
add_action('woocommerce_before_main_content', 'archive_site_main_wrapper_open', 15);

// Site main container close.
function archive_site_main_wrapper_close()
{
    if (!is_singular()) : echo '</div>';
    endif;
}
add_action('woocommerce_after_main_content', 'archive_site_main_wrapper_close', 5);

// Remove WC sidebar.
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Remove demo store notification.
remove_action('wp_footer', 'woocommerce_demo_store');

/**
 * Single Product Actions
 */

// Remove default product title.
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

// Remove product meta.
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Remove product tabs.
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

// Add breadcrumb.
add_action('woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 4);

// Wrap single product content.
function monoscopic_product_container_open()
{
    echo '<div class="product-main">';
    echo '<div class="wrapper">';
}
add_action('woocommerce_before_single_product_summary', 'monoscopic_product_container_open', 5);

// Close the wrapper.
function monoscopic_product_container_close()
{
    echo '</div>';
    echo '</div>';
}
add_action('woocommerce_after_single_product_summary', 'monoscopic_product_container_close', 1);

// Reposition Notices.
remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_checkout_form_cart_notices', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 5);
remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_lost_password_form', 'woocommerce_output_all_notices', 10);
remove_action('before_woocommerce_pay', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_reset_password_form', 'woocommerce_output_all_notices', 10);
add_action('monoscopic_after_header', 'woocommerce_output_all_notices', 1);

// Add product header wrapper.
function monoscopic_product_header_open()
{
    echo '<header class="product-header">';
}
add_action('woocommerce_single_product_summary', 'monoscopic_product_header_open', 5);

// Product tags.
add_action('woocommerce_single_product_summary', 'monoscopic_wc_product_tags', 9);

// Add product title.
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);

// Reposition product short description.
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 11);

// Add product SKU.
add_action('woocommerce_single_product_summary', 'monoscopic_wc_product_sku', 12);

// Close product header wrapper.
function monoscopic_product_header_close()
{
    echo '</header>';
}
add_action('woocommerce_single_product_summary', 'monoscopic_product_header_close', 18);

// Add product cart wrapper.
function monoscopic_product_cart_wrapper_open()
{
    echo '<div class="product-cart">';
}
add_action('woocommerce_before_add_to_cart_form', 'monoscopic_product_cart_wrapper_open', 1);

// Reposition product price
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_before_add_to_cart_form', 'woocommerce_template_single_price', 2);

// Close product cart wrapper.
function monoscopic_product_cart_wrapper_close()
{
    echo '</div>';
}
add_action('woocommerce_after_add_to_cart_form', 'monoscopic_product_cart_wrapper_close', 100);

// Add product description.
add_action('woocommerce_single_product_summary', 'monoscopic_wc_product_description', 39);

// Add product meta wrapper.
function monoscopic_product_meta_wrapper_open()
{
    echo '<div class="product-meta">';
}
add_action('woocommerce_single_product_summary', 'monoscopic_product_meta_wrapper_open', 40);

// Add Product Meta
add_action('woocommerce_single_product_summary', 'monoscopic_wc_product_attributes_text', 41);

// Close product meta wrapper.
function monoscopic_product_meta_wrapper_close()
{
    echo '</div>';
}
add_action('woocommerce_single_product_summary', 'monoscopic_product_meta_wrapper_close', 45);

add_action('woocommerce_after_single_product_summary', 'monoscopic_wc_shop_description', 10);

/**
 * Product Archive Actions
 */

// Remove breadcrumb.
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Remove Catalog Ordering.
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Remove result count.
// remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Add the audio player.
add_action('woocommerce_after_shop_loop_item', 'monoscopic_audio_player');
