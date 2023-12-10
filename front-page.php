<?php
/**
 * The Front page template file. When this is present the index
 * and home twig templates are ignored, and modular.twig is displayed.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * Methods for TimberHelper can be found in the /lib plugin sub-directory
 * @package WordPress
 * @subpackage Bēsu
 * @version 0.9.0
 * @since Bēsu 0.5.0
 */

$context = Timber::context();
$context['posts'] = Timber::get_posts();

Timber::render( 'front-page.twig', $context );
