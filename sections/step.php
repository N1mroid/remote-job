<?php
/**
 * Step Section
 * 
 * @package JobScout_Pro
 */

$title = get_theme_mod( 'step_section_title', __( 'How It Works', 'jobscout-pro' ) );
$steps = get_theme_mod( 'step_section_steps', array() );

if( $title || $steps ){ ?>
	<section id="step-section" class="howitwork-section">
		<div class="container">
			<?php 
				if( $steps ){
					if( $title ) echo '<h2 class="section-title">'. esc_html( $title ) .'</h2>'; 
					$i = 1;
					$step_count = count( $steps );
					$step_class = ' steps-'. $step_count;
					echo '<div class="step-wrap'. esc_attr( $step_class ) .'">';
						foreach ( $steps as $step ) { ?>
								<div class="step-block">
									<div class="step-count"><?php esc_html_e( 'Step ', 'jobscout-pro' ); ?><span class="step-num"><?php echo absint( $i ); ?></span>
									</div>
									<?php  
										if( $step['title'] ) echo '<h3 class="title">'. esc_html( $step['title'] ) .'</h3>'; 
										if( $step['subtitle'] ) echo '<div class="description">'. esc_html( $step['subtitle'] ) .'</div>'; 
									?>
								</div>
							<?php
							$i++;
						}
					echo '</div>';
				}
			?>
		</div>
	</section> <!-- .howitwork-section -->
<?php }
