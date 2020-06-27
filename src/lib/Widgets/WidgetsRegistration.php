<?php
/**
 * A helper class to register all widget classes
 *
 * @package EFPE\Widgets
 */

namespace EFPE\Widgets;

/**
 * Class WidgetsRegistration
 */
class WidgetsRegistration {
	/**
	 * Initialize the class
	 */
	public function init() {
		add_action( 'widgets_init', [ $this, 'register_widgets' ] );
	}

	/**
	 * Register all widgets
	 */
	public function register_widgets() {
		register_widget( ProvenExpertLogoWidget::class );
		register_widget( RatingsSealBarWidget::class );
		register_widget( RatingsSealCircleWidget::class );
		register_widget( RatingsSealLandingWidget::class );
		register_widget( RatingsSealLandscapeWidget::class );
		register_widget( RatingsSealPortraitWidget::class );
		register_widget( RatingsSealSquareWidget::class );
		register_widget( RatingSummaryRichSnippetWidget::class );
	}
}
