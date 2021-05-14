<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Methods for TimberHelper can be found in the /lib plugin sub-directory
 * @package WordPress
 * @subpackage Árbol
 * @version 0.5.0
 * @since Árbol 0.5.0
 */

$context = Timber::context();
$context['posts'] = Timber::get_posts();
$templates = array( 'pages/index.twig' );
if ( is_front_page() ) {
	array_unshift( $templates, 'pages/front-page.twig' );
}
Timber::render( $templates, $context );
