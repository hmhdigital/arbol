<?php
/**
 * The Template for displaying search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Methods for TimberHelper can be found in the /lib plugin sub-directory
 * @package WordPress
 * @subpackage Árbol
 * @version 0.9.0
 * @since Árbol 0.5.0
 */

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );

$context = Timber::context();
$context['title'] = 'Search results for ' . get_search_query();
$context['posts'] = Timber::get_posts();

Timber::render( $templates, $context );
