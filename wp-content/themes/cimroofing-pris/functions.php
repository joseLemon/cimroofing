<?php

add_theme_support( 'post-thumbnails' );

function img_exists($url){
	$headers=get_headers($url);
	return stripos($headers[0],"200 OK")?true:false;
}

//  USER REDIRECTS
add_action('template_redirect','redirect_controller');
function redirect_controller() {
	if( ( is_page('project-history') || is_page('editinspectionform') || is_page('editproject') || is_page('editreport')
	      || is_page('inspectionform') || is_page('inspectionhistory') || is_page('newproject') || is_page('reportform')
	      || is_page('reportpdf') ) && !is_user_logged_in() ) {
		wp_redirect( home_url().'/projects' );
		die();
	} else if( ( is_page('editinspectionform') || is_page('editproject') || is_page('inspectionform') || is_page('inspectionhistory')
	             || is_page('newproject') || is_page('reportform') || is_page('reportpdf') ) && !current_user_can('manage_options')) {
		wp_redirect( home_url().'/projects' );
		die();
	}
}

add_action('login_head', 'custom_loginlogo');
function custom_loginlogo() {
	echo '
	<style type="text/css">
		h1 a {
		background: url('.get_bloginfo('template_directory').'/img/logo.png) no-repeat center center!important; 
		background-size: cover;
		width: 320px!important;
		height: 110px!important;
		}
	</style>
	';
}

/*
add_filter('login_redirect', 'admin_default_page');
function admin_default_page() {
	if ( !current_user_can('manage_options') ) {
		return home_url().'/inspectionhistory';
	}
}
*/

add_action( 'wp_login_failed', 'custom_login_failed' );
function custom_login_failed( $username ) {
	$referrer = wp_get_referer();

	if ( $referrer && ! strstr($referrer, 'wp-login') && ! strstr($referrer,'wp-admin') )
	{
		wp_redirect( add_query_arg('login', 'failed', $referrer) );
		exit;
	}
}

add_action('wp_logout', 'logout_redirect');
function logout_redirect(){
	wp_safe_redirect(home_url().'/projects');
	exit;
}

/*add_filter( 'authenticate', 'custom_authenticate_username_password', 30, 3);
function custom_authenticate_username_password( $user, $username, $password )
{
	if ( is_a($user, 'WP_User') ) { return $user; }

	if ( empty($username) || empty($password) )
	{
		$error = new WP_Error();
		$user  = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));

		return $error;
	}
}*/

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

?>