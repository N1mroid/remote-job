<?php
/**
 * Getting Started Page.
 *
 * @package JobScout_Pro
 */

require get_template_directory() . '/inc/getting-started/class-getting-start-plugin-helper.php';

if( ! function_exists( 'jobscout_pro_getting_started_admin_scripts' ) ) :
/**
 * Load Getting Started styles in the admin
 */
function jobscout_pro_getting_started_admin_scripts( $hook ){
	// Load styles only on our page
    if( 'appearance_page_jobscout-pro-license' != $hook ) return;

    wp_enqueue_style( 'jobscout-pro-getting-started', get_template_directory_uri() . '/inc/getting-started/css/getting-started.css', false, JOBSCOUT_PRO_THEME_VERSION );
    
    wp_enqueue_script( 'plugin-install' );
	wp_enqueue_script( 'updates' );
	wp_enqueue_script( 'layzr', get_template_directory_uri() . '/js/layzr.min.js', array('jquery'), '2.0.4', true );
	wp_enqueue_script( 'jobscout-pro-getting-started', get_template_directory_uri() . '/inc/getting-started/js/getting-started.js', array( 'jquery' ), JOBSCOUT_PRO_THEME_VERSION, true );
	wp_localize_script( 'jobscout-pro-getting-started', 'jobscout_pro_getting_started', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'jobscout-pro-recommended-plugin-install', get_template_directory_uri() . '/inc/getting-started/js/recommended-plugin-install.js', array( 'jquery' ), JOBSCOUT_PRO_THEME_VERSION, true );    
    wp_localize_script( 'jobscout-pro-recommended-plugin-install', 'jobscout_pro_start_page', array( 'activating' => __( 'Activating ', 'jobscout-pro' ) ) );
}
endif;
add_action( 'admin_enqueue_scripts', 'jobscout_pro_getting_started_admin_scripts' );

if( ! function_exists( 'jobscout_pro_call_plugin_api' ) ) :
/**
 * Plugin API
**/
function jobscout_pro_call_plugin_api( $plugin ) {
	include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	$call_api = plugins_api( 
        'plugin_information', 
            array(
    		'slug'   => $plugin,
    		'fields' => array(
    			'downloaded'        => false,
    			'rating'            => false,
    			'description'       => false,
    			'short_description' => true,
    			'donate_link'       => false,
    			'tags'              => false,
    			'sections'          => true,
    			'homepage'          => true,
    			'added'             => false,
    			'last_updated'      => false,
    			'compatibility'     => false,
    			'tested'            => false,
    			'requires'          => false,
    			'downloadlink'      => false,
    			'icons'             => true
    		)
    	) 
    );
	return $call_api;
}
endif;

if( ! function_exists( 'jobscout_pro_check_for_icon' ) ) :
/**
 * Check For Icon 
**/
function jobscout_pro_check_for_icon( $arr ) {
	if( ! empty( $arr['svg'] ) ){
		$plugin_icon_url = $arr['svg'];
	}elseif( ! empty( $arr['2x'] ) ){
		$plugin_icon_url = $arr['2x'];
	}elseif( ! empty( $arr['1x'] ) ){
		$plugin_icon_url = $arr['1x'];
	}else{
		$plugin_icon_url = $arr['default'];
	}                               
	return $plugin_icon_url;
}
endif;

if( ! function_exists( 'jobscout_pro_theme_club_list' ) ) :
/**
 * Ajax Callback for Theme Club List
 */
