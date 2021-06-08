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
 * @subpackage Bēsu
 * @version 0.5.0
 * @since Bēsu 0.5.0
 */

$context = Timber::context();
$context['posts'] = Timber::get_posts();
$templates = array( 'index.twig' );
if ( is_front_page() ) {
	array_unshift( $templates, 'landing.twig' );
}
Timber::render( $templates, $context );
