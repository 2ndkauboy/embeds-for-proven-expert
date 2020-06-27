<?php
/**
 * The seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\RatingsSealVerticalEmbed;

/**
 * Class RatingsSeal
 *
 * @extends  AbstractWidget
 */
class RatingsSealVerticalWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal';
		$this->widget_description = esc_html__( 'Display a vertical seal widgets from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal';
		$this->widget_name        = __( 'ProvenExpert Ratings Seal (vertical)', 'embeds-for-proven-expert' );
		$this->embed              = new RatingsSealVerticalEmbed();
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
