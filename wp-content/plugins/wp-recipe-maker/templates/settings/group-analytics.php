<?php
/**
 * Template for the plugin settings structure.
 *
 * @link       http://bootstrapped.ventures
 * @since      6.5.0
 *
 * @package    WP_Recipe_Maker
 * @subpackage WP_Recipe_Maker/templates/settings
 */

$analytics = array(
	'id' => 'analytics',
	'icon' => 'chart',
	'name' => __( 'Analytics', 'wp-recipe-maker' ),
	'settings' => array(
		array(
			'id' => 'analytics_enabled',
			'name' => __( 'Enable Analytics', 'wp-recipe-maker' ),
			'description' => __( 'Track different visitor actions related to recipes. Might require changes to your cookie or privacy policy!', 'wp-recipe-maker' ),
			'type' => 'toggle',
			'default' => false,
		),
	),
);

if ( defined( 'WPRM_HH_BETA' ) && WPRM_HH_BETA ) {
	$analytics['settings'][] = array(
		'id' => 'honey_home_integration',
		'name' => __( 'Honey & Home Integration', 'wp-recipe-maker' ),
		'description' => __( 'Advanced recipe analytics in closed beta. Click on "Learn More" to show your interest.', 'wp-recipe-maker' ),
		'documentation' => 'http://honeyandhome.com',
		'type' => 'toggle',
		'default' => false,
		'dependency' => array(
			'id' => 'analytics_enabled',
			'value' => true,
		),
	);

	$hh_integration_status = get_option( 'hh_integration_status', false );

	$description = __( 'Add your H&H token to start syncing data. This will send your analytics data to the Honey & Home platform.', 'wp-recipe-maker' );
	if ( false !== $hh_integration_status ) {
		if ( $hh_integration_status['success'] ) {
			$description = __( 'The integration is currently active.', 'wp-recipe-maker' );
		} else {
			$description = __( 'There was a problem with activating the integration:', 'wp-recipe-maker' ) . ' ' . $hh_integration_status['message'];
		}
	}
	
	$analytics['settings'][] = array(
		'id' => 'honey_home_token',
		'name' => __( 'Honey & Home Token', 'wp-recipe-maker' ),
		'description' => $description,
		'type' => 'text',
		'default' => '',
		'sanitize' => function( $value ) {
			return trim( sanitize_text_field( $value ) );
		},
		'dependency' => array(
			array(
				'id' => 'analytics_enabled',
				'value' => true,
			),
			array(
				'id' => 'honey_home_integration',
				'value' => true,
			),
		),
	);
}