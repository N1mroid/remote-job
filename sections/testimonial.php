<?php
/**
 * Testimonial Section
 * 
 * @package JobScout_Pro
 */

$section_title = get_theme_mod( 'testimonial_section_title', __( 'Clients Testimonials', 'jobscout-pro' ) );
$section_desc  = get_theme_mod( 'testimonial_section_subtitle', __( 'We&rsquo;ll help you find it. We&rsquo;re your first step to becoming everything you want to be.', 'jobscout-pro' ) );
$bg_control    =  get_theme_mod( 'testimonial_section_bg_control', 'bg_image' );
$bg_image      =  get_theme_mod( 'testimonial_section_bg_image', get_template_directory_uri().'/images/testimonial-bg.jpg' );
$bg_color      =  get_theme_mod( 'testimonial_section_bg_color', '#2ace5e' );

if ( 'bg_image' == $bg_control ){
    if( $bg_image ){
        $section_style = 'background-image: url(' . esc_url( $bg_image ) . '); background-repeat: no-repeat;';
    } else {
        $section_style = 'background-color: #2ace5e;';
    }
} else {
    $section_style = ! empty( $bg_color ) ? 'background-color:' . $bg_color : 'background-color: #2ace5e;';
}

if( $section_title || $section_desc ||  is_active_sidebar( 'testimonial' ) ){ ?>
	<section id="testimonial-section" class="testimonial-section" <?php echo 'style="'. esc_attr( $section_style ) .'"'; ?>>
		<?php if( $section_title || $section_desc ){ ?>
			<div class="container">
				<?php 
					if( $section_title ) echo '<h2 class="section-title">'. esc_html( $section_title ) .'</h2>';
					if( $section_desc ) echo '<div class="section-desc">'. wpautop( wp_kses_post( $section_desc ) ) .'</div>';
				?>
			</div>
		<?php } 
		if( is_active_sidebar( 'testimonial' ) ) { ?>
			<div class="widgets-wrap owl-carousel">
		   		<?php dynamic_sidebar( 'testimonial' ); ?>
		   </div><!-- .widgets-wrap -->
		<?php } ?>

	</section> <!-- .testimonial-section -->
	<?php
}