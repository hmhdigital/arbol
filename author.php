<?php
/**
 * The template for displaying Author Archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Methods for TimberHelper can be found in the /lib plugin sub-directory
 * @package WordPress
 * @subpackage Bēsu
 * @version 0.9.0
 * @since Bēsu 0.5.0
 */

global $wp_query;

$context = Timber::context();
$context['posts'] = new Timber\PostQuery();
if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = new Timber\User( $wp_query->query_vars['author'] );
	$context['author'] = $author;
	$context['title'] = 'Author Archives: ' . $author->name();
}
Timber::render( array( 'author.twig', 'archive.twig' ), $context );
