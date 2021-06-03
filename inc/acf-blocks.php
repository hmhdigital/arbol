<?php
/**
 * ACF Customizations
 *
 * @package Besu
 */

/**
 * Register Blocks
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 */

 function Besu_register_blocks() {

	if( ! function_exists( 'acf_register_block_type' ) )
		return;

		acf_register_block( array(
			'name'            => 'example_block',
			'title'           => __( 'Example Block', 'your-text-domain' ),
			'description'     => __( 'A custom example block.', 'your-text-domain' ),
			'render_callback' => 'my_acf_block_render_callback',
			'category'        => 'formatting',
			'icon'            => 'admin-comments',
			'keywords'        => array( 'example' ),
		) );
 }
 add_action( 'acf/init', 'besu_register_blocks' );

 /**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function my_acf_block_render_callback( $block, $content = '', $is_preview = false ) {
    $context = Timber::context();

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['fields'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( 'blocks/example-block.twig', $context );
}
