@extends('layouts.main')
@section("content")
<style type="text/css">
    p{
        margin-bottom: 0px;
    }
    input#sendon, input#reminderdate {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#sendon:before, input#reminderdate:before {
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input#sendon::-webkit-datetime-edit, input#sendon::-webkit-inner-spin-button, input#sendon::-webkit-clear-button {
        display: none;
    }
    input#reminderdate::-webkit-datetime-edit, input#reminderdate::-webkit-inner-spin-button, input#reminderdate::-webkit-clear-button {
        display: none;
    }

    input#sendon::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    input#reminderdate::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    input#sendon1, input#reminderdate1 {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#sendon1:before, input#reminderdate1:before {
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input#sendon1::-webkit-datetime-edit, input#sendon1::-webkit-inner-spin-button, input#sendon1::-webkit-clear-button {
        display: none;
    }
    input#reminderdate1::-webkit-datetime-edit, input#reminderdate1::-webkit-inner-spin-button, input#reminderdate1::-webkit-clear-button {
        display: none;
    }

    input#sendon1::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    input#reminderdate1::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    input#sendon2, input#reminderdate2 {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#sendon2:before, input#reminderdate2:before {
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input#sendon2::-webkit-datetime-edit, input#sendon2::-webkit-inner-spin-button, input#sendon2::-webkit-clear-button {
        display: none;
    }
    input#reminderdate2::-webkit-datetime-edit, input#reminderdate2::-webkit-inner-spin-button, input#reminderdate2::-webkit-clear-button {
        display: none;
    }

    input#sendon2::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    input#reminderdate2::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    .record:hover{
        color: red;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <!-- tabs content -->
            <div class="col-md-12 col-sm-2">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Appointments / Manage Appointments</h4>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                    <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                    <?php } ?>
                    <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                    <?php } ?>
                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                </div>
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-button-tabs nav-justified" style="">
                        <li><a href="{{ url('manage_appointment') }}">Appointment History</a></li>
                        <li><a href="{{ url('client_list') }}">Client List</a></li>
                        <li class="active"><a href="{{ url('manage_appointment_client') }}">Manage Client</a></li>
                    </ul>
                    <div class="tab-content margin-top-10" style="">
                        <div class="col-md-6">
                            <label style="display: inline-flex;">
                                <select class="form-control input-xsmall input-inline margin-right-10" style="margin-top: -10px;">
                                    <option value="5">5</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="-1">All</option>
                                </select>
                                records
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label style="display: inline-flex; float: right;">Search:<input type="search" class="form-control input-small input-inline margin-left-10" placeholder="" style="margin-top: -10px;" id="filter" /></label>
                        </div>
                        <div class="col-md-12 margin-bottom-40 margin-top-20 padding-0" id="results">
                            <?php
                            foreach($clients as $value){
                            ?>

                                    <div class="col-md-3 margin-bottom-20 reslt">
                                        <div class="col-md-12 shadow-boxx" style="padding: 10px;">

                                            <div class="col-md-12 text-center padding-0 margin-top-20">
                                                <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                    <tbody>
                                                        <tr colspan="2" style="">
                                                            <span class="text-center">
                                                                <img src="{{ asset('public/assets/images/client') }}/<?= $value->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px; object-fit:cover;
                                                                min-width: 130px; min-height:130px " width="130" height="130" alt="featured item" />
                                                            </span>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Name : </b></td>
                                                            <td style="white-space: nowrap;"><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="white-space: nowrap;"><b>Start Date : </b></td>
                                                            <td><?= date('d F Y', strtotime($value->created_at)) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="white-space: nowrap;"><b>YTD Paid : </b></td>
                                                            <td>
                                                                <a class="record" href="{{route('revenue_records_pos')}}?client=<?= $value->id ?>">
                                                                    <?= $paid_amount = \App\Http\Controllers\HomeController::calculatepaidamount($value->email); ?>

                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td><b>Balance : </b></td>
                                                            <td>
                                                                <a class="record" href="{{route('revenue_records_neg')}}?client=<?= $value->id ?>">
                                                                    <?= $paid_amount = \App\Http\Controllers\HomeController::calculatebalance($value->email); ?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Appointment : </b></td>
                                                            <td>
                                                                <a class="record" href="{{ url('manage_appointment') }}?client=<?= $value->id ?>">
                                                                    <?= $appcount = \App\Http\Controllers\HomeController::appointment_get_count($value->id) ?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="white-space: nowrap;"><b>Change Apptmt : </b></td>
                                                            <td>
                                                                <a class="record" href="{{ url('manage_appointment') }}?client=<?= $value->id ?>">
                                                                    <?= $appcount2 = \App\Http\Controllers\HomeController::change_appointment_get_count($value->id) ?></td>
                                                                </a>
                                                        </tr>
                                                        <tr>
                                                            <td style="white-space: nowrap;"><b>Cancel Apptmt : </b></td>
                                                            <td>
                                                                <a class="record" href="{{ url('manage_appointment') }}?client=<?= $value->id ?>">
                                                                    <?= $appcount3 = \App\Http\Controllers\HomeController::cancel_appointment_get_count($value->id) ?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Faith : </b></td>
                                                            <td><?= $value->religion ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="col-md-12 text-center padding-0">
                                                    <a href="{{ url('appointment_step3') }}/<?= $value->id ?>" class="btn btn-xs btn-info custom-padding">Make Apptmt</a>
                                                    <a href="#" data-toggle="modal" data-target="#modalRegister<?= $value->id ?>" class="btn btn-xs btn-info custom-padding">Send Mail</a>
                                                    <a href="#" class="btn btn-xs btn-info custom-padding">More Info</a>
                                                </div>
                                            </div>
                                            {{-- <div class="clearfix"></div>
                                            <hr /> --}}

                                            <div id="modalRegister<?= $value->id ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title" style="text-align-last: center">Send Mail</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <form action="{{ url('appointment_email_send') }}" method="POST" role="form" enctype="multipart/form-data">
                                                                        @csrf
                                                                            <div class="col-md-12">
                                                                                <input type="email" class="form-control" placeholder="To" name="email" value="<?= $value->email ?>" readonly />
                                                                            </div>
                                                                            <div class="col-md-12 margin-top-20">
                                                                                <input type="text" name="subject" class="form-control" placeholder="Subject" id="subject">
                                                                            </div>
                                                                            <div class="col-md-12 margin-top-20">
                                                                                <textarea class="form-control" name="message" placeholder="Enter message"></textarea>
                                                                            </div>
                                                                            <div class="col-md-12 text-center margin-top-20">
                                                                                <button type="submit" class="btn btn-info subbtn">Send </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                            <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <p style="color: red" id="emailer"></p>
                            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <tr>
                                        <th class="table-checkbox">
                                            <input type="checkbox" class="group-checkable" data-set="#datatable_sample checkboxes" />
                                        </th>
                                        <th>Client Name</th>
                                        <th>Client Email</th>
                                        <th>D. O. B</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($clients as $value) {
                                    ?>
                                            <tr class="odd gradeX">
                                                <td><input type="checkbox" class="checkboxes" value="<?= $value->id ?>" /></td>
                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                <td><?= $value->email ?></td>
                                                <td><?= date('d M Y', strtotime($value->dob)) ?></td>
                                                <td><?= $value->cell_phone ?></td>
                                                <td><?= $value->status ?></td>
                                                <td>
                                                    <form action="{{ url('edit_clientf') }}" method="post" style="padding: 0; float: left;">
                                                    @csrf
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <input type="submit" class="btn btn-xs btn-success" value="Edit">
                                                    </form>
                                                    <a href="{{ url('delete_clientf') }}/<?= $value->id ?>" class="btn btn-xs btn-danger" style="float: left;">Delete</a>
                                                    <a href="{{ url('appointment_step3') }}/{{ $value->id }}" class="btn btn-xs btn-info" style="float: left;">Make Appointment</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="divider divider-center divider-short">
                        <i class="fa fa-star-o"></i>
                    </div>

                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#email-tab" data-toggle="tab">Send Email</a></li>
                            <li><a href="#card-tab" data-toggle="tab">Send Card</a></li>
                            <li><a href="#video-tab" data-toggle="tab">Send Video</a></li>
                        </ul>

                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="email-tab">
                                <form id="client_manage_submit" class="margin-bottom-0" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required />
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
                                                    <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send With Clock</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info reminderonsub" style="width: 100%;">Send With Reminders</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info prvbtn" style="width: 100%;">Preview</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send Now</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding: 0px;">
                                                        <a class="btn btn-xs btn-info dateonsub" style="width: 100%;">Send On</a>

                                                    </div>
                                                    <input type="submit" id="submit_button" value="" style="display: none">
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $date = date('Y-m-d');
                                        ?>
                                        <div class="col-md-12">
                                            <div class="col-md-12 dateon" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="date" name="sendon" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= $date ?>" id="sendon">
                                                        <p style="color: red" id="send_on_alert"></p>
                                                    </div>
                                                    <div class="col-md-2" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12 reminderon" style="margin-top: 10px; display: none;">
                                                <div class="row">
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" name="reminderdate" id="reminderdate">

                                                        <p style="color: red" id="reminder_date_alert"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="time" class="form-control" name="remindertime" id="remindertime">
                                                        <p style="color: red" id="reminder_time_alert"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0; ">
                                                        <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send With Reminder</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center" style="padding: 15px">
                                            <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="card-tab">
                                <form class="margin-bottom-0" method="POST" id="manage_client_card_submit" role="form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12 padding-0 text-center" style="background-color: #da291c; color: #fff; padding-top: 10px; padding-bottom: 10px;">
                                                Card Categories
                                            </div>
                                            <div class="col-md-12 padding-0">
                                                <ul class="nav nav-tabs nav-bottom-border category-ul">
                                                    <?php
                                                    $c = 0;
                                                        foreach($category as $value){
                                                    ?>
                                                            <li class="<?php if($c == 0){echo 'active';} ?>"><a href="#<?= $value->category ?>" data-toggle="tab"><?= $value->category ?></a></li>
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
                                                    <div class="tab-pane fade in <?php if($k == 0){echo 'active';} ?>" id="<?= $value->category ?>">
                                                        <div class="col-md-12 padding-0">
                                                            <?php

                                                            foreach ($imgs as $img) { ?>



                                                            <div class="col-md-2" style="margin-bottom: 10px;">
                                                                <img src="<?php echo asset('public/images')?>/<?= $img->image ?>" alt="" class="card_img" style="width: 100%;" />
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
                                                <input type="text" class="form-control" name="subject" id="subject1" placeholder="Subject" required />
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
                                                        <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn1" style="width: 100%;">Send With Clock</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info reminderonsub1" style="width: 100%;">Send With Reminders</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info prvbtn1" style="width: 100%;">Preview</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn1" style="width: 100%;">Send Now</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding: 0px;">
                                                            <a class="btn btn-xs btn-info dateonsub1" style="width: 100%;">Send On</a>

                                                        </div>
                                                        <input type="submit" id="submit_button1" value="" style="display: none">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 dateon1" style="margin-top: 10px; display: none;">
                                                    <div class="row">
                                                        <div class="col-md-6"></div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="date" name="sendon" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="sendon1">
                                                            <p style="color: red" id="send_on_alert1"></p>
                                                        </div>
                                                        <div class="col-md-2" style="padding: 0; ">
                                                            <a class="btn btn-xs btn-info subbtn1" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 reminderon1" style="margin-top: 10px; display: none;">
                                                    <div class="row">
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" name="reminderdate" id="reminderdate1">

                                                            <p style="color: red" id="reminder_date_alert1"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="time" class="form-control" name="remindertime" id="remindertime1">
                                                            <p style="color: red" id="reminder_time_alert1"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0; ">
                                                            <a class="btn btn-xs btn-info subbtn1" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send With Reminder</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center" style="padding: 15px">
                                            <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card1"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="video-tab">
                                <form class="margin-bottom-0" method="POST" id="manage_client_video_submit" role="form" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="subject" id="subject2" placeholder="Subject" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-2 padding-0">
                                                    <label class="margin-top-10">Video File: </label>
                                                </div>
                                                <div class="col-md-10 padding-0">
                                                    <div class="fancy-file-upload fancy-file-danger">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control" name="video" onchange="jQuery(this).next('input').val(this.value);"  accept="video/*" required />
                                                        <input type="text" class="form-control" placeholder="no file selected" readonly="" />
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
                                                        <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn2" style="width: 100%;">Send With Clock</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info reminderonsub2" style="width: 100%;">Send With Reminders</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info prvbtn2" style="width: 100%;">Preview</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn2" style="width: 100%;">Send Now</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding: 0px;">
                                                            <a class="btn btn-xs btn-info dateonsub2" style="width: 100%;">Send On</a>

                                                        </div>
                                                        <input type="submit" id="submit_button2" value="" style="display: none">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $date = date('Y-m-d');
                                            ?>
                                            <div class="col-md-12">
                                                <div class="col-md-12 dateon2" style="margin-top: 10px; display: none;">
                                                    <div class="row">
                                                        <div class="col-md-6"></div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="date" name="sendon" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= $date ?>" id="sendon2">
                                                            <p style="color: red" id="send_on_alert2"></p>
                                                        </div>
                                                        <div class="col-md-2" style="padding: 0; ">
                                                            <a class="btn btn-xs btn-info subbtn2" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 reminderon2" style="margin-top: 10px; display: none;">
                                                    <div class="row">
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" name="reminderdate" id="reminderdate2">

                                                            <p style="color: red" id="reminder_date_alert2"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <input type="time" class="form-control" name="remindertime" id="remindertime2">
                                                            <p style="color: red" id="reminder_time_alert2"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0; ">
                                                            <a class="btn btn-xs btn-info subbtn2" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send With Reminder</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center" style="padding: 15px">
                                                <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div id="modall" class="modal fade" role='dialog'>
        <div class="modal-dialog">
            <div class="modal-content" style="background: white">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div  id= "modal-body"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<button class="scroll" style="display: none;"></button>
<script type="text/javascript">
    $(document).on('click','.checkboxes',function(){
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
                success: function (response) {
                    // alert(response);
                    var marr = [];
                    for (var i = 0; i < response.length; ++i) {
                        marr.push(response[i]);
                    }
                    $('.malto').val(marr);
                    // mail_arr.push(response);
                }
            });
        }
        else{
            $(this).removeClass("checked");
            var id = $(this).val();
            var smail = "";
            var mails = $(".malto").val();
            $.ajax({
                  url: "<?php echo url('/'); ?>/uncheckboxesmail",
                  data: 'id=' + id + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    smail = response;
                }
            })
            .then( function( data ) {
                $.ajax({
                    url:  "<?php echo url('/'); ?>/uncheckedboxesmail",
                    data: 'id=' + id + '&mails=' + mails + '&_token={{ csrf_token() }}',
                    type: "POST",
                    success: function (response) {
                        $('.malto').val(response);
                    }
                });
            });
        }
    });
    $(document).on("change", ".group-checkable", function(){
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
        if($(this).prop('checked')){
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
                success: function (response) {
                    // alert(response);
                    var marr = [];
                    for (var i = 0; i < response.length; ++i) {
                        marr.push(response[i]);
                    }
                    $('.malto').val(marr);
                    mail_arr.push(response);
                }
            });
        }
        else{
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
    $(document).on("change", "tbody tr .checkboxes", function () {
        if ($(this).prop('checked')) {

        }
        else{
            $(".group-checkable").prop('checked', false);
        }
    });
    $(document).ready(function(){
        $(".dateonsub").click(function(){
            $(".dateon").show();
            $(".reminderon").hide();
        });
        $(".reminderonsub").click(function(){
            $(".reminderon").show();
            $(".dateon").hide();
        });
    });
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#reminderdate').attr('min', maxDate);
        $('#sendon').attr('min', maxDate);
    });
    $(document).ready(function(){
        $("#sendon").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $("#reminderdate").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
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
            if($(".malto").val() == ""){
                $("#emailer").html("Please select atleast one client !!");
                $('html, body').animate({
                    scrollTop: $(".nav-button-tabs").offset().top
                }, 500);
            }
            else{

                $("#emailer").html("");
                if($(".summernote1").code() == ""){
                    $("#textre").html("Please Enter message !!!");
                    $('html, body').animate({
                        scrollTop: $(".summernote1").offset().top
                    }, 500);
                }
                else{
                    $("#textre").html("");
                    var submit_value  = $("#submit_button").val();
                    var message       = $(".summernote1").code();
                    var bakg          = $("#bakg").val();
                    var formData = new FormData(this);
                    formData.append("message", message);
                    formData.append("bakg", bakg);
                    if(submit_value == "Send Now"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "manage_client_submit",
                          data:  formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                          success: function(html) {
                            // alert(html);
                            $(".checkboxes").prop('checked', false);
                            $(".group-checkable").prop('checked', false);
                            $("tbody tr").removeClass("active");
                            $("#success_card").html(html);
                            $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                            $('.malto').val("");
                            $('#subject').val("");
                            $(".summernote1").code("");
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
                    }
                    else if(submit_value == "Send On"){
                        if($("#sendon").val() == "")
                        {
                            $("#send_on_alert").html("Date is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "manage_client_send_on",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card").html(html);
                                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject').val("");
                                $(".summernote1").code("");
                                $("#sendon").val("");
                                $(".dateon").hide();
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                            });
                        }
                    }
                    else if(submit_value == "Save"){

                        if($("#reminderdate").val() == "")
                        {
                            $("#reminder_date_alert").html("Date is required!");
                        }
                        else if($("#remindertime").val() == "")
                        {
                            $("#reminder_date_alert").hide();
                            $("#reminder_time_alert").html("Time is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "manage_client_send_with_reminder",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card").html(html);
                                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject').val("");
                                $(".summernote1").code("");
                                $(".reminderon").hide();
                                $("#reminderdate").val("");
                                $("#remindertime").val("");
                              },
                              complete: function(){
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
        $(".prvbtn").click(function(){
            var bakg  = $("#bakg").val();
            var message  = $(".summernote1").code();
            var url = "<?php echo url('/'); ?>/user_banner_details";
            $.ajax({
                  url: url,
                  data: '_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var user_banner = response;
                    var preview = '<div style="padding:10px; background-color:'+bakg+'"><div style="padding: 5px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
                    $("#modall #modal-body").html(preview);
                    $('#modall').modal('show');
                }
            });

        });
        $(".color-td").click(function(){
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
        $(".card_img").click(function()
        {
            // alert($(this).attr('src'));
            $(".card_img").css({'border' : 'none', 'padding' : '0'})
            var img_path = $(this).attr('src');
            $("#img_path").val(img_path);
            $(this).css({'border' : '3px solid red', 'padding' : '2px'});
        });
    });
    $(document).ready(function(){
        $(".dateonsub1").click(function(){
            $(".dateon1").show();
            $(".reminderon1").hide();
        });
        $(".reminderonsub1").click(function(){
            $(".reminderon1").show();
            $(".dateon1").hide();
        });
    });
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#reminderdate1').attr('min', maxDate);
        $('#sendon1').attr('min', maxDate);
    });
    $(document).ready(function(){
        $("#sendon1").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $("#reminderdate1").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
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
            if($(".malto").val() == ""){
                $("#emailer").html("Please select atleast one client !!");
                $('html, body').animate({
                    scrollTop: $(".nav-button-tabs").offset().top
                }, 500);
            }
            else{

                $("#emailer").html("");
                if($(".summernote2").code() == ""){
                    $("#textre1").html("Please Enter message !!!");
                    $('html, body').animate({
                        scrollTop: $(".summernote2").offset().top
                    }, 500);
                }
                else{
                    $("#textre1").html("");
                    var submit_value  = $("#submit_button1").val();
                    var message       = $(".summernote2").code();
                    var formData = new FormData(this);
                    formData.append("message", message);
                    if(submit_value == "Send Now"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "manage_client_card_submit",
                          data:  formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                          success: function(html) {
                            // alert(html);
                            $(".checkboxes").prop('checked', false);
                            $(".group-checkable").prop('checked', false);
                            $("tbody tr").removeClass("active");
                            $("#success_card1").html(html);
                            $('#success_card1').fadeIn('fast').delay(20000).fadeOut('fast');
                            $('.malto').val("");
                            $('#subject1').val("");
                            $(".summernote2").code("");
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
                    }
                    else if(submit_value == "Send On"){
                        if($("#sendon1").val() == "")
                        {
                            $("#send_on_alert1").html("Date is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "manage_client_card_send_on",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card1").html(html);
                                $('#success_card1').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject1').val("");
                                $(".summernote2").code("");
                                $("#sendon1").val("");
                                $(".dateon1").hide();
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                            });
                        }
                    }
                    else if(submit_value == "Send With Reminder"){

                        if($("#reminderdate1").val() == "")
                        {
                            $("#reminder_date_alert1").html("Date is required!");
                        }
                        else if($("#remindertime1").val() == "")
                        {
                            $("#reminder_date_alert1").hide();
                            $("#reminder_time_alert1").html("Time is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "manage_client_card_send_with_reminder",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card1").html(html);
                                $('#success_card1').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject1').val("");
                                $(".summernote2").code("");
                                $(".reminderon1").hide();
                                $("#reminderdate1").val("");
                                $("#remindertime1").val("");
                              },
                              complete: function(){
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
        $(".prvbtn1").click(function(){
            var message  = $(".summernote2").code();
            var url = "<?php echo url('/'); ?>/user_banner_details";
            $.ajax({
                  url: url,
                  data: '_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var user_banner = response;
                    var preview = '<div style="padding:10px;"><div style="padding: 20px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
                    $("#modall #modal-body").html(preview);
                    $('#modall').modal('show');
                }
            });

        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".dateonsub2").click(function(){
            $(".dateon2").show();
            $(".reminderon2").hide();
        });
        $(".reminderonsub2").click(function(){
            $(".reminderon2").show();
            $(".dateon2").hide();
        });
    });
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#reminderdate2').attr('min', maxDate);
        $('#sendon2').attr('min', maxDate);
    });
    $(document).ready(function(){
        $("#sendon2").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");
        $("#reminderdate2").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
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
            if($(".malto").val() == ""){
                $("#emailer").html("Please select atleast one client !!");
                $('html, body').animate({
                    scrollTop: $(".nav-button-tabs").offset().top
                }, 500);
            }
            else{

                $("#emailer").html("");
                if($(".summernote3").code() == ""){
                    $("#textre2").html("Please Enter message !!!");
                    $('html, body').animate({
                        scrollTop: $(".summernote3").offset().top
                    }, 500);
                }
                else{
                    $("#textre2").html("");
                    var submit_value  = $("#submit_button2").val();
                    var message       = $(".summernote3").code();
                    var formData = new FormData(this);
                    formData.append("message", message);
                    if(submit_value == "Send Now"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "manage_client_video_submit",
                          data:  formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                          success: function(html) {
                            // alert(html);
                            $(".checkboxes").prop('checked', false);
                            $(".group-checkable").prop('checked', false);
                            $("tbody tr").removeClass("active");
                            $("#success_card2").html(html);
                            $('#success_card2').fadeIn('fast').delay(20000).fadeOut('fast');
                            $('.malto').val("");
                            $('#subject2').val("");
                            $(".summernote3").code("");
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
                    }
                    else if(submit_value == "Send On"){
                        if($("#sendon2").val() == "")
                        {
                            $("#send_on_alert2").html("Date is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "manage_client_video_send_on",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                // alert(html);
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card2").html(html);
                                $('#success_card2').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject2').val("");
                                $(".summernote3").code("");
                                $("#sendon2").val("");
                                $(".dateon2").hide();
                              },
                              complete: function(){
                                $("#loading").hide();
                                $("#wrapper").show();
                              }
                            });
                        }
                    }
                    else if(submit_value == "Send With Reminder"){

                        if($("#reminderdate2").val() == "")
                        {
                            $("#reminder_date_alert2").html("Date is required!");
                        }
                        else if($("#remindertime2").val() == "")
                        {
                            $("#reminder_date_alert2").hide();
                            $("#reminder_time_alert2").html("Time is required!");
                        }
                        else{
                            $.ajax({
                              type: "POST",
                              beforeSend: function(){
                                $("#loading").show();
                                $("#wrapper").hide();
                              },
                              url: "manage_client_video_send_with_reminder",
                              data:  formData,
                                contentType: false,
                                cache: false,
                                processData:false,
                              success: function(html) {
                                $(".checkboxes").prop('checked', false);
                                $(".group-checkable").prop('checked', false);
                                $("tbody tr").removeClass("active");
                                $("#success_card2").html(html);
                                $('#success_card2').fadeIn('fast').delay(20000).fadeOut('fast');
                                $('.malto').val("");
                                $('#subject2').val("");
                                $(".summernote3").code("");
                                $(".reminderon2").hide();
                                $("#reminderdate2").val("");
                                $("#remindertime2").val("");
                              },
                              complete: function(){
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
        $(".prvbtn2").click(function(){
            var message  = $(".summernote3").code();
            var url = "<?php echo url('/'); ?>/user_banner_details";
            $.ajax({
                  url: url,
                  data: '_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    var user_banner = response;
                    var preview = '<div style="padding:10px;"><div style="padding: 20px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
                    $("#modall #modal-body").html(preview);
                    $('#modall').modal('show');
                }
            });

        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#monthlylist').each(function() {

          var year = (new Date()).getFullYear();
          var current = year;
          year -= 0;
          for (var i = 0; i < 10; i++) {
            if ((year-i) == current)
              $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
            else
              $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
          }

        });
        $('#quarterlylist').each(function() {

          var year = (new Date()).getFullYear();
          var current = year;
          year -= 0;
          for (var i = 0; i < 10; i++) {
            if ((year-i) == current)
              $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
            else
              $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
          }

        })
        setTimeout(function() {
            $("#monthlylist").trigger('change');
            $("#quarterlylist").trigger('change');
        },10);
        $("#monthlylist").change(function(){
            // alert($(this).val());
            var year = $(this).val();
            var url = "<?php echo url('/'); ?>/monthlylistappointment";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'year=' + year + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $("#monthly_tbody").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        });
        $("#quarterlylist").change(function(){
            // alert($(this).val());
            var year = $(this).val();
            var url = "<?php echo url('/'); ?>/quarterlylistappointment";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'year=' + year + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $("#quarterly_tbody").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        });
    });
</script>
<script type="text/javascript">
    $("#filter").keyup(function() {

      // Retrieve the input field text and reset the count to zero
      var filter = $(this).val(),
        count = 0;

      // Loop through the comment list
      $('#results .reslt').each(function() {


        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
          $(this).hide();  // MY CHANGE

          // Show the list item if the phrase matches and increase the count by 1
        } else {
          $(this).show(); // MY CHANGE
          count++;
        }

      });

    });
</script>
@endsection
