<?php

if (!defined('_MONOSCOPIC_VERSION')) {
	define('_MONOSCOPIC_VERSION', '1.0.0');
}

function monoscopic_setup()
{
	add_theme_support('title-tag');

	add_theme_support('post-thumbnails');

	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'monoscopic'),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action('after_setup_theme', 'monoscopic_setup');

function monoscopic_content_width()
{
	$GLOBALS['content_width'] = apply_filters('monoscopic_content_width', 2560);
}
add_action('after_setup_theme', 'monoscopic_content_width', 0);

function monoscopic_scripts()
{
	// CSS
	wp_enqueue_style('style', get_stylesheet_uri(), array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css', array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('variables', get_template_directory_uri() . '/assets/css/variables.css', array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('symbols', get_template_directory_uri() . '/assets/css/symbols.css', array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('footer', get_template_directory_uri() . '/assets/css/footer.css', array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('header', get_template_directory_uri() . '/assets/css/header.css', array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper.css', array(), _MONOSCOPIC_VERSION);
	wp_enqueue_style('woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), _MONOSCOPIC_VERSION);
	
	// JS
	wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.min.js', array(), _MONOSCOPIC_VERSION, true);
	wp_enqueue_script('app', get_template_directory_uri() . '/js/main.js', array(), _MONOSCOPIC_VERSION, true);
}
add_action('wp_enqueue_scripts', 'monoscopic_scripts');

/**
 * Extend search functionality.
 */
require get_template_directory() . '/inc/extend-search.php';

/**
 * Load WooCommerce compatibility files.
 */

if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/wc-setup.php';
	require get_template_directory() . '/inc/wc-functions.php';
	require get_template_directory() . '/inc/wc-actions.php';
}

function custom_add_to_cart_button($button, $product)
{
	// Add a data attribute for the product title
	$button = str_replace('<a href=', '<a data-product_title="' . esc_attr($product->get_title()) . '" href=', $button);
	return $button;
}
add_filter('woocommerce_loop_add_to_cart_link', 'custom_add_to_cart_button', 10, 2);

function the_pagination()
{
	the_posts_pagination(array(
		'mid_size' => 2,
		'prev_text' => __('Previous', 'monoscopic'),
		'next_text' => __('Next', 'monoscopic'),
	));
}

function custom_search_form_placeholder($form)
{
	$new_placeholder = 'What are you looking for?';

	if (strpos($form, 'placeholder="') !== false) {
		$form = preg_replace('/placeholder="[^"]*"/', 'placeholder="' . esc_attr($new_placeholder) . '"', $form);
	}

	return $form;
}
add_filter('get_search_form', 'custom_search_form_placeholder', 100, 1);
