<?php
/**
 * Embeds for ProvenExpert
 *
 * @package embeds-for-proven-expert
 * @author  Bernhard Kau
 * @license GPLv3
 *
 * @wordpress-plugin
 * Plugin Name: Embeds for ProvenExpert
 * Plugin URI: https://github.com/2ndkauboy/embeds-for-proven-expert
 * Description: Provide multiple Embeds for ProvenExpert rating seals, logos and rating summaries.
 * Version: 1.0.2
 * Author: Bernhard Kau
 * Author URI: https://kau-boys.de
 * Text Domain: embeds-for-proven-expert
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 */

define( 'EFPE_VERSION', '1.0.2' );
define( 'EFPE_FILE', __FILE__ );
define( 'EFPE_PATH', plugin_dir_path( EFPE_FILE ) );

// The pre_init functions check the compatibility of the plugin and calls the init function, if check were successful.
efpe_pre_init();

/**
 * Pre init function to check the plugin's compatibility.
 */
function efpe_pre_init() {
	// Check, if the min. required PHP version is available and if not, show an admin notice.
	if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
		add_action( 'admin_notices', 'efpe_min_php_version_error' );

		// Stop the further processing of the plugin.
		return;
	}

	if ( file_exists( EFPE_PATH . 'composer.json' ) && ! file_exists( EFPE_PATH . 'vendor/autoload.php' ) ) {
		add_action( 'admin_notices', 'efpe_autoloader_missing' );

		// Stop the further processing of the plugin.
		return;
	}

	// If all checks were successful, load the plugin.
	require_once EFPE_PATH . 'src/load.php';
}

/**
 * Show an admin notice error message, if the PHP version is too low
 */
function efpe_min_php_version_error() {
	echo '<div class="error"><p>';
	esc_html_e( 'Embeds for ProvenExpert requires PHP version 5.6 or higher to function properly. Please upgrade PHP or deactivate Embeds for ProvenExpert.', 'embeds-for-proven-expert' );
	echo '</p></div>';
}

/**
 * Show an admin notice error message, if the PHP version is too low
 */
function efpe_autoloader_missing() {
	echo '<div class="error"><p>';
	esc_html_e( 'Embeds for ProvenExpert is missing the Composer autoloader file. Please run `composer install` in the root folder of the plugin or use a release version including the `vendor` folder.', 'embeds-for-proven-expert' );
	echo '</p></div>';
}
