<?php
/**
 * Class ProvenExpertApiCredentials
 *
 * @package EFPE\Settings
 */

namespace EFPE\Settings;

/**
 * Class ProvenExpertApiCredentials
 */
class ProvenExpertApiCredentials {
	/**
	 * Initialize the class
	 */
	public function init() {
		add_action( 'admin_menu', [ $this, 'add_options_page' ] );
		add_action( 'admin_init', [ $this, 'add_settings' ] );
	}

	/**
	 * Add an options page for the settings
	 */
	public function add_options_page() {
		add_options_page(
			_x( 'Embeds for ProvenExpert Settings', 'settings-page-title', 'embeds-for-proven-expert' ),
			_x( 'ProvenExpert', 'settings-page-menu-name', 'embeds-for-proven-expert' ),
			'manage_options',
			'efpe',
			[ $this, 'options_page' ]
		);
	}

	/**
	 * Add the settings, sections and fields
	 */
	public function add_settings() {
		register_setting(
			'efpe',
			'efpe_api_id'
		);
		register_setting(
			'efpe',
			'efpe_api_key'
		);

		add_settings_section(
			'efpe_api_credentials_section',
			null,
			null,
			'efpe'
		);

		add_settings_field(
			'efpe_api_id_settings_field',
			__( 'API ID', 'embeds-for-proven-expert' ),
			[ $this, 'settings_field' ],
			'efpe',
			'efpe_api_credentials_section',
			[
				'label_for' => 'efpe_api_id',
			]
		);
		add_settings_field(
			'efpe_api_key_settings_field',
			__( 'API key', 'embeds-for-proven-expert' ),
			[ $this, 'settings_field' ],
			'efpe',
			'efpe_api_credentials_section',
			[
				'label_for' => 'efpe_api_key',
			]
		);
	}

	/**
	 * Render the options page
	 */
	public function options_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		settings_errors( 'efpe_messages' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form method="post" action="options.php">
				<p><?php echo esc_html__( 'To use the ProvenExpert embeds on you site, you have to provide credentials for the ProvenExert API in the settings below.', 'embeds-for-proven-expert' ); ?></p>
				<p>
					<?php
					echo wp_kses_post(
						sprintf(
						// Translators: %s: link tag to the provenexpert.com page for the API credentials.
							__( 'If you have not yet created your credentials, you can do so on the %s.', 'embeds-for-proven-expert' ),
							sprintf(
							// Translators: %1$s: url provenexpert.com page for the API credentials, %2$s: link text for this link.
								'<a href="%1$s">%2$s</a>',
								__( 'https://www.provenexpert.com/en-us/custom-survey-links/', 'embeds-for-proven-expert' ),
								__( 'Personalized survey links (API) page', 'embeds-for-proven-expert' )
							)
						)
					);
					?>
				</p>
				<?php
				settings_fields( 'efpe' );
				do_settings_sections( 'efpe' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Render the settings field
	 *
	 * @param array $args Arguments for the settings field.
	 */
	public function settings_field( $args ) {
		$setting = get_option( $args['label_for'] );
		?>
		<input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>>" name="<?php echo esc_attr( $args['label_for'] ); ?>" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" class="regular-text">
		<?php
	}
}
