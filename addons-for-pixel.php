<?php
/**
 * Plugin Name: Addons for Pixel 
 * Description: Add variables for Facebook Pixel in wordpress
 * Plugin URI: https://sjsocialmedia.com/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Author: SJ Social Media
 * Version: 1.1
 * Author URI: https://sjsocialmedia.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 *
 * Addons for Pixel is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Addons for Pixel is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
*/

// AFP_FPViewContent 
function AFP_FPViewContent() {
    ?>
		<script> 
		document.addEventListener("DOMContentLoaded", function(event) { 
				fbq('track', 'ViewContent', {
				  content_name: '<?php the_title(); ?>',
				  content_type: '<?php $post_type = get_post_type( $post->ID ); echo $post_type; ?>',				   
				  content_ids: '<?php the_ID(); ?>',
				}); 
			}); 
		</script>
    <?php
}
add_action('page_template', 'AFP_FPViewContent');

// PixelViewPost 
function AFP_FPViewPost() {
    ?>		
		<script> 
		document.addEventListener("DOMContentLoaded", function(event) { 
				fbq('track', 'ViewContent', {
				  content_name: '<?php the_title(); ?>',
				  content_category: '<?php $cat = get_the_category(); echo $cat[0]->cat_name; ?>',
				  content_ids: '<?php the_ID(); ?>',
				  content_type: '<?php $post_type = get_post_type( $post->ID ); echo $post_type; ?>',				   
				}); 
			}); 
		</script>		
    <?php
}
add_action('single_template', 'AFP_FPViewPost');

// PixelProducts 
function AFP_FPProducts() {
    ?>
		<script> 
		document.addEventListener("DOMContentLoaded", function(event) { 
				fbq('track', 'ViewContent', {
				  content_name: '<?php the_title(); ?>',
				  content_category: '<?php $cat = get_the_category(); echo $cat[0]->cat_name; ?>',
				  content_ids: '<?php the_ID(); ?>',
				  content_type: '<?php $post_type = get_post_type( $post->ID ); echo $post_type; ?>',
				  currency: '<?php echo get_woocommerce_currency(); ?>',
				  value: '<?php $product = wc_get_product(); echo $product->get_price(); ?>',				   
				}); 
			}); 
		</script>
    <?php
}
add_action('woocommerce_single_product_summary', 'AFP_FPProducts');

//Adding the Open Graph in the Language Attributes
function AFP_OpengraphDoctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
add_filter('language_attributes', 'AFP_OpengraphDoctype');

//Lets add Open Graph Meta Info 
function AFP_FOpengraph() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
		echo '<meta property="og:url" content="' . get_permalink() . '"/>';
		echo '<meta property="og:description" content="' . get_the_excerpt() . '"/>';
		echo '<meta property="og:type" content="website">';
		echo '<meta property="og:image" content="' . get_the_post_thumbnail_url($post->ID, 'full') . '"/>';
		echo "";
}
add_action( 'wp_head', 'AFP_FOpengraph' );
