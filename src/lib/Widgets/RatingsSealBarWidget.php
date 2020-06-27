<?php
/**
 * The bar seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\RatingsSealBarEmbed;

/**
 * Class RatingsSealBarWidget
 *
 * @extends  AbstractWidget
 */
class RatingsSealBarWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal_bar';
		$this->widget_description = esc_html__( 'Display a bar seal widget from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal_bar';
		$this->widget_name        = __( 'ProvenExpert Ratings Seal (bar)', 'embeds-for-proven-expert' );
		$this->embed              = new RatingsSealBarEmbed();
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
