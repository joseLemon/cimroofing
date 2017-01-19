<?php
/*
Plugin Name: Login Form
Plugin URI: http://lemonthree.mx
Description: Login form to grant access to the site and full functions.
Version: 1.1
Author: José Angel Lujan
Author URI: http://lemonthree.mx
*/

function login_form() {	?>
    <div class="login-form">
        <div class="row no-margin">
            <div class="">
				<?php wp_login_form(); ?>
            </div>
        </div>
        <div class="center-block">
            <a href="<?php echo home_url().'/wp-login.php?action=lostpassword'; ?> ">Forgot your password?</a>
        </div>
    </div>
	<?php
}

function login_auth( $username, $password ) {
	global $user;
	$creds = array();
	$creds['user_login'] = $username;
	$creds['user_password'] =  $password;
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	if ( is_wp_error($user) ) {
		echo $user->get_error_message();
	}
	if ( !is_wp_error($user) ) {
		wp_redirect(home_url('wp-admin'));
	}
}

function login_process() {
	if (isset($_POST['login_submit'])) {
		login_auth($_POST['login_name'], $_POST['login_password']);
	}

	login_form();
}

function add_style() {
	wp_enqueue_style('bootstrap-min-css', get_template_directory_uri().'/css/bootstrap.min.css' );
	wp_enqueue_style('style', get_template_directory_uri().'style.css' );
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js' );
}

function login_shortcode() {
	ob_start();
	login_process();
	return ob_get_clean();
}

add_shortcode('login_form', 'login_shortcode');