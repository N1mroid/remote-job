<?php
/**
 * Template Name: Contact Page
 * 
 * @package JobScout_Pro
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php 
				if( is_active_sidebar( 'contact-template-left' ) ){ ?>
					<div class="contact-form">
						<?php dynamic_sidebar( 'contact-template-left' ); ?>
					</div>
				<?php } 

				if( is_active_sidebar( 'contact-template-right' ) ){ ?>
					<div class="contact-map-wrap">
						<?php dynamic_sidebar( 'contact-template-right' ); ?>
					</div><!-- .contact-map-wrap -->
				<?php 
				}
			?>
		</main> <!-- #main -->
	</div> <!-- #primary -->
	
	<?php 
get_footer();