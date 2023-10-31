<?php
/**
 * Abstract embed class.
 *
 * @package  EFPE\ProvenExpertEmbeds
 */

namespace EFPE\ProvenExpertEmbeds;

use EFPE\Helpers\ProvenExpertAPI;

/**
 * Class AbstractProvenExpertEmbed
 */
abstract class AbstractProvenExpertEmbed {
	/**
	 * The API endpoint for the specific widget.
	 *
	 * @var string
	 */
	public $api_endpoint = '';

	/**
	 * An array of static API args.
	 *
	 * @var array
	 */
	public $api_args = [];

	/**
	 * Settings.
	 *
	 * @var array
	 */
	public $settings = [];

	/**
	 * Filter out arguments that are not valid for this widget
	 *
	 * @param array $args The request arguments.
	 *
	 * @return array
	 */
	public function filter_request_args( $args ) {
		foreach ( $args as $key => $arg ) {
			// Remove the arg, if it's not within the settings of this specific embed.
			if ( ! array_key_exists( $key, $this->settings ) ) {
				unset( $args[ $key ] );
				// Check if setting with type "number" are "empty" and remove them, as they otherwise cause issues.
			} elseif ( 'number' === $this->settings[ $key ]['type'] && ( ! is_numeric( $arg ) || empty( $arg ) ) ) {
				unset( $args[ $key ] );
			}
		}

		return $args;
	}

	/**
	 * Get the embed markup from the ProvenExpert API
	 *
	 * @param array $args The arguments for the request.
	 *
	 * @return string
	 */
	public function get_embed_markup( $args ) {
		// Filter our any invalid args and merge it to the static args.
		$request_args['body']['data'] = array_merge( $this->api_args, $this->filter_request_args( $args ) );
		// Get the response from the transient cache or ProvenExpert API.
		$response_body = ProvenExpertAPI::get_response_body( $this->api_endpoint, $request_args );

		if ( is_wp_error( $response_body ) ) {
			return '';
		}

		return '<div class="efpe-container" style="position: relative;">' . $response_body['html'] . '</div>';
	}
}
