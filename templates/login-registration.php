<?php
/**
 * Template Name: Login and Registration
 * 
 * @package JobScout_Pro
 */

get_header(); 

global $user_login;
?>
    <div class="jbp-loginform">
    	<h1 class="jbp_header"><?php esc_html_e( 'Login to Dashboard', 'jobscout-pro' ); ?></h1>
        <?php 
            // In case of a login error.
            if ( isset( $_POST['login'] ) && $_POST['login'] == 'failed' ) : ?>
    	            <div class="jpp_login_error">
    		            <p><?php esc_html_e(  'FAILED: Try again!', 'jobscout-pro' ); ?></p>
    	            </div>
            <?php 
                endif;
            // If user is already logged in.
            if ( is_user_logged_in() ) : ?>

                <div class="jbp-logout"> 
                    
                    <?php printf( esc_html__( 'You are already logged in as %s.', 'jobscout-pro' ), $user_login ); ?>

                </div>

                <a id="wp-submit" href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" title="<?php esc_html_e( 'Logout', 'jobscout-pro' ); ?>">
                    <?php esc_html_e(  'Logout', 'jobscout-pro' ); ?>
                </a>

            <?php 
                // If user is not logged in.
                else: 
                	$job_dashboard = get_option( 'job_manager_job_dashboard_page_id' );
					$form_action   = $job_dashboard ? get_the_permalink( $job_dashboard ) :  home_url( '/' );
                    // Login form arguments.
                    $args = array(
                        'echo'           => true,
                        'redirect'       => $form_action, 
                        'form_id'        => 'loginform',
                        'label_username' => __( 'Username' , 'jobscout-pro' ),
                        'label_password' => __( 'Password' , 'jobscout-pro' ),
                        'label_remember' => __( 'Remember Me', 'jobscout-pro'  ),
                        'label_log_in'   => __( 'Log In', 'jobscout-pro'  ),
                        'id_username'    => 'user_login',
                        'id_password'    => 'user_pass',
                        'id_remember'    => 'rememberme',
                        'id_submit'      => 'wp-submit',
                        'remember'       => true,
                        'value_username' => NULL,
                        'value_remember' => false
                    ); 
                    
                    // Calling the login form.
                    wp_login_form( $args );
                endif;
        ?> 

	</div>

<?php 

