<?php
/**
 * The landing seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\RatingsSealLandingEmbed;

/**
 * Class RatingsSealLandingWidget
 *
 * @extends  AbstractWidget
 */
class RatingsSealLandingWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal_landing';
		$this->widget_description = esc_html__( 'Display a landing seal widget from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal_landing';
		$this->widget_name        = __( 'ProvenExpert Ratings Seal (landing)', 'embeds-for-proven-expert' );
		$this->embed              = new RatingsSealLandingEmbed();
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
