<?php

/**
 * Single Product Thumbnails
 */

defined('ABSPATH') || exit;

if (!function_exists('monoscopic_wc_gallery_image_html')) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

if ($attachment_ids && $product->get_image_id()) {
	foreach ($attachment_ids as $attachment_id) {
		echo apply_filters('woocommerce_single_product_image_thumbnail_html', monoscopic_wc_gallery_image_html($attachment_id), $attachment_id);
	}
}
