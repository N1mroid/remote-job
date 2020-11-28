<?php
/**
 * Popular Section
 * 
 * @package JobScout_Pro
 */

$title                   = get_theme_mod( 'popular_section_title', __( 'Popular Categories', 'jobscout-pro' ) );
$sub_title               = get_theme_mod( 'popular_section_subtitle', __( 'We&rsquo;re your first step to becoming everything you want to be.', 'jobscout-pro' ) );
$ed_popular_options      = get_theme_mod( 'ed_popular_options', 'job_type' );
$job_categories          = get_theme_mod( 'popular_job_categories', array() );
$job_types               = get_theme_mod( 'popular_job_types', array() );

if( is_wp_job_manager_activated() || $title || $sub_title ){ ?>
    <section id="popular-section" class="category-section">
        <div class="container">
            <?php
                if( $title || $sub_title ){
                    echo '<section class="widget widget_text">';
                        if( $title ) echo '<h2 class="section-title">'. esc_html( $title ) .'</h2>';
                        if( $sub_title ) echo '<div class="section-desc">'. wpautop( wp_kses_post( $sub_title ) ) .'</div>';
                    echo '</section>';
                }

                if( is_wp_job_manager_activated() ){
                                                        
                    if( $ed_popular_options == 'job_type' && $job_types ){
                        foreach ( $job_types as $type ) { 
                            $term_type_obj      = get_term_by( 'slug', $type['job_type'], 'job_listing_type' );
                            ?>
                            <section class="widget widget_rrtc_icon_text_widget">        
                                <div class="rtc-itw-holder">

                                    <?php if( $term_type_obj ){ 
                                        $term_image_id = get_term_meta( $term_type_obj->term_id, 'category-image-id', true ); 
                                        ?>
                                        <div class="rtc-itw-inner-holder">
                                            <div class="text-holder">
                                                  <a href="<?php echo esc_url( get_term_link( $term_type_obj->term_id ) ); ?>"><?php 
                                                    if( $term_type_obj->name ){
                                                        echo ' <h2 class="widget-title">'. esc_html( $term_type_obj->name ) .'</h2>';
                                                    }
                                                ?></a>
                                                <div class="content">
                                                    <p><?php echo ( absint( $term_type_obj->count ). __( ' Open Vacancies', 'jobscout-pro' ) ) ?></p>
                                                </div>
                                            </div>
                                            <?php 
                                            echo '<div class="icon-holder">';
                                                if( $term_image_id ){ 
                                                    echo wp_get_attachment_image( $term_image_id, 'thumbnail', false, array( 'alt' => esc_html( $term_type_obj->name ) ) );
                                                }else{
                                                    jobscout_pro_fallback_svg_image( 'thumbnail' );
                                                } 
                                            echo '</div>'; ?>
                                        </div>
                                    <?php } ?>

                                </div>
                            </section>
                        <?php
                        }
                    }elseif( $ed_popular_options == 'job_category' && $job_categories ){
                        foreach ( $job_categories as $category ) { 
                            $term_cat_obj      = get_term_by( 'slug', $category['job_cat'], 'job_listing_category' );
                            ?>
                            <section class="widget widget_rrtc_icon_text_widget">        
                                <div class="rtc-itw-holder">
                                    <?php if( $term_cat_obj ){ 
                                        $term_image_id = get_term_meta( $term_cat_obj->term_id, 'category-image-id', true ); 
                                        ?>
                                        <div class="rtc-itw-inner-holder">
                                            <div class="text-holder">
                                                  <a href="<?php echo esc_url( get_term_link( $term_cat_obj->term_taxonomy_id ) ); ?>">
                                                    <?php 
                                                        if( $term_cat_obj->name ){
                                                            echo ' <h2 class="widget-title">'. esc_html( $term_cat_obj->name ) .'</h2>';
                                                        }
                                                     ?>
                                                </a>
                                                <div class="content">
                                                    <p><?php echo ( absint( $term_cat_obj->count ). __( ' Open Vacancies', 'jobscout-pro' ) ) ?></p>
                                                </div>
                                            </div>
                                            <?php 
                                            echo '<div class="icon-holder">';
                                                if( $term_image_id ){ 
                                                    echo wp_get_attachment_image( $term_image_id, 'thumbnail', false, array( 'alt' => esc_html( $term_cat_obj->name ) ) );
                                                }else{
                                                    jobscout_pro_fallback_svg_image( 'thumbnail' );
                                                } 
                                            echo '</div>'; ?>
                                        </div>
                                    <?php } ?>

                                </div>
                            </section>
                        <?php
                        }
                    } 
                }
            ?>
        </div>
    </section> <!-- .category-section -->
    <?php 
}