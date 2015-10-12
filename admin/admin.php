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

        <script type="text/javascript">
            AJAXURL = "<?= admin_url( 'admin-ajax.php' )?>";
            VIEWLABEL = "<?php _e('view the flag content','fleetingtime') ?>";
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
                            <div class="form-group" style="margin-top: 30px;">

                                <label for="position" class="col-sm-4 control-label">
                                    1.<?php _e('Choose Where the fleeting time flag to show','fleetingtime');?>
                                </label>
                                <div class="col-sm-8">
                                    <select  class="form-control" id="position" >
                                            <option value="up"><?php _e('Above the post content','fleetingtime');?></option>
                                            <option value="down"><?php _e('Below the post content','fleetingtime');?></option>
                                            <option value="popup"><?php _e('Popup Layer','fleetingtime');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="btn-group" style="margin-top:20px;">

                                <button class="btn btn-success" type="button" id="addbtn">
                                    <em class="glyphicon glyphicon-plus"></em> <?php _e('Add Period','fleetingtime'); ?>
                                </button>
                                <button class="btn btn-warning" type="button" id="deletebtn">
                                    <em class="glyphicon glyphicon-remove"></em> <?php _e('Delete Period','fleetingtime');?>
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
                            <p>

                            </p>
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
                                                    <input type="text" class="form-control" id="title" name="title" />
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-success" role="alert" id="alertsuccess">...</div>
    <div class="alert alert-warning" role="alert" id="alertparamerror">...</div>
    <div class="alert alert-warning" role="alert" id="alertsyserror">...</div>

    <script src="<?= plugins_url('assets/js/jquery.min.js',dirname(__FILE__))?>"></script>
    <script src="<?= plugins_url('assets/js/bootstrap.min.js',dirname(__FILE__))?>"></script>
    <script src="<?= plugins_url('assets/js/scripts.js',dirname(__FILE__))?>"></script>
    <?php

}

?>