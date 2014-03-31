<?php
/*
Plugin Name: FooBox WP e-Commerce Excluder
Description: Exclude FooBox scripts and CSS from WP e-Commerce product pages
Version: 0.0.1
Author: FooPlugins
Author URI: http://fooplugins.com
License: GPL2
*/

if ( !class_exists( 'Foobox_WPEcommerce_Excluder' ) ) {

	class Foobox_WPEcommerce_Excluder {

		function __construct() {
			add_action( 'init', array($this, 'init') );
		}

		function init() {
			add_filter( 'foobox_enqueue_scripts', array($this, 'enqueue_scripts_or_styles'), 999 );
			add_filter( 'foobox_enqueue_styles', array($this, 'enqueue_scripts_or_styles'), 999 );
		}

		function enqueue_scripts_or_styles($default) {
			$body_classes = get_body_class();
			if (is_array($body_classes) && in_array('single-wpsc-product', $body_classes)) {
				return false;
			}
			return $default;
		}
	}
}

$GLOBALS['Foobox_WPEcommerce_Excluder'] = new Foobox_WPEcommerce_Excluder();