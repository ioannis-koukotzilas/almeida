<?php

function cf_search_join($join)
{
  global $wpdb;

  if (is_search() && !is_admin()) { // Ensure this only applies to the front-end search
    $join .= " LEFT JOIN " . $wpdb->postmeta . " ON " . $wpdb->posts . ".ID = " . $wpdb->postmeta . ".post_id ";
  }

  return $join;
}
add_filter('posts_join', 'cf_search_join');

function cf_search_where($where)
{
  global $pagenow, $wpdb;

  if (is_search() && !is_admin()) { // Ensure this only applies to the front-end search
    // Include only specific post types in search
    $post_types = ["product"];
    $post_types_sql = "'" . implode("', '", $post_types) . "'";

    // Add SQL to filter by specified post types
    $where .= " AND " . $wpdb->posts . ".post_type IN ($post_types_sql)";

    // Modify the search query to include custom fields
    $where = preg_replace(
      "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
      "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)",
      $where
    );
  }

  return $where;
}
add_filter('posts_where', 'cf_search_where');

function cf_search_distinct($where)
{
  if (is_search() && !is_admin()) { // Ensure this only applies to the front-end search
    return "DISTINCT";
  }

  return $where;
}
add_filter('posts_distinct', 'cf_search_distinct');
