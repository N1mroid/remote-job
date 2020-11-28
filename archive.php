<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout_Pro
 */

get_header(); ?>

	<div id="primary" class="content-area">
        
        <?php 
        /**
         * Before Posts hook
        */
        do_action( 'jobscout_pro_before_posts_content' );
        ?>
        
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : 
        
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

	        /**
	         * After Posts hook
	         * @hooked jobscout_navigation - 15
	        */
	        do_action( 'jobscout_after_posts_content' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
     
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();