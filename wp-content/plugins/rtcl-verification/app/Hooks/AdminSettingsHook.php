<?php


namespace RtclVerification\Hooks;


use Rtcl\Helpers\Functions;
use RtclVerification\Helpers\Functions as VerificationFunctions;

class AdminSettingsHook {

	public static function init() {
		add_filter( 'rtcl_misc_settings_options', [ __CLASS__, 'misc_verification_settings' ] );
		add_action( 'admin_head', [ __CLASS__, 'add_admin_settings_style' ] );
	}

	/**
	 * @param       $target_item
	 * @param       $options
	 * @param array $newOptions
	 *
	 * @return array
	 */
	private static function append_options( $target_item, $options, array $newOptions ) {
		$position = array_search( $target_item, array_keys( $options ) );
		if ( $position > - 1 ) {
			Functions::array_insert( $options, $position, $newOptions );
		} else {
			array_unshift( $newOptions, [
				$target_item . '_pro_section' => [
					'title'       => esc_html__( 'Verification settings', 'rtcl-verification' ),
					'type'        => 'title',
					'description' => '',
				]
			] );

			$options = array_merge( $options, $newOptions );
		}

		return $options;
	}

	public static function misc_verification_settings( $options ) {

		$newOptions = [
			'verification_section'          => [
				'title' => esc_html__( 'SMS Gateway', 'rtcl-verification' ),
				'type'  => 'title',
			],
			'verification_gateway'          => [
				'title'   => esc_html__( 'Gateway Type', 'rtcl-verification' ),
				'type'    => 'radio',
				'default' => 'firebase',
				'options' => VerificationFunctions::sms_gateway_options(),
			],
			'firebase_api_key'              => [
				'title'      => esc_html__( 'Firebase API key', 'rtcl-verification' ),
				'type'       => 'text',
				'dependency' => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'firebase'
						]
					]
				]
			],
			'firebase_app_id'               => [
				'title'      => esc_html__( 'Firebase App ID', 'rtcl-verification' ),
				'type'       => 'text',
				'dependency' => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'firebase'
						]
					]
				]
			],
			'firebase_project_id'           => [
				'title'      => esc_html__( 'Firebase Project ID', 'rtcl-verification' ),
				'type'       => 'text',
				'dependency' => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'firebase'
						]
					]
				]
			],
			'firebase_sender_id'            => [
				'title'      => esc_html__( 'Firebase Messaging Sender ID', 'rtcl-verification' ),
				'type'       => 'text',
				'dependency' => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'firebase'
						]
					]
				]
			],
			'firebase_measurement_id'       => [
				'title'      => esc_html__( 'Firebase Measurement ID', 'rtcl-verification' ),
				'type'       => 'text',
				'dependency' => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'firebase'
						]
					]
				]
			],
			'twilio_site_id'                => [
				'title'       => esc_html__( 'Twilio SID', 'rtcl-verification' ),
				'type'        => 'text',
				'dependency'  => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'twilio'
						]
					]
				],
				'description' => esc_html__( 'Add Twilio account site ID here.', 'rtcl-verification' )
			],
			'twilio_auth_token'             => [
				'title'       => esc_html__( 'Twilio Auth Token', 'rtcl-verification' ),
				'type'        => 'text',
				'dependency'  => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'twilio'
						]
					]
				],
				'description' => esc_html__( 'Add Twilio account authentication token here.', 'rtcl-verification' )
			],
			'twilio_phone_from'             => [
				'title'       => esc_html__( 'Twilio Phone [From]', 'rtcl-verification' ),
				'type'        => 'text',
				'dependency'  => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'twilio'
						]
					]
				],
				'description' => esc_html__( 'Add Twilio account phone number.', 'rtcl-verification' )
			],
			'geezsms_token'             => [
				'title'      => esc_html__( 'GeezSMS Token', 'classima' ),
				'type'       => 'text',
				'dependency' => [
					'rules' => [
						"input[id^=rtcl_misc_settings-verification_gateway]" => [
							'type'  => 'equal',
							'value' => 'geezsms'
						]
					]
				],
				'description' => esc_html__( 'SMS gateway only for Ethiopia.', 'rtcl-verification' )
			],
			'verification_expired_time'     => [
				'title'       => esc_html__( 'OTP Resend Time (Second)', 'rtcl-verification' ),
				'type'        => 'number',
				'default'     => 100,
				'description' => esc_html__( 'Add OTP resend timer. It also will be use as expire time in seconds.', 'rtcl-verification' )
			],
			'verification_post_restriction' => [
				'title'       => esc_html__( 'Disable Ad Post', 'rtcl-verification' ),
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Disable', 'rtcl-verification' ),
				'description' => esc_html__( 'Disable ad post button for unverified user.', 'rtcl-verification' )
			],
			'verification_country_list'     => [
				'title'    => esc_html__( 'Select Countries', 'rtcl-verification' ),
				'type'     => 'multiselect',
				'class'    => 'rtcl-select2',
				'css'      => 'width: 400px;',
				'description' => esc_html__('Please, select the country list to show specific country.', 'rtcl-verification'),
				'options'  => rtcl()->countries->get_countries()
			],
			'verification_default_country'  => [
				'title'   => esc_html__( 'Default Country', 'rtcl-verification' ),
				'type'    => 'select',
				'class'   => 'rtcl-select2',
				'css'      => 'width: 400px;',
				'options' => rtcl()->countries->get_countries()
			],
		];
		$newOptions = apply_filters( 'rtcl_verification_misc_settings_pro_feature', $newOptions );

		return self::append_options( 'recaptcha_secret_key', $options, $newOptions );
	}

	public static function add_admin_settings_style() {
		?>
		<style>
            .rtcl-settings table.form-table .rtcl_misc_settings-geezsms_token p.description {
				color: #c90808;
            }
		</style>
		<?php
	}

}