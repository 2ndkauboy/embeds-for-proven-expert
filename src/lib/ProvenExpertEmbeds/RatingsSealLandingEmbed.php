<?php
/**
 * The ratings seal bar embed
 *
 * @package EFPE\ProvenExpertEmbeds
 */

namespace EFPE\ProvenExpertEmbeds;

/**
 * Class RatingsSealLandingEmbed
 *
 * @extends  AbstractProvenExpertEmbed
 */
class RatingsSealLandingEmbed extends AbstractProvenExpertEmbed {
	/**
	 * Register the embed and it's settings.
	 */
	public function __construct() {
		$this->api_endpoint = '/widget/create';
		$this->api_args     = [
			'type' => 'landing',
		];
		$this->settings     = [
			'style'      => [
				'label'   => __( 'Color of the header', 'embeds-for-proven-expert' ),
				'type'    => 'select',
				'std'     => '',
				'options' => [
					''      => '',
					'black' => __( 'black', 'embeds-for-proven-expert' ),
					'white' => __( 'white', 'embeds-for-proven-expert' ),
				],
			],
			'avatar'     => [
				'label' => __( 'Show profile image', 'embeds-for-proven-expert' ),
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'wfpe-advanced-setting',
			],
			'feedback'   => [
				'label' => __( 'Display customer votes', 'embeds-for-proven-expert' ),
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'wfpe-advanced-setting',
			],
			'competence' => [
				'label' => __( 'Show top competencies', 'embeds-for-proven-expert' ),
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'wfpe-advanced-setting',
			],
		];
	}
}
