<?php
/**
 * Abstract widget class
 *
 * @see      WooCommerce/Abstracts/WC_Widget
 *
 * @package  EFPE\Widgets
 */

namespace EFPE\Widgets;

use EFPE\ProvenExpertEmbeds\AbstractProvenExpertEmbed;
use WP_Widget;

/**
 * Class AbstractWidget
 *
 * @extends WP_Widget
 */
abstract class AbstractWidget extends WP_Widget {

	/**
	 * CSS class.
	 *
	 * @var string
	 */
	public $widget_cssclass;

	/**
	 * Widget description.
	 *
	 * @var string
	 */
	public $widget_description;

	/**
	 * Widget ID.
	 *
	 * @var string
	 */
	public $widget_id;

	/**
	 * Widget name.
	 *
	 * @var string
	 */
	public $widget_name;

	/**
	 * The settings for the widget.
	 *
	 * @var array
	 */
	public $widget_settings;

	/**
	 * The embed instance
	 *
	 * @var AbstractProvenExpertEmbed
	 */
	public $embed;

	/**
	 * Settings.
	 *
	 * @var array
	 */
	public $settings;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$widget_ops = [
			'classname'                   => $this->widget_cssclass,
			'description'                 => $this->widget_description,
			'customize_selective_refresh' => true,
		];

		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );

		// Merge the widget and embed settings to be used when creating the widget form.
		$this->settings = array_merge( $this->widget_settings, $this->embed->settings );

		add_action( 'save_post', [ $this, 'flush_widget_cache' ] );
		add_action( 'deleted_post', [ $this, 'flush_widget_cache' ] );
		add_action( 'switch_theme', [ $this, 'flush_widget_cache' ] );
	}

	/**
	 * Get cached widget.
	 *
	 * @param array $args Arguments.
	 *
	 * @return bool true if the widget is cached otherwise false
	 */
	public function get_cached_widget( $args ) {
		// Don't get cache if widget_id doesn't exists.
		if ( empty( $args['widget_id'] ) ) {
			return false;
		}

		$cache = wp_cache_get( $this->get_widget_id_for_cache( $this->widget_id ), 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = [];
		}

		if ( isset( $cache[ $this->get_widget_id_for_cache( $args['widget_id'] ) ] ) ) {
			echo $cache[ $this->get_widget_id_for_cache( $args['widget_id'] ) ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			return true;
		}

		return false;
	}

	/**
	 * Cache the widget.
	 *
	 * @param array  $args    Arguments.
	 * @param string $content Content.
	 *
	 * @return string the content that was cached
	 */
	public function cache_widget( $args, $content ) {
		// Don't set any cache if widget_id doesn't exist.
		if ( empty( $args['widget_id'] ) ) {
			return $content;
		}

		$cache = wp_cache_get( $this->get_widget_id_for_cache( $this->widget_id ), 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = [];
		}

		$cache[ $this->get_widget_id_for_cache( $args['widget_id'] ) ] = $content;

		wp_cache_set( $this->get_widget_id_for_cache( $this->widget_id ), $cache, 'widget' );

		return $content;
	}

	/**
	 * Flush the cache.
	 */
	public function flush_widget_cache() {
		foreach ( [ 'https', 'http' ] as $scheme ) {
			wp_cache_delete( $this->get_widget_id_for_cache( $this->widget_id, $scheme ), 'widget' );
		}
	}

	/**
	 * Get this widgets title.
	 *
	 * @param array $instance Array of instance options.
	 *
	 * @return string
	 */
	protected function get_instance_title( $instance ) {
		if ( isset( $instance['title'] ) ) {
			return $instance['title'];
		}

		if ( isset( $this->settings, $this->settings['title'], $this->settings['title']['std'] ) ) {
			return $this->settings['title']['std'];
		}

		return '';
	}

	/**
	 * Output the html at the start of a widget.
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Instance.
	 */
	public function widget_start( $args, $instance ) {
		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		$title = apply_filters( 'widget_title', $this->get_instance_title( $instance ), $instance, $this->id_base );

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	/**
	 * Output the html at the end of a widget.
	 *
	 * @param array $args Arguments.
	 */
	public function widget_end( $args ) {
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @param array $new_instance New instance.
	 * @param array $old_instance Old instance.
	 *
	 * @return array
	 * @see    WP_Widget->update
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		if ( empty( $this->settings ) ) {
			return $instance;
		}

		// Loop settings and get values to save.
		foreach ( $this->settings as $key => $setting ) {
			if ( ! isset( $setting['type'] ) ) {
				continue;
			}

			// Format the value based on settings type.
			switch ( $setting['type'] ) {
				case 'number':
					$instance[ $key ] = absint( $new_instance[ $key ] );

					if ( isset( $setting['min'] ) && '' !== $setting['min'] ) {
						$instance[ $key ] = max( $instance[ $key ], $setting['min'] );
					}

					if ( isset( $setting['max'] ) && '' !== $setting['max'] ) {
						$instance[ $key ] = min( $instance[ $key ], $setting['max'] );
					}
					break;
				case 'textarea':
					$instance[ $key ] = wp_kses( trim( wp_unslash( $new_instance[ $key ] ) ), wp_kses_allowed_html( 'post' ) );
					break;
				case 'checkbox':
					$instance[ $key ] = empty( $new_instance[ $key ] ) ? 0 : 1;
					break;
				default:
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? sanitize_text_field( $new_instance[ $key ] ) : $setting['std'];
					break;
			}

			/**
			 * Sanitize the value of a setting.
			 */
			$instance[ $key ] = apply_filters( 'efpe_widget_settings_sanitize_option', $instance[ $key ], $new_instance, $key, $setting );
		}

		$this->flush_widget_cache();

		return $instance;
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param array $instance Instance.
	 *
	 * @see   WP_Widget->form
	 */
	public function form( $instance ) {
		if ( empty( $this->settings ) ) {
			return;
		}

		foreach ( $this->settings as $key => $setting ) {
			$class = isset( $setting['class'] ) ? $setting['class'] : '';
			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

			switch ( $setting['type'] ) {
				case 'text':
					?>
					<p class="efpe-setting <?php echo esc_attr( $class ); ?>">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); ?><?php /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>"/>
					</p>
					<?php
					break;

				case 'number':
					?>
					<p class="efpe-setting <?php echo esc_attr( $class ); ?>">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>"/>
					</p>
					<?php
					break;

				case 'select':
					?>
					<p class="efpe-setting <?php echo esc_attr( $class ); ?>">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></label>
						<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<?php
					break;

				case 'textarea':
					?>
					<p class="efpe-setting <?php echo esc_attr( $class ); ?>">
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></label>
						<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" cols="20" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'checkbox':
					?>
					<p class="efpe-setting <?php echo esc_attr( $class ); ?>">
						<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></label>
					</p>
					<?php
					break;

				// Default: run an action.
				default:
					do_action( 'efpe_widget_field_' . $setting['type'], $key, $value, $setting, $instance );
					break;
			}
		}
	}

	/**
	 * Get widget id plus scheme/protocol to prevent serving mixed content from (persistently) cached widgets.
	 *
	 * @param string $widget_id Id of the cached widget.
	 * @param string $scheme    Scheme for the widget id.
	 *
	 * @return string            Widget id including scheme/protocol.
	 */
	protected function get_widget_id_for_cache( $widget_id, $scheme = '' ) {
		if ( $scheme ) {
			$widget_id_for_cache = $widget_id . '-' . $scheme;
		} else {
			$widget_id_for_cache = $widget_id . '-' . ( is_ssl() ? 'https' : 'http' );
		}

		return apply_filters( 'efpe_cached_widget_id', $widget_id_for_cache );
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget' and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {
		$this->widget_start( $args, $instance );

		// Temporarily allowing all style attributes is necessary, because ProvenExpert generates some invalid HTML.
		add_filter( 'safe_style_css', [ $this, 'allow_all_style_attributes' ] );
		echo wp_kses( $this->embed->get_embed_markup( $instance ), $this->allowed_html() );
		remove_filter( 'safe_style_css', [ $this, 'allow_all_style_attributes' ] );

		$this->widget_end( $args );
	}

	/**
	 * Get the allowed HTML tags to sanitize the ProvenExpert API HTML markup.
	 *
	 * @return array
	 */
	public function allowed_html() {
		// Allow all HTML from posts.
		$allowed_html = wp_kses_allowed_html( 'post' );
		// Additionally allow style and script tags.
		$allowed_html['script'] = [
			'type' => true,
			'src'  => true,
		];
		$allowed_html['style']  = [];

		return $allowed_html;
	}

	/**
	 * Temporarily allow all attributes.
	 *
	 * @param string[] $attr Array of allowed CSS attributes.
	 *
	 * @return array
	 */
	public function allow_all_style_attributes( $attr ) {
		return [];
	}
}
