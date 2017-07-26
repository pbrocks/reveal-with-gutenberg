<?php
/**
 * Plugin Name: Reveal with Gutenberg
 * Plugin URI: https://AhmadAwais.com/
 * Description: An ever growing Gutenberg boilerplate to help developers
 */

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

// define( 'REVAL_JS', plugins_url( basename( __FILE__ ) ) );
define( 'REVAL_JS', plugin_dir_url( __FILE__ ) );

require 'inc/classes/class-reveal-page-template.php';
