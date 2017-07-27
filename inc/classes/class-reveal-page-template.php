<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

new Reveal_Page_Template();

class Reveal_Page_Template {

	public function __construct() {
		add_filter( 'theme_page_templates', array( $this, 'add_page_template_to_dropdown' ) );
		add_filter( 'template_include', array( $this, 'change_page_template' ), 99 );
		// add_action( 'admin_head', array( $this, 'print_in_head' ), 99 );
		// add_action( 'wp_head', array( $this, 'print_in_head' ), 99 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		// wp_register_script( 'reveal-jbase', plugin_dir_url( __FILE__ ) . '/reveal-js/js/reveal.js', array( 'jquery' ), 'version', true );
		// wp_register_script( 'reveal-min', plugins_url( '../reveal-js/lib/js/head.min.js', __FILE__ ), array( 'jquery' ), 'version', true );
		// wp_register_style( 'reveal-base', plugin_dir_url( __FILE__ ) . '../reveal-js/css/reveal.css' );
		wp_register_style( 'reveal-black', REVAL_JS . 'reveal-js/css/theme/black.css' );
		// wp_enqueue_style( 'reveal-base' );
		// wp_enqueue_script( 'reveal-jbase' );
		wp_enqueue_style( 'reveal-black' );
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

	/**
	 * Add page templates.
	 *
	 * @param array $templates The list of page templates
	 *
	 * @return array  $templates  The modified list of page templates
	 */
	public function add_page_template_to_dropdown( $templates ) {
		$templates[ plugin_dir_path( __FILE__ ) . '../templates/reveal-page-template.php' ] = __( 'Reveal Page Template', 'reveal-with-gutenberg' );
		return $templates;
	}

	/**
	 * Change the page template to the selected template on the dropdown
	 * Change the single template to the fixed template in the plugin
	 *
	 * @param $template
	 *
	 * @return mixed
	 */
	public function change_page_template( $template ) {
		if ( is_page( 'reveal-page' ) ) {
			$meta = get_post_meta( get_the_ID() );

			if ( ! empty( $meta['_wp_page_template'][0] ) && $meta['_wp_page_template'][0] != $template ) {
				$template = $meta['_wp_page_template'][0];
			}
		} elseif ( is_single() ) {

			$fileTemplate = plugin_dir_path( __FILE__ ) . 'templates/reveal-page-template.php';
			if ( file_exists( $fileTemplate ) ) {
				$template = $fileTemplate;
			}
		}

		return $template;
	}
}

