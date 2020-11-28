<?php
/**
 * JobScout Pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package JobScout_Pro
 */

$theme_data = wp_get_theme();
if( ! defined( 'JOBSCOUT_PRO_THEME_VERSION' ) ) define ( 'JOBSCOUT_PRO_THEME_VERSION', $theme_data->get( 'Version' ) );
if( ! defined( 'JOBSCOUT_PRO_THEME_NAME' ) ) define( 'JOBSCOUT_PRO_THEME_NAME', $theme_data->get( 'Name' ) );

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

if( is_rara_theme_companion_activated() ) :
	/**
	 * Modify filter hooks of RTC plugin.
	 */
	require get_template_directory() . '/inc/rtc-filters.php';
endif;

if( is_wp_job_manager_activated() ) :
	/**
	 * Modify filter hooks of WP Job Manager plugin.
	 */
	require get_template_directory() . '/inc/wp-job-manager-filters.php';
endif;

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox/metabox.php';

/**
 * Metabox for job type
 */
require get_template_directory() . '/inc/metabox/jbp-taxonomy-thumb.php';

/**
 * User Metabox
 */
require get_template_directory() . '/inc/metabox/user-metabox.php';

/**
 * Social Sharing
 */
require get_template_directory() . '/inc/social-sharing.php';

/**
 * Typography Functions
 */
require get_template_directory() . '/inc/typography/typography.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';

/**
 * Performance
*/
require get_template_directory() . '/inc/performance.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * Theme Updater
*/
require get_template_directory() . '/updater/theme-updater.php';
/**
 * Demo Import
 */
require get_template_directory() . '/inc/import-hooks.php';


/**
 * Add theme compatibility function for woocommerce if active
*/
if( is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}