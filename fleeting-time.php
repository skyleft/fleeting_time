<?php

/*
Plugin Name: Fleeting Time
Plugin URI: http://andy-cheung.me
Description: Add some fleeting time flag to your post according to the post time
Version: 1.0
Author: andy
Author URI: http://andy-cheung.me
License: GPL2
*/

    define( 'FLEETING_HOME', dirname( __FILE__ ) . '/' );

    require_once('admin/admin.php');

    add_action('init','fleeting_init');

    if(is_admin()){
        add_action('admin_menu', 'fleeting_admin_menu');
    }

    function fleeting_init(){
        load_plugin_textdomain( 'fleeting_time', basename( dirname( __FILE__ ) ) . '/languages' );
    }

    function fleeting_admin_menu(){
        add_options_page(__('fleeting time'),__('fleeting time'),'administrator','fleeting-time','display_admin_page');
    }

?>