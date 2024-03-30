<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Methods for TimberHelper can be found in the /lib plugin sub-directory
 * @package WordPress
 * @subpackage Árbol
 * @version 0.9.0
 * @since Árbol 0.5.0
 */

$context = Timber::context();
Timber::render( '404.twig', $context );
