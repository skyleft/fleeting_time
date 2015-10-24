<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 15/10/10
 * Time: 上午7:17
 */


function display_admin_page()
{

    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><? _e('welcome to use fleeting time plugin', 'fleetingtime'); ?></title>

        <link href="<?= plugins_url('assets/css/bootstrap.min.css',dirname(__FILE__))?>" rel="stylesheet">
        <link href="<?= plugins_url('assets/css/style.css',dirname(__FILE__))?>" rel="stylesheet">
        <link href="<?= plugins_url('assets/css/fleeting.css',dirname(__FILE__))?>" rel="stylesheet">

        <script type="text/javascript">
            AJAXURL = "<?= admin_url( 'admin-ajax.php' )?>";
            VIEWLABEL = "<?php _e('Preview the flag content','fleetingtime') ?>";
            BOTTOMLABEL = "<?php _e('Bottom of the post','fleetingtime') ?>";
            UPLABEL = "<?php _e('Top of the post','fleetingtime') ?>";

            ALERT_OK = "<?php _e('ok','fleetingtime');?>";
            ALERT_PLEASE_CHOOSE_ONE_ROW = "<?php _e('please choose one row','fleetingtime');?>";
            ALERT_FAILED = "<?php _e('failed','fleetingtime');?>";

            TITLE_SHOULD_NOT_BE_EMPTY = "<?php _e('title should not be empty!','fleetingtime');?>";
            POSITION_SHOULD_NOT_BE_EMPTY = "<?php _e('position should not be empty!','fleetingtime');?>";
            STARTTIME_SHOULD_NOT_BE_EMPTY = "<?php _e('starttime should not be empty!','fleetingtime');?>";
            ENDTIME_SHOULD_NOT_BE_EMPTY = "<?php _e('endtime should not be empty!','fleetingtime');?>";
            CONTENT_SHOULD_NOT_BE_EMPTY = "<?php _e('content should not be empty!','fleetingtime');?>";

            TIME_ALREADY_EXISTED = "<?php _e('the time period is already existed!','fleetingtime');?>";
        </script>
    </head>
    <body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>
                        <? _e('welcome to use fleeting time plugin', 'fleetingtime'); ?>
                    </h2>
                </div>
                <div class="tabbable" id="tabs-780271">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#panel-140385" data-toggle="tab"><? _e('Options', 'fleetingtime'); ?></a>
                        </li>
                        <li>
                            <a href="#panel-281564" data-toggle="tab"><? _e('About this plugin', 'fleetingtime'); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-140385">
                            
                            <div class="btn-group" style="margin-top:20px;">

                                <button class="btn btn-success" type="button" id="addbtn">
                                    <em class="glyphicon glyphicon-plus"></em> <?php _e('Add Period','fleetingtime'); ?>
                                </button>
                                <button class="btn btn-primary" type="button" id="editbtn">
                                    <em class="glyphicon glyphicon-edit"></em> <?php _e('Edit Period','fleetingtime'); ?>
                                </button>
                                <button class="btn btn-warning" type="button" id="deletebtn">
                                    <em class="glyphicon glyphicon-remove"></em> <?php _e('Delete Period','fleetingtime');?>
                                </button>
                                <button class="btn btn-success" type="button" id="refreshbtn">
                                    <em class="glyphicon glyphicon-refresh"></em> <?php _e('Refresh','fleetingtime');?>
                                </button>
                            </div>
                            <table class="table table-bordered table-hover table-condensed" style="margin-top: 10px">
                                <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        <?php _e('Period Title','fleetingtime');?>
                                    </th>
                                    <th>
                                        <?php _e('Position','fleetingtime');?>
                                    </th>
                                    <th>
                                        <?php _e('Period Start Time','fleetingtime');?>
                                    </th>
                                    <th>
                                        <?php _e('Period End Time','fleetingtime');?>
                                    </th>
                                    <th>
                                        <?php _e('Check Fleeting Flag','fleetingtime');?>
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="datacon">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="panel-281564">
                            <div class="view" style="margin-top:20px;margin-left:10px;margin-right:10px;">
                            <p style="line-height:27px;margin-bottom:20px;">
                                以前自己用wordpress写个人博客，一直坚持写了好几年，大概从大一一直到毕业之后。
                            </p>
                            <p style="line-height:27px;margin-bottom:20px;">
                                每次翻阅前段时间的博客的时候，总感觉那时的自己好幼稚，对那时的文字总有说不清的感觉，
                                想删掉，但又不舍，毕竟也是那时真实的写照。
                                就如现在有句话说的，现在想想以前的自己，真觉得是个傻逼。
                            </p>
                            <p style="line-height:27px;margin-bottom:20px;">

                                所以呢，我就写了这个小插件，可以为不同时段的文章，添加一下小的标记，表明自己当时的情况，为读者提供更好的参考。
                                有的时候写一些技术文章或者软件使用教程，可能时间过久技术早已变更，也可以标记一下。
                            </p>
                            <p style="line-height:27px;margin-bottom:20px;">
                                由于是第一次写wordpress的插件，即便是有很长的使用经验，但是仍然不是很熟悉wordpress的插件API，对插件的需求
                                把握也不足，最终也不知道做出的这东西有多少实际意义，勉勉强强就发布吧，如果您有任何意见，或者有需要的wordpress插件
                                开发需要，都可以Email给我  @im@andy-cheung.me , 谢谢！
                            </p>
                            </div>
                            
                        </div>
                        <div class="modal fade" id="codedialog" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width:600px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            <?php _e('Add a Fleeting Period.','fleetingtime')?>
                                        </h4>
                                    </div>
                                    <div class="modal-body" style="padding-bottom:5px;">
                                        <form class="form-horizontal" role="form" id="fleetingform">
                                            <div class="form-group">

                                                <label for="title" class="col-sm-3 control-label">
                                                    <?php _e('Period Title','fleetingtime')?>
                                                </label>
                                                <div class="col-sm-9">
                                                	<input type="hidden" id="id" name="id">
                                                    <input type="text" class="form-control" id="title" name="title" />
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <label for="position" class="col-sm-3 control-label">
                                                    <?php _e('Choose Where the fleeting time flag to show','fleetingtime')?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select  class="form-control" id="position" name="position" >
                                                            <option value="up" id="upposition"><?php _e('Above the post content','fleetingtime');?></option>
                                                            <option value="bottom" id="bottomposition"><?php _e('Below the post content','fleetingtime');?></option>
                                                            <!-- <option value="popup"><?php _e('Popup Layer','fleetingtime');?></option> -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <label for="starttime" class="col-sm-3 control-label">
                                                    <?php _e('Period Start Time','fleetingtime')?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="starttime" name="starttime" />
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <label for="endtime" class="col-sm-3 control-label">
                                                    <?php _e('Period End Time','fleetingtime')?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="endtime" name="endtime" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="flag_content" class="col-sm-3 control-label">
                                                    <?php _e('Fleeting Words','fleetingtime')?>
                                                </label>
                                                <div class="col-sm-9">
                                                    <?php wp_editor( '', flag_content, $settings = array(
                                                        quicktags=>1,
                                                        tinymce=>0,
                                                        media_buttons=>0,
                                                        textarea_rows=>4,
                                                        editor_class=>"textareastyle"
                                                    ) ); ?>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer" style="padding-top:5px;padding-bottom:5px;">
                                        <button type="submit" class="btn btn-default" id="savebtn">
                                            <?php _e('Save','fleetingtime')?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="previewdialog" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width:400px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            <?php _e('Preview','fleetingtime')?>
                                        </h4>
                                    </div>
                                    <div class="modal-body" style="padding-bottom:5px;margin:10px;border:1px solid #dedee3;" id="pre_post">
                                        <div style="width:100%;height:90px;text-align:center;" >
                                        	<h1><?php _e('Your Post','fleetingtime' ); ?></h1>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= plugins_url('assets/js/jquery.min.js',dirname(__FILE__))?>"></script>
    <script src="<?= plugins_url('assets/js/bootstrap.min.js',dirname(__FILE__))?>"></script>
    <script src="<?= plugins_url('assets/js/bootbox.min.js',dirname(__FILE__) );?>"></script>
    <script src="<?= plugins_url('assets/js/scripts.js',dirname(__FILE__))?>"></script>
    <?php

}

?>