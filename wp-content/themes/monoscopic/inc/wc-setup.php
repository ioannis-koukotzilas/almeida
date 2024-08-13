<?php

/**
 * 
 * WooCommerce setup function.
 * 
 */

function monoscopic_woocommerce_setup()
{
  add_theme_support(
    'woocommerce',
    array(
      'product_grid'          => array(
        'default_rows'    => 4,
        'min_rows'        => 1,
        'default_columns' => 4,
        'min_columns'     => 1,
        'max_columns'     => 4,
      ),
    )
  );

  remove_theme_support('wc-product-gallery-zoom');
  remove_theme_support('wc-product-gallery-lightbox');
  remove_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'monoscopic_woocommerce_setup');

/**
 * 
 * WooCommerce Images
 * 
 */

// Used on single product pages.
add_filter('woocommerce_get_image_size_single', function ($size) {
  return array(
    'width' => 0,
    'height' => 0,
    'crop' => 0,
  );
});

// Used below the main image on the single product page to switch the gallery.
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
  return array(
    'width' => 0,
    'height' => 0,
    'crop' => 0,
  );
});

// Used in the product grids in places such as the shop page.
add_filter('woocommerce_get_image_size_thumbnail', function ($size) {
  return array(
    'width' => 0,
    'height' => 0,
    'crop' => 0,
  );
});

// Controls the size used in the product grid/catalog.
add_filter('single_product_archive_thumbnail_size', function ($size) {
  return 'medium';
});

// Controls the size used in the product grid/catalog for category images.
add_filter('subcategory_archive_thumbnail_size', function ($size) {
  return 'medium';
});

// Controls the main image size used in the product gallery.
add_filter('woocommerce_gallery_image_size', function ($size) {
  return 'large';
});

// Controls the size used in the product gallery, below to main image.
add_filter('woocommerce_gallery_thumbnail_size', function ($size) {
  return 'large';
});

/**
 * 
 * Disable the default WooCommerce stylesheet.
 * 
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * 
 * Cart
 * 
 */

// Cart Fragments. Ensure cart contents update when products are added to the cart via AJAX.
function monoscopic_woocommerce_cart_link_fragment($fragments)
{
  ob_start();
  monoscopic_woocommerce_cart_link();
  $fragments['a.cart-contents'] = ob_get_clean();

  return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'monoscopic_woocommerce_cart_link_fragment');

// Cart Link. Displayed a link to the cart including the number of items present and the cart total.
function monoscopic_woocommerce_cart_link()
{
?>
  <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your crate', 'monoscopic'); ?>">
    <?php
    $item_count_text = WC()->cart->get_cart_contents_count();
    ?>
    <?php esc_html_e('Cart', 'monoscopic'); ?> <?php echo esc_html('(' . $item_count_text . ')'); ?>
  </a>
<?php
}

// Display Cart.
function monoscopic_woocommerce_cart()
{
  if (is_cart()) {
    $class = 'current-menu-item';
  } else {
    $class = '';
  }
?>
  <div class="cart <?php echo esc_attr($class); ?>">
    <?php monoscopic_woocommerce_cart_link(); ?>
  </div>
<?php
}

/**
 * 
 * Related Products.
 * 
 */

function monoscopic_woocommerce_related_products_args($args)
{
  $defaults = array(
    'posts_per_page' => 12,
    'columns'        => '',
  );

  $args = wp_parse_args($defaults, $args);

  return $args;
}
add_filter('woocommerce_output_related_products_args', 'monoscopic_woocommerce_related_products_args');

/**
 * 
 * Upsell Products.
 * 
 */

function wc_change_number_related_products($args)
{
  $defaults = array(
    'posts_per_page' => 12,
    'columns'        => '',
  );

  $args = wp_parse_args($defaults, $args);

  return $args;
}
add_filter('woocommerce_upsell_display_args', 'wc_change_number_related_products', 20);


/**
 * 
 * Change pagination next and previous buttons.
 * 
 */

add_filter('woocommerce_pagination_args', 'monoscopic_override_pagination_args');
function monoscopic_override_pagination_args($args)
{
  $args['prev_text'] = __('Previous');
  $args['next_text'] = __('Next');
  return $args;
}
