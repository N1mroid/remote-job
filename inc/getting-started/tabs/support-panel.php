<?php
/**
 * Support Panel.
 *
 * @package JobScout_Pro
 */
?>
<!-- Support panel -->
<div id="support-panel" class="panel-left">
	<div class="toggle-block active">
		<h3 class="toggle-title"><?php esc_html_e( 'How can I activate the theme license?', 'jobscout-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php printf( __( 'To activate the theme license, you need to copy the license key from your %1$sRara Theme\'s Dashboard%2$s and enter the key on the right-hand side of this page. You can log in to your Rara Theme\'s Dashboard using the username and password that was sent to your email during the theme purchase.', 'jobscout-pro' ), '<a href="'. esc_url( 'https://rarathemes.com/my-account/' ) .'" target="_blank">', '</a>' );
			?></p>
		</div>
	</div>

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'What are the benefits of activating the theme license?', 'jobscout-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php esc_html_e( 'When you activate the theme license, you can enjoy the seamless theme updates and faster support. We solve compatibility issues and bugs, make the theme more secure, and add extra features with theme updates. So, if you want your website to be safe and secure, you should activate the theme license so that you never miss our theme updates.', 'jobscout-pro' );
			?></p>
		</div>
	</div>	

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'What are the benefits of upgrading to the Theme Club?', 'jobscout-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php printf( __( 'For just small additional amount of money, you will get access to all our current themes, new theme releases, theme updates, and email support with the %1$sTheme Club%2$s.', 'jobscout-pro' ), '<a href="'. esc_url( 'https://rarathemes.com/theme-club/' ) .'" target="_blank">', '</a>' );
			?></p>
		</div>
	</div>

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'How can I upgrade to the Theme Club?', 'jobscout-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php printf ( __( 'To upgrade to the Theme Club, please log in to your %1$sRara Theme\'s Dashboard%2$s using the username and password created during the purchase. After you log in, go to the %3$sPurchase History%4$s section and click on %3$sView Licenses%4$s. Click on %3$sView Upgrades%4$s and select %3$sTheme Club Upgrade%4$s you want.', 'jobscout-pro' ), '<a href="'. esc_url( 'https://rarathemes.com/my-account/' ) .'" target="_blank">', '</a>', '<b>', '</b>' );
			?></p>
		</div>
	</div>
    
    <div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'Why is my theme not working well?', 'jobscout-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php esc_html_e( 'If your customizer is not loading properly or you are having issues with the theme, it might be due to the plugin conflict.', 'jobscout-pro' );
			?></p>
			<p><?php printf( __( 'To solve the issue, deactivate all the plugins first, except the ones recommended by the theme. Then, hard reload your website using %1$s"Ctrl+Shift+R"%2$s on Windows and %1$s"Cmd+Shift+R"%2$s on Mac. If the issues are fixed, start activating the plugins one by one, and reload and check your site each time. This will help you find out the plugin that is causing the problem.', 'jobscout-pro' ), '<b>', '</b>' );
			?></p>
			<p><?php printf( __( 'If this didn\'t help, please %1$sContact Support%2$s.', 'jobscout-pro' ), '<a href="'. esc_url( 'https://rarathemes.com/support-ticket/' ) .'" target="_blank">', '</a>' ); ?></p>
		</div>
	</div>

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'How can I solve my issues quickly and get faster support?', 'jobscout-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php esc_html_e( 'Before you send us a support ticket for any issues, please make sure you have updated the theme to the latest version. We might have fixed the bug in the theme update.', 'jobscout-pro' );
			?></p>
			<p><?php esc_html_e( 'When you submit the support ticket, please try to provide as much details as possible so that we can solve your problem faster. We recommend you to send us a screenshot(s) with issues explained and your website\'s address (URL).', 'jobscout-pro' );
			?></p>
		</div>
	</div>	
</div><!-- .panel-left support -->