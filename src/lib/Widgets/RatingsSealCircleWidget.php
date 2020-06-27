<?php
/**
 * The circle seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\RatingsSealCircleEmbed;

/**
 * Class RatingsSealCircleWidget
 *
 * @extends  AbstractWidget
 */
class RatingsSealCircleWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal_circle';
		$this->widget_description = esc_html__( 'Display a circle seal widget from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal_circle';
		$this->widget_name        = __( 'ProvenExpert Ratings Seal (circle)', 'embeds-for-proven-expert' );
		$this->embed              = new RatingsSealCircleEmbed();
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
