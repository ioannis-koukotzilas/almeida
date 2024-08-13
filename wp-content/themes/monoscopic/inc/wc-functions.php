<?php

function monoscopic_wc_gallery_image_html($attachment_id)
{
  $image = wp_get_attachment_image($attachment_id, 'large');

  return '<div class="swiper-slide">' . $image . '</div>';
}

function monoscopic_wc_breadcrumb()
{
  return array(
    'delimiter'   => ' › ',
    'wrap_before' => '<nav class="breadcrumb" itemprop="breadcrumb"><div class="wrapper">',
    'wrap_after'  => '</div></nav>',
    'before'      => '',
    'after'       => '',
    'home'        => 'Home',
  );
}
add_filter('woocommerce_breadcrumb_defaults', 'monoscopic_wc_breadcrumb');

function monoscopic_wc_product_tags()
{
  global $product;
  echo wc_get_product_tag_list($product->get_id(), ', ', '<div class="product-tags">' . _n('', '', count($product->get_tag_ids()), 'woocommerce') . ' ', '</div>');
}

function monoscopic_wc_product_sku()
{
  global $product;
?>
  <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
    <div class="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></div>
  <?php endif; ?>
<?php
}

function monoscopic_wc_product_description()
{
  the_content();
}

function monoscopic_wc_product_attributes_text()
{
  global $post;
  $attribute_names = ['pa_color', 'pa_material'];
  foreach ($attribute_names as $attribute_name) {
    $taxonomy = get_taxonomy($attribute_name);
    if ($taxonomy && !is_wp_error($taxonomy)) {
      $terms = wp_get_post_terms($post->ID, $attribute_name);
      $terms_array = [];
      if (!empty($terms)) {
        foreach ($terms as $term) {
          $full_line = $term->name;
          array_push($terms_array, $full_line);
        }
        echo '<div class="term">' . $taxonomy->labels->singular_name . ': ' . implode(', ', $terms_array) . '</div>';
      }
    }
  }
}

function monoscopic_wc_shop_description()
{
?>
  <div class="shop-description">
    <div class="wrapper">
      <h2 class="section-title">About Almeida</h2>
      <p>Every person inspires a different and unique response, every person is a jewel. Jewels get attracted to each other and most of the time it is just “love at first sight”.</p>
      <p>Our designs are the spontaneous result of contact and work with noble metals and precious and semi precious stones. Gems from all over the world pile up in our atelier and slowly take the form of a bracelet, necklace or earring.</p>
    </div>
  </div>
<?php
}
