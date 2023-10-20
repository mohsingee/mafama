@extends('layouts.main')
@section('content')
    <style type="text/css">
        .commall {
            border: 1px solid;
            border-radius: 4px;
            padding: 5px;
            margin: 5px 0;
        }

        #monthlylist {
            list-style-type: none;
            width: 100%;
            padding: 0;
        }

        #monthlylist li {
            display: inline-table;
            background: #da291c;
            color: white;
            padding: 3px 25px;
            margin: 10px 0;
            border-radius: 4px;
            cursor: pointer;
        }

        .card_img {
            height: 80px !important;
        }
    </style>
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs -->
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Archives</h4>
                        </div>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-20">
                        <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                        <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth Place</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                        <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <?php } ?>
                        <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                        <?php } ?>
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily
                            Briefing</a>
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>
                    <div class="text-center">
                        <ul class="" id="monthlylist">
                            <?php foreach($years as $value){ ?>
                            <li <?php if($value == date('Y')){ ?> style="text-decoration: underline;" class="act" <?php } ?>>
                                {{ $value }}</li>
                            <?php } ?>
                        </ul>
                        <input type="hidden" name="" id="choosenyear" value="{{ date('Y') }}">
                    </div>
                    <ul class="nav nav-tabs nav-button-tabs nav-justified">
                        <li class="active"><a href="#monthlyappointment" data-toggle="tab">Monthly Appointment</a></li>
                        <li><a href="#quarterlyappointment" data-toggle="tab">Quarterly Appointment</a></li>
                        <!-- <li><a href="#monthly" data-toggle="tab">Monthly Email</a></li>
                        <li><a href="#monthly" data-toggle="tab">Quarterly Email</a></li> -->
                        <li><a href="#monthlyfinance" data-toggle="tab">Monthly Finance</a></li>
                        <li><a href="#quarterlyfinance" data-toggle="tab">Quarterly Finance</a></li>
                        <li><a href="#editing" data-toggle="tab">Editing</a></li>
                        <li><a href="#deleting" data-toggle="tab">Deleting</a></li>
                    </ul>
                    <div class="tab-content margin-top-10"
                        style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="tab-pane fade in active" id="monthlyappointment">

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="monthly_tbody">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade in" id="quarterlyappointment">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Jan-Mar</th>
                                        <th>Apr-Jun</th>
                                        <th>Jul-Sep</th>
                                        <th>Oct-Dec</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="quarterly_tbody">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade in" id="monthlyfinance">

                            <div id="" class="table-scroll">


                                <div class="table-wrap">

                                    <table class="table table-striped table-bordered table-hover" id="monthlyfinancetable">
                                        <label for="ON">ON</label>
                                        <input type="radio" id="show" name="fav_language" onchange="show()"
                                            value="">
                                        <label for="OFF">OFF</label>
                                        <input type="radio" id="hide" name="fav_language" onchange="hide()"
                                            value="">
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="quarterlyfinance">
                            <div id="" class="table-scroll">
                                <div class="table-wrap">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="quarterlyfinancetable">

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="editing">
                            <div style="margin-bottom: 20px">
                                <h4>Revenue Updates Report</h4>
                                <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monthly_revenue_tbody">
                                    </tbody>
                                </table>
                            </div>
                            <div style="margin-bottom: 20px">
                                <h4>Expense Updates Report</h4>
                                <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monthly_expenses_tbody">
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <h4>Assets Updates Report</h4>
                                <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monthly_asset_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="deleting">
                            <div style="margin-bottom: 20px">
                                <h4>Revenue Deletion</h4>
                                <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monthly_revenue_tbody2">
                                    </tbody>
                                </table>
                            </div>
                            <div style="margin-bottom: 20px">
                                <h4>Expense Deletion</h4>
                                <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monthly_expenses_tbody2">
                                    </tbody>
                                </table>
                            </div>
                            <div style="margin-bottom: 20px">
                                <h4>Assets Deletion</h4>
                                <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monthly_asset_tbody2">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12">
                        <p style="color: red" id="emailer"></p>
                        <div id="monthly_details"></div>
                    </div>
                    <div class="col-md-12 mail_part" style="display: none;">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#email-tab" data-toggle="tab">Send Email</a></li>
                            <li><a href="#card-tab" data-toggle="tab">Send Card</a></li>
                            <li><a href="#video-tab" data-toggle="tab">Send Video</a></li>
                            <!-- <li><a href="#sms-tab" data-toggle="tab">Send SMS</a></li> -->
                        </ul>

                        <div class="tab-content margin-top-10"
                            style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="email-tab">
                                <form id="client_manage_submit" class="margin-bottom-0" method="POST" role="form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control malto" placeholder="To" name="malto"
                                        value="" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="subject" id="subject"
                                                    placeholder="Subject" required />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-2 padding-0">
                                                <label>Background: </label>
                                            </div>
                                            <div class="col-md-10 padding-0">
                                                <table style="border: 1px solid #da291c4d; margin-bottom: 15px;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="color-td color1"></td>
                                                            <td class="color-td color2"></td>
                                                            <td class="color-td color3"></td>
                                                            <td class="color-td color4"></td>
                                                            <td class="color-td color5"></td>
                                                            <td class="color-td color6"></td>
                                                            <td class="color-td color7"></td>
                                                            <td class="color-td color8"></td>
                                                            <td class="color-td color9"></td>
                                                            <td class="color-td color10"></td>
                                                            <td class="color-td color11"></td>
                                                            <td class="color-td color12"></td>
                                                            <td class="color-td color13"></td>
                                                            <td class="color-td color14"></td>
                                                            <td class="color-td color15"></td>
                                                            <td class="color-td color16"></td>
                                                            <td class="color-td color17"></td>
                                                            <td class="color-td color18"></td>
                                                            <td class="color-td color19"></td>
                                                            <td class="color-td color20"></td>
                                                            <td class="color-td color21"></td>
                                                            <td class="color-td color22"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <input type="hidden" id="bakg" name="bakg">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea type="color" class="form-control summernote msgbox summernote1" rows="6" placeholder="Message"></textarea>
                                                <p style="color: red" id="textre"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12 text-center email-btn" style="margin-top: 10px;">
                                                <div class="row">
                                                    <!--<div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">-->
                                                    <!--    <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send With Clock</a>-->
                                                    <!--</div>-->
                                                    <div class="col-md-5th text-center"
                                                        style="padding: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info reminderonsub"
                                                            style="width: 100%;">Send With Reminders</a>
                                                    </div>
                                                    <div class="col-md-5th text-center"
                                                        style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info prvbtn"
                                                            style="width: 100%;">Preview</a>
                                                    </div>
                                                    <div class="col-md-5th text-center"
                                                        style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send
                                                            Now</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding: 0px;">
                                                        <a class="btn btn-xs btn-info dateonsub" style="width: 100%;">Send
                                                            On</a>

                                                    </div>
                                                    <input type="submit" id="submit_button" value=""
                                                        style="display: none">
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        // $ip = $_SERVER['REMOTE_ADDR'];
                                        // $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                                        // $ipInfo = json_decode($ipInfo);
                                        // $timezone = $ipInfo->timezone;
                                        $date = date('Y-m-d');
                                        // $dt = new DateTime($date, new DateTimeZone('America/New_York'));
                                        // $dt->setTimezone(new DateTimeZone($timezone));
                                        // $adate = $dt->format('Y-m-d');
                                        ?>
                                        <div class="col-md-12">
                                            <div class="col-md-12 dateon" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="date" name="sendon" class="form-control"
                                                            data-date="" data-date-format="DD MMMM YYYY"
                                                            value="<?= $date ?>" id="sendon">
                                                        <p style="color: red" id="send_on_alert"></p>
                                                    </div>
                                                    <div class="col-md-2" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn"
                                                            style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send
                                                            On</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 reminderon" style="margin-top: 10px; display: none;">
                                            <div class="row">
                                                <div class="col-md-4" style="padding: 0 10px; ">
                                                    <select class="form-control" name="reminderdate">
                                                        <option value="1">every hour</option>
                                                        <option value="2">every 2 hour</option>
                                                        <option value="3">every 3 hour</option>
                                                        <option value="4">every 4 hour</option>
                                                        <option value="5">every 5 hour</option>
                                                        <option value="6">every 6 hour</option>
                                                        <option value="24">every day</option>
                                                        <option value="48">every 2 day</option>
                                                        <option value="72">every 3 day</option>
                                                        <option value="96">every 4 day</option>
                                                        <option value="120">every 5 day</option>
                                                        <option value="144">every 6 day</option>
                                                        <option value="168">every week</option>
                                                    </select>
                                                    <p style="color: red" id="reminder_date_alert"></p>
                                                </div>
                                                <div class="col-md-4" style="padding: 0 10px; ">
                                                    <!-- <input type="time" class="form-control" name="remindertime" id="remindertime"> -->
                                                    <select class="form-control" name="remindertimes">
                                                        <option value="2">2times</option>
                                                        <option value="3">3times</option>
                                                        <option value="4">4times</option>
                                                        <option value="5">5times</option>
                                                        <option value="6">6times</option>
                                                        <option value="7">7times</option>
                                                        <option value="8">8times</option>
                                                        <option value="9">9times</option>
                                                        <option value="10">10times</option>
                                                    </select>
                                                    <p style="color: red" id="reminder_time_alert"></p>
                                                </div>
                                                <div class="col-md-4" style="padding: 0; ">
                                                    <a class="btn btn-xs btn-info subbtn"
                                                        style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Save</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center" style="padding: 15px">
                                            <span style="color: green; font-size: 15px; font-weight: 600;"
                                                id="success_card"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="card-tab">
                                <form class="margin-bottom-0" method="POST" id="manage_client_card_submit"
                                    role="form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control malto" placeholder="To" name="malto"
                                        value="" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12 padding-0 text-center"
                                                style="background-color: #da291c; color: #fff; padding-top: 10px; padding-bottom: 10px;">
                                                Card Categories
                                            </div>
                                            <div class="col-md-12 padding-0">
                                                <ul class="nav nav-tabs nav-bottom-border category-ul">
                                                    <?php
                                                    $c = 0;
                                                        foreach($category as $value){
                                                    ?>
                                                    <li class="<?php if ($c == 0) {
                                                        echo 'active';
                                                    } ?>"><a href="#<?= $value->category ?>"
                                                            data-toggle="tab"><?= $value->category ?></a></li>
                                                    <?php
                                                    $c++;
                                                        }
                                                    ?>
                                                </ul>

                                                <div class="tab-content">
                                                    <?php
                                                    $k = 0;
                                                        foreach($category as $value){
                                                            $imgs = \App\Http\Controllers\HomeController::get_card_image($value->category);
                                                    ?>
                                                    <div class="tab-pane fade in <?php if ($k == 0) {
                                                        echo 'active';
                                                    } ?>"
                                                        id="<?= $value->category ?>">
                                                        <div class="col-md-12 padding-0">
                                                            <?php

                                                            foreach ($imgs as $img) { ?>



                                                            <div class="col-md-2" style="margin-bottom: 10px;">
                                                                <img src="<?php echo asset('public/images'); ?>/<?= $img->image ?>"
                                                                    alt="" class="img img-responsive card_img" />
                                                            </div>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                    <?php
                                                    $k++;
                                                        }
                                                    ?>
                                                    <input type="hidden" name="img" id="img_path" val="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="subject" id="subject1"
                                                    placeholder="Subject" required />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea type="color" class="form-control summernote msgbox summernote2" rows="6" placeholder="Message"></textarea>
                                                <p style="color: red" id="textre1"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="">
                                            <div class="row">
                                                <div class="col-md-12 text-center email-btn" style="margin-top: 10px;">
                                                    <div class="row">
                                                        <!--<div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">-->
                                                        <!--    <a class="btn btn-xs btn-info subbtn1" style="width: 100%;">Send With Clock</a>-->
                                                        <!--</div>-->
                                                        <div class="col-md-5th text-center"
                                                            style="padding: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info reminderonsub1"
                                                                style="width: 100%;">Send With Reminders</a>
                                                        </div>
                                                        <div class="col-md-5th text-center"
                                                            style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info prvbtn1"
                                                                style="width: 100%;">Preview</a>
                                                        </div>
                                                        <div class="col-md-5th text-center"
                                                            style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn1"
                                                                style="width: 100%;">Send Now</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding: 0px;">
                                                            <a class="btn btn-xs btn-info dateonsub1"
                                                                style="width: 100%;">Send On</a>

                                                        </div>
                                                        <input type="submit" id="submit_button1" value=""
                                                            style="display: none">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 dateon1" style="margin-top: 10px; display: none;">
                                                    <div class="row">
                                                        <div class="col-md-6"></div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="date" name="sendon" class="form-control"
                                                                data-date="" data-date-format="DD MMMM YYYY"
                                                                value="<?= date('Y-m-d') ?>" id="sendon1">
                                                            <p style="color: red" id="send_on_alert1"></p>
                                                        </div>
                                                        <div class="col-md-2" style="padding: 0; ">
                                                            <a class="btn btn-xs btn-info subbtn1"
                                                                style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send
                                                                On</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 reminderon1"
                                                    style="margin-top: 10px; display: none;">
                                                    <div class="row">
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="date" class="form-control" data-date=""
                                                                data-date-format="DD MMMM YYYY"
                                                                value="<?= date('Y-m-d') ?>" name="reminderdate"
                                                                id="reminderdate1">

                                                            <p style="color: red" id="reminder_date_alert1"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="time" class="form-control"
                                                                name="remindertime" id="remindertime1">
                                                            <p style="color: red" id="reminder_time_alert1"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0; ">
                                                            <a class="btn btn-xs btn-info subbtn1"
                                                                style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send
                                                                With Reminder</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center" style="padding: 15px">
                                            <span style="color: green; font-size: 15px; font-weight: 600;"
                                                id="success_card1"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="video-tab">
                                <form class="margin-bottom-0" method="POST" id="manage_client_video_submit"
                                    role="form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control malto" placeholder="To" name="malto"
                                        value="" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="subject"
                                                        id="subject2" placeholder="Subject" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-2 padding-0">
                                                    <label class="margin-top-10">Video File: </label>
                                                </div>
                                                <div class="col-md-10 padding-0">
                                                    <div class="fancy-file-upload fancy-file-danger">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control" name="video"
                                                            onchange="jQuery(this).next('input').val(this.value);"
                                                            accept="video/*" required />
                                                        <input type="text" class="form-control"
                                                            placeholder="no file selected" readonly="" />
                                                        <span class="button">Choose File</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 margin-top-10">
                                                <div class="form-group">
                                                    <textarea type="color" class="form-control summernote msgbox summernote3" rows="6" placeholder="Message"></textarea>
                                                    <p style="color: red" id="textre2"></p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-12 text-center email-btn" style="margin-top: 10px;">
                                                    <div class="row">
                                                        <!--<div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">-->
                                                        <!--    <a class="btn btn-xs btn-info subbtn2" style="width: 100%;">Send With Clock</a>-->
                                                        <!--</div>-->
                                                        <div class="col-md-5th text-center"
                                                            style="padding: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info reminderonsub2"
                                                                style="width: 100%;">Send With Reminders</a>
                                                        </div>
                                                        <div class="col-md-5th text-center"
                                                            style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info prvbtn2"
                                                                style="width: 100%;">Preview</a>
                                                        </div>
                                                        <div class="col-md-5th text-center"
                                                            style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn2"
                                                                style="width: 100%;">Send Now</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding: 0px;">
                                                            <a class="btn btn-xs btn-info dateonsub2"
                                                                style="width: 100%;">Send On</a>

                                                        </div>
                                                        <input type="submit" id="submit_button2" value=""
                                                            style="display: none">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            // $ip = $_SERVER['REMOTE_ADDR'];
                                            // $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                                            // $ipInfo = json_decode($ipInfo);
                                            // $timezone = $ipInfo->timezone;
                                            $date = date('Y-m-d');
                                            // $dt = new DateTime($date, new DateTimeZone('America/New_York'));
                                            // $dt->setTimezone(new DateTimeZone($timezone));
                                            // $adate = $dt->format('Y-m-d');
                                            ?>
                                            <div class="col-md-12">
                                                <div class="col-md-12 dateon2" style="margin-top: 10px; display: none;">
                                                    <div class="row">
                                                        <div class="col-md-6"></div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="date" name="sendon" class="form-control"
                                                                data-date="" data-date-format="DD MMMM YYYY"
                                                                value="<?= $date ?>" id="sendon2">
                                                            <p style="color: red" id="send_on_alert2"></p>
                                                        </div>
                                                        <div class="col-md-2" style="padding: 0; ">
                                                            <a class="btn btn-xs btn-info subbtn2"
                                                                style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send
                                                                On</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 reminderon2"
                                                    style="margin-top: 10px; display: none;">
                                                    <div class="row">
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <!-- <input type="date" class="form-control" name="reminderdate" id="reminderdate"> -->
                                                            <input type="date" class="form-control" data-date=""
                                                                data-date-format="DD MMMM YYYY"
                                                                value="<?= date('Y-m-d') ?>" name="reminderdate"
                                                                id="reminderdate2">

                                                            <p style="color: red" id="reminder_date_alert2"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="time" class="form-control"
                                                                name="remindertime" id="remindertime2">
                                                            <p style="color: red" id="reminder_time_alert2"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0; ">
                                                            <a class="btn btn-xs btn-info subbtn2"
                                                                style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send
                                                                With Reminder</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center" style="padding: 15px">
                                                <span style="color: green; font-size: 15px; font-weight: 600;"
                                                    id="success_card2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="modall" class="modal fade" role='dialog'>
        <div class="modal-dialog">
            <div class="modal-content" style="background: white">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div id="modal-body"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            // alert("hi");
            setTimeout(function() {
                $("#monthlylist li.act").trigger("click");
            }, 10);
        });
        $("#monthlylist li").click(function() {
            $("#monthlylist li").css("text-decoration", "none");
            $(this).css("text-decoration", "underline");
            $("#choosenyear").val($(this).html());
            var year = $(this).html();
            var url = "<?php echo url('/'); ?>/monthlylistappointment";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_tbody").html(response);
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            }).then(function(data) {
                $.ajax({
                    url: "<?php echo url('/'); ?>/quarterlylistappointment",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#quarterly_tbody").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                })
            }).then(function(data) {
                $.ajax({
                    url: "<?php echo url('/'); ?>/monthlylistfinance",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#monthlyfinancetable").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                })
            }).then(function(data) {
                $.ajax({
                    url: "<?php echo url('/'); ?>/quarterlylistfinance",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#quarterlyfinancetable").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                })
            }).then(function(data) {

                $.ajax({
                    url: "<?php echo url('/'); ?>/monthlyrevenuelistappointment",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#monthly_revenue_tbody").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                });
            }).then(function(data) {
                $.ajax({
                    url: "<?php echo url('/'); ?>/monthlyexpenseslistappointment",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#monthly_expenses_tbody").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                })
            }).then(function(data) {

                $.ajax({
                    url: "<?php echo url('/'); ?>/monthlyassetlistappointment",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#monthly_asset_tbody").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                });
            }).then(function(data) {


                $.ajax({
                    url: "<?php echo url('/'); ?>/monthlyrevenuelistappointmentt",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#monthly_revenue_tbody2").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                })
            }).then(function(data) {
                $.ajax({
                    url: "<?php echo url('/'); ?>/monthlyexpenseslistappointmentt",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#monthly_expenses_tbody2").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                })
            }).then(function(data) {


                $.ajax({
                    url: "<?php echo url('/'); ?>/monthlyassetlistappointmentt",
                    beforeSend: function() {
                        $("#loading").show();
                        $("#wrapper").hide();
                    },
                    data: 'year=' + year + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        $("#monthly_asset_tbody2").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                })
            });
        });


        $(document).on("click", "#editing .revenue_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var account_description = id[1];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_revenue_month_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&account_description=' + account_description +
                    '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", "#editing .expense_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var account_description = id[1];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_expense_month_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&account_description=' + account_description +
                    '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", "#editing .asset_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var description = id[1];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_asset_month_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&description=' + description +
                    '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });

        $(document).on("click", "#deleting .revenue_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var account_description = id[1];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_revenue_delete_month_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&account_description=' + account_description +
                    '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", "#deleting .expense_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var account_description = id[1];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_expense_delete_month_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&account_description=' + account_description +
                    '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", "#deleting .asset_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var description = id[1];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_asset_delete_month_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&description=' + description +
                    '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });


        $(document).on("click", ".new_client_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('nclient123');
            var month = id[0];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/new_clients_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });



        $(document).on("click", ".total_new_clients", function() {
            var year = $("#choosenyear").val();
            var url = "<?php echo url('/'); ?>/total_clients_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });



        $(document).on("click", ".new_appointment_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('nappointments123');
            var month = id[0];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/new_appointment_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".change_appointment_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('cappointments123');
            var month = id[0];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/change_appointment_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".cancel_appointment_det", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('canappointments123');
            var month = id[0];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/cancel_appointment_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".new_client_detq", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('qnclient123');
            var month = id[0];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/new_clients_detailsq";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".new_appointment_detq", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('qnappointments123');
            var month = id[0];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/new_appointment_detailsq";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".change_appointment_detq", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('cappointments123');
            var month = id[0];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/change_appointment_detailsq";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".cancel_appointment_detq", function() {
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('canappointments123');
            var month = id[0];
            var year = $("#choosenyear").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/cancel_appointment_detailsq";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'year=' + year + '&month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                    $(".mail_part").show();
                    // $("#modal-body").html(response);
                    // $("#modall").modal('show');
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.checkboxes', function() {
            if ($(this).prop('checked')) {
                $(this).addClass("checked");
                var mail_arr = [];
                $(".checkboxes.checked").each(function() {
                    var id = $(this).val();
                    mail_arr.push(id);
                });
                // alert(mail_arr);
                var id = $(this).val();
                var url = "<?php echo url('/'); ?>/checkboxesmail";
                $.ajax({
                    url: url,
                    data: 'mail_arr=' + mail_arr + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        var marr = [];
                        for (var i = 0; i < response.length; ++i) {
                            marr.push(response[i]);
                        }
                        $('.malto').val(marr);
                        mail_arr.push(response);
                    }
                });
            } else {
                $(this).removeClass("checked");
                var id = $(this).val();
                var smail = "";
                var mails = $(".malto").val();
                $.ajax({
                        url: "<?php echo url('/'); ?>/uncheckboxesmail",
                        data: 'id=' + id + '&_token={{ csrf_token() }}',
                        type: "POST",
                        success: function(response) {
                            smail = response;
                        }
                    })
                    .then(function(data) {
                        $.ajax({
                            url: "<?php echo url('/'); ?>/uncheckedboxesmail",
                            data: 'id=' + id + '&mails=' + mails + '&_token={{ csrf_token() }}',
                            type: "POST",
                            success: function(response) {
                                $('.malto').val(response);
                            }
                        });
                    });
            }
        });
        $(document).on("change", ".group-checkable", function() {
            // if ($(this).prop('checked')) {
            //         var boxes = $('.checkboxes:not(:checked)');
            //         boxes.each(function(){
            //             $(this).prop('checked', false);
            //             $(this).trigger('click');
            //         });
            //     }
            //     else{
            //         $('.checkboxes').prop('checked', true);

            //         $('.checkboxes').trigger('click');
            //     }
            if ($(this).prop('checked')) {
                $(".checkboxes").prop("checked", false);
                $(".checkboxes").addClass("checked");
                $(".checkboxes").trigger('click');
                var mail_arr = [];
                $(".checkboxes.checked").each(function() {
                    var id = $(this).val();
                    mail_arr.push(id);
                });
                // alert(mail_arr);
                var id = $(this).val();
                var url = "<?php echo url('/'); ?>/checkboxesmail";
                $.ajax({
                    url: url,
                    data: 'mail_arr=' + mail_arr + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        var marr = [];
                        for (var i = 0; i < response.length; ++i) {
                            marr.push(response[i]);
                        }
                        $('.malto').val(marr);
                        // mail_arr.push(response);
                    }
                });
            } else {
                $(".checkboxes").prop("checked", false);
                $(".gradeX").removeClass("active");
                $(".checkboxes").removeClass("checked");
                // $(".checkboxes").trigger('click');
                $('.malto').val("");
            }
        });
        // $(".group-checkable").change(function(){
        //         if ($(this).prop('checked')) {
        //             var boxes = $('.checkboxes:not(:checked)');
        //             boxes.each(function(){
        //                 $(this).prop('checked', false);
        //                 $(this).trigger('click');
        //             });
        //         }
        //         else{
        //             $('.checkboxes').prop('checked', true);

        //             $('.checkboxes').trigger('click');
        //         }
        //     });
        $(document).on("change", "tbody tr .checkboxes", function() {
            if ($(this).prop('checked')) {

            } else {
                $(".group-checkable").prop('checked', false);
            }
        });
        $(document).ready(function() {
            $(".dateonsub").click(function() {
                $(".dateon").show();
                $(".reminderon").hide();
            });
            $(".reminderonsub").click(function() {
                $(".reminderon").show();
                $(".dateon").hide();
            });
        });
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            // alert(maxDate);
            $('#reminderdate').attr('min', maxDate);
            $('#sendon').attr('min', maxDate);
        });
        $(document).ready(function() {
            $("#sendon").on("change", function() {
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format(this.getAttribute("data-date-format"))
                )
            }).trigger("change");
            $("#reminderdate").on("change", function() {
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format(this.getAttribute("data-date-format"))
                )
            }).trigger("change");
            $(".subbtn").click(function() {
                var submit_value = $(this).text();
                // alert(submit_value);
                $("#submit_button").val(submit_value);
                $("#submit_button").trigger('click');
            });
            $("#client_manage_submit").submit(function(e) {
                //---------------^---------------
                e.preventDefault();
                if ($(".malto").val() == "") {
                    $("#emailer").html("Please select atleast one client !!");
                    $('html, body').animate({
                        scrollTop: $(".nav-button-tabs").offset().top
                    }, 500);
                } else {

                    $("#emailer").html("");
                    if ($(".summernote1").code() == "") {
                        $("#textre").html("Please Enter message !!!");
                        $('html, body').animate({
                            scrollTop: $(".summernote1").offset().top
                        }, 500);
                    } else {
                        $("#textre").html("");
                        var submit_value = $("#submit_button").val();
                        var message = $(".summernote1").code();
                        var bakg = $("#bakg").val();
                        var formData = new FormData(this);
                        formData.append("message", message);
                        formData.append("bakg", bakg);
                        if (submit_value == "Send Now") {
                            $.ajax({
                                type: "POST",
                                beforeSend: function() {
                                    $("#loading").show();
                                    $("#wrapper").hide();
                                },
                                url: "manage_client_submit",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(html) {
                                    // alert(html);
                                    $(".checkboxes").prop('checked', false);
                                    $(".group-checkable").prop('checked', false);
                                    $("tbody tr").removeClass("active");
                                    $("#success_card").html(html);
                                    $('#success_card').fadeIn('fast').delay(20000).fadeOut(
                                        'fast');
                                    $('.malto').val("");
                                    $('#subject').val("");
                                    $(".summernote1").code("");
                                },
                                complete: function() {
                                    $("#loading").hide();
                                    $("#wrapper").show();
                                }
                            });
                        } else if (submit_value == "Send On") {
                            if ($("#sendon").val() == "") {
                                $("#send_on_alert").html("Date is required!");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    beforeSend: function() {
                                        $("#loading").show();
                                        $("#wrapper").hide();
                                    },
                                    url: "manage_client_send_on",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(html) {
                                        // alert(html);
                                        $(".checkboxes").prop('checked', false);
                                        $(".group-checkable").prop('checked', false);
                                        $("tbody tr").removeClass("active");
                                        $("#success_card").html(html);
                                        $('#success_card').fadeIn('fast').delay(20000).fadeOut(
                                            'fast');
                                        $('.malto').val("");
                                        $('#subject').val("");
                                        $(".summernote1").code("");
                                        $("#sendon").val("");
                                        $(".dateon").hide();
                                    },
                                    complete: function() {
                                        $("#loading").hide();
                                        $("#wrapper").show();
                                    }
                                });
                            }
                        } else if (submit_value == "Save") {

                            if ($("#reminderdate").val() == "") {
                                $("#reminder_date_alert").html("Date is required!");
                            } else if ($("#remindertime").val() == "") {
                                $("#reminder_date_alert").hide();
                                $("#reminder_time_alert").html("Time is required!");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    beforeSend: function() {
                                        $("#loading").show();
                                        $("#wrapper").hide();
                                    },
                                    url: "manage_client_send_with_reminder",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(html) {
                                        $(".checkboxes").prop('checked', false);
                                        $(".group-checkable").prop('checked', false);
                                        $("tbody tr").removeClass("active");
                                        $("#success_card").html(html);
                                        $('#success_card').fadeIn('fast').delay(20000).fadeOut(
                                            'fast');
                                        $('.malto').val("");
                                        $('#subject').val("");
                                        $(".summernote1").code("");
                                        $(".reminderon").hide();
                                        $("#reminderdate").val("");
                                        $("#remindertime").val("");
                                    },
                                    complete: function() {
                                        $("#loading").hide();
                                        $("#wrapper").show();
                                        $(".scroll").trigger('click');
                                    }
                                });
                            }
                        }
                    }
                }
            });
            $(".prvbtn").click(function() {
                var bakg = $("#bakg").val();
                var message = $(".summernote1").code();
                var url = "<?php echo url('/'); ?>/user_banner_details";
                $.ajax({
                    url: url,
                    data: '_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        var user_banner = response;
                        var preview = '<div style="padding:10px; background-color:' + bakg +
                            '"><div style="padding: 5px">' + user_banner +
                            '</div><p style="margin-bottom: 0;">' + message + '</p></div>';
                        $("#modall #modal-body").html(preview);
                        $('#modall').modal('show');
                    }
                });

            });
            $(".color-td").click(function() {
                var classs = $(this).attr("class");
                var cls = classs.split("color-td ");
                var mainc = cls[1];
                // alert(mainc);
                var bakg = $(this).css("background-color");
                // alert(bakg);
                $("#bakg").val(bakg);
            });

        });
        $(document).on('click', ".scroll", function() {
            var d = $("section");
            d.scrollTop(d[0].scrollHeight);
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".card_img").click(function() {
                // alert($(this).attr('src'));
                $(".card_img").css({
                    'border': 'none',
                    'padding': '0'
                })
                var img_path = $(this).attr('src');
                $("#img_path").val(img_path);
                $(this).css({
                    'border': '3px solid red',
                    'padding': '2px'
                });
            });
        });
        $(document).ready(function() {
            $(".dateonsub1").click(function() {
                $(".dateon1").show();
                $(".reminderon1").hide();
            });
            $(".reminderonsub1").click(function() {
                $(".reminderon1").show();
                $(".dateon1").hide();
            });
        });
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            // alert(maxDate);
            $('#reminderdate1').attr('min', maxDate);
            $('#sendon1').attr('min', maxDate);
        });
        $(document).ready(function() {
            $("#sendon1").on("change", function() {
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format(this.getAttribute("data-date-format"))
                )
            }).trigger("change");
            $("#reminderdate1").on("change", function() {
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format(this.getAttribute("data-date-format"))
                )
            }).trigger("change");
            $(".subbtn1").click(function() {
                var submit_value = $(this).text();
                // alert(submit_value);
                $("#submit_button1").val(submit_value);
                $("#submit_button1").trigger('click');
            });
            $("#manage_client_card_submit").submit(function(e) {
                //---------------^---------------
                e.preventDefault();
                if ($(".malto").val() == "") {
                    $("#emailer").html("Please select atleast one client !!");
                    $('html, body').animate({
                        scrollTop: $(".nav-button-tabs").offset().top
                    }, 500);
                } else {

                    $("#emailer").html("");
                    if ($(".summernote2").code() == "") {
                        $("#textre1").html("Please Enter message !!!");
                        $('html, body').animate({
                            scrollTop: $(".summernote2").offset().top
                        }, 500);
                    } else {
                        $("#textre1").html("");
                        var submit_value = $("#submit_button1").val();
                        var message = $(".summernote2").code();
                        var formData = new FormData(this);
                        formData.append("message", message);
                        if (submit_value == "Send Now") {
                            $.ajax({
                                type: "POST",
                                beforeSend: function() {
                                    $("#loading").show();
                                    $("#wrapper").hide();
                                },
                                url: "manage_client_card_submit",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(html) {
                                    // alert(html);
                                    $(".checkboxes").prop('checked', false);
                                    $(".group-checkable").prop('checked', false);
                                    $("tbody tr").removeClass("active");
                                    $("#success_card1").html(html);
                                    $('#success_card1').fadeIn('fast').delay(20000).fadeOut(
                                        'fast');
                                    $('.malto').val("");
                                    $('#subject1').val("");
                                    $(".summernote2").code("");
                                },
                                complete: function() {
                                    $("#loading").hide();
                                    $("#wrapper").show();
                                }
                            });
                        } else if (submit_value == "Send On") {
                            if ($("#sendon1").val() == "") {
                                $("#send_on_alert1").html("Date is required!");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    beforeSend: function() {
                                        $("#loading").show();
                                        $("#wrapper").hide();
                                    },
                                    url: "manage_client_card_send_on",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(html) {
                                        // alert(html);
                                        $(".checkboxes").prop('checked', false);
                                        $(".group-checkable").prop('checked', false);
                                        $("tbody tr").removeClass("active");
                                        $("#success_card1").html(html);
                                        $('#success_card1').fadeIn('fast').delay(20000).fadeOut(
                                            'fast');
                                        $('.malto').val("");
                                        $('#subject1').val("");
                                        $(".summernote2").code("");
                                        $("#sendon1").val("");
                                        $(".dateon1").hide();
                                    },
                                    complete: function() {
                                        $("#loading").hide();
                                        $("#wrapper").show();
                                    }
                                });
                            }
                        } else if (submit_value == "Send With Reminder") {

                            if ($("#reminderdate1").val() == "") {
                                $("#reminder_date_alert1").html("Date is required!");
                            } else if ($("#remindertime1").val() == "") {
                                $("#reminder_date_alert1").hide();
                                $("#reminder_time_alert1").html("Time is required!");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    beforeSend: function() {
                                        $("#loading").show();
                                        $("#wrapper").hide();
                                    },
                                    url: "manage_client_card_send_with_reminder",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(html) {
                                        $(".checkboxes").prop('checked', false);
                                        $(".group-checkable").prop('checked', false);
                                        $("tbody tr").removeClass("active");
                                        $("#success_card1").html(html);
                                        $('#success_card1').fadeIn('fast').delay(20000).fadeOut(
                                            'fast');
                                        $('.malto').val("");
                                        $('#subject1').val("");
                                        $(".summernote2").code("");
                                        $(".reminderon1").hide();
                                        $("#reminderdate1").val("");
                                        $("#remindertime1").val("");
                                    },
                                    complete: function() {
                                        $("#loading").hide();
                                        $("#wrapper").show();
                                        $(".scroll").trigger('click');
                                    }
                                });
                            }
                        }
                    }
                }
            });
            $(".prvbtn1").click(function() {
                var message = $(".summernote2").code();
                var url = "<?php echo url('/'); ?>/user_banner_details";
                $.ajax({
                    url: url,
                    data: '_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        var user_banner = response;
                        var preview = '<div style="padding:10px;"><div style="padding: 20px">' +
                            user_banner + '</div><p style="margin-bottom: 0;">' + message +
                            '</p></div>';
                        $("#modall #modal-body").html(preview);
                        $('#modall').modal('show');
                    }
                });

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".dateonsub2").click(function() {
                $(".dateon2").show();
                $(".reminderon2").hide();
            });
            $(".reminderonsub2").click(function() {
                $(".reminderon2").show();
                $(".dateon2").hide();
            });
        });
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            // alert(maxDate);
            $('#reminderdate2').attr('min', maxDate);
            $('#sendon2').attr('min', maxDate);
        });
        $(document).ready(function() {
            $("#sendon2").on("change", function() {
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format(this.getAttribute("data-date-format"))
                )
            }).trigger("change");
            $("#reminderdate2").on("change", function() {
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format(this.getAttribute("data-date-format"))
                )
            }).trigger("change");
            $(".subbtn2").click(function() {
                var submit_value = $(this).text();
                // alert(submit_value);
                $("#submit_button2").val(submit_value);
                $("#submit_button2").trigger('click');
            });
            $("#manage_client_video_submit").submit(function(e) {
                //---------------^---------------
                e.preventDefault();
                if ($(".malto").val() == "") {
                    $("#emailer").html("Please select atleast one client !!");
                    $('html, body').animate({
                        scrollTop: $(".nav-button-tabs").offset().top
                    }, 500);
                } else {

                    $("#emailer").html("");
                    if ($(".summernote3").code() == "") {
                        $("#textre2").html("Please Enter message !!!");
                        $('html, body').animate({
                            scrollTop: $(".summernote3").offset().top
                        }, 500);
                    } else {
                        $("#textre2").html("");
                        var submit_value = $("#submit_button2").val();
                        var message = $(".summernote3").code();
                        var formData = new FormData(this);
                        formData.append("message", message);
                        if (submit_value == "Send Now") {
                            $.ajax({
                                type: "POST",
                                beforeSend: function() {
                                    $("#loading").show();
                                    $("#wrapper").hide();
                                },
                                url: "manage_client_video_submit",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(html) {
                                    // alert(html);
                                    $(".checkboxes").prop('checked', false);
                                    $(".group-checkable").prop('checked', false);
                                    $("tbody tr").removeClass("active");
                                    $("#success_card2").html(html);
                                    $('#success_card2').fadeIn('fast').delay(20000).fadeOut(
                                        'fast');
                                    $('.malto').val("");
                                    $('#subject2').val("");
                                    $(".summernote3").code("");
                                },
                                complete: function() {
                                    $("#loading").hide();
                                    $("#wrapper").show();
                                }
                            });
                        } else if (submit_value == "Send On") {
                            if ($("#sendon2").val() == "") {
                                $("#send_on_alert2").html("Date is required!");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    beforeSend: function() {
                                        $("#loading").show();
                                        $("#wrapper").hide();
                                    },
                                    url: "manage_client_video_send_on",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(html) {
                                        // alert(html);
                                        $(".checkboxes").prop('checked', false);
                                        $(".group-checkable").prop('checked', false);
                                        $("tbody tr").removeClass("active");
                                        $("#success_card2").html(html);
                                        $('#success_card2').fadeIn('fast').delay(20000).fadeOut(
                                            'fast');
                                        $('.malto').val("");
                                        $('#subject2').val("");
                                        $(".summernote3").code("");
                                        $("#sendon2").val("");
                                        $(".dateon2").hide();
                                    },
                                    complete: function() {
                                        $("#loading").hide();
                                        $("#wrapper").show();
                                    }
                                });
                            }
                        } else if (submit_value == "Send With Reminder") {

                            if ($("#reminderdate2").val() == "") {
                                $("#reminder_date_alert2").html("Date is required!");
                            } else if ($("#remindertime2").val() == "") {
                                $("#reminder_date_alert2").hide();
                                $("#reminder_time_alert2").html("Time is required!");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    beforeSend: function() {
                                        $("#loading").show();
                                        $("#wrapper").hide();
                                    },
                                    url: "manage_client_video_send_with_reminder",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(html) {
                                        $(".checkboxes").prop('checked', false);
                                        $(".group-checkable").prop('checked', false);
                                        $("tbody tr").removeClass("active");
                                        $("#success_card2").html(html);
                                        $('#success_card2').fadeIn('fast').delay(20000).fadeOut(
                                            'fast');
                                        $('.malto').val("");
                                        $('#subject2').val("");
                                        $(".summernote3").code("");
                                        $(".reminderon2").hide();
                                        $("#reminderdate2").val("");
                                        $("#remindertime2").val("");
                                    },
                                    complete: function() {
                                        $("#loading").hide();
                                        $("#wrapper").show();
                                        $(".scroll").trigger('click');
                                    }
                                });
                            }
                        }
                    }
                }
            });
            $(".prvbtn2").click(function() {
                var message = $(".summernote3").code();
                var url = "<?php echo url('/'); ?>/user_banner_details";
                $.ajax({
                    url: url,
                    data: '_token={{ csrf_token() }}',
                    type: "POST",
                    success: function(response) {
                        // alert(response);
                        var user_banner = response;
                        var preview = '<div style="padding:10px;"><div style="padding: 20px">' +
                            user_banner + '</div><p style="margin-bottom: 0;">' + message +
                            '</p></div>';
                        $("#modall #modal-body").html(preview);
                        $('#modall').modal('show');
                    }
                });

            });
        });
        $(document).on("click", ".actual_month_revenue", function() {
            var idd = $(this).attr('id');
            var id = idd.split('revactual');
            var month = id[0];
            // alert(month);
            var url = "<?php echo url('/'); ?>/revenue_actual_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".actual_other_revenue", function() {
            var idd = $(this).attr('id');
            var id = idd.split('otheractual');
            var month = id[0];
            // alert(month);
            var url = "<?php echo url('/'); ?>/other_revenue_actual_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });

        function uncheck() {

            console.log();
        }


        $(document).on("click", ".actual_monthly_expense", function() {
            var idd = $(this).attr('id');
            var id = idd.split('actualexpense');
            var month = id[0];
            var name = id[1];
            // alert(month);
            var url = "<?php echo url('/'); ?>/expense_actual_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'month=' + month + '&name=' + name + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".actual_quarter_revenue", function() {
            var idd = $(this).attr('id');
            var id = idd.split('qrevactual');
            var month = id[0];
            // alert(month);
            var url = "<?php echo url('/'); ?>/quarterrevenue_actual_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".quarteractual_other_revenue", function() {
            var idd = $(this).attr('id');
            var id = idd.split('qotheractual');
            var month = id[0];
            // alert(month);
            var url = "<?php echo url('/'); ?>/quarterother_revenue_actual_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'month=' + month + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
        $(document).on("click", ".actual_quarterly_expense", function() {
            var idd = $(this).attr('id');
            var id = idd.split('qactualexpense');
            var month = id[0];
            var name = id[1];
            // alert(month);
            var url = "<?php echo url('/'); ?>/quarterexpense_actual_details";

            $.ajax({
                url: url,
                beforeSend: function() {
                    $("#loading").show();
                    $("#wrapper").hide();
                },
                data: 'month=' + month + '&name=' + name + '&_token={{ csrf_token() }}',
                type: "POST",
                success: function(response) {
                    // alert(response);
                    $("#monthly_details").html(response);
                },
                complete: function() {
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
    </script>
@endsection
