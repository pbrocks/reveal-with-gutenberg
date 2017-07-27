<?php

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

new Reveal_Customizer_Section();

class Reveal_Customizer_Section {
	public function __construct() {
		add_action( 'customize_register', array( $this, 'wp_customizer_manager' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_manager' ) );
		add_shortcode( 'get-theme-mods', array( $this, 'wp_customizer_mods' ) );
		add_action( 'customize_register', array( $this, 'theme_slug_customizer' ) );

	}
	/**
	 * [wp_customizer_manager description]
	 *
	 * @param [type] $reveal_customizer [description]
	 * @return [type]             [description]
	 */
	public function wp_enqueue_manager() {
		// wp_enqueue_script( 'handle_name', 'source', array( 'jquery' ), 'version', false );
		// wp_enqueue_script( 'something', plugin_dir_url( __FILE__ ) . '../js/something.js', array( 'jquery' ) );
	}

	/**
	 * [wp_customizer_manager description]
	 *
	 * @param [type] $reveal_customizer [description]
	 * @return [type]             [description]
	 */
	public function wp_customizer_manager( $reveal_customizer ) {
		$this->reveal_section( $reveal_customizer );
	}

	/**
	 * [wp_customizer_mods description]
	 *
	 * @param [type] $reveal_customizer [description]
	 * @return [type]             [description]
	 */
	public function wp_customizer_mods( $reveal_customizer ) {
		$customizer_mods = '<div id="ads_box" style="height:4rem;background-color:salmon;text-align:center;padding-top:1rem;">'
		. get_theme_mod( 'show_reveal' ) . ' = ';
		$customizer_mods .= '<b>show_reveal is a ' . gettype(get_theme_mod( 'show_reveal' ) ) . ' <br></div>';
		$customizer_mods .= $this->get_theme_mods();
		return $customizer_mods;
	}


	/**
	 * [get_theme_mods description]
	 *
	 * @param [type] $reveal_customizer [description]
	 * @return [type]             [description]
	 */
	public function get_theme_mods() {
		$mods = get_theme_mods();
		echo '<pre>';
		// var_dump( $var );
		print_r( $mods );
		echo '</pre>';
	}


	/**
	 * The reveal_section function adds a new section
	 * to the Customizer to display the settings and
	 * controls that we build.
	 *
	 * @param  [type] $reveal_customizer [description]
	 * @return [type]             [description]
	 */
	private function reveal_section( $reveal_customizer ) {
		$reveal_customizer->add_panel( 'reveal_panel', array(
			'title'       => 'Reveal',
			'description' => 'This is a description of this Reveal panel',
			'priority'    => 10,
			// developer.wordpress.org/reference/functions/comment_form/
			)
		);
		$reveal_customizer->add_section(
			'reveal_controls_section', array(
			'title'          => 'Reveal Controls',
			'priority'       => 16,
			'panel'          => 'reveal_panel',
			'description' => 'This is a description of Reveal panel in <h4>' . __FILE__ . '</h4>',
			)
		);
		$reveal_customizer->add_setting( 'show_reveal', array(
			'default'        => false,
			'sanitize_callback'        => array( $this, 'sanitize_checkbox_boolean' ),
			'transport' => 'refresh', // or postMessage
			// 'transport' => 'postMessage', // or refresh
		) );

		/**
		 * Adding a Checkbox Toggle
		 */
		if ( ! class_exists( 'Customizer_Toggle_Control' ) ) {
			require_once( CUSTOMIZER_STARTER_PATH . 'inc/controls/checkbox/toggle-control.php' );
		}

		$reveal_customizer->add_control(
			new Customizer_Toggle_Control( $reveal_customizer,
				'show_reveal', array(
					'label'   => 'Show Reveal',
					'description' => 'Show Reveal => slide to turn on setting. Toggle is equivalent to a checkbox.',
					'section' => 'reveal_controls_section',
					'type'    => 'ios',
				// 'type'    => 'checkbox',
					'priority' => 1,
				)
			) );
	}


	//checkbox sanitization function
	public function sanitize_checkbox_boolean( $input ) {
		//returns true if checkbox is checked
		// Boolean check 
		return ( ( isset( $input ) && true == $input ) ? true : false );
	}

	/**
	 * Sanitize a checkbox to only allow 0 or 1
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  $input
	 * @return int
	 */
	public function sanitize_checkbox( $input ) {
		return ( 1 === absint( $input ) ) ? 1 : 0;
	}

		/**
		 * Adding a category dropdown control.
		 */
		// if ( ! class_exists( 'Category_Dropdown_Custom_Control' ) ) {
		// include_once dirname( __FILE__ ) . '/controls/select/category-dropdown-custom-control.php';
		// }
		// $reveal_customizer->add_setting(
		// 'reveal_category_dropdown_setting', array(
		// 'default'        => '',
		// )
		// );
		// $reveal_customizer->add_control(
		// new Category_Dropdown_Custom_Control(
		// $reveal_customizer, 'reveal_category_dropdown_setting', array(
		// 'label'      => 'Category Dropdown Setting',
		// 'section'    => 'reveal_controls_section',
		// 'settings'   => 'reveal_category_dropdown_setting',
		// 'priority'   => 3,
		// )
		// )
		// );
		/**
		 * Adding a post dropdown control
		 */
		// if ( ! class_exists( 'Pages_Dropdown_Custom_Control' ) ) {
		// include_once dirname( __FILE__ ) . '/controls/select/pages-dropdown-custom-control.php';
		// }
		// $reveal_customizer->add_setting(
		// 'reveal_pages_dropdown_setting', array(
		// 'default'        => '',
		// )
		// );
		// $reveal_customizer->add_control(
		// new Pages_Dropdown_Custom_Control(
		// $reveal_customizer, 'reveal_pages_dropdown_setting', array(
		// 'label'   => 'Pages Dropdown Setting',
		// 'section' => 'reveal_controls_section',
		// 'settings'   => 'reveal_pages_dropdown_setting',
		// 'priority' => 6,
		// )
		// )
		// );
		/**
		 * Adding a post type dropdown control
		 */
		// if ( ! class_exists( 'Post_Type_Dropdown_Custom_Control' ) ) {
		// include_once dirname( __FILE__ ) . '/controls/select/post-type-dropdown-custom-control.php';
		// }
		// $reveal_customizer->add_setting(
		// 'reveal_post_type_dropdown_setting', array(
		// 'default'        => '',
		// )
		// );
		// $reveal_customizer->add_control(
		// new Post_Type_Dropdown_Custom_Control(
		// $reveal_customizer, 'reveal_post_type_dropdown_setting', array(
		// 'label'    => 'Post Type Dropdown Setting',
		// 'section'  => 'reveal_controls_section',
		// 'settings' => 'reveal_post_type_dropdown_setting',
		// 'priority' => 6,
		// )
		// )
		// );
		/**
		 * Adding a user dropdown control
		 */
		// if ( ! class_exists( 'User_Dropdown_Custom_Control' ) ) {
		// include_once dirname( __FILE__ ) . '/controls/select/user-dropdown-custom-control.php';
		// }
		// $reveal_customizer->add_setting(
		// 'reveal_user_dropdown_setting', array(
		// 'default'        => '',
		// )
		// );
		// $reveal_customizer->add_control(
		// new User_Dropdown_Custom_Control(
		// $reveal_customizer, 'reveal_user_dropdown_setting', array(
		// 'label'   => 'User Dropdown Setting',
		// 'section' => 'reveal_controls_section',
		// 'settings'   => 'reveal_user_dropdown_setting',
		// 'priority' => 9,
		// )
		// )
		// );
	// }
}
