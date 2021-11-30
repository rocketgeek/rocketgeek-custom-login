<?php
/**
 * Plugin Name: RocketGeek Custom Login (Dark)
 * Plugin URI: https://github.com/rocketgeek/rocketgeek-custom-login-dark
 * Description: Custom login screen.
 * Version: 1.0.0
 * Author: Chad Butler
 * Author URI: https://butlerblog.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: rocketgeek-custom-login-dark
 *
 * Borrowed heavily from Adam Clark's project at
 * https://github.com/avclark/10up-bcl
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class RocketGeek_Custom_Login_Dark {
	public function run() {
		add_action( 'login_head',        array( $this, 'enqueue_styles'         ) );
		add_filter( 'login_headerurl',   array( $this, 'get_login_logo_url'     ) );
		add_filter( 'login_message',     array( $this, 'message'                ) );
		add_filter( 'login_footer',      array( $this, 'default_check_remember' ) );
	}
	
	/**
	 * Loads the plugin stylesheet.
	 */
	function enqueue_styles() {
		wp_enqueue_style( 'rktgk-cld-styles', plugins_url( 'assets/css/rktgk-cld.css', __FILE__ ) );
	}


	/**
	 * Gets the login page logo.
	 */
	function get_login_logo_url() {
		return get_bloginfo( 'url' );
	}

	/**
	 * Handle messaging for different page states.
	 */
	function message() {

		// Checks array keys for message display.
		$action    = array_key_exists( 'action', $_REQUEST    ) ? $_REQUEST['action']    : null;
		$loggedout = array_key_exists( 'loggedout', $_REQUEST ) ? $_REQUEST['loggedout'] : null;

		// Messaging.
		if ( $action == 'lostpassword' ) {
			// Lost password message.
			return '<p class="message">Please enter your username or email address. You will receive a link to create a new password via email.</p>';
		} elseif ( $loggedout == true ) {
			// Logged out message.
			return '';
		} else {
			// General login message.
			return '<p class="welcome-message">Please Login.</p>';
		}
	}

	/**
	 * Insert js to make "remember me" checked by default.
	 */
	function default_check_remember() {
		echo 
		"<script>
			var rememberMe = document.getElementById('rememberme');
			if (typeof(rememberMe) != 'undefined' && rememberMe != null) {
				rememberMe.checked = true;
			}
		</script>";
	}
}

$rktgk_cld = new RocketGeek_Custom_Login_Dark;
$rktgk_cld->run();
