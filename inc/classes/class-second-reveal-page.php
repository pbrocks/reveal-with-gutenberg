<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

new Second_Reveal_Page();

class Second_Reveal_Page {

	public function __construct() {
		// add_action( 'admin_head', array( $this, 'print_in_head' ), 99 );
		// add_action( 'wp_head', array( $this, 'print_in_head' ), 99 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		// wp_register_script( 'reveal-jbase', plugin_dir_url( __FILE__ ) . '/reveal-js/js/reveal.js', array( 'jquery' ), 'version', true );
		// wp_register_script( 'reveal-min', plugins_url( '../reveal-js/lib/js/head.min.js', __FILE__ ), array( 'jquery' ), 'version', true );
		wp_register_style( 'reveal-base', plugin_dir_url( __FILE__ ) . '../reveal-js/css/reveal.css' );
		wp_register_style( 'reveal-solarized', REVAL_JS . 'reveal-js/css/theme/solarized.css' );
		// wp_enqueue_style( 'reveal-base' );
		// wp_enqueue_script( 'reveal-jbase' );
		wp_enqueue_style( 'reveal-base' );
		wp_enqueue_style( 'reveal-solarized' );
	}

	/**
	 * Add page templates.
	 *
	 * @param array $templates The list of page templates
	 *
	 * @return array  $templates  The modified list of page templates
	 */
	public function print_in_head() {
		$templates['plugin'] = plugin_dir_path( __FILE__ ) . '../templates/reveal-page-template.php';
		$templates['script'] = plugins_url( '/../js/drag-drop.js', __FILE__ );

		$templates['file'] = __FILE__;
		 // ] = __( 'Reveal Page Template', 'reveal-with-gutenberg' );
		echo '<pre><h3 style="text-align: center; color: salmon;">';
		// var_dump( $var );
		print_r( $templates );
		echo '</h3></pre>';
		return $templates;
	}

}

