<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout_Pro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
        /**
         * 
         * @hooked jobscout_pro_entry_header - 10
         * @hooked jobscout_pro_post_thumbnail - 15
        */
        do_action( 'jobscout_pro_before_single_post_entry_content' );
    

        /**
         * @hooked jobscout_pro_entry_content - 15
         * @hooked jobscout_pro_entry_footer  - 20
        */
        do_action( 'jobscout_pro_single_post_entry_content' );
        
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
