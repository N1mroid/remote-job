<?php
/**
 * JobScout Pro Demo Import Hooks.
 *
 * @package jobscout_pro 
 */
 
/** Import content data*/
if ( ! function_exists( 'jobscout_pro_import_files' ) ) :
function jobscout_pro_import_files() {
    return array(
        array(
            'import_file_name'             => 'Default Layout',
            'import_file_url'              => 'https://rarathemesdemo.com/wp-content/uploads/2020/06/jobscoutpro.xml',
            'import_widget_file_url'       => 'https://rarathemesdemo.com/wp-content/uploads/2020/06/jobscoutpro.wie',
            'import_customizer_file_url'   => 'https://rarathemesdemo.com/wp-content/uploads/2020/06/jobscoutpro.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.png',
            'import_notice'                => __( 'Please wait for about 10 - 15 minutes. Do not close or refresh the page until the import is complete.', 'jobscout-pro' ),
        ),
    );       
}
add_filter( 'rrdi/import_files', 'jobscout_pro_import_files' );
endif;

/** Programmatically set the front page and menu */
if ( ! function_exists( 'jobscout_pro_after_import' ) ) :

function jobscout_pro_after_import( $selected_import ) {
 
    if ( 'Default Layout' === $selected_import['import_file_name'] ) {
        //Set Menu
        $primary   = get_term_by('name', 'Primary', 'nav_menu');        
        $secondary = get_term_by('name', 'Secondary', 'nav_menu');        
        
        set_theme_mod( 'nav_menu_locations', 
            array( 
                'primary'   => $primary->term_id,
                'secondary' => $secondary->term_id
            )
        );  
    }
    /** Set Front page */
    $page = get_page_by_path('home'); /** This need to be slug of the page that is assigned as Front page */
        if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
        update_option( 'show_on_front', 'page' );
    }
    /** Blog Page */
    $postpage = get_page_by_path('blog'); /** This need to be slug of the page that is assigned as Posts page */
    if( $postpage ){
        $post_pgid = $postpage->ID;
        update_option( 'page_for_posts', $post_pgid );
    }

    /** For Trip Taxonomy Images */
    $array = array(
        '12' => '28',
        '13' => '35',
        '14' => '36',   
        '15' => '27',
        '17' => '37',
        '18' => '29',        
        '20' => '26',
        '25' => '25',
    );
    foreach( $array as $k => $v ){
        add_term_meta( $k, 'category-image-id', $v );        
    }

}
add_action( 'rrdi/after_import', 'jobscout_pro_after_import' );
endif;

function jobscout_pro_import_msg(){
    return __( 'Before you begin, make sure all recommended plugins are activated.', 'jobscout-pro' );
}
add_filter( 'rrdi_before_import_msg', 'jobscout_pro_import_msg' );