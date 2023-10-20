@extends('layouts.main')
@section('content')
    <?php use Carbon\Carbon; ?>
    <style type="text/css">
        p {
            margin-bottom: 0px;
        }

        p,
        pre,
        ul,
        ol,
        dl,
        dd,
        blockquote,
        address,
        table,
        fieldset,
        form {
            margin-bottom: 0px !important;
        }

        input#sendon,
        input#reminderdate {
            position: relative;
            /*width: 150px; height: 20px;*/
            /*color: white;*/
        }

        input#sendon:before,
        input#reminderdate:before {
            position: absolute;
            /*top: 3px; left: 3px;*/
            content: attr(data-date);
            display: inline-block;
            color: black;
        }

        input#sendon::-webkit-datetime-edit,
        input#sendon::-webkit-inner-spin-button,
        input#sendon::-webkit-clear-button {
            display: none;
        }

        input#reminderdate::-webkit-datetime-edit,
        input#reminderdate::-webkit-inner-spin-button,
        input#reminderdate::-webkit-clear-button {
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

        input#sendon1,
        input#reminderdate1 {
            position: relative;
            /*width: 150px; height: 20px;*/
            /*color: white;*/
        }

        input#sendon1:before,
        input#reminderdate1:before {
            position: absolute;
            /*top: 3px; left: 3px;*/
            content: attr(data-date);
            display: inline-block;
            color: black;
        }

        input#sendon1::-webkit-datetime-edit,
        input#sendon1::-webkit-inner-spin-button,
        input#sendon1::-webkit-clear-button {
            display: none;
        }

        input#reminderdate1::-webkit-datetime-edit,
        input#reminderdate1::-webkit-inner-spin-button,
        input#reminderdate1::-webkit-clear-button {
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

        input#sendon2,
        input#reminderdate2 {
            position: relative;
            /*width: 150px; height: 20px;*/
            /*color: white;*/
        }

        input#sendon2:before,
        input#reminderdate2:before {
            position: absolute;
            /*top: 3px; left: 3px;*/
            content: attr(data-date);
            display: inline-block;
            color: black;
        }

        input#sendon2::-webkit-datetime-edit,
        input#sendon2::-webkit-inner-spin-button,
        input#sendon2::-webkit-clear-button {
            display: none;
        }

        input#reminderdate2::-webkit-datetime-edit,
        input#reminderdate2::-webkit-inner-spin-button,
        input#reminderdate2::-webkit-clear-button {
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

        .year-filter-wraper {
            text-align: right;
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
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified" style="">
                            <li class="active"><a href="{{ url('manage_appointment') }}">Appointment History</a></li>
                            <li><a href="{{ url('client_list') }}">Client List</a></li>
                            <li><a href="{{ url('manage_appointment_client') }}">Manage Client</a></li>
                        </ul>
                        <div class="tab-content margin-top-10"
                            style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab11">
                                    <div class="">
                                        <div class="year-filter-wraper">
                                            <a href="{{ url('/manage_appointment?year=2023') }}"
                                                class="{{ Request::get('year') == '2023' ? 'active1' : '' }} btn btn-md btn-info margin-right-10">2023</a>
                                            <a href="{{ url('/manage_appointment?year=2022') }}"
                                                class="{{ Request::get('year') == '2022' ? 'active1' : '' }} btn btn-md btn-info margin-right-10">2022</a>

                                        </div>
                                        <div class="table-scroll" id="tabledata"></div>
                                        <div id="table-scroll" class="table-scroll fw1">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered table-hover main-table"
                                                    id="">

                                                    <style>
                                                        /* CSS */


                                                        .button-1:hover,
                                                        .button-1:focus {
                                                            background-color: #f14d3b;
                                                        }

                                                        .active1 {
                                                            background: purple !important;
                                                        }
                                                    </style>
                                                    <thead>


                                                        <tr class="" style="cursor: pointer">
                                                            <th class=""></th>
                                                            <th data-month="1"
                                                                class="{{ request()->month == 1 ? 'active1' : '' }} month-clk button-1">
                                                                Jan</th>
                                                            <th data-month="2"
                                                                class="{{ request()->month == 2 ? 'active1' : '' }} month-clk button-1">
                                                                Feb</th>
                                                            <th data-month="3"
                                                                class="{{ request()->month == 3 ? 'active1' : '' }} month-clk button-1">
                                                                Mar</th>
                                                            <th data-month="4"
                                                                class="{{ request()->month == 4 ? 'active1' : '' }} month-clk button-1">
                                                                Apr</th>
                                                            <th data-month="5"
                                                                class="{{ request()->month == 5 ? 'active1' : '' }} month-clk button-1">
                                                                May</th>
                                                            <th data-month="6"
                                                                class="{{ request()->month == 6 ? 'active1' : '' }} month-clk button-1">
                                                                Jun</th>
                                                            <th data-month="7"
                                                                class="{{ request()->month == 7 ? 'active1' : '' }} month-clk button-1">
                                                                Jul</th>
                                                            <th data-month="8"
                                                                class="{{ request()->month == 8 ? 'active1' : '' }} month-clk button-1">
                                                                Aug</th>
                                                            <th data-month="9"
                                                                class="{{ request()->month == 9 ? 'active1' : '' }} month-clk button-1">
                                                                Sep</th>
                                                            <th data-month="10"
                                                                class="{{ request()->month == 10 ? 'active1' : '' }} month-clk button-1">
                                                                Oct</th>
                                                            <th data-month="11"
                                                                class="{{ request()->month == 11 ? 'active1' : '' }} month-clk button-1">
                                                                Nov</th>
                                                            <th data-month="12"
                                                                class="{{ request()->month == 12 ? 'active1' : '' }} month-clk button-1">
                                                                Dec</th>
                                                            <th data-month="all"
                                                                class="{{ request()->month == 'all' ? 'active1' : '' }} month-clk button-1">
                                                                Total</th>
                                                            <th data-month="graph"
                                                                class="{{ request()->month == 'graph' ? 'active1' : '' }} month-clk button-1">
                                                                Graph</th>
                                                        </tr>
                                                    </thead>

                                                </table>

                                                @if (request()->has('month'))
                                                    @if (request()->month == 'graph')
                                                        <div style="display: flex">

                                                            <div class="container bg-white col-md-8 mx-auto">
                                                                <div>
                                                                    <h3 style="text-align: center">
                                                                        Appointment History
                                                                    </h3>
                                                                </div>
                                                                <table>
                                                                    @php
                                                                        
                                                                        $max_val = max($graph_data_vals);
                                                                        // dd($graph_data);
                                                                        
                                                                        // rsort($graph_data);
                                                                    @endphp
                                                                    @foreach ($graph_data as $ind => $gd)
                                                                        @php
                                                                            $rgbColor = [];
                                                                            foreach (['r', 'g', 'b'] as $color) {
                                                                                $rgbColor[$color] = mt_rand(0, 255);
                                                                            }
                                                                        @endphp
                                                                        <tr>
                                                                            <td style="color:#da291c">{{ $gd['month'] }}
                                                                            </td>
                                                                            <td>
                                                                                <div class="badge"
                                                                                    style="background: #0000df">
                                                                                    <div
                                                                                        style="padding-left:5px;padding-right:5px;">
                                                                                        {{ $gd['val'] }}
                                                                                    </div>


                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div style="width: 400px; display:flex">
                                                                                    <div
                                                                                        style="border-radius:2px; width: {{ ($gd['val'] / $max_val) * 100 }}%; background: rgb(<?= implode(',', $rgbColor) ?>); height: 20px;">
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @if (request()->month != 'graph')
                                <p style="color: red" id="emailer"></p>
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                    <thead>
                                        <tr>
                                            <th class="table-checkbox">
                                                <input type="checkbox" class="group-checkable"
                                                    data-set="#datatable_sample checkboxes" />
                                            </th>
                                            <th>Client Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                 foreach ($appointments as $value) {
                                 ?>
                                        <tr>
                                            <td><input type="checkbox" class="checkboxes" value="<?= $value->cid ?>" /></td>
                                            <td><?= $value->client_first_name ?> <?= $value->client_last_name ?></td>
                                            <td><?= $value->client_email ?></td>
                                            <td><?= $value->client_phone ?></td>
                                            <td><?= date('d F Y', strtotime($value->appointment_date)) ?></td>
                                            <td><?= date('h:i A', strtotime($value->appointment_time)) ?></td>
                                            <?php if($value->cstatus == "off"){
                                     ?>
                                            <td>
                                                <a class="btn btn-xs btn-info" data-toggle="modal"
                                                    data-target="#modalAppointment<?= $value->aid ?>">Canceled</a>
                                                <div id="modalAppointment<?= $value->aid ?>" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">

                                                            <div class="modal-body">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                                <div class="col-md-12 shadow-boxx">
                                                                    <div class="col-md-12 margin-bottom-20"
                                                                        style="background-color: #da291c; padding: 0px; border-radius: 10px;">
                                                                        <h4
                                                                            style="color: #fff; font-weight: 400; margin-top: 10px; margin-bottom: 10px;">
                                                                            Appointment for <?= $value->client_first_name ?>
                                                                            <?= $value->client_last_name ?></h4>
                                                                    </div>
                                                                    <div class="col-md-12 padding-0">
                                                                        <table class="profile-info margin-bottom-10"
                                                                            style="width: 100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="width: 30%"><b>Date : </b>
                                                                                    </td>
                                                                                    <td style="width: 70%">
                                                                                        <b><?= date('d F Y', strtotime($value->appointment_date)) ?>,
                                                                                            <?= Carbon::parse($value->appointment_date)->format('l') ?></b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="width: 30%"><b>Time : </b>
                                                                                    </td>
                                                                                    <td style="width: 70%">
                                                                                        <b><?= date('h:i A', strtotime($value->appointment_time)) ?></b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="width: 30%"><b>With : </b>
                                                                                    </td>
                                                                                    <td style="width: 70%">
                                                                                        <?= $value->affiliate_first_name ?>
                                                                                        <?= $value->affiliate_last_name ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><b>Company: </b></td>
                                                                                    <td>&nbsp;<?= $value->affiliate_company ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="vertical-align: baseline;">
                                                                                        <b>Address: </b></td>
                                                                                    <td>&nbsp;<?= $value->affiliate_address ?>,<br>
                                                                                        State-
                                                                                        <?= $value->affiliate_state ?>,
                                                                                        Country-
                                                                                        <?= $value->affiliate_country ?>,
                                                                                        <?= $value->affiliate_city ?>-<?= $value->affiliate_zip ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><b>Phone: </b></td>
                                                                                    <td>&nbsp;<?= $value->affiliate_phone ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="width: 30%; vertical-align: baseline;">
                                                                                        <b>Reason : </b></td>
                                                                                    <td style="width: 70%">
                                                                                        <?= $value->appointment_reason ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php
                                     }else{
                                     ?>
                                            <td>
                                                <a class="btn btn-xs btn-info" data-toggle="modal"
                                                    data-target="#modalAppointmentt<?= $value->aid ?>">Active</a>
                                                <div id="modalAppointmentt<?= $value->aid ?>" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">

                                                            <div class="modal-body">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                                <div class="col-md-12 shadow-boxx">
                                                                    <div class="col-md-12 text-center margin-bottom-20"
                                                                        style="background-color: #da291c; padding: 0px; border-radius: 10px;">
                                                                        <h4
                                                                            style="color: #fff; font-weight: 400; margin-top: 10px; margin-bottom: 10px;">
                                                                            Appointment for <?= $value->client_first_name ?>
                                                                            <?= $value->client_last_name ?></h4>
                                                                    </div>
                                                                    <div class="col-md-12 text-center padding-0">
                                                                        <table class="profile-info margin-bottom-10"
                                                                            style="width: 100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="width: 30%"><b>Date : </b>
                                                                                    </td>
                                                                                    <td style="width: 70%">
                                                                                        <b><?= date('d F Y', strtotime($value->appointment_date)) ?>,
                                                                                            <?= Carbon::parse($value->appointment_date)->format('l') ?></b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="width: 30%"><b>Time : </b>
                                                                                    </td>
                                                                                    <td style="width: 70%">
                                                                                        <b><?= date('h:i A', strtotime($value->appointment_time)) ?></b>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="width: 30%"><b>With : </b>
                                                                                    </td>
                                                                                    <td style="width: 70%">
                                                                                        <?= $value->affiliate_first_name ?>
                                                                                        <?= $value->affiliate_last_name ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><b>Company: </b></td>
                                                                                    <td>&nbsp;<?= $value->affiliate_company ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="vertical-align: baseline;">
                                                                                        <b>Address: </b></td>
                                                                                    <td>&nbsp;<?= $value->affiliate_address ?>,<br>
                                                                                        State-
                                                                                        <?= $value->affiliate_state ?>,
                                                                                        Country-
                                                                                        <?= $value->affiliate_country ?>,
                                                                                        <?= $value->affiliate_city ?>-<?= $value->affiliate_zip ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><b>Phone: </b></td>
                                                                                    <td>&nbsp;<?= $value->affiliate_phone ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="width: 30%; vertical-align: baseline;">
                                                                                        <b>Reason : </b></td>
                                                                                    <td style="width: 70%">
                                                                                        <?= $value->appointment_reason ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                        <?php
                                 }
                                 ?>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="divider divider-center divider-short">
                        <!-- divider -->
                        <i class="fa fa-star-o"></i>
                    </div>

                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#email-tab" data-toggle="tab">Send Email</a></li>
                            <li><a href="#card-tab" data-toggle="tab">Send Card</a></li>
                            <li><a href="#video-tab" data-toggle="tab">Send Video</a></li>
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
                                                    <div class="col-md-5th text-center"
                                                        style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send
                                                            With Clock</a>
                                                    </div>
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
                                                                    alt="" class="card_img"
                                                                    style="width: 100%;" />
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
                                                        <div class="col-md-5th text-center"
                                                            style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn1"
                                                                style="width: 100%;">Send With Clock</a>
                                                        </div>
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
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <select class="form-control" name="reminderdate">
                                                                <option value="1">every hour</option>
                                                                <option value="2">every 2 hour</option>
                                                                <option value="3">every 3 hour</option>
                                                                <option value="4">every 4 hour</option>
                                                                <option value="5">every 5 hour</option>
                                                                <option value="6">every 6 hour</option>
                                                            </select>
                                                            <p style="color: red" id="reminder_date_alert1"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <select class="form-control" name="remindertime">
                                                                <option value="2">2times</option>
                                                                <option value="3">3times</option>
                                                                <option value="4">4times</option>
                                                                <option value="5">5times</option>
                                                                <option value="6">6times</option>
                                                            </select>
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
                                                        <div class="col-md-5th text-center"
                                                            style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn2"
                                                                style="width: 100%;">Send With Clock</a>
                                                        </div>
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
                                                        <input type="date" class="form-control" data-date=""
                                                            data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>"
                                                            name="reminderdate" id="reminderdate2">

                                                        <p style="color: red" id="reminder_date_alert2"></p>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 10px; ">
                                                        <input type="time" class="form-control" name="remindertime"
                                                            id="remindertime2">
                                                        <p style="color: red" id="reminder_time_alert2"></p>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <select class="form-control" name="reminderdate">
                                                                <option value="1">every hour</option>
                                                                <option value="2">every 2 hour</option>
                                                                <option value="3">every 3 hour</option>
                                                                <option value="4">every 4 hour</option>
                                                                <option value="5">every 5 hour</option>
                                                                <option value="6">every 6 hour</option>
                                                            </select>
                                                            <p style="color: red" id="reminder_date_alert2"></p>
                                                        </div>
                                                        <div class="col-md-4" style="padding: 0 10px; ">
                                                            <select class="form-control" name="remindertime">
                                                                <option value="2">2times</option>
                                                                <option value="3">3times</option>
                                                                <option value="4">4times</option>
                                                                <option value="5">5times</option>
                                                                <option value="6">6times</option>
                                                            </select>
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
                    <!-- <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#monthly-tab" data-toggle="tab">Monthly</a></li>
                            <li><a href="#quarterly-tab" data-toggle="tab">Quarterly</a></li>
                        </ul>

                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="monthly-tab">
                                <div class="col-md-4 col-md-offset-4">
                                    <select class="form-control select2" id="monthlylist">

                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
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
                            <div class="tab-pane fade" id="quarterly-tab">
                                <div class="col-md-4 col-md-offset-4">
                                    <select class="form-control select2" id="quarterlylist">

                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample1">
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
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
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
    </section>
    <button class="scroll" style="display: none;"></button>
    <form action="" method="get" class="month-filter">
        <input type="hidden" name="month" id="month-name">
    </form>
    <script type="text/javascript">
        $('.month-clk').on('click', function(e) {
            e.preventDefault();
            let month = $(this).data('month');
            $('#month-name').val(month);
            $('.month-filter').submit();
        })
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
                        // mail_arr.push(response);
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
                        mail_arr.push(response);
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
                        } else if (submit_value == "Save") {

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
                        } else if (submit_value == "Save") {

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
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#monthlylist').each(function() {

                var year = (new Date()).getFullYear();
                var current = year;
                year -= 0;
                for (var i = 0; i < 10; i++) {
                    if ((year - i) == current)
                        $(this).append('<option selected value="' + (year - i) + '">' + (year - i) +
                            '</option>');
                    else
                        $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
                }

            });
            $('#quarterlylist').each(function() {

                var year = (new Date()).getFullYear();
                var current = year;
                year -= 0;
                for (var i = 0; i < 10; i++) {
                    if ((year - i) == current)
                        $(this).append('<option selected value="' + (year - i) + '">' + (year - i) +
                            '</option>');
                    else
                        $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
                }

            })
            setTimeout(function() {
                $("#monthlylist").trigger('change');
                $("#quarterlylist").trigger('change');
            }, 10);
            $("#monthlylist").change(function() {
                // alert($(this).val());
                var year = $(this).val();
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
                });
            });
            $("#quarterlylist").change(function() {
                // alert($(this).val());
                var year = $(this).val();
                var url = "<?php echo url('/'); ?>/quarterlylistappointment";

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
                        $("#quarterly_tbody").html(response);
                    },
                    complete: function() {
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
                });
            });
        });
    </script>

@endsection
