@extends('layouts.main') 
@section("content")
<?php use Carbon\Carbon; ?>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Appointments / Steps to make appointment</h4>
                    </div>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                    <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                    <?php } ?>
                    <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                    <?php } ?>
<!--                     <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a> -->
                </div>
                <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                                    <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                    <li><a href="#">Client Management</a></li>
                                    <li><a href="#">Email Management</a></li>
                                    <li><a href="#">Financial Management</a></li>
                                    
                                </ul>-->
                <div class="col-md-12">
                    <div class="col-md-12 margin-bottom-40 margin-top-20">
                        <!-- <div class="col-md-12 text-center margin-bottom-20">
                            <h4>Appointment Details</h4>
                        </div> -->

                        <div class="col-md-12 margin-bottom-20">
                            <div class="col-md-6 col-md-offset-3 margin-bottom-20">
                                <div class="col-md-12 shadow-boxx">
                                    <div class="col-md-12 text-center margin-bottom-20" style="background-color: #da291c; padding: 0px; border-radius: 10px;">
                                        <h4 style="color: #fff; font-weight: 400; margin-top: 10px; margin-bottom: 10px;">Appointment for <?= $appointments->affiliate_first_name ?> <?= $appointments->affiliate_last_name ?></h4>
                                    </div>
                                    <!-- <div class="col-md-4 padding-0">
                                        <img src="assets/images/demo/people/300x300/11-min.jpg" style="border: 1px solid #da291c73 !important; border-radius: 5px;" width="140" height="140" alt="featured item" />
                                    </div> -->
                                    <div class="col-md-12 text-center padding-0">
                                        <table class="profile-info margin-bottom-10" style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%"><b>Date : </b></td>
                                                    <td style="width: 70%"><input type="text" class="form-control" value="<?= date('d F Y', strtotime($appointments->appointment_date)) ?>, <?= Carbon::parse($appointments->appointment_date)->format('l') ?>" readonly /></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%"><b>Time : </b></td>
                                                    <td style="width: 70%"><input type="text" class="form-control" value="<?= date('h:i A', strtotime($appointments->appointment_time)) ?>" readonly /></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%"><b>With : </b></td>
                                                    <td style="width: 70%"><?= $appointments->affiliate_first_name ?> <?= $appointments->affiliate_last_name ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Company: </b></td>
                                                    <td>&nbsp;<?= $appointments->affiliate_company ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: baseline;"><b>Address: </b></td>
                                                    <td>&nbsp;<?= $appointments->affiliate_address ?>,<br> State- <?= $appointments->affiliate_state ?>, Country- <?= $appointments->affiliate_country ?>, <?= $appointments->affiliate_city ?>-<?= $appointments->affiliate_zip ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Phone: </b></td>
                                                    <td>&nbsp;<?= $appointments->affiliate_phone ?></td>
                                                </tr>
                                                <tr>
                                                	<td style="width: 30%; vertical-align: baseline;"><b>Reason : </b></td>
                                                	<td style="width: 70%"><?= $appointments->appointment_reason ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-info" style="margin-right: 10px; width: 200px;">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection