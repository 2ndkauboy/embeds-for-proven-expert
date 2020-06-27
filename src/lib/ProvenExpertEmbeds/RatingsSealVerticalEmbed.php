<?php
/**
 * The ratings seal vertical embed
 *
 * @package EFPE\ProvenExpertEmbeds
 */

namespace EFPE\ProvenExpertEmbeds;

/**
 * Class RatingsSeal
 *
 * @extends  AbstractWidget
 */
class RatingsSealVerticalEmbed extends AbstractProvenExpertEmbed {
	/**
	 * Register the embed and it's settings.
	 */
	public function __construct() {
		$this->api_endpoint = '/widget/create';
		$this->api_args     = [
			'type' => 'portrait',
		];
		$this->settings     = [
			'width'    => [
				'label' => __( 'Ratings seal width in pixels', 'embeds-for-proven-expert' ),
				'type'  => 'number',
				'std'   => 200,
				'step'  => 1,
				'min'   => 90,
				'max'   => 250,
			],
			'feedback' => [
				'label' => __( 'Display customer votes', 'embeds-for-proven-expert' ),
				'type'  => 'checkbox',
				'std'   => 0,
			],
			'slider'   => [
				'label' => __( 'Ratings seal on browser margin', 'embeds-for-proven-expert' ),
				'type'  => 'checkbox',
				'std'   => 0,
			],
			'fixed'    => [
				'label' => __( 'Dock seal on browser margin', 'embeds-for-proven-expert' ),
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'efpe-advanced-setting',
			],
			'origin'   => [
				'label'   => __( 'Distance of seal measured from top or bottom browser margin?', 'embeds-for-proven-expert' ),
				'type'    => 'select',
				'std'     => '',
				'options' => [
					''       => '',
					'top'    => __( 'top', 'embeds-for-proven-expert' ),
					'bottom' => __( 'bottom', 'embeds-for-proven-expert' ),
				],
				'class'   => 'efpe-advanced-setting',
			],
			'position' => [
				'label' => __( 'Pixel distance of seal from top or bottom browser margin', 'embeds-for-proven-expert' ),
				'type'  => 'number',
				'std'   => '',
				'step'  => 1,
				'min'   => 0,
				'max'   => '',
				'class' => 'efpe-advanced-setting',
			],
			'side'     => [
				'label'   => __( 'Browser side on which ratings seal is docked', 'embeds-for-proven-expert' ),
				'type'    => 'select',
				'std'     => '',
				'options' => [
					''      => '',
					'left'  => __( 'left', 'embeds-for-proven-expert' ),
					'right' => __( 'right', 'embeds-for-proven-expert' ),
				],
				'class'   => 'efpe-advanced-setting',
			],
			'viewport' => [
				'label' => __( 'Browser width in pixels from which seal is displayed', 'embeds-for-proven-expert' ),
				'type'  => 'number',
				'std'   => '',
				'step'  => 1,
				'min'   => 0,
				'max'   => '',
				'class' => 'efpe-advanced-setting',
			],
		];
	}
}
