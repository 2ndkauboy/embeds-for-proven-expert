<?php
/**
 * The rating rich snippet embed
 *
 * @package EFPE\ProvenExpertEmbeds
 */

namespace EFPE\ProvenExpertEmbeds;

/**
 * Class RatingSummaryRichSnippetEmbed
 *
 * @extends  AbstractProvenExpertEmbed
 */
class RatingSummaryRichSnippetEmbed extends AbstractProvenExpertEmbed {
	/**
	 * Register the embed and it's settings.
	 */
	public function __construct() {
		$this->api_endpoint = 'rating/summary/richsnippet';
		$this->api_args     = [
			'type' => 'bar',
		];
		$this->settings     = [
			'version' => [
				'label'   => _x( 'Version', 'rich snippet version', 'embeds-for-proven-expert' ),
				'type'    => 'select',
				'std'     => '',
				'options' => [
					'1' => __( '1', 'embeds-for-proven-expert' ),
					'2' => __( '2', 'embeds-for-proven-expert' ),
					'3' => __( '3', 'embeds-for-proven-expert' ),
					'4' => __( '4', 'embeds-for-proven-expert' ),
				],
				'class'   => 'wfpe-advanced-setting',
			],
		];
	}
}
