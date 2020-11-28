<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JobScout_Pro
 */
    /**
     * Doctype Hook
     * 
     * @hooked jobscout_pro_doctype
    */
    do_action( 'jobscout_pro_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked jobscout_pro_head
    */
    do_action( 'jobscout_pro_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php
    wp_body_open();
    
    /**
     * Before Header
     * @hooked jobscout_pro_responsive_header - 15
     * @hooked jobscout_pro_page_start - 20 
    */
    do_action( 'jobscout_pro_before_header' );
    
    /**
     * Header
     * 
     * @hooked jobscout_pro_header - 20     
    */
    do_action( 'jobscout_pro_header' );
    
    /**
     * Content
     * 
     * @hooked jobscout_pro_breadcrumbs_bar
    */
    do_action( 'jobscout_pro_after_header' );
    /**
     * Content
     * 
     * @hooked jobscout_pro_content_start
    */
    do_action( 'jobscout_pro_content' );