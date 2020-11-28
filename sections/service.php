<?php
/**
 * Services Section
 * 
 * @package JobScout_Pro
 */

if( is_active_sidebar( 'service' ) ){ ?>
	<section id="service_section" class="service-section">
	    <?php dynamic_sidebar( 'service' ); ?>
	</section> <!-- .service-section -->
<?php
}