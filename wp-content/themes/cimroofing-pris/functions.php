<?php

add_theme_support( 'post-thumbnails' );

function img_exists($url){
    $headers=get_headers($url);
    return stripos($headers[0],"200 OK")?true:false;
}

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

?>