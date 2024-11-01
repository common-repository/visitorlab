<?php

/**
 * @package VisitorLab
 */
/*
* Plugin Name: VisitorLAB
* Plugin URI: https://www.visitorlab.com/
* Description: VisitorLAB is a web analytics tool to visualize how visitor act on it. With a unique feature set, VisitorLAB gives you a way to understand user behavior behind the number. 
* Version: 1.0.2
* Author: VisitorLAB
* Author URI: https://visitorlab.com
* Licence: GPLv3
* License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
* Text Domain: visitorlab
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'plugins_loaded', 'visitorlab_plugin_init' );

function visitorlab_plugin_init() {

	if ( ! class_exists( 'WP_VisitorLab' ) ) :

		class WP_VisitorLab {
			/**
			 * @var Const Plugin Version Number
			 */
			const VERSION = '1.0.2';

			/**
			 * @var Singleton The reference the *Singleton* instance of this class
			 */
			private static $instance;

			/**
			 * Returns the *Singleton* instance of this class.
			 *
			 * @return Singleton The *Singleton* instance.
			 */
			public static function get_instance() {
				if ( null === self::$instance ) {
					self::$instance = new self();
				}
				return self::$instance;
			}

			private function __clone() {}

			private function __wakeup() {}

			/**
			 * Protected constructor
			 */
			private function __construct() {
				add_action( 'admin_init', array( $this, 'install' ) );
				$this->init();
			}

			/**
			 * Init the plugin after plugins_loaded so environment variables are set.
			 *
			 * @since 1.0.0
			 */
			public function init() {
				require_once( dirname( __FILE__ ) . '/includes/class-visitorlab.php' );
				$visitorlab = new VisitorLab();
				$visitorlab->init();
			}

			/**
			 * Updates the plugin version in db
			 *
			 * @since 1.0.0
			 */
			public function update_plugin_version() {
				delete_option( 'visitorlab_version' );
				update_option( 'visitorlab_version', self::VERSION );
			}

			/**
			 * Handles upgrade routines.
			 *
			 * @since 1.0.0
			 */
			public function install() {
				if ( ! is_plugin_active( plugin_basename( __FILE__ ) ) ) {
					return;
				}

				if ( ( self::VERSION !== get_option( 'visitorlab_version' ) ) ) {

					$this->update_plugin_version();
				}
			}

			/**
			 * Adds plugin action links.
			 *
			 * @since 1.0.0
			 */
			public function plugin_action_links( $links ) {
				$plugin_links = array(
					'<a href="admin.php?page=visitorlab-settings">Settings</a>',
					'<a href="https://www.visitorlab.com/">Support</a>',
				);
				return array_merge( $plugin_links, $links );
			}
		}

		WP_VisitorLab::get_instance();
	endif;
}
