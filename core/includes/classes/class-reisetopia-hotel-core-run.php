<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Reisetopia_Hotel_Core_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		REISETOPIA
 * @subpackage	Classes/Reisetopia_Hotel_Core_Run
 * @author		Nouman shahid
 * @since		1.0.0
 */
class Reisetopia_Hotel_Core_Run{

	/**
	 * Our Reisetopia_Hotel_Core_Run constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		$this->add_hooks();
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOKS
	 * ###
	 * ######################
	 */

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	1.0.0
	 * @return	void
	 */
	private function add_hooks(){
	
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts_and_styles' ), 20 );
	
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOK CALLBACKS
	 * ###
	 * ######################
	 */

	/**
	 * Enqueue the backend related scripts and styles for this plugin.
	 * All of the added scripts andstyles will be available on every page within the backend.
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function enqueue_backend_scripts_and_styles() {
		wp_enqueue_style( 'reisetopia-backend-styles', REISETOPIA_PLUGIN_URL . 'core/includes/assets/css/backend-styles.css', array(), REISETOPIA_VERSION, 'all' );
		wp_enqueue_script( 'reisetopia-backend-scripts', REISETOPIA_PLUGIN_URL . 'core/includes/assets/js/backend-scripts.js', array(), REISETOPIA_VERSION, false );
		wp_localize_script( 'reisetopia-backend-scripts', 'reisetopia', array(
			'plugin_name'   	=> __( REISETOPIA_NAME, 'reisetopia-hotel-core' ),
		));
	}

}
