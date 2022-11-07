<?php

/*
Plugin Name: RCA Core
Plugin URI: https://chess-teacher.com
Description: Custom plugin for RCA website
Version: 1.0.0
Author URI: https://chess-teacher.com
*/



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


//Loading CSS and Js
function rca_loading_assets() {
    // CSS
    wp_enqueue_style('rca-cbreplay-style', plugins_url( '/assets/css/CBReplay.css' , __FILE__ ) );
    wp_enqueue_style('rca-spinkit', plugins_url( '/assets/css/spinkit.min.css' , __FILE__ ) );
    wp_enqueue_style('rca-custom-style', plugins_url( '/assets/css/custom.css' , __FILE__ ) );

    // JS
    wp_enqueue_script('rca-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    wp_enqueue_script('rca-cbreplay-script', plugins_url('/assets/js/CBReplay.js', __FILE__));
    //wp_enqueue_script('rca-custom-script', plugins_url('/assets/js/custom.js', __FILE__));
}

add_action( 'wp_enqueue_scripts', 'rca_loading_assets' );

require_once( plugin_dir_path( __FILE__ ) . 'inc/widget-popular-latest-posts.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/widget-popular-latest-posts-2.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/widget-categories-list.php' );


// Adding Google Analytics in the <head>
// function rca_google_analytics() { 



// }

// // Add hook for front-end <head></head>
// add_action( 'wp_head', 'rca_google_analytics' );



// Send email notification to another email on new comment
function rca_comment_moderation_recipients( $emails, $comment_id ) {

    // Adding any email
    $emails = array( 'support_manager@chess-teacher.com' );
    return $emails;
}

add_filter( 'comment_moderation_recipients', 'rca_comment_moderation_recipients', 11, 2 );
add_filter( 'comment_notification_recipients', 'rca_comment_moderation_recipients', 11, 2 );

// Add "Author" role embed iframe permission
function add_author_embed_caps() {
    // gets the author role
    $role = get_role( 'author' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'unfiltered_html' );
}
add_action( 'admin_init', 'add_author_embed_caps');

// Allow CORS Access-Control-Allow-Origin
add_filter( 'allowed_http_origin', '__return_true' );