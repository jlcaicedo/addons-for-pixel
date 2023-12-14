<?php
/**
 * Plugin Name: Addons for Pixel
 * Description: Enhances WordPress with Facebook Pixel functionalities and Open Graph integration.
 * Plugin URI: https://sjsocialmedia.com/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Author: SJ Social Media
 * Version: 1.7.3
 * Author URI: https://sjsocialmedia.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: addons-for-pixel
 */

if (!defined('ABSPATH')) exit;

// Check if Official Facebook Pixel plugin is active
function afp_check_official_facebook_pixel() {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (!is_plugin_active('official-facebook-pixel/facebook-for-wordpress.php')) {
        add_action('admin_notices', 'afp_facebook_pixel_admin_notice');
    }
}

function afp_facebook_pixel_admin_notice() {
    ?>
    <div class="notice notice-warning is-dismissible">
        <p><?php _e('Addons for Pixel requires the Official Facebook Pixel plugin to be installed and active.', 'addons-for-pixel'); ?></p>
    </div>
    <?php
}

add_action('admin_init', 'afp_check_official_facebook_pixel');

function afp_insert_facebook_pixel_script() {
    if (is_singular()) {
        $content_category = is_singular('product') ? wc_get_product_category_list(get_the_ID()) : (get_the_category() ? get_the_category()[0]->cat_name : '');
        $currency = function_exists('get_woocommerce_currency') ? get_woocommerce_currency() : '';
        $product_value = function_exists('wc_get_product') ? wc_get_product()->get_price() : '';

        $pixel_params = array(
            'content_name' => get_the_title(),
            'content_category' => $content_category,
            'content_ids' => get_the_ID(),
            'content_type' => get_post_type(),
            'currency' => $currency,
            'value' => $product_value,
        );
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                fbq('track', 'ViewContent', <?php echo json_encode($pixel_params); ?>);
            });
        </script>
        <?php
    }
}

add_action('wp_footer', 'afp_insert_facebook_pixel_script');

function afp_add_opengraph_doctype($output) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}

add_filter('language_attributes', 'afp_add_opengraph_doctype');

function afp_add_opengraph_meta() {
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

add_action('wp_head', 'afp_add_opengraph_meta');