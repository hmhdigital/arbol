<?php
/**
 * Bēsu functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Bēsu
 * @version 0.9.0
 * @since Bēsu 0.5.0
 */

 /**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/views/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'views/', 'views/layouts', 'views/pages', 'views/partials', 'views/blocks', 'views/modules' );

 /**
 * Theme defaults and WordPress features.
 */
 require_once get_template_directory() . '/inc/bootstrap.php';

 /**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
// Timber::$autoescape = false;


 /**
 * Enqueue scripts and styles.
 */
function besu_assets() {
	// Loads required CSS header only.
	wp_enqueue_style( 'besu-style', get_stylesheet_uri() );

	// Loads bundled theme CSS.
	wp_enqueue_style( 'besu-css-styles', get_template_directory_uri() . '/build/index.css',
	array(),
	(include get_template_directory() . '/build/index.asset.php')['version']
	);

	// Loads bundled theme JS.
	wp_enqueue_script('besu-js-scripts', get_template_directory_uri() . '/build/index.js',
	(include get_template_directory() . '/build/index.asset.php')['dependencies'],
    (include get_template_directory() . '/build/index.asset.php')['version'],
    true
	);

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'besu_assets' );

/**
 * Disable Editor on certain pages.
 */
require get_template_directory() . '/inc/disable-editor.php';

/**
 * ACF Add-ons.
 */
require get_template_directory() . '/inc/acf-blocks.php';
