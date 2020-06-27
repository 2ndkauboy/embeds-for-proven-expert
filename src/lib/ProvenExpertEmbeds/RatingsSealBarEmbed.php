<?php
/**
 * The ratings seal bar embed
 *
 * @package EFPE\ProvenExpertEmbeds
 */

namespace EFPE\ProvenExpertEmbeds;

/**
 * Class RatingsSealBarEmbed
 *
 * @extends  AbstractProvenExpertEmbed
 */
class RatingsSealBarEmbed extends AbstractProvenExpertEmbed {
	/**
	 * Register the embed and it's settings.
	 */
	public function __construct() {
		$this->api_endpoint = '/widget/create';
		$this->api_args     = [
			'type' => 'bar',
		];
		$this->settings     = [
			'style'    => [
				'label'   => __( 'Background color', 'embeds-for-proven-expert' ),
				'type'    => 'select',
				'std'     => '',
				'options' => [
					''      => '',
					'black' => __( 'black', 'embeds-for-proven-expert' ),
					'white' => __( 'white', 'embeds-for-proven-expert' ),
				],
				'class'   => 'wfpe-advanced-setting',
			],
			'feedback' => [
				'label' => __( 'Display customer votes', 'embeds-for-proven-expert' ),
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'wfpe-advanced-setting',
			],
		];
	}
}
