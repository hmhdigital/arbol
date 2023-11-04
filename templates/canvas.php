<?php
/**
 * Template Name: Full Screen Canvas
 * Description: A full Screen layout with no header or footer.
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
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
Timber::render( 'canvas.twig', $context );
