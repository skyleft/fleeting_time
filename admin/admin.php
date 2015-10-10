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
                            <div class="form-group">

                                <label for="position" class="col-sm-4 control-label">
                                    <?php _e('Choose Where the fleeting time flag to show','fleetingtime');?>
                                </label>
                                <div class="col-sm-8">
                                    <select type="email" class="form-control" id="position" >
                                            <option value="up"><?php _e('Above the post content','fleetingtime');?></option>
                                            <option value="down"><?php _e('Below the post content','fleetingtime');?></option>
                                            <option value="popup"><?php _e('Popup Layer','fleetingtime');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="btn-group" style="margin-top:20px;">

                                <button class="btn btn-default" type="button">
                                    <em class="glyphicon glyphicon-align-left"></em> <?php _e('Add Period','fleetingtime'); ?>
                                </button>
                                <button class="btn btn-default" type="button">
                                    <em class="glyphicon glyphicon-align-center"></em> <?php _e('Delete Period','fleetingtime');?>
                                </button>
                            </div>
                            <table class="table table-bordered table-hover table-condensed">
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
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="panel-281564">
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= plugins_url('assets/js/jquery.min.js',dirname(__FILE__))?>"></script>
    <script src="<?= plugins_url('assets/js/bootstrap.min.js',dirname(__FILE__))?>"></script>
    <script src="<?= plugins_url('assets/js/scripts.js',dirname(__FILE__))?>"></script>
    <?php

}

?>