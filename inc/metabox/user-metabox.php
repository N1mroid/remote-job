<?php 
/**
* JobScout Pro Metabox for Sidebar Layout
*
* @package JobScout_Pro
*/

/**
 * User Profile Extra Fields
 */
function jobscout_pro_user_fields( $user ) { 
    
    wp_nonce_field( basename( __FILE__ ), 'jobscout_pro_user_fields_nonce' ); 
    
    if( is_string( $user ) === true ){
        $user = new stdClass();//create a new
        $id = -9999;
        unset( $user );
    }else{
        $id = $user->ID;
    }
    
    $defaults = apply_filters( 'jobscout_pro_user_social_icons', array( 
        'facebook'     => '', 
        'twitter'      => '',
        'instagram'    => '',
        'snapchat'     => '',
        'pinterest'    => '',
        'linkedin'     => '',
        'google-plus'  => '',
        'youtube'      => ''
    ) );
    $social_icons = get_user_meta( $id, '_jobscout_pro_user_social_icons', true );
    
    $social_icons = $social_icons ? $social_icons : $defaults; ?>
    
    <h3><?php esc_html_e( 'User Social Link', 'jobscout-pro' ); ?></h3>
    
    <ul class="user-social-sortable-icons">    
        <?php foreach( $social_icons as $k => $v ){ ?>        
        <li>
            <label for="<?php echo esc_attr( $k ); ?>"><?php printf( esc_html__( '%s :', 'jobscout-pro' ), ucfirst( $k ) ); ?></label>            
            <input type="text" name="jobscout_pro_user_social_icons[<?php echo esc_attr( $k ); ?>]" id="<?php echo esc_attr( $k ); ?>" value="<?php echo isset( $v ) ? esc_attr( $v ) : ''; ?>" class="regular-text" /><br />
            <span class="description"><?php printf( esc_html__( 'Please enter your %s Url.', 'jobscout-pro' ), ucfirst( $k ) ); ?></span>
        <?php } ?>                  
    </ul>
<?php 
}
/** Hooks to add extra field in profile */
add_action( 'show_user_profile', 'jobscout_pro_user_fields' ); // editing your own profile
add_action( 'edit_user_profile', 'jobscout_pro_user_fields' ); // editing another user
add_action( 'user_new_form', 'jobscout_pro_user_fields' ); // creating a new user

/**
 * Saving Extra User Profile Information
*/ 
function jobscout_pro_save_user_fields( $user_id ) {
    $socials = array();
    // Check if our nonce is set.
	if ( ! isset( $_POST['jobscout_pro_user_fields_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['jobscout_pro_user_fields_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

    if ( !current_user_can( 'edit_user', $user_id ) ) return false;
    
    if( isset( $_POST['jobscout_pro_user_social_icons'] ) ){
        foreach( $_POST['jobscout_pro_user_social_icons'] as $key => $links ){
            $socials[$key] = esc_url_raw( $links );
        }
        update_user_meta( $user_id, '_jobscout_pro_user_social_icons', $socials );
    }
}
/** Hook to Save Extra User Fields */
add_action( 'personal_options_update', 'jobscout_pro_save_user_fields' );
add_action( 'edit_user_profile_update', 'jobscout_pro_save_user_fields' );
add_action( 'user_register', 'jobscout_pro_save_user_fields' );