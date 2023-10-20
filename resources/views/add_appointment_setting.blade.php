@extends('layouts.main') 
@section("content")


<style>
    .checkbox + .checkbox,
    .radio + .radio {
        margin-top: 0px;
    }
    td.radio i,
    .checkbox i {
        position: inherit;
    }
</style>
<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-10 text-center">
                        <h4>Settings / Appointment Settings</h4>
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
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily Briefing</a>
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                        <li class="active"><a href="{{ url('add_appointment_setting') }}">Appointment Settings</a></li>
                        <li><a href="{{ url('block_appointment_date') }}">Block Appointment Date</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <?php
                            if($excount == 0){
                            ?>
                                <form  action="{{ url('appointment_setting_entry') }}" method="POST" id="" enctype="multipart/form-data"> 
                                    @csrf
                                    <div class="col-md-12" style="border-radius: 10px; padding-top: 10px; padding-bottom: 20px;">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Days</th>
                                                        <th class="text-center" scope="col">Set Start Time</th>
                                                        <th class="text-center" scope="col">Set End Time</th>
                                                        <th class="text-center" scope="col">Block Days</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        <tr>
                                            <th scope="row">Monday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="mon_start" class="form-control" placeholder="" value="06:00 AM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="mon_start">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00" selected>06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="mon_start1">
                                                            <option value="AM" selected>AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="mon_end" class="form-control" placeholder="" value="10:00 PM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="mon_end">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00" selected>10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="mon_end1">
                                                            <option value="AM">AM</option>
                                                            <option value="PM" selected>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input name="mon_block" id="mon_block" type="checkbox" value="block" class="blockday">
                                                    <i></i> 
                                                </label>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th scope="row">Tuesday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="tues_start" class="form-control" placeholder="" value="06:00 AM" value="06:00 AM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="tues_start">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00" selected>06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="tues_start1">
                                                            <option value="AM" selected>AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="tues_end" class="form-control" placeholder="" value="10:00 PM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="tues_end">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00" selected>10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="tues_end1">
                                                            <option value="AM">AM</option>
                                                            <option value="PM" selected>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="tues_block" id="tues_block" value="block" class="blockday">
                                                    <i></i> 
                                                </label>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th scope="row">Wednesday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="wed_start" class="form-control" placeholder="" value="06:00 AM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="wed_start">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00" selected>06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="wed_start1">
                                                            <option value="AM" selected>AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="wed_end" class="form-control" placeholder="" value="10:00 PM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="wed_end">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00" selected>10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="wed_end1">
                                                            <option value="AM">AM</option>
                                                            <option value="PM" selected>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="wed_block" id="wed_block" value="block" class="blockday">
                                                    <i></i> 
                                                </label>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th scope="row">Thursday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="thu_start" class="form-control" placeholder="" value="06:00 AM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="thu_start">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00" selected>06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="thu_start1">
                                                            <option value="AM" selected>AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="thu_end" class="form-control" placeholder="" value="10:00 PM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="thu_end">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00" selected>10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="thu_end1">
                                                            <option value="AM">AM</option>
                                                            <option value="PM" selected>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="thu_block" id="thu_block" value="block" class="blockday">
                                                    <i></i> 
                                                </label>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th scope="row">Friday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="fri_start" class="form-control" placeholder="" value="06:00 AM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="fri_start">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00" selected>06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="fri_start1">
                                                            <option value="AM" selected>AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="fri_end" class="form-control" placeholder="" value="10:00 PM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="fri_end">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00" selected>10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="fri_end1">
                                                            <option value="AM">AM</option>
                                                            <option value="PM" selected>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="fri_block" id="fri_block" value="block" class="blockday">
                                                    <i></i> 
                                                </label>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th scope="row">Saturday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="sat_start" class="form-control" placeholder="" value="06:00 AM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="sat_start">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00" selected>06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="sat_start1">
                                                            <option value="AM" selected>AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="sat_end" class="form-control" placeholder="" value="10:00 PM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="sat_end">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00" selected>10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="sat_end1">
                                                            <option value="AM">AM</option>
                                                            <option value="PM" selected>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="sat_block" id="sat_block" value="block" class="blockday">
                                                    <i></i> 
                                                </label>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th scope="row">Sunday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="sun_start" class="form-control" placeholder="" value="06:00 AM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="sun_start">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00" selected>06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="sun_start1">
                                                            <option value="AM" selected>AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="sun_end" class="form-control" placeholder="" value="10:00 PM" required>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="sun_end">
                                                            <option value="01:00">01:00</option>
                                                            <option value="01:30">01:30</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="02:30">02:30</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="03:30">03:30</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="04:30">04:30</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="05:30">05:30</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="06:30">06:30</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="07:30">07:30</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="08:30">08:30</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="09:30">09:30</option>
                                                            <option value="10:00" selected>10:00</option>
                                                            <option value="10:30">10:30</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="11:30">11:30</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="12:30">12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="sun_end1">
                                                            <option value="AM">AM</option>
                                                            <option value="PM" selected>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="sun_block" id="sun_block" value="block" class="blockday">
                                                    <i></i> 
                                                </label>
                                                
                                            </td> 
                                        </tr>
                                    </tbody>
                                            </table>
                                        </div>
                                        <div class="row gy-4">
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 5px; margin-right: 20px;">I want to receive appointment </label>
                                                    <label class="radio">
                                                        <input type="radio" name="receive_time" value="30" />
                                                        <i></i> every 1/2 hour
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="receive_time" value="60" checked="checked" />
                                                        <i></i> every 1 hour
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 10px; margin-right: 20px;">Before the appointment time I want to show the pop up window on the screen as a reminder </label>
                                                    <select class="form-control" name="popup_reminder" style="width: 100px;">
                                                        <option value="60">60 Min</option>
                                                        <option value="90">90 Min</option>
                                                        <option value="120">120 Min</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 10px; margin-right: 20px;">Number of days/hrs a client is allowed to Change an Appointment before the appointment date/time. </label>
                                                    <input type="number" class="form-control" style="width: 100px; margin-right: 10px;" value="3" name="change_time" required />
                                                    <select class="form-control" name="change_unit" style="width: 100px;">
                                                        <option value="hours">Hours</option>
                                                        <option value="day">Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 10px; margin-right: 20px;">Number of days/hrs a client is allowed to Cancel an Appointment before the appointment date/time. </label>
                                                    <input type="number" class="form-control" style="width: 100px; margin-right: 10px; margin-left: 10px;" value="" name="cancel_time" required />
                                                    <select class="form-control" name="cancel_unit" style="width: 100px;">
                                                        <option value="hours">Hours</option>
                                                        <option value="day">Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 10px; margin-right: 20px;">Notify me before the appointment </label>
                                                    <input type="number" class="form-control" style="width: 100px; margin-right: 10px;" value="3" name="notification_time" required />
                                                    <select class="form-control" name="notification_unit" style="width: 100px;">
                                                        <option value="hours">Hours</option>
                                                        <option value="day">Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 40px; text-align: center;">
                                            <button type="submit" class="btn btn-sm btn-info">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }else{
                                // $users = App\Http\Controllers\ServiceProvider::getLowestPrice();
                            ?>
                                <form  action="{{ url('appointment_setting_update') }}" method="POST" id="" enctype="multipart/form-data"> 
                                @csrf
                                    <div class="col-md-12" style="border-radius: 10px; padding-top: 10px; padding-bottom: 20px;">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Days</th>
                                                        <th class="text-center" scope="col">Set Start Time</th>
                                                        <th class="text-center" scope="col">Set End Time</th>
                                                        <th class="text-center" scope="col">Block Days</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        <tr>
                                            <?php 
                                            if($users[0]->monday == "block"){ 
                                                $mon_start = "";
                                                $mon_end = "";
                                                $mon_checked = "checked";
                                                $mon_start_disable = "disabled";
                                                $mon_end_disable = "disabled";
                                            }
                                            else{
                                                $mon = explode(',', $users[0]->monday);
                                                $mon_start = $mon[0];
                                                $mon_end = $mon[1];
                                                $mon_checked = "";
                                                $mon_start_disable = "required";
                                                $mon_end_disable = "required";
                                            }
                                            ?>
                                            <th scope="row">monnesday</th>
                                            <!-- <td>
                                                <input type="time" name="mon_start" value="<?= $mon_start ?>" class="form-control" placeholder="" <?= $mon_start_disable ?>>
                                            </td>
                                            <td><input type="time" name="mon_end" value="<?= $mon_end ?>" class="form-control" placeholder="" <?= $mon_end_disable ?>></td> -->
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="mon_start" value="<?= date('h:i A', strtotime($mon_start)) ?>" class="form-control" placeholder="" <?= $mon_start_disable ?>>
                                                <?php
                                                    $monstart =  date('h:i A', strtotime($mon_start));
                                                    $monstart1 = explode(' ', $monstart);
                                                    $montime = $monstart1[0];
                                                    $montime1 = $monstart1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="mon_startt">
                                                            <option value="01:00" <?php if($montime == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($montime == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($montime == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($montime == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($montime == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($montime == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($montime == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($montime == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($montime == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($montime == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($montime == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($montime == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($montime == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($montime == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($montime == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($montime == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($montime == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($montime == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($montime == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($montime == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($montime == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($montime == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($montime == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($montime == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="mon_startt1">
                                                            <option value="AM" <?php if($montime1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($montime1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="mon_end" value="<?= date('h:i A', strtotime($mon_end)) ?>" class="form-control" placeholder=""  <?= $mon_end_disable ?>>
                                                <?php
                                                    $monend =  date('h:i A', strtotime($mon_end));
                                                    $monend1 = explode(' ', $monend);
                                                    $montimee = $monend1[0];
                                                    $montimee1 = $monend1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="mon_endd">
                                                            <option value="01:00" <?php if($montimee == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($montimee == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($montimee == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($montimee == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($montimee == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($montimee == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($montimee == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($montimee == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($montimee == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($montimee == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($montimee == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($montimee == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($montimee == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($montimee == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($montimee == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($montimee == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($montimee == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($montimee == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($montimee == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($montimee == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($montimee == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($montimee == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($montimee == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($montimee == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="mon_endd1">
                                                            <option value="AM" <?php if($montimee1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($montimee1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="mon_block" id="mon_block" value="block" class="blockday" <?= $mon_checked ?>>
                                                    <i></i> 
                                                </label>
                                            </td>  
                                        </tr>
                                        <tr>
                                            <?php 
                                            if($users[0]->tuesday == "block"){ 
                                                $tues_start = "";
                                                $tues_end = "";
                                                $tues_checked = "checked";
                                                $tues_start_disable = "disabled";
                                                $tues_end_disable = "disabled";
                                            }
                                            else{
                                                $tues = explode(',', $users[0]->tuesday);
                                                $tues_start = $tues[0];
                                                $tues_end = $tues[1];
                                                $tues_checked = "";
                                                $tues_start_disable = "required";
                                                $tues_end_disable = "required";
                                            }
                                            ?>
                                            <th scope="row">tuesnesday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="tues_start" value="<?= date('h:i A', strtotime($tues_start)) ?>" class="form-control" placeholder="" <?= $tues_start_disable ?>>
                                                <?php
                                                    $tuesstart =  date('h:i A', strtotime($tues_start));
                                                    $tuesstart1 = explode(' ', $tuesstart);
                                                    $tuestime = $tuesstart1[0];
                                                    $tuestime1 = $tuesstart1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="tues_startt">
                                                            <option value="01:00" <?php if($tuestime == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($tuestime == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($tuestime == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($tuestime == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($tuestime == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($tuestime == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($tuestime == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($tuestime == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($tuestime == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($tuestime == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($tuestime == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($tuestime == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($tuestime == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($tuestime == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($tuestime == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($tuestime == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($tuestime == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($tuestime == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($tuestime == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($tuestime == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($tuestime == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($tuestime == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($tuestime == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($tuestime == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="tues_startt1">
                                                            <option value="AM" <?php if($tuestime1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($tuestime1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="tues_end" value="<?= date('h:i A', strtotime($tues_end)) ?>" class="form-control" placeholder=""  <?= $tues_end_disable ?>>
                                                <?php
                                                    $tuesend =  date('h:i A', strtotime($tues_end));
                                                    $tuesend1 = explode(' ', $tuesend);
                                                    $tuestimee = $tuesend1[0];
                                                    $tuestimee1 = $tuesend1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="tues_endd">
                                                            <option value="01:00" <?php if($tuestimee == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($tuestimee == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($tuestimee == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($tuestimee == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($tuestimee == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($tuestimee == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($tuestimee == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($tuestimee == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($tuestimee == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($tuestimee == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($tuestimee == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($tuestimee == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($tuestimee == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($tuestimee == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($tuestimee == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($tuestimee == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($tuestimee == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($tuestimee == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($tuestimee == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($tuestimee == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($tuestimee == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($tuestimee == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($tuestimee == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($tuestimee == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="tues_endd1">
                                                            <option value="AM" <?php if($tuestimee1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($tuestimee1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="tues_block" id="tues_block" value="block" class="blockday" <?= $tues_checked ?>>
                                                    <i></i> 
                                                </label>
                                            </td>  
                                        </tr>
                                        <tr>
                                            <?php 
                                            if($users[0]->wednesday == "block"){ 
                                                $wed_start = "";
                                                $wed_end = "";
                                                $wed_checked = "checked";
                                                $wed_start_disable = "disabled";
                                                $wed_end_disable = "disabled";
                                            }
                                            else{
                                                $wed = explode(',', $users[0]->wednesday);
                                                $wed_start = $wed[0];
                                                $wed_end = $wed[1];
                                                $wed_checked = "";
                                                $wed_start_disable = "required";
                                                $wed_end_disable = "required";
                                            }
                                            ?>
                                            <th scope="row">Wednesday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="wed_start" value="<?= date('h:i A', strtotime($wed_start)) ?>" class="form-control" placeholder="" <?= $wed_start_disable ?>>
                                                <?php
                                                    $wedstart =  date('h:i A', strtotime($wed_start));
                                                    $wedstart1 = explode(' ', $wedstart);
                                                    $wedtime = $wedstart1[0];
                                                    $wedtime1 = $wedstart1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="wed_startt">
                                                            <option value="01:00" <?php if($wedtime == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($wedtime == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($wedtime == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($wedtime == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($wedtime == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($wedtime == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($wedtime == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($wedtime == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($wedtime == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($wedtime == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($wedtime == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($wedtime == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($wedtime == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($wedtime == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($wedtime == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($wedtime == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($wedtime == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($wedtime == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($wedtime == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($wedtime == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($wedtime == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($wedtime == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($wedtime == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($wedtime == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="wed_startt1">
                                                            <option value="AM" <?php if($wedtime1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($wedtime1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="wed_end" value="<?= date('h:i A', strtotime($wed_end)) ?>" class="form-control" placeholder=""  <?= $wed_end_disable ?>>
                                                <?php
                                                    $wedend =  date('h:i A', strtotime($wed_end));
                                                    $wedend1 = explode(' ', $wedend);
                                                    $wedtimee = $wedend1[0];
                                                    $wedtimee1 = $wedend1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="wed_endd">
                                                            <option value="01:00" <?php if($wedtimee == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($wedtimee == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($wedtimee == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($wedtimee == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($wedtimee == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($wedtimee == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($wedtimee == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($wedtimee == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($wedtimee == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($wedtimee == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($wedtimee == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($wedtimee == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($wedtimee == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($wedtimee == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($wedtimee == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($wedtimee == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($wedtimee == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($wedtimee == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($wedtimee == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($wedtimee == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($wedtimee == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($wedtimee == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($wedtimee == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($wedtimee == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="wed_endd1">
                                                            <option value="AM" <?php if($wedtimee1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($wedtimee1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="wed_block" id="wed_block" value="block" class="blockday" <?= $wed_checked ?>>
                                                    <i></i> 
                                                </label>
                                            </td>  
                                        </tr>
                                        <tr>
                                            <?php 
                                            if($users[0]->thursday == "block"){ 
                                                $thu_start = "";
                                                $thu_end = "";
                                                $thu_checked = "checked";
                                                $thu_start_disable = "disabled";
                                                $thu_end_disable = "disabled";
                                            }
                                            else{
                                                $thu = explode(',', $users[0]->thursday);
                                                $thu_start = $thu[0];
                                                $thu_end = $thu[1];
                                                $thu_checked = "";
                                                $thu_start_disable = "required";
                                                $thu_end_disable = "required";
                                            }
                                            ?>
                                            <th scope="row">Thursday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="thu_start" value="<?= date('h:i A', strtotime($thu_start)) ?>" class="form-control" placeholder="" <?= $thu_start_disable ?>>
                                                <?php
                                                    $thustart =  date('h:i A', strtotime($thu_start));
                                                    $thustart1 = explode(' ', $thustart);
                                                    $thutime = $thustart1[0];
                                                    $thutime1 = $thustart1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="thu_startt">
                                                            <option value="01:00" <?php if($thutime == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($thutime == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($thutime == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($thutime == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($thutime == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($thutime == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($thutime == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($thutime == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($thutime == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($thutime == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($thutime == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($thutime == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($thutime == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($thutime == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($thutime == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($thutime == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($thutime == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($thutime == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($thutime == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($thutime == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($thutime == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($thutime == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($thutime == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($thutime == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="thu_startt1">
                                                            <option value="AM" <?php if($thutime1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($thutime1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="thu_end" value="<?= date('h:i A', strtotime($thu_end)) ?>" class="form-control" placeholder=""  <?= $thu_end_disable ?>>
                                                <?php
                                                    $thuend =  date('h:i A', strtotime($thu_end));
                                                    $thuend1 = explode(' ', $thuend);
                                                    $thutimee = $thuend1[0];
                                                    $thutimee1 = $thuend1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="thu_endd">
                                                            <option value="01:00" <?php if($thutimee == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($thutimee == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($thutimee == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($thutimee == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($thutimee == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($thutimee == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($thutimee == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($thutimee == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($thutimee == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($thutimee == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($thutimee == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($thutimee == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($thutimee == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($thutimee == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($thutimee == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($thutimee == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($thutimee == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($thutimee == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($thutimee == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($thutimee == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($thutimee == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($thutimee == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($thutimee == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($thutimee == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="thu_endd1">
                                                            <option value="AM" <?php if($thutimee1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($thutimee1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="thu_block" id="thu_block" value="block" class="blockday" <?= $thu_checked ?>>
                                                    <i></i> 
                                                </label>
                                            </td>  
                                        </tr>
                                        <tr>
                                            <?php 
                                            if($users[0]->friday == "block"){ 
                                                $fri_start = "";
                                                $fri_end = "";
                                                $fri_checked = "checked";
                                                $fri_start_disable = "disabled";
                                                $fri_end_disable = "disabled";
                                            }
                                            else{
                                                $fri = explode(',', $users[0]->friday);
                                                $fri_start = $fri[0];
                                                $fri_end = $fri[1];
                                                $fri_checked = "";
                                                $fri_start_disable = "required";
                                                $fri_end_disable = "required";
                                            }
                                            ?>
                                            <th scope="row">Friday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="fri_start" value="<?= date('h:i A', strtotime($fri_start)) ?>" class="form-control" placeholder="" <?= $fri_start_disable ?>>
                                                <?php
                                                    $fristart =  date('h:i A', strtotime($fri_start));
                                                    $fristart1 = explode(' ', $fristart);
                                                    $fritime = $fristart1[0];
                                                    $fritime1 = $fristart1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="fri_startt">
                                                            <option value="01:00" <?php if($fritime == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($fritime == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($fritime == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($fritime == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($fritime == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($fritime == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($fritime == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($fritime == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($fritime == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($fritime == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($fritime == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($fritime == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($fritime == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($fritime == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($fritime == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($fritime == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($fritime == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($fritime == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($fritime == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($fritime == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($fritime == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($fritime == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($fritime == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($fritime == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="fri_startt1">
                                                            <option value="AM" <?php if($fritime1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($fritime1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="fri_end" value="<?= date('h:i A', strtotime($fri_end)) ?>" class="form-control" placeholder=""  <?= $fri_end_disable ?>>
                                                <?php
                                                    $friend =  date('h:i A', strtotime($fri_end));
                                                    $friend1 = explode(' ', $friend);
                                                    $fritimee = $friend1[0];
                                                    $fritimee1 = $friend1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="fri_endd">
                                                            <option value="01:00" <?php if($fritimee == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($fritimee == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($fritimee == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($fritimee == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($fritimee == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($fritimee == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($fritimee == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($fritimee == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($fritimee == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($fritimee == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($fritimee == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($fritimee == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($fritimee == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($fritimee == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($fritimee == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($fritimee == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($fritimee == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($fritimee == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($fritimee == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($fritimee == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($fritimee == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($fritimee == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($fritimee == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($fritimee == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="fri_endd1">
                                                            <option value="AM" <?php if($fritimee1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($fritimee1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="fri_block" id="fri_block" value="block" class="blockday" <?= $fri_checked ?>>
                                                    <i></i> 
                                                </label>
                                            </td>  
                                        </tr>
                                        <tr>
                                            <?php 
                                            if($users[0]->saturday == "block"){ 
                                                $sat_start = "";
                                                $sat_end = "";
                                                $sat_checked = "checked";
                                                $sat_start_disable = "disabled";
                                                $sat_end_disable = "disabled";
                                            }
                                            else{
                                                $sat = explode(',', $users[0]->saturday);
                                                $sat_start = $sat[0];
                                                $sat_end = $sat[1];
                                                $sat_checked = "";
                                                $sat_start_disable = "required";
                                                $sat_end_disable = "required";
                                            }
                                            ?>
                                            <th scope="row">Saturday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="sat_start" value="<?= date('h:i A', strtotime($sat_start)) ?>" class="form-control" placeholder="" <?= $sat_start_disable ?>>
                                                <?php
                                                    $satstart =  date('h:i A', strtotime($sat_start));
                                                    $satstart1 = explode(' ', $satstart);
                                                    $sattime = $satstart1[0];
                                                    $sattime1 = $satstart1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="sat_startt">
                                                            <option value="01:00" <?php if($sattime == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($sattime == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($sattime == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($sattime == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($sattime == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($sattime == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($sattime == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($sattime == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($sattime == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($sattime == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($sattime == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($sattime == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($sattime == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($sattime == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($sattime == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($sattime == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($sattime == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($sattime == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($sattime == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($sattime == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($sattime == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($sattime == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($sattime == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($sattime == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="sat_startt1">
                                                            <option value="AM" <?php if($sattime1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($sattime1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="sat_end" value="<?= date('h:i A', strtotime($sat_end)) ?>" class="form-control" placeholder=""  <?= $sat_end_disable ?>>
                                                <?php
                                                    $satend =  date('h:i A', strtotime($sat_end));
                                                    $satend1 = explode(' ', $satend);
                                                    $sattimee = $satend1[0];
                                                    $sattimee1 = $satend1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="sat_endd">
                                                            <option value="01:00" <?php if($sattimee == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($sattimee == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($sattimee == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($sattimee == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($sattimee == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($sattimee == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($sattimee == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($sattimee == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($sattimee == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($sattimee == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($sattimee == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($sattimee == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($sattimee == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($sattimee == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($sattimee == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($sattimee == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($sattimee == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($sattimee == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($sattimee == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($sattimee == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($sattimee == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($sattimee == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($sattimee == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($sattimee == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="sat_endd1">
                                                            <option value="AM" <?php if($sattimee1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($sattimee1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="sat_block" id="sat_block" value="block" class="blockday" <?= $sat_checked ?>>
                                                    <i></i> 
                                                </label>
                                            </td>  
                                        </tr>
                                        <tr>
                                            <?php 
                                            if($users[0]->sunday == "block"){ 
                                                $sun_start = "";
                                                $sun_end = "";
                                                $sun_checked = "checked";
                                                $sun_start_disable = "disabled";
                                                $sun_end_disable = "disabled";
                                            }
                                            else{
                                                $sun = explode(',', $users[0]->sunday);
                                                $sun_start = $sun[0];
                                                $sun_end = $sun[1];
                                                $sun_checked = "";
                                                $sun_start_disable = "required";
                                                $sun_end_disable = "required";
                                            }
                                            ?>
                                            <th scope="row">Sunday</th>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="sun_start" value="<?= date('h:i A', strtotime($sun_start)) ?>" class="form-control" placeholder="" <?= $sun_start_disable ?>>
                                                <?php
                                                    $sunstart =  date('h:i A', strtotime($sun_start));
                                                    $sunstart1 = explode(' ', $sunstart);
                                                    $suntime = $sunstart1[0];
                                                    $suntime1 = $sunstart1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="sun_startt">
                                                            <option value="01:00" <?php if($suntime == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($suntime == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($suntime == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($suntime == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($suntime == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($suntime == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($suntime == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($suntime == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($suntime == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($suntime == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($suntime == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($suntime == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($suntime == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($suntime == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($suntime == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($suntime == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($suntime == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($suntime == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($suntime == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($suntime == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($suntime == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($suntime == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($suntime == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($suntime == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="sun_startt1">
                                                            <option value="AM" <?php if($suntime1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($suntime1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 8px 30px;">
                                                <input type="hidden" name="sun_end" value="<?= date('h:i A', strtotime($sun_end)) ?>" class="form-control" placeholder=""  <?= $sun_end_disable ?>>
                                                <?php
                                                    $sunend =  date('h:i A', strtotime($sun_end));
                                                    $sunend1 = explode(' ', $sunend);
                                                    $suntimee = $sunend1[0];
                                                    $suntimee1 = $sunend1[1];
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-8" style="padding: 0 5px">
                                                        <select class="form-control" id="sun_endd">
                                                            <option value="01:00" <?php if($suntimee == "01:00"){ ?> selected <?php } ?>>01:00</option>
                                                            <option value="01:30" <?php if($suntimee == "01:30"){ ?> selected <?php } ?>>01:30</option>
                                                            <option value="02:00" <?php if($suntimee == "02:00"){ ?> selected <?php } ?>>02:00</option>
                                                            <option value="02:30" <?php if($suntimee == "02:30"){ ?> selected <?php } ?>>02:30</option>
                                                            <option value="03:00" <?php if($suntimee == "03:00"){ ?> selected <?php } ?>>03:00</option>
                                                            <option value="03:30" <?php if($suntimee == "03:30"){ ?> selected <?php } ?>>03:30</option>
                                                            <option value="04:00" <?php if($suntimee == "04:00"){ ?> selected <?php } ?>>04:00</option>
                                                            <option value="04:30" <?php if($suntimee == "04:30"){ ?> selected <?php } ?>>04:30</option>
                                                            <option value="05:00" <?php if($suntimee == "05:00"){ ?> selected <?php } ?>>05:00</option>
                                                            <option value="05:30" <?php if($suntimee == "05:30"){ ?> selected <?php } ?>>05:30</option>
                                                            <option value="06:00" <?php if($suntimee == "06:00"){ ?> selected <?php } ?>>06:00</option>
                                                            <option value="06:30" <?php if($suntimee == "06:30"){ ?> selected <?php } ?>>06:30</option>
                                                            <option value="07:00" <?php if($suntimee == "07:00"){ ?> selected <?php } ?>>07:00</option>
                                                            <option value="07:30" <?php if($suntimee == "07:30"){ ?> selected <?php } ?>>07:30</option>
                                                            <option value="08:00" <?php if($suntimee == "08:00"){ ?> selected <?php } ?>>08:00</option>
                                                            <option value="08:30" <?php if($suntimee == "08:30"){ ?> selected <?php } ?>>08:30</option>
                                                            <option value="09:00" <?php if($suntimee == "09:00"){ ?> selected <?php } ?>>09:00</option>
                                                            <option value="09:30" <?php if($suntimee == "09:30"){ ?> selected <?php } ?>>09:30</option>
                                                            <option value="10:00" <?php if($suntimee == "10:00"){ ?> selected <?php } ?>>10:00</option>
                                                            <option value="10:30" <?php if($suntimee == "10:30"){ ?> selected <?php } ?>>10:30</option>
                                                            <option value="11:00" <?php if($suntimee == "11:00"){ ?> selected <?php } ?>>11:00</option>
                                                            <option value="11:30" <?php if($suntimee == "11:30"){ ?> selected <?php } ?>>11:30</option>
                                                            <option value="12:00" <?php if($suntimee == "12:00"){ ?> selected <?php } ?>>12:00</option>
                                                            <option value="12:30" <?php if($suntimee == "12:30"){ ?> selected <?php } ?>>12:30</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="padding: 0 5px">
                                                        <select class="form-control" id="sun_endd1">
                                                            <option value="AM" <?php if($suntimee1 == "AM"){ ?> selected <?php } ?>>AM</option>
                                                            <option value="PM" <?php if($suntimee1 == "PM"){ ?> selected <?php } ?>>PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="checkbox chk-sm">
                                                    <input type="checkbox" name="sun_block" id="sun_block" value="block" class="blockday" <?= $sun_checked ?>>
                                                    <i></i> 
                                                </label>
                                            </td> 
                                        </tr>
                                    </tbody>  
                                            </table>
                                        </div>
                                        <div class="row gy-4">
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 5px; margin-right: 20px;">I want to receive appointment </label>
                                                    <label class="radio">
                                                        <input type="radio" name="receive_time" value="30" <?php if($users[0]->receive_time == "30"){  ?> checked <?php } ?> />
                                                        <i></i> every 1/2 hour
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="receive_time" value="60"  <?php if($users[0]->receive_time == "60"){  ?> checked <?php } ?> />
                                                        <i></i> every 1 hour
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 10px; margin-right: 20px;">Before the appointment time I want to show the pop up window on the screen as a reminder </label>
                                                    <select class="form-control" name="popup_reminder" style="width: 100px;">
                                                        <option value="60" <?php if($users[0]->popup_reminder == "60"){  ?> selected <?php } ?>>60 Min</option>
                                                        <option value="90" <?php if($users[0]->popup_reminder == "90"){  ?> selected <?php } ?>>90 Min</option>
                                                        <option value="120" <?php if($users[0]->popup_reminder == "120"){  ?> selected <?php } ?>>120 Min</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 10px; margin-right: 20px;">Number of days/hrs a client is allowed to Change an Appointment before the appointment date/time. </label>
                                                    <input type="number" class="form-control" style="width: 100px; margin-right: 10px;" value="<?= $users[0]->change_time ?>" name="change_time" required />
                                                    <select class="form-control" name="change_unit" style="width: 100px;">
                                                        <option value="hours" <?php if($users[0]->change_unit == "hours"){  ?> selected <?php } ?>>Hours</option>
                                                        <option value="day" <?php if($users[0]->change_unit == "day"){  ?> selected <?php } ?>>Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 10px; margin-right: 20px;">Number of days/hrs a client is allowed to Cancel an Appointment before the appointment date/time. </label>
                                                    <input type="number" class="form-control" style="width: 100px; margin-right: 10px; margin-left: 10px;" value="<?= $users[0]->cancel_time ?>" name="cancel_time" required />
                                                    <select class="form-control" name="cancel_unit" style="width: 100px;">
                                                        <option value="hours" <?php if($users[0]->cancel_unit == "hours"){  ?> selected <?php } ?>>Hours</option>
                                                        <option value="day" <?php if($users[0]->cancel_unit == "day"){  ?> selected <?php } ?>>Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group" style="display: inline-flex;">
                                                    <label class="form-label" for="" style="margin-top: 10px; margin-right: 20px;">Notify me before the appointment </label>
                                                    <input type="number" class="form-control" style="width: 100px; margin-right: 10px;" value="<?= $users[0]->notification_time ?>" name="notification_time" required />
                                                    <select class="form-control" name="notification_unit" style="width: 100px;">
                                                        <option value="hours" <?php if($users[0]->notification_unit == "hours"){  ?> selected <?php } ?>>Hours</option>
                                                        <option value="day" <?php if($users[0]->notification_unit == "day"){  ?> selected <?php } ?>>Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 40px; text-align: center;">
                                            <button type="submit" class="btn btn-sm btn-info">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $(".blockday").on('change', function(){
        var blockday = $(this).attr("id");
        var sday = blockday.split('_');
        var day = sday[0];
        // alert(day);
        if($(this).prop('checked')){
            // alert("checked");
            $("input[name='"+day+"_start'").prop('disabled', true);
            $("input[name='"+day+"_start'").removeAttr("required");
            $("input[name='"+day+"_end'").prop('disabled', true);
            $("input[name='"+day+"_end'").removeAttr("required");
            $("input[name='"+day+"_start'").val("");
            $("input[name='"+day+"_end'").val("");
        }
        else{
            // alert("no");
            $("input[name='"+day+"_start'").prop('disabled', false);
            $("input[name='"+day+"_start'").attr("required", true);
            $("input[name='"+day+"_end'").prop('disabled', false);
            $("input[name='"+day+"_end'").attr("required", true);
        }
    });
    });

</script>
<script type="text/javascript">
    $("#mon_start").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#mon_start1").val();
        $("input[name='mon_start']").val(mst+" "+mst1);
    });
    $("#mon_start1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#mon_start").val();
        $("input[name='mon_start']").val(mst+" "+mst1);
    });
    $("#tues_start").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#tues_start1").val();
        $("input[name='tues_start']").val(mst+" "+mst1);
    });
    $("#tues_start1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#tues_start").val();
        $("input[name='tues_start']").val(mst+" "+mst1);
    });
    $("#wed_start").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#wed_start1").val();
        $("input[name='wed_start']").val(mst+" "+mst1);
    });
    $("#wed_start1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#wed_start").val();
        $("input[name='wed_start']").val(mst+" "+mst1);
    });
    $("#thu_start").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#thu_start1").val();
        $("input[name='thu_start']").val(mst+" "+mst1);
    });
    $("#thu_start1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#thu_start").val();
        $("input[name='thu_start']").val(mst+" "+mst1);
    });
    $("#fri_start").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#fri_start1").val();
        $("input[name='fri_start']").val(mst+" "+mst1);
    });
    $("#fri_start1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#fri_start").val();
        $("input[name='fri_start']").val(mst+" "+mst1);
    });
    $("#sat_start").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#sat_start1").val();
        $("input[name='sat_start']").val(mst+" "+mst1);
    });
    $("#sat_start1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#sat_start").val();
        $("input[name='sat_start']").val(mst+" "+mst1);
    });
    $("#sun_start").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#sun_start1").val();
        $("input[name='sun_start']").val(mst+" "+mst1);
    });
    $("#sun_start1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#sun_start").val();
        $("input[name='sun_start']").val(mst+" "+mst1);
    });
    $("#mon_end").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#mon_end1").val();
        $("input[name='mon_end']").val(mst+" "+mst1);
    });
    $("#mon_end1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#mon_end").val();
        $("input[name='mon_end']").val(mst+" "+mst1);
    });
    $("#tues_end").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#tues_end1").val();
        $("input[name='tues_end']").val(mst+" "+mst1);
    });
    $("#tues_end1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#tues_end").val();
        $("input[name='tues_end']").val(mst+" "+mst1);
    });
    $("#wed_end").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#wed_end1").val();
        $("input[name='wed_end']").val(mst+" "+mst1);
    });
    $("#wed_end1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#wed_end").val();
        $("input[name='wed_end']").val(mst+" "+mst1);
    });
    $("#thu_end").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#thu_end1").val();
        $("input[name='thu_end']").val(mst+" "+mst1);
    });
    $("#thu_end1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#thu_end").val();
        $("input[name='thu_end']").val(mst+" "+mst1);
    });
    $("#fri_end").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#fri_end1").val();
        $("input[name='fri_end']").val(mst+" "+mst1);
    });
    $("#fri_end1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#fri_end").val();
        $("input[name='fri_end']").val(mst+" "+mst1);
    });
    $("#sat_end").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#sat_end1").val();
        $("input[name='sat_end']").val(mst+" "+mst1);
    });
    $("#sat_end1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#sat_end").val();
        $("input[name='sat_end']").val(mst+" "+mst1);
    });
    $("#sun_end").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#sun_end1").val();
        $("input[name='sun_end']").val(mst+" "+mst1);
    });
    $("#sun_end1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#sun_end").val();
        $("input[name='sun_end']").val(mst+" "+mst1);
    });
</script>
<script type="text/javascript">
    $("#mon_startt").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#mon_startt1").val();
        $("input[name='mon_start']").val(mst+" "+mst1);
    });
    $("#mon_startt1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#mon_startt").val();
        $("input[name='mon_start']").val(mst+" "+mst1);
    });
    $("#tues_startt").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#tues_startt1").val();
        $("input[name='tues_start']").val(mst+" "+mst1);
    });
    $("#tues_startt1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#tues_startt").val();
        $("input[name='tues_start']").val(mst+" "+mst1);
    });
    $("#wed_startt").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#wed_startt1").val();
        $("input[name='wed_start']").val(mst+" "+mst1);
    });
    $("#wed_startt1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#wed_startt").val();
        $("input[name='wed_start']").val(mst+" "+mst1);
    });
    $("#thu_startt").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#thu_startt1").val();
        $("input[name='thu_start']").val(mst+" "+mst1);
    });
    $("#thu_startt1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#thu_startt").val();
        $("input[name='thu_start']").val(mst+" "+mst1);
    });
    $("#fri_startt").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#fri_startt1").val();
        $("input[name='fri_start']").val(mst+" "+mst1);
    });
    $("#fri_startt1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#fri_startt").val();
        $("input[name='fri_start']").val(mst+" "+mst1);
    });
    $("#sat_startt").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#sat_startt1").val();
        $("input[name='sat_start']").val(mst+" "+mst1);
    });
    $("#sat_startt1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#sat_startt").val();
        $("input[name='sat_start']").val(mst+" "+mst1);
    });
    $("#sun_startt").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#sun_startt1").val();
        $("input[name='sun_start']").val(mst+" "+mst1);
    });
    $("#sun_startt1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#sun_startt").val();
        $("input[name='sun_start']").val(mst+" "+mst1);
    });
    $("#mon_endd").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#mon_endd1").val();
        $("input[name='mon_end']").val(mst+" "+mst1);
    });
    $("#mon_endd1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#mon_endd").val();
        $("input[name='mon_end']").val(mst+" "+mst1);
    });
    $("#tues_endd").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#tues_endd1").val();
        $("input[name='tues_end']").val(mst+" "+mst1);
    });
    $("#tues_endd1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#tues_endd").val();
        $("input[name='tues_end']").val(mst+" "+mst1);
    });
    $("#wed_endd").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#wed_endd1").val();
        $("input[name='wed_end']").val(mst+" "+mst1);
    });
    $("#wed_endd1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#wed_endd").val();
        $("input[name='wed_end']").val(mst+" "+mst1);
    });
    $("#thu_endd").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#thu_endd1").val();
        $("input[name='thu_end']").val(mst+" "+mst1);
    });
    $("#thu_endd1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#thu_endd").val();
        $("input[name='thu_end']").val(mst+" "+mst1);
    });
    $("#fri_endd").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#fri_endd1").val();
        $("input[name='fri_end']").val(mst+" "+mst1);
    });
    $("#fri_endd1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#fri_endd").val();
        $("input[name='fri_end']").val(mst+" "+mst1);
    });
    $("#sat_endd").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#sat_endd1").val();
        $("input[name='sat_end']").val(mst+" "+mst1);
    });
    $("#sat_endd1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#sat_endd").val();
        $("input[name='sat_end']").val(mst+" "+mst1);
    });
    $("#sun_endd").on("change", function(){
        var mst = $(this).val();
        var mst1 = $("#sun_endd1").val();
        $("input[name='sun_end']").val(mst+" "+mst1);
    });
    $("#sun_endd1").on("change", function(){
        var mst1 = $(this).val();
        var mst = $("#sun_endd").val();
        $("input[name='sun_end']").val(mst+" "+mst1);
    });
</script>
@endsection