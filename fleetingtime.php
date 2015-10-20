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

    register_activation_hook( __FILE__, 'fleetingtime_install');
    register_deactivation_hook( __FILE__, 'fleetingtime_remove' );

    add_action('wp_ajax_doCreate', 'doCreate');
    add_action('wp_ajax_doLoadData', 'doLoadData');
    add_action('wp_ajax_doRemove','doRemove');
    add_action('wp_ajax_doGet', 'doGet');

    function fleetingtime_install() {
        fleetingtime_create_table();
    }
    function fleetingtime_remove() {
        //do some clear when the fleetingtime plugin were removed
    }

    function doLoadData(){
        global $wpdb;
        $table_name = $wpdb->prefix . "fleetingtime";
        $ft = $wpdb->get_results(
            "
                SELECT ID, TITLE, POSITION,STARTTIME, ENDTIME, FLAG_CONTENT
                FROM $table_name
                "
        );
        echo json_encode($ft);
        wp_die();
    }
    function doGet(){
        global $wpdb;
        $table_name = $wpdb->prefix . "fleetingtime";
        $id = $_POST['id'];
        $res = $wpdb->get_row(
                "
                    SELECT ID,TITLE,POSITION,STARTTIME,ENDTIME,FLAG_CONTENT 
                    FROM $table_name WHERE ID = $id
                "
            );
        echo json_encode($res);
        wp_die();
    }
    function doCreate(){
        global $wpdb;
        $table_name = $wpdb->prefix . "fleetingtime";
        $data = array();$res = array('valid'=>true);
        if(isset($_POST['title']))
            $data['title']=$_POST['title'];
        if(isset($_POST['starttime']) && strlen(trim($_POST['starttime']))>0)
            $data['starttime']=$_POST['starttime'];
        else
            $res['valid']=false;
        if(isset($_POST['position']) && strlen(trim($_POST['position']))>0)
            $data['position']=$_POST['position'];
        else
            $res['valid']=false;
        if(isset($_POST['endtime']) && strlen(trim($_POST['endtime']))>0)
            $data['endtime']=$_POST['endtime'];
        else
            $res['valid']=false;
        if(isset($_POST['flag_content']) && strlen(trim($_POST['flag_content']))>0)
            $data['flag_content']=$_POST['flag_content'];
        else
            $res['valid']=false;
        if($res['valid']){
            if($_POST['id']){
                $sql_res = $wpdb->update($table_name, $data, array('ID'=>$_POST['id']), array('%s','%s','%s','%s','%s'), array('%d'));
            }else{
                $sql_res = $wpdb->insert($table_name,$data,array('%s','%s','%s','%s','%s'));
            }
            if($sql_res !== false){
                echo json_encode(array('success'=>true));
            }else{
                echo json_encode(array('success'=>false,'message'=>__('unknown error','fleetingtime')));
            }

        }else{
            echo json_encode(array('success'=>false,'message'=>__('invalid parameter','fleetingtime')));
        }

        wp_die();
    }



    function getFleetingByTime($postTime){
        if($postTime){
            global $wpdb;
            $table_name = $wpdb->prefix . "fleetingtime";
            $ft = $wpdb->get_results(
                "
                SELECT ID, TITLE, POSITION, STARTTIME, ENDTIME, FLAG_CONTENT
                FROM $table_name WHERE '$postTime' BETWEEN STARTTIME AND ENDTIME
                "
            );
            return $ft;
        }
        return null;
    }

    function doRemove(){
        global $wpdb;
        $table_name = $wpdb->prefix . "fleetingtime";
        if(isset($_POST['id']) && strlen(trim($_POST['id']))>0){
            $ids = trim($_POST['id']);
            if (substr($ids, -1)===',') {
                $ids = substr($ids, 0, strlen($ids)-1);
            }
            $ids = explode(',', $ids);
            $sql = "DELETE FROM $table_name WHERE ID IN (";
            for ($i=0; $i < count($ids)-1; $i++) { 
                $sql .= '%d,';
            }
            $sql .= '%d)';
            $wpdb->query( $wpdb->prepare( 
                $sql,
                    $ids
            ) );
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('success'=>false,'message'=>__('invalid parameter','fleetingtime')));
        }
        wp_die();
    }
    require_once('admin/admin.php');

    function fleeting_init(){
        load_plugin_textdomain( 'fleetingtime', false,dirname(plugin_basename(__FILE__)).'/languages/' );
    }

    function fleeting_admin_menu(){
        add_options_page(__('fleeting time','fleetingtime'),__('fleeting time','fleetingtime'),'administrator','fleetingtime','display_admin_page');
    }


    function fleetingtime_create_table(){
        global $wpdb;
        $table_name = $wpdb->prefix.'fleetingtime';
        if($wpdb->get_var("show tables like '$table_name'") != $table_name){
            $create_table_sql = "CREATE TABLE ". $table_name . " (id bigint(20) NOT NULL AUTO_INCREMENT,"
                ."title varchar(255) NOT NULL,"
                ."position enum('up','bottom','popup') NOT NULL DEFAULT 'bottom',"
                ."starttime timestamp NOT NULL,"
                ."endtime timestamp NOT NULL,"
                ."flag_content text NOT NULL,"
                ."PRIMARY KEY(id)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            dbDelta($create_table_sql);
        }
    }

    add_action('plugins_loaded','fleeting_init');

    if(is_admin()){
        add_action('admin_menu', 'fleeting_admin_menu');
    }

    function fleeting_content($content){
        if(is_single()){
            $fleeting = getFleetingByTime($GLOBALS['post']->post_date);
            if (count($fleeting)>0) {
                $fleeting = $fleeting[0];
                $position = $fleeting->POSITION;
                if ('up'===$position){
                    $content = decorate_content($fleeting->FLAG_CONTENT).$content;
                }else{
                    $content .= decorate_content($fleeting->FLAG_CONTENT);
                }
                return $content;
            }
            
        }

        return $content;
        

    }

    function decorate_content($content){
        return "<div class='fleeting-box-090807'>$content</div>";
    }

    add_filter('the_content', 'fleeting_content');

    add_action('wp_head','fleeting_style');

    function fleeting_style(){
        $fleeting_style = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".plugins_url('assets/css/fleeting.css',__FILE__)."\">";
        echo $fleeting_style;
    }
?>
