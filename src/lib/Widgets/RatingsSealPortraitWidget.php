<?php
/**
 * The portrait seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\RatingsSealPortraitEmbed;

/**
 * Class RatingsSeal
 *
 * @extends  AbstractWidget
 */
class RatingsSealPortraitWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal_portrait';
		$this->widget_description = esc_html__( 'Display a portrait seal widgets from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal_portrait';
		$this->widget_name        = __( 'ProvenExpert Ratings Seal (portrait)', 'embeds-for-proven-expert' );
		$this->embed              = new RatingsSealPortraitEmbed();
		$this->widget_settings    = [
			'title' => [
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'embeds-for-proven-expert' ),
			],
		];

		parent::__construct();
	}
}
