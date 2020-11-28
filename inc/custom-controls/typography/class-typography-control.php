<?php
/**
 * JobScout Pro Customizer Typography Control
 *
 * @package JobScout_Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'JobScout_Pro_Typography_Control' ) ) {
    
    class JobScout_Pro_Typography_Control extends WP_Customize_Control {
    
    	public $tooltip = '';
    	public $js_vars = array();
    	public $output = array();
    	public $option_type = 'theme_mod';
    	public $type = 'typography';
    
    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function to_json() {
    		parent::to_json();
    
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		} else {
    			$this->json['default'] = $this->setting->default;
    		}
    		$this->json['js_vars'] = $this->js_vars;
    		$this->json['output']  = $this->output;
    		$this->json['value']   = $this->value();
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['tooltip'] = $this->tooltip;
    		$this->json['id']      = $this->id;
    		$this->json['l10n']    = apply_filters( 'jobscout_pro_il8n_strings', array(
    			'on'                 => esc_attr__( 'ON', 'jobscout-pro' ),
    			'off'                => esc_attr__( 'OFF', 'jobscout-pro' ),
    			'all'                => esc_attr__( 'All', 'jobscout-pro' ),
    			'cyrillic'           => esc_attr__( 'Cyrillic', 'jobscout-pro' ),
    			'cyrillic-ext'       => esc_attr__( 'Cyrillic Extended', 'jobscout-pro' ),
    			'devanagari'         => esc_attr__( 'Devanagari', 'jobscout-pro' ),
    			'greek'              => esc_attr__( 'Greek', 'jobscout-pro' ),
    			'greek-ext'          => esc_attr__( 'Greek Extended', 'jobscout-pro' ),
    			'khmer'              => esc_attr__( 'Khmer', 'jobscout-pro' ),
    			'latin'              => esc_attr__( 'Latin', 'jobscout-pro' ),
    			'latin-ext'          => esc_attr__( 'Latin Extended', 'jobscout-pro' ),
    			'vietnamese'         => esc_attr__( 'Vietnamese', 'jobscout-pro' ),
    			'hebrew'             => esc_attr__( 'Hebrew', 'jobscout-pro' ),
    			'arabic'             => esc_attr__( 'Arabic', 'jobscout-pro' ),
    			'bengali'            => esc_attr__( 'Bengali', 'jobscout-pro' ),
    			'gujarati'           => esc_attr__( 'Gujarati', 'jobscout-pro' ),
    			'tamil'              => esc_attr__( 'Tamil', 'jobscout-pro' ),
    			'telugu'             => esc_attr__( 'Telugu', 'jobscout-pro' ),
    			'thai'               => esc_attr__( 'Thai', 'jobscout-pro' ),
    			'serif'              => _x( 'Serif', 'font style', 'jobscout-pro' ),
    			'sans-serif'         => _x( 'Sans Serif', 'font style', 'jobscout-pro' ),
    			'monospace'          => _x( 'Monospace', 'font style', 'jobscout-pro' ),
    			'font-family'        => esc_attr__( 'Font Family', 'jobscout-pro' ),
    			'font-size'          => esc_attr__( 'Font Size', 'jobscout-pro' ),
    			'font-weight'        => esc_attr__( 'Font Weight', 'jobscout-pro' ),
    			'line-height'        => esc_attr__( 'Line Height', 'jobscout-pro' ),
    			'font-style'         => esc_attr__( 'Font Style', 'jobscout-pro' ),
    			'letter-spacing'     => esc_attr__( 'Letter Spacing', 'jobscout-pro' ),
    			'text-align'         => esc_attr__( 'Text Align', 'jobscout-pro' ),
    			'text-transform'     => esc_attr__( 'Text Transform', 'jobscout-pro' ),
    			'none'               => esc_attr__( 'None', 'jobscout-pro' ),
    			'uppercase'          => esc_attr__( 'Uppercase', 'jobscout-pro' ),
    			'lowercase'          => esc_attr__( 'Lowercase', 'jobscout-pro' ),
    			'top'                => esc_attr__( 'Top', 'jobscout-pro' ),
    			'bottom'             => esc_attr__( 'Bottom', 'jobscout-pro' ),
    			'left'               => esc_attr__( 'Left', 'jobscout-pro' ),
    			'right'              => esc_attr__( 'Right', 'jobscout-pro' ),
    			'center'             => esc_attr__( 'Center', 'jobscout-pro' ),
    			'justify'            => esc_attr__( 'Justify', 'jobscout-pro' ),
    			'color'              => esc_attr__( 'Color', 'jobscout-pro' ),
    			'select-font-family' => esc_attr__( 'Select a font-family', 'jobscout-pro' ),
    			'variant'            => esc_attr__( 'Variant', 'jobscout-pro' ),
    			'style'              => esc_attr__( 'Style', 'jobscout-pro' ),
    			'size'               => esc_attr__( 'Size', 'jobscout-pro' ),
    			'height'             => esc_attr__( 'Height', 'jobscout-pro' ),
    			'spacing'            => esc_attr__( 'Spacing', 'jobscout-pro' ),
    			'ultra-light'        => esc_attr__( 'Ultra-Light 100', 'jobscout-pro' ),
    			'ultra-light-italic' => esc_attr__( 'Ultra-Light 100 Italic', 'jobscout-pro' ),
    			'light'              => esc_attr__( 'Light 200', 'jobscout-pro' ),
    			'light-italic'       => esc_attr__( 'Light 200 Italic', 'jobscout-pro' ),
    			'book'               => esc_attr__( 'Book 300', 'jobscout-pro' ),
    			'book-italic'        => esc_attr__( 'Book 300 Italic', 'jobscout-pro' ),
    			'regular'            => esc_attr__( 'Normal 400', 'jobscout-pro' ),
    			'italic'             => esc_attr__( 'Normal 400 Italic', 'jobscout-pro' ),
    			'medium'             => esc_attr__( 'Medium 500', 'jobscout-pro' ),
    			'medium-italic'      => esc_attr__( 'Medium 500 Italic', 'jobscout-pro' ),
    			'semi-bold'          => esc_attr__( 'Semi-Bold 600', 'jobscout-pro' ),
    			'semi-bold-italic'   => esc_attr__( 'Semi-Bold 600 Italic', 'jobscout-pro' ),
    			'bold'               => esc_attr__( 'Bold 700', 'jobscout-pro' ),
    			'bold-italic'        => esc_attr__( 'Bold 700 Italic', 'jobscout-pro' ),
    			'extra-bold'         => esc_attr__( 'Extra-Bold 800', 'jobscout-pro' ),
    			'extra-bold-italic'  => esc_attr__( 'Extra-Bold 800 Italic', 'jobscout-pro' ),
    			'ultra-bold'         => esc_attr__( 'Ultra-Bold 900', 'jobscout-pro' ),
    			'ultra-bold-italic'  => esc_attr__( 'Ultra-Bold 900 Italic', 'jobscout-pro' ),
    			'invalid-value'      => esc_attr__( 'Invalid Value', 'jobscout-pro' ),
    		) );
    
    		$defaults = array( 'font-family'=> false );
    
    		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
    	}
    
    	/**
    	 * Enqueue scripts and styles.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function enqueue() {
    		wp_enqueue_style( 'jobscout-pro-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.css', null );
            
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-tooltip' );
    		wp_enqueue_script( 'jquery-stepper-min-js' );
    		wp_enqueue_script( 'jobscout-pro-selectize', get_template_directory_uri() . '/inc/js/selectize.js', array( 'jquery' ), false, true );
    		wp_enqueue_script( 'jobscout-pro-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.js', array( 'jquery', 'jobscout-pro-selectize' ), false, true );
    
    		$google_fonts   = JobScout_Pro_Fonts::get_google_fonts();
    		$standard_fonts = JobScout_Pro_Fonts::get_standard_fonts();
    		$all_variants   = JobScout_Pro_Fonts::get_all_variants();
    
    		$standard_fonts_final = array();
    		foreach ( $standard_fonts as $key => $value ) {
    			$standard_fonts_final[] = array(
    				'family'      => $value['stack'],
    				'label'       => $value['label'],
    				'is_standard' => true,
    				'variants'    => array(
    					array(
    						'id'    => 'regular',
    						'label' => $all_variants['regular'],
    					),
    					array(
    						'id'    => 'italic',
    						'label' => $all_variants['italic'],
    					),
    					array(
    						'id'    => '700',
    						'label' => $all_variants['700'],
    					),
    					array(
    						'id'    => '700italic',
    						'label' => $all_variants['700italic'],
    					),
    				),
    			);
    		}
    
    		$google_fonts_final = array();
    
    		if ( is_array( $google_fonts ) ) {
    			foreach ( $google_fonts as $family => $args ) {
    				$label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
    				$variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
    
    				$available_variants = array();
    				foreach ( $variants as $variant ) {
    					if ( array_key_exists( $variant, $all_variants ) ) {
    						$available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
    					}
    				}
    
    				$google_fonts_final[] = array(
    					'family'   => $family,
    					'label'    => $label,
    					'variants' => $available_variants
    				);
    			}
    		}
    
    		$final = array_merge( $standard_fonts_final, $google_fonts_final );
    		wp_localize_script( 'jobscout-pro-typography', 'all_fonts', $final );
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * I put this in a separate file because PhpStorm didn't like it and it fucked with my formatting.
    	 *
    	 * @see    WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 * @return void
    	 */
    	protected function content_template(){ ?>
    		<# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            
            <div class="wrapper">
                <# if ( data.default['font-family'] ) { #>
                    <# if ( '' == data.value['font-family'] ) { data.value['font-family'] = data.default['font-family']; } #>
                    <# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
                    <div class="font-family">
                        <h5>{{ data.l10n['font-family'] }}</h5>
                        <select id="jobscout-pro-typography-font-family-{{{ data.id }}}" placeholder="{{ data.l10n['select-font-family'] }}"></select>
                    </div>
                    <div class="variant jobscout-pro-variant-wrapper">
                        <h5>{{ data.l10n['style'] }}</h5>
                        <select class="variant" id="jobscout-pro-typography-variant-{{{ data.id }}}"></select>
                    </div>
                <# } #>   
                
            </div>
            <?php
    	}    
    }
}