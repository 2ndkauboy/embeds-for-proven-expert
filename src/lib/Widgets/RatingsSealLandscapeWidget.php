<?php
/**
 * The landscape seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\RatingsSealLandscapeEmbed;

/**
 * Class RatingsSealLandscapeWidget
 *
 * @extends  AbstractWidget
 */
class RatingsSealLandscapeWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal_landscape';
		$this->widget_description = esc_html__( 'Display a landscape seal widget from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal_landscape';
		$this->widget_name        = __( 'ProvenExpert Ratings Seal (landscape)', 'embeds-for-proven-expert' );
		$this->embed              = new RatingsSealLandscapeEmbed();
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