// only show the registration form to non-logged-in members
if( ! is_user_logged_in() ) {

	echo '<div class="jbp-newuser">';

	// check to make sure user registration is enabled
	$registration_enabled = get_option('users_can_register');
			?>
		<h2 class="jbp_header"><?php esc_html_e( 'Register New Account', 'jobscout-pro' ); ?></h2>
	<?php
	// only show the registration form if allowed
	if( $registration_enabled ) {

		if( ! is_user_logged_in() ){ 

			if ( isset( $_POST['jbp_user_login'] ) && '' != $_POST['jbp_user_login'] && wp_verify_nonce($_POST['jbp_register_nonce'], 'jbp-register-nonce') ) {
				$user_login		= $_POST["jbp_user_login"];	
				$user_email		= $_POST["jbp_user_email"];
				$user_role		= $_POST["jbp_user_role"];
				$user_first 	= $_POST["jbp_user_first"];
				$user_last	 	= $_POST["jbp_user_last"];
				$user_pass		= $_POST["jbp_user_pass"];
				$pass_confirm 	= $_POST["jbp_user_pass_confirm"];
		 
				// this is required for username checks
				// require_once( ABSPATH . WPINC . '/registration.php');
		 
				if(username_exists($user_login)) {
					// Username already registered
					jbp_errors()->add('username_unavailable', __( 'Username already taken', 'jobscout-pro' ));
				}
				if(!validate_username($user_login)) {
					// invalid username
					jbp_errors()->add('username_invalid', __( 'Invalid username', 'jobscout-pro' ));
				}
				if($user_login == '') {
					// empty username
					jbp_errors()->add('username_empty', __( 'Please enter a username', 'jobscout-pro' ));
				}
				if(!is_email($user_email)) {
					//invalid email
					jbp_errors()->add('email_invalid', __( 'Invalid email', 'jobscout-pro' ));
				}
				if(email_exists($user_email)) {
					//Email address already registered
					jbp_errors()->add('email_used', __( 'Email already registered', 'jobscout-pro' ));
				}
				if( $user_pass == '') {
					// passwords do not match
					jbp_errors()->add('password_empty', __( 'Please enter a password', 'jobscout-pro' ));
				}
				if($user_pass != $pass_confirm) {
					// passwords do not match
					jbp_errors()->add('password_mismatch', __( 'Passwords do not match', 'jobscout-pro' ));
				}
		 
				$errors = jbp_errors()->get_error_messages();

				// only create the user in if there are no errors
				if( empty( $errors ) ) {
		 
					$new_user_id = wp_insert_user(array(
							'user_login'		=> $user_login,
							'user_pass'	 		=> $user_pass,
							'user_email'		=> $user_email,
							'first_name'		=> $user_first,
							'last_name'			=> $user_last,
							'user_registered'	=> date('Y-m-d H:i:s'),
							'role'				=> $user_role
						)
					);


					if( $new_user_id ) {
						echo '<div class="rbp-registration-success">';
							printf( esc_html__( 'A mail has been sent to your Sign Up email address %1$s. Please follow the link to activate your account%2$s If you don&rsquo;t get an email, please check your spam folder.', 'jobscout-pro' ), $user_pass ,'</br>' );
						echo '</div>';
					}
		 
				}else{
					jbp_show_error_messages(); 
				}
		 	}
			?>
 			
			<form id="jbp_registration_form" class="jbp_form" action="" method="POST">
				<fieldset>
					<p>
						<label for="jbp_user_Login"><?php esc_html_e( 'Username', 'jobscout-pro' ); ?></label>
						<input name="jbp_user_login" id="jbp_user_login" class="required" type="text"/>
					</p>
					<p>
						<label for="jbp_user_email"><?php esc_html_e( 'Email', 'jobscout-pro' ); ?></label>
						<input name="jbp_user_email" id="jbp_user_email" class="required" type="email"/>
					</p>
					<p>
						<label for="jbp_user_role"><?php esc_html_e( 'User Role', 'jobscout-pro' ); ?></label>
						<select name="jbp_user_role" id="jbp_user_role">
							<option value="jbp_employer"><?php esc_html_e(  'Employer', 'jobscout-pro' ); ?></option>
							<option value="jbp_job_seeker"><?php esc_html_e(  'Job Seeker', 'jobscout-pro' ); ?></option>
						</select>
					</p>
					<p>
						<label for="jbp_user_first"><?php esc_html_e( 'First Name', 'jobscout-pro' ); ?></label>
						<input name="jbp_user_first" id="jbp_user_first" type="text"/>
					</p>
					<p>
						<label for="jbp_user_last"><?php esc_html_e( 'Last Name', 'jobscout-pro' ); ?></label>
						<input name="jbp_user_last" id="jbp_user_last" type="text"/>
					</p>
					<p>
						<label for="password"><?php esc_html_e( 'Password', 'jobscout-pro' ); ?></label>
						<input name="jbp_user_pass" id="password" class="required" type="password"/>
					</p>
					<p>
						<label for="password_again"><?php esc_html_e( 'Password Again', 'jobscout-pro' ); ?></label>
						<input name="jbp_user_pass_confirm" id="password_again" class="required" type="password"/>
					</p>
					<p>
						<input type="hidden" name="jbp_register_nonce" value="<?php echo wp_create_nonce('jbp-register-nonce'); ?>"/>
						<input type="submit" name="jbp_newuser_submit" value="<?php esc_html_e( 'Register Your Account', 'jobscout-pro' ); ?>"/>
					</p>
				</fieldset>
			</form>
			<?php
		} else {
			printf( esc_html__( 'You are already logged in as %s.', 'jobscout-pro' ), $user_login );
		}	
	} else {
		esc_html_e( 'User registration is not enabled', 'jobscout-pro' );
	}

	echo '</div>';
}

get_footer(); 