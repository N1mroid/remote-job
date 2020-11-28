<?php
/**
 * CTA Section
 * 
 * @package JobScout_Pro
 */
if( is_active_sidebar( 'cta' ) ){ ?>
	<section id="cta-section" class="bg-cta-section">
	    <?php dynamic_sidebar( 'cta' ); ?>
	</section> <!-- .bg-cta-section -->
<?php
}