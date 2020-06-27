<?php
/**
 * The rating seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\RatingSummaryRichSnippetEmbed;

/**
 * Class RatingSummaryRichSnippetWidget
 *
 * @extends  AbstractWidget
 */
class RatingSummaryRichSnippetWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal_rating_summary';
		$this->widget_description = esc_html__( 'Display a rating summary from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal_rating_summary';
		$this->widget_name        = __( 'ProvenExpert Rating Summary', 'embeds-for-proven-expert' );
		$this->embed              = new RatingSummaryRichSnippetEmbed();
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
