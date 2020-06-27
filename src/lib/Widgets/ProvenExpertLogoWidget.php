<?php
/**
 * The circle seal widget
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\ProvenExpertLogoEmbed;

/**
 * Class ProvenExpertLogoWidget
 *
 * @extends  AbstractWidget
 */
class ProvenExpertLogoWidget extends AbstractWidget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'efpe_seal_logo';
		$this->widget_description = esc_html__( 'Display a logo widget from ProvenExpert.', 'embeds-for-proven-expert' );
		$this->widget_id          = 'efpe_seal_logo';
		$this->widget_name        = __( 'ProvenExpert logo', 'embeds-for-proven-expert' );
		$this->embed              = new ProvenExpertLogoEmbed();
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
