<?php
/**
 * Plugin Name: Addons for Pixel
 * Description: Add variables for Facebook Pixel in WordPress
 * Plugin URI: https://sjsocialmedia.com/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Author: SJ Social Media
 * Version: 1.7.2
 * Author URI: https://sjsocialmedia.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 *
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) exit;

// Check if Facebook Pixel plugin is active
function AFP_check_facebook_pixel_active() {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (!is_plugin_active('facebook-pixel-plugin/facebook-pixel-plugin.php')) {
        add_action('admin_notices', 'AFP_facebook_pixel_admin_notice');
    }
}
add_action('admin_init', 'AFP_check_facebook_pixel_active');

// Admin notice if Facebook Pixel plugin is not active
function AFP_facebook_pixel_admin_notice() {
    ?>
    <div class="notice notice-warning is-dismissible">
        <p><?php _e('Addons for Pixel requires the Facebook Pixel plugin to be installed and active for optimal functionality.', 'addons-for-pixel'); ?></p>
    </div>
    <?php
}

// General function to insert Facebook Pixel script
function AFP_insert_fb_pixel_script($params) {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            fbq('track', 'ViewContent', <?php echo json_encode($params); ?>);
        });
    </script>
    <?php
}

// Function for pages
function AFP_FPViewContent() {
    if (is_page()) {
        $params = array(
            'content_name' => get_the_title(),
            'content_type' => get_post_type(),
            'content_ids'  => get_the_ID(),
        );
        AFP_insert_fb_pixel_script($params);
    }
}
add_action('wp_footer', 'AFP_FPViewContent');

// Function for single posts
function AFP_FPViewPost() {
    if (is_single()) {
        $category = get_the_category();
        $cat_name = !empty($category) ? $category[0]->cat_name : '';

        $params = array(
            'content_name' => get_the_title(),
            'content_category' => $cat_name,
            'content_ids' => get_the_ID(),
            'content_type' => get_post_type(),
        );
        AFP_insert_fb_pixel_script($params);
    }
}
add_action('wp_footer', 'AFP_FPViewPost');

// Check if WooCommerce is active before defining WooCommerce-related functions
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    // Function for WooCommerce products
    function AFP_FPProducts() {
        if (is_product()) {
            global $product;
            $params = array(
                'content_name' => get_the_title(),
                'content_category' => wc_get_product_category_list($product->get_id()),
                'content_ids' => get_the_ID(),
                'content_type' => 'product',
                'currency' => get_woocommerce_currency(),
                'value' => $product->get_price(),
            );
            AFP_insert_fb_pixel_script($params);
        }
    }
    add_action('woocommerce_after_single_product', 'AFP_FPProducts');
}

// Adding Open Graph in the Language Attributes
function AFP_OpengraphDoctype($output) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'AFP_OpengraphDoctype');

// Adding Open Graph Meta Info
function AFP_FOpengraph() {
    if (is_singular()) {
        global $post;
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '"/>';
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '"/>';
        echo '<meta property="og:description" content="' . esc_attr(get_the_excerpt()) . '"/>';
        echo '<meta property="og:type" content="website">';
        if (has_post_thumbnail($post->ID)) {
            echo '<meta property="og:image" content="' . esc_url(get_the_post_thumbnail_url($post->ID, 'full')) . '"/>';
        }
    }
}
add_action('wp_head', 'AFP_FOpengraph');