function jobscout_pro_theme_club_list(){
	//Getting theme list from the transient if there are any....
	$theme_array = get_transient( 'rara_theme_feed_transient' );
	
	ob_start();

	if( $theme_array ){	?>
		<div class="theme-intro">
			<?php if( $theme_array['club_desc'] ) echo '<div class="theme-intro-left">' . $theme_array['club_desc'][0] . '</div>'; ?>
			<div class="theme-intro-right">
				<a class="button-primary club-button" href="<?php echo esc_url( 'https://rarathemes.com/theme-club/' ); ?>" target="_blank"><?php esc_html_e( 'Learn about the Theme Club', 'jobscout-pro' ); ?>
					<i class="fas fa-arrow-right"></i>
				</a>
			</div>
		</div>
		<?php
		if( $theme_array['themes'] ){ ?>
			<div class="theme-list">
				<?php
					foreach( $theme_array['themes'] as $theme_list ){
						$theme_title   = isset( $theme_list['title'] ) ? $theme_list['title'] : '';
						$theme_image   = isset( $theme_list['image'] ) ? $theme_list['image'] : '';
						$theme_content = isset( $theme_list['content'] ) ? $theme_list['content'] : ''; ?>
						<div class="rara-theme">
							<div class="theme-image">
								<a class="theme-link" href="<?php echo esc_url( 'https://rarathemes.com/wordpress-themes/' . $theme_list['slug'] . '/' ); ?>" target="_blank" rel="nofollow">
									<img data-layzr="<?php echo esc_url( $theme_image ); ?>" src="" alt="">
								</a>
							</div>
							<h3><a href="<?php echo esc_url( 'https://rarathemes.com/wordpress-themes/' . $theme_list['slug'] . '/' ); ?>"><?php echo esc_html( $theme_title ); ?></a></h3>
							<?php echo wp_kses_post( $theme_content ); ?>
						</div>
						<?php
					}
				?>
			</div><!-- .theme-list -->
			<?php
		}                
	}else{
		// Getting the Themelist from restapi from https://rarathemes.com
		$themes_list = wp_safe_remote_get( 'https://rarathemes.com/wp-json/rara/v1/themefeed' );

		if ( ! is_wp_error( $themes_list ) && 200 === wp_remote_retrieve_response_code( $themes_list ) ){    
			$body        = wp_remote_retrieve_body( $themes_list ); //getting body 
			$theme_array = json_decode( $body, true ); // making object into array                
			if( $theme_array ){
				set_transient( 'rara_theme_feed_transient', $theme_array, WEEK_IN_SECONDS ); ?>
				<div class="theme-intro">
					<?php if( $theme_array['club_desc'] ) echo '<div class="theme-intro-left">' . $theme_array['club_desc'][0] . '</div>'; ?>
					<div class="theme-intro-right">
						<a class="button-primary club-button" href="<?php echo esc_url( 'https://rarathemes.com/theme-club/' ); ?>" target="_blank"><?php esc_html_e( 'Learn about the Theme Club', 'jobscout-pro' ); ?>
							<i class="fas fa-arrow-right"></i>
						</a>
					</div>
				</div>
				<?php 
					if( $theme_array['themes'] ){ ?>
					<div class="theme-list">
						<?php
							foreach( $theme_array['themes'] as $theme_list ){
								$theme_title   = isset( $theme_list['title'] ) ? $theme_list['title'] : '';
								$theme_image   = isset( $theme_list['image'] ) ? $theme_list['image'] : '';
								$theme_content = isset( $theme_list['content'] ) ? $theme_list['content'] : ''; ?>
								<div class="rara-theme">
									<div class="theme-image">
										<a class="theme-link" href="<?php echo esc_url( 'https://rarathemes.com/wordpress-themes/' . $theme_list['slug'] . '/' ); ?>" target="_blank" rel="nofollow">
											<img data-layzr="<?php echo esc_url( $theme_image ); ?>" src="" alt="">
										</a>
									</div>
									<h3><a href="<?php echo esc_url( 'https://rarathemes.com/wordpress-themes/' . $theme_list['slug'] . '/' ); ?>"><?php echo esc_html( $theme_title ); ?></a></h3>
									<?php echo wp_kses_post( $theme_content ); ?>
								</div>
								<?php
							}
						?>
					</div><!-- .theme-list -->
					<?php
				}
			}
		}else {
			$themes_link = 'https://rarathemes.com/theme-club/';
			printf( __( '%1$sThis theme feed seems to be temporarily down. Please check back later, or visit our <a href="%2$s" target="_blank">Themes Club page on Rara Theme</a>.%3$s', 'jobscout-pro' ), '<p>', esc_url( $themes_link ), '</p>' );
		}       
	}
	
	echo ob_get_clean();

	wp_die();
}
endif;
add_action( 'wp_ajax_theme_club_from_rest', 'jobscout_pro_theme_club_list' );