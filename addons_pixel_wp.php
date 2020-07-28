<?php
/**
 * Plugin Name: Addons for Pixel on wordpress Plugin
 * Description: Adicionar variables para Facebook Pixel en wordpress
 * Plugin URI: https://sjsocialmedia.com/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Author: SJ Social Media
 * Version: 1.1
 * Author URI: https://sjsocialmedia.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 *
 * SJ Social Media Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * SJ Social Media Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
*/

//Load Facebook SDK for JavaScript


// PixelViewContent 
function PixelViewContent() {
    ?>
		
		<!-- Add Pixel Events to the button's click handler -->
		<script> 
		document.addEventListener("DOMContentLoaded", function(event) { 
				fbq('track', 'ViewContent', {
				  content_name: '<?php the_title(); ?>',
				  content_type: '<?php $post_type = get_post_type( $post->ID ); echo $post_type; ?>',				   
				  content_ids: '<?php the_ID(); ?>',
				}); 
			}); 
		</script>
		<!-- End Facebook Pixel Code -->
		

    <?php
}
add_action('page_template', 'PixelViewContent');


// PixelViewPost 
function PixelViewPost() {
    ?>
		
		<!-- Add Pixel Events to the button's click handler -->
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
		<!-- End Facebook Pixel Code -->
		

    <?php
}
add_action('single_template', 'PixelViewPost');


// PixelProducts 
function PixelProducts() {
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
add_action('woocommerce_single_product_summary', 'PixelProducts');


//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
add_filter('language_attributes', 'add_opengraph_doctype');
 

//Lets add Open Graph Meta Info 
function add_opengraph() {
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
add_action( 'wp_head', 'add_opengraph', 5 );
