<?php
/**
 * The Template for displaying all single posts
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
$timber_post = Timber::get_post();
$context['post'] = $timber_post;

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig' ), $context );
}
