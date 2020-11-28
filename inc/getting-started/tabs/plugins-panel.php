<?php
/**
 * Help Panel.
 *
 * @package JobScout_Pro
 */
?>
<!-- Updates panel -->
<div id="plugins-panel" class="panel-left visible">
	<h4><?php esc_html_e( 'Recommended Plugins', 'jobscout-pro' ); ?></h4>
	<p><?php esc_html_e( 'Below is a list of recommended plugins to install that will help you get the best out of JobScout Pro. Though every plugin is optional, it is recommended that you at least install the WP Job Manager, WPJM Extra Fields, Contact Listing for WP Job Manager, RaraTheme Companion, BlossomThemes Email Newsletter, Contact Form 7 & Rara One Click Demo Import plugins to create a website similar to the JobScout Pro demo.', 'jobscout-pro' ); ?></p>

	<hr/>

	<?php 
	$free_plugins = array(
		'wp-job-manager' => array(
			'slug' 		=> 'wp-job-manager',
			'filename' 	=> 'wp-job-manager.php',
		),
        'wpjm-extra-fields' => array(
			'slug' 		=> 'wpjm-extra-fields',
			'filename' 	=> 'wpjm-extra-fields.php',
		),
        'wp-job-manager-contact-listing' => array(
			'slug' 		=> 'wp-job-manager-contact-listing',
			'filename' 	=> 'wp-job-manager-contact-listing.php',
		),
        'raratheme-companion' => array(
			'slug'     	=> 'raratheme-companion',
			'filename' 	=> 'raratheme-companion.php',
		), 
        'blossomthemes-email-newsletter' => array(
			'slug' 		=> 'blossomthemes-email-newsletter',
			'filename' 	=> 'blossomthemes-email-newsletter.php',
		),
        'contact-form-7' => array(
			'slug' 		=> 'contact-form-7',
			'filename' 	=> 'wp-contact-form-7.php',
		),
		'customizer-search' => array(
			'slug'     	=> 'customizer-search',
			'filename' 	=> 'customizer-search.php',
		),               
		'rara-one-click-demo-import' => array(
			'slug' 	 	=> 'rara-one-click-demo-import',
			'filename'  => 'rara-one-click-demo-import.php',
		),                
	);

	if( $free_plugins ){ ?>
		<h4 class="recomplug-title"><?php esc_html_e( 'Free Plugins', 'jobscout-pro' ); ?></h4>
		<p><?php esc_html_e( 'These Free Plugins might be handy for you.', 'jobscout-pro' ); ?></p>
		<div class="recomended-plugin-wrap">
    		<?php
    		foreach( $free_plugins as $plugin ) {
    			$info     = jobscout_pro_call_plugin_api( $plugin['slug'] );
    			$icon_url = jobscout_pro_check_for_icon( $info->icons ); ?>    
    			<div class="recom-plugin-wrap">
    				<div class="plugin-img-wrap">
    					<img src="<?php echo esc_url( $icon_url ); ?>" />
    					<div class="version-author-info">
    						<span class="version"><?php printf( esc_html__( 'Version %s', 'jobscout-pro' ), $info->version ); ?></span>
    						<span class="seperator">|</span>
    						<span class="author"><?php echo esc_html( strip_tags( $info->author ) ); ?></span>
    					</div>
    				</div>
    				<div class="plugin-title-install clearfix">
    					<span class="title" title="<?php echo esc_attr( $info->name ); ?>">
    						<?php echo esc_html( $info->name ); ?>	
    					</span>
                        <div class="button-wrap">
    					   <?php echo JobScout_Pro_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $plugin['slug'], $plugin['filename'] ); ?>
                        </div>
    				</div>
    			</div>
    			<?php
    		} 
            ?>
		</div>
	<?php
	} 
?>
</div><!-- .panel-left -->