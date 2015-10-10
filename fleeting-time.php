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


    require_once('admin/admin.php');

    if(is_admin()){
        add_action('admin_menu', 'fleeting_admin_menu');
    }

    function fleeting_admin_menu(){
        add_options_page('fleeting time','fleeting time','administrator','fleeting-time','display_admin_page');
    }

?>