<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package JobScout_Pro
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://rarathemes.com', // Site where EDD is hosted
		'item_name'      => 'JobScout Pro', // Name of theme
		'theme_slug'     => 'jobscout-pro', // Theme slug
		'version'        => '2.1.2', // The current version of this theme
		'author'         => 'Rara Theme', // The author of this theme
		'download_id'    => '412112', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
		'item_id'        => '',
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Getting Started', 'jobscout-pro' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'jobscout-pro' ),
		'license-key'               => __( 'License Key', 'jobscout-pro' ),
		'license-action'            => __( 'License Action', 'jobscout-pro' ),
		'deactivate-license'        => __( 'Deactivate License', 'jobscout-pro' ),
		'activate-license'          => __( 'Activate License', 'jobscout-pro' ),
		'status-unknown'            => __( 'License status is unknown.', 'jobscout-pro' ),
		'renew'                     => __( 'Renew?', 'jobscout-pro' ),
		'unlimited'                 => __( 'unlimited', 'jobscout-pro' ),
		'license-key-is-active'     => __( 'License key is active.', 'jobscout-pro' ),
		'expires%s'                 => __( 'Expires %s.', 'jobscout-pro' ),
		'expires-never'             => __( 'Lifetime License.', 'jobscout-pro' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'jobscout-pro' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'jobscout-pro' ),
		'license-key-expired'       => __( 'License key has expired.', 'jobscout-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'jobscout-pro' ),
		'license-is-inactive'       => __( 'License is inactive.', 'jobscout-pro' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'jobscout-pro' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'jobscout-pro' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'jobscout-pro' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'jobscout-pro' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'jobscout-pro' ),
	)

);
