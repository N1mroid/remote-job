jQuery(document).ready(function($){
    /* Move Fornt page widgets to frontpage panel */
    wp.customize.section( 'sidebar-widgets-contact-template-left' ).panel( 'contact_page_setting' );
    wp.customize.section( 'sidebar-widgets-contact-template-right' ).panel( 'contact_page_setting' );
    
    //Scroll to front page section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });    
    
    /* Home page preview url */
    wp.customize.panel( 'frontpage_settings', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( jobscout_pro_cdata.home );
            }
        });
    });
    
    /* Contact Page preview url */
    wp.customize.panel( 'contact_page_setting', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( jobscout_pro_cdata.contact );
            }
        });
    });

    $('#sub-accordion-section-body_settings').on( 'click', '.typography_text', function(e){
        e.preventDefault();
        wp.customize.control( 'ed_googlefont_local' ).focus();        
    });

    $('#sub-accordion-section-performance_settings').on( 'click', '.ed_googlefont_local', function(e){
        e.preventDefault();
        wp.customize.control( 'typography_text' ).focus();        
    }); 

});

function scrollToSection( section_id ){
    var preview_section_id = "banner-section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {

        case 'accordion-section-header_image':
        preview_section_id = "banner-section";
        break;

        case 'accordion-section-popular_section':
        preview_section_id = "popular-section";
        break;
        
        case 'accordion-section-job_posting_section':
        preview_section_id = "job-posting-section";
        break;
        
        case 'accordion-section-step_section':
        preview_section_id = "step-section";
        break;
        
        case 'accordion-section-sidebar-widgets-cta':
        preview_section_id = "cta-section";
        break;

        case 'accordion-section-blog_section':
        preview_section_id = "blog-section";
        break;
        
        case 'accordion-section-sidebar-widgets-testimonial':
        preview_section_id = "testimonial-section";
        break;
        
        case 'accordion-section-sidebar-widgets-client':
        preview_section_id = "client-section";
        break;

        case 'accordion-section-sort_front_page_settings':
        preview_section_id = "banner-section";
        break;

        case 'accordion-section-one_page_settings':
        preview_section_id = "banner-section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}