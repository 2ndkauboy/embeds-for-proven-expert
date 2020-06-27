<?php
/**
 * Main plugin file to load other classes
 *
 * @package EFPE
 */

namespace EFPE;

use EFPE\Helpers\ProvenExpertAPI;
use EFPE\Widgets\WidgetsRegistration;

/**
 * Init function of the plugin
 */
function load() {
	// Load Composer autoloader.
	$autoloader = EFPE_PATH . 'vendor/autoload.php';

	if ( is_readable( $autoloader ) ) {
		include $autoloader;
	}

	// Construct all modules to initialize.
	$modules = [
		'proven_expert_api'    => new ProvenExpertAPI(),
		'widgets_registration' => new WidgetsRegistration(),
	];

	// Initialize all modules.
	foreach ( $modules as $module ) {
		if ( is_callable( [ $module, 'init' ] ) ) {
			call_user_func( [ $module, 'init' ] );
		}
	}
}
add_action( 'plugins_loaded', 'EFPE\load' );
