<?php
/**
 * WordPress defaults and theme features
 *
 * @package Árbol
 */

class bootstrapSite extends Timber\Site {
    public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_action( 'init', array( $this, 'register_menus' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'timber_twig', array( $this, 'add_to_twig' ) );

        parent::__construct();
    }

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	/** This is where you can register nav menus */
	public function register_menus() {
		register_nav_menus( array(
			'header-menu' => esc_html__( 'Header', 'arbol' ),
			'footer-menu' => esc_html__( 'Footer', 'arbol' )
		) );
	}

	/** This is where you can register custom post types. */
	public function register_post_types() {

	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}


	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['header']  = new Timber\Menu('header-menu');
		$context['footer']  = new Timber\Menu('footer-menu');
		$context['site']  = $this;
		return $context;
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	// public function myfoo( $text ) {
	// 	$text .= ' bar!';
	// 	return $text;
	// }

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	// public function add_to_twig( $twig ) {
	// 	$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
	// 	$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
	// 	return $twig;
	// }

}

new bootstrapSite();
