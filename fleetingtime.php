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

    add_action('plugins_loaded','fleeting_init');

    if(is_admin()){
        add_action('admin_menu', 'fleeting_admin_menu');
    }

    function fleeting_init(){
        load_plugin_textdomain( 'fleetingtime', false,dirname(plugin_basename(__FILE__)).'/languages/' );
    }

    function fleeting_admin_menu(){
        add_options_page(__('fleeting time','fleetingtime'),__('fleeting time','fleetingtime'),'administrator','fleetingtime','display_admin_page');
    }

?>