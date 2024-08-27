<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Reisetopia_Hotel_Core' ) ) :

	/**
	 * Main Reisetopia_Hotel_Core Class.
	 *
	 * @package		REISETOPIA
	 * @subpackage	Classes/Reisetopia_Hotel_Core
	 * @since		1.0.0
	 * @author		Nouman shahid
	 */
	final class Reisetopia_Hotel_Core {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Reisetopia_Hotel_Core
		 */
		private static $instance;

		/**
		 * REISETOPIA helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Reisetopia_Hotel_Core_Helpers
		 */
		public $helpers;

		/**
		 * REISETOPIA settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Reisetopia_Hotel_Core_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'reisetopia-hotel-core' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'reisetopia-hotel-core' ), '1.0.0' );
		}

		/**
		 * Main Reisetopia_Hotel_Core Instance.
		 *
		 * Insures that only one instance of Reisetopia_Hotel_Core exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Reisetopia_Hotel_Core	The one true Reisetopia_Hotel_Core
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Reisetopia_Hotel_Core ) ) {
				self::$instance					= new Reisetopia_Hotel_Core;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Reisetopia_Hotel_Core_Helpers();
				self::$instance->settings		= new Reisetopia_Hotel_Core_Settings();

				//Fire the plugin logic
				new Reisetopia_Hotel_Core_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'REISETOPIA/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once REISETOPIA_PLUGIN_DIR . 'core/includes/classes/class-reisetopia-hotel-core-helpers.php';
			require_once REISETOPIA_PLUGIN_DIR . 'core/includes/classes/class-reisetopia-hotel-core-settings.php';

			require_once REISETOPIA_PLUGIN_DIR . 'core/includes/classes/class-reisetopia-hotel-core-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'reisetopia-hotel-core', FALSE, dirname( plugin_basename( REISETOPIA_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.