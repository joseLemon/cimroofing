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

function GenerateThumbnail($im_filename,$th_filename,$max_width,$max_height,$quality = 0.75) {
// The original image must exist
    if(is_file($im_filename))
    {
        // Let's create the directory if needed
        $th_path = dirname($th_filename);
        if(!is_dir($th_path))
            mkdir($th_path, 0777, true);
        // If the thumb does not aleady exists
        if(!is_file($th_filename))
        {
            // Get Image size info
            list($width_orig, $height_orig, $image_type) = @getimagesize($im_filename);
            if(!$width_orig)
                return 2;
            switch($image_type)
            {
                case 1: $src_im = @imagecreatefromgif($im_filename);    break;
                case 2: $src_im = @imagecreatefromjpeg($im_filename);   break;
                case 3: $src_im = @imagecreatefrompng($im_filename);    break;
            }
            if(!$src_im)
                return 3;


            $aspect_ratio = (float) $height_orig / $width_orig;

            $thumb_height = $max_height;
            $thumb_width = round($thumb_height / $aspect_ratio);
            if($thumb_width > $max_width)
            {
                $thumb_width    = $max_width;
                $thumb_height   = round($thumb_width * $aspect_ratio);
            }

            $width = $thumb_width;
            $height = $thumb_height;

            $dst_img = @imagecreatetruecolor($width, $height);
            if(!$dst_img)
                return 4;
            $success = @imagecopyresampled($dst_img,$src_im,0,0,0,0,$width,$height,$width_orig,$height_orig);
            if(!$success)
                return 4;
            switch ($image_type)
            {
                case 1: $success = @imagegif($dst_img,$th_filename); break;
                case 2: $success = @imagejpeg($dst_img,$th_filename,intval($quality*100));  break;
                case 3: $success = @imagepng($dst_img,$th_filename,intval($quality*9)); break;
            }
            if(!$success)
                return 4;
        }
        return 0;
    }
    return 1;
}

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

?>