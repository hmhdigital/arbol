<?php
/**
 * Third party plugins that hijack the theme will call wp_head() to get the header template.
 * We use this to start our output buffer and render into the view/page-plugin.twig template in footer.php
 *
 * If you're not using a plugin that requries this behavior (ones that do include Events Calendar Pro and
 * WooCommerce) you can delete this file and footer.php
 *
 * @link https://codex.wordpress.org/Theme_Development#Basic_Templates
 *
 * @package  WordPress
 * @subpackage Árbol
 * @since    0.9.0
 */

$GLOBALS['timberContext'] = Timber::context();
ob_start();
