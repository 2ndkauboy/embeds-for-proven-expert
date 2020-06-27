<?php
/**
 * The square seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\RatingsSealSquareEmbed;

/**
 * Class RatingsSealSquareWidget
 *
 * @extends  AbstractWidget
 */
class RatingsSealSquareWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal_square';
		$this->widget_description = esc_html__( 'Display a square seal widget from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal_square';
		$this->widget_name        = __( 'ProvenExpert Ratings Seal (square)', 'embeds-for-proven-expert' );
		$this->embed              = new RatingsSealSquareEmbed();
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
