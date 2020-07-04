<?php
/**
 * Helper class to access the ProvenExpert API
 *
 * @see      WooCommerce/Admin/WC_Helper_API
 *
 * @package  EFPE\Helpers
 */

namespace EFPE\Helpers;

use WP_Error;

/**
 * Class ProvenExpertAPI
 */
class ProvenExpertAPI {
	/**
	 * Base path for API routes.
	 *
	 * @var string
	 */
	public static $api_base;

	/**
	 * The authorization ID.
	 *
	 * @var string
	 */
	public static $api_id = '';

	/**
	 * The authorization key.
	 *
	 * @var string
	 */
	public static $api_key = '';

	/**
	 * Initialize the helper
	 */
	public function init() {
		add_action( 'init', [ $this, 'load' ] );
	}

	/**
	 * Load
	 *
	 * Allow devs to point the API base to a local API development or staging server.
	 * The URL can be changed on init before priority 10.
	 */
	public static function load() {
		self::$api_base = apply_filters( 'efpe_helper_api_base', 'https://www.provenexpert.com/api/v1' );
		self::$api_id   = get_option( 'efpe_api_id' );
		self::$api_key  = get_option( 'efpe_api_key' );
	}

	/**
	 * Perform an HTTP request to the Helper API.
	 *
	 * @param string $endpoint The endpoint to request.
	 * @param array  $args     Additional data for the request. Set authenticated to a truthy value to enable auth.
	 *
	 * @return array|WP_Error The response from wp_safe_remote_request()
	 */
	public static function request( $endpoint, $args = [] ) {
		$url = self::url( $endpoint );

		if ( empty( self::$api_id ) || empty( self::$api_key ) ) {
			return new WP_Error( 'efpe_authentication', __( 'You need to set up the API credentials in the settings', 'embeds-for-proven-expert' ) );
		}

		$args['headers']['Authorization'] = 'Basic ' . base64_encode( self::$api_id . ':' . self::$api_key ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode

		/**
		 * Allow developers to filter the request args passed to wp_safe_remote_request().
		 * Useful to remove sslverify when working on a local api dev environment.
		 */
		$args = apply_filters( 'efpe_helper_api_request_args', $args, $endpoint );

		return wp_safe_remote_request( $url, $args );
	}

	/**
	 * Wrapper for self::request().
	 *
	 * @param string $endpoint The helper API endpoint to request.
	 * @param array  $args     Arguments passed to wp_remote_request().
	 *
	 * @return array The response object from wp_safe_remote_request().
	 */
	public static function post( $endpoint, $args = [] ) {
		$args['method'] = 'POST';

		return self::request( $endpoint, $args );
	}

	/**
	 * Using the API base, form a request URL from a given endpoint.
	 *
	 * @param string $endpoint The endpoint to request.
	 *
	 * @return string The absolute endpoint URL.
	 */
	public static function url( $endpoint ) {
		$endpoint = ltrim( $endpoint, '/' );
		$endpoint = sprintf( '%s/%s', self::$api_base, $endpoint );
		$endpoint = esc_url_raw( $endpoint );

		return $endpoint;
	}

	/**
	 * Execute the request to the ProvenExpert API and get the result body
	 *
	 * @param string $endpoint The endpoint to request.
	 * @param array  $args     Additional data for the request. Set authenticated to a truthy value to enable auth.
	 *
	 * @return array|WP_Error The response from wp_safe_remote_request()
	 */
	public static function get_response_body( $endpoint, $args ) {
		ksort( $args['body'] );
		$hash = md5( wp_json_encode( $args['body'] ) );

		$cache_key     = '_efpe_api_request_' . $hash;
		$response_body = get_transient( $cache_key );

		if ( false === $response_body ) {
			$request       = self::post( $endpoint, $args );
			$response_code = wp_remote_retrieve_response_code( $request );

			if ( is_wp_error( $request ) ) {
				return $request;
			}

			if ( 200 !== $response_code ) {
				$response_message = wp_remote_retrieve_response_message( $request );

				/* translators: %d: HTTP response code, %s: error message */
				$error_message = sprintf( __( 'Error receiving the data from the ProvenExpert API (%1$d): %2$s', 'embeds-for-proven-expert' ), $response_code, $response_message );

				return new WP_Error( 'efpe_request', $error_message );
			} else {
				$response_body = json_decode( wp_remote_retrieve_body( $request ), true );
			}

			set_transient( $cache_key, $response_body, 12 * HOUR_IN_SECONDS );
		}

		return $response_body;
	}
}
