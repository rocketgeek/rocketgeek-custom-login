<?php
/**
 * Plugin Name: RocketGeek Custom Login
 * Plugin URI: https://github.com/rocketgeek/rocketgeek-custom-login
 * Description: A customization of the default WP login screen.
 * Version: 1.1.0
 * Author: Chad Butler
 * Author URI: https://butlerblog.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: rocketgeek-custom-login
 *
 * Borrowed heavily from Adam Clark's project at
 * https://github.com/avclark/10up-bcl
 * 
 * @since 1.0.0 Initial version.
 * @since 1.1.0 Changed class name, incorporated both light and dark themes.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class RocketGeek_Custom_Login {

	// Define the theme (dark|light)
	static public $theme = 'dark';

	static public function run() {
		add_action( 'init',              array( 'RocketGeek_Custom_Login', 'load_textdomain'        ) );
		add_action( 'login_head',        array( 'RocketGeek_Custom_Login', 'enqueue_styles'         ) );
		add_filter( 'login_headerurl',   array( 'RocketGeek_Custom_Login', 'get_login_logo_url'     ) );
		add_filter( 'login_message',     array( 'RocketGeek_Custom_Login', 'message'                ) );
		add_filter( 'login_footer',      array( 'RocketGeek_Custom_Login', 'default_check_remember' ) );
	}
	
	/**
	 * Load the translation (if needed).
	 */
	static public function load_textdomain() {
		load_plugin_textdomain( 'rocketgeek-custom-login', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	
	/**
	 * Loads the plugin stylesheet.
	 */
	static public function enqueue_styles() {
		// Load the non-minified CSS file if script debug is on.
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';
		
		wp_enqueue_style( 'rktgk-custom-login-style', plugins_url( 'assets/css/rktgk-custom-login-' . self::$theme . $suffix . '.css', __FILE__ ) );
		
		/**
		 * If you want to run simple CSS tests without turning on script debug, comment out the 
		 * line above and uncomment this one. It will just load the regular css file. Once you're done
		 * with testing, I recommend you minify the css and return to loading the minified version.
		 */
		// wp_enqueue_style( 'rktgk-custom-login-style', plugins_url( 'assets/css/rktgk-custom-login-' . self::theme . '.css', __FILE__ ) );
	}


	/**
	 * Gets the login page logo.
	 */
	static public function get_login_logo_url() {
		return get_bloginfo( 'url' );
	}

	/**
	 * Handle messaging for different page states.
	 */
	static public function message() {

		// Checks array keys for message display.
		$action    = array_key_exists( 'action',    $_REQUEST ) ? $_REQUEST['action']    : null;
		$loggedout = array_key_exists( 'loggedout', $_REQUEST ) ? $_REQUEST['loggedout'] : null;

		// Messaging.
		if ( $action == 'lostpassword' ) {
			// Lost password message.
			return '<p class="message">' . __( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'rocketgeek-custom-login' ) . '</p>';
		} elseif ( $loggedout == true ) {
			// Logged out message.
			return '';
		} else {
			// General login message.
			return '<p class="welcome-message">' . __( 'Please Login.', 'rocketgeek-custom-login' ) . '</p>';
		}
	}

	/**
	 * JS to make "remember me" checked by default.
	 */
	static public function default_check_remember() {
		echo 
		"<script>
			var rememberMe = document.getElementById('rememberme');
			if (typeof(rememberMe) != 'undefined' && rememberMe != null) {
				rememberMe.checked = true;
			}
		</script>";
	}
}

RocketGeek_Custom_Login::run();
