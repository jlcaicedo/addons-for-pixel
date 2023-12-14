=== Addons for Pixel ===
Contributors: jlcaicedo
Donate link: https://www.paypal.com/paypalme/JoseLuisCaicedo
Tags: redes sociales, facebook pixel
Requires at least: 5.1
Tested up to: 5.5
Requires PHP: 7.2
Stable tag: 1.7.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds personalized commands to Facebook pixel about your pages.

== Description ==

This plugin has been developed by [SJ social Media](https://sjsocialmedia.com/) for use in wordpress.

We have integrated some Facebook Pixel commands to make it visible and identify shopping carts and IDs of internal pages and posts.

Our next step is to add a variation for the automotive market with wordpress

The Facebook pixel
A piece of code for your website that lets you measure, optimize and build audiences for your ad campaigns.

Measure conversions with the Facebook Pixel
Understand how your cross-device ads help influence conversions.

Optimize delivery to people likely to take action
Ensure your ads are shown to the people most likely to take action.

Create custom audiences from website visitors
Dynamic ads help you automatically show website visitors the products they viewed on your website—or related ones.

Learn about your website traffic
Get rich insights about how people use your website from your Facebook pixel dashboard.

== Support or Contact ==

Having trouble with Pages? Check out our [documentation](https://github.com/jlcaicedo/addons-for-pixel) or [contact support](mailto:soporte@sjsocialmedia.com) and we’ll help you sort it out.

== Installation ==

1. Upload `Addons-for-Pixel` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= What is sjsocialmedia.com? =

Is a Agency to Digital Marketing and specialist to WordPress

== Screenshots ==

1. Here we see the parameters that have been sent and we can see that we send the correct content type parameters and name to facebook.
2. Here we see the parameters that have been sent and we can see that we send the correct content type parameters, the name and the internal ID of wordpress to Facebook for better monitoring.

== Changelog ==

= 1.7.3 =
- Unified Facebook Pixel and Open Graph functionalities for comprehensive WordPress integration.
- Ensured active status verification for the Official Facebook Pixel plugin.
- Generalized Facebook Pixel script insertion across all posts and pages.
- Maintained Open Graph meta tags for enhanced social media content presentation.
- Updated function and variable names for better clarity and coherence with the plugin's purpose.
- Optimized hook usage for improved efficiency.
- Enhanced WooCommerce compatibility with conditional function execution.
- Ensured compatibility with the latest version of WordPress.

= 1.7.2 =
* tested plugin with WordPress 7.2

Verificación del Plugin de Facebook Pixel: La función AFP_check_facebook_pixel_active utiliza is_plugin_active para verificar si el plugin de Facebook Pixel está activo. Necesitarás reemplazar 'facebook-pixel-plugin/facebook-pixel-plugin.php' con la ruta correcta del archivo principal del plugin de Facebook Pixel.

Mostrar un Aviso en el Panel de Administración: Si el plugin de Facebook Pixel no está activo, se añade un aviso en el panel de administración mediante admin_notices.

Internacionalización: La función _e se utiliza para permitir la traducción del texto del aviso. Asegúrate de que el text domain 'addons-for-pixel' coincida con el que utilizas en tu plugin.

= 1.7.0 =
* tested plugin with WordPress 7.2

Facebook Pixel Script Insertion Generalization: A generic function AFP_insert_fb_pixel_script is created to insert the Facebook Pixel script. This reduces code duplication.

Page Type Check: The AFP_FPViewContent, AFP_FPViewPost and AFP_FPProducts functions now check the page type (page, post, WooCommerce product) before running the script.

Using wp_footer for Scripts: Change the hook to wp_footer to ensure that the script is loaded at the end of the body of the page.

WooCommerce Compatibility: It checks if WooCommerce is active before running the script on products.

Data Escaping: WordPress escaping functions are used to ensure data security.

Open Graph Meta Tags: Open Graph meta tags are added to the head to improve integration with Facebook.

= 1.1 =
* tested plugin with WordPress 5.5

= 1.0 =
* Initial release on WordPress.org
