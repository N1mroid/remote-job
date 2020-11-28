<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout_Pro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Blog">
	<?php 
        /**
         * @hooked jobscout_pro_post_thumbnail - 10
        */
        do_action( 'jobscout_pro_before_post_entry_content' );

        echo '<div class="content-wrap">';
        /**
         * @hooked jobscout_pro_entry_header  - 10 
         * @hooked jobscout_pro_entry_content - 15
         * @hooked jobscout_pro_entry_footer  - 20
        */
        do_action( 'jobscout_pro_post_entry_content' );
        
        echo '</div>';
    ?>
</article><!-- #post-<?php the_ID(); ?> -->