@extends('layouts.main') 

@section("content")

<style type="text/css">

    .profile-info td:first-child {

        width: 28%;

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

                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>

                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>

                </div>

                <div class="col-md-12">

                    <div class="row process-wizard process-wizard-info">

                        <div class="col-xs-5th process-wizard-step complete">

                            <div class="text-center process-wizard-stepnum">Step 1</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Locate the Professional by Location or by Keyword.</div>

                        </div>



                        <div class="col-xs-5th process-wizard-step complete">

                            <!-- complete -->

                            <div class="text-center process-wizard-stepnum">Step 2</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Click Make an Appointment to go to next step.</div>

                        </div>



                        <div class="col-xs-5th process-wizard-step complete">

                            <!-- complete -->

                            <div class="text-center process-wizard-stepnum">Step 3</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Click on any available date below to view available time for that date.</div>

                        </div>



                        <div class="col-xs-5th process-wizard-step complete">

                            <!-- active -->

                            <div class="text-center process-wizard-stepnum">Step 4</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Enter reason for Appointment.</div>

                        </div>



                        <div class="col-xs-5th process-wizard-step complete">

                            <!-- active -->

                            <div class="text-center process-wizard-stepnum">Step 5</div>

                            <div class="progress"><div class="progress-bar"></div></div>

                            <a href="#" class="process-wizard-dot"></a>

                            <div class="process-wizard-info text-center">Click on Set Appointment to Proceed.</div>

                        </div>

                    </div>

                    <div class="clearfix"></div>

                    <hr />

                    <div class="col-md-12 margin-bottom-40 margin-top-20">

                        <div class="col-md-6 col-md-offset-3 margin-bottom-20">

                            <div class="col-md-12 shadow-boxx">

                                <div class="col-md-12 text-center margin-bottom-20" style="background-color: #da291c; padding: 0px; border-radius: 10px;">

                                    <h4 style="color: #fff; font-weight: 400; margin-top: 10px; margin-bottom: 10px;">Appointment for <?= $user->first_name ?> <?= $user->last_name ?></h4>

                                </div>

                                <div class="col-md-4 padding-0">

                                    <img src="{{ asset('public/images/affiliates') }}/<?= $user->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px; padding: 5px" width="140" height="140" alt="featured item" />

                                </div>

                                <div class="col-md-8 text-center padding-0">

                                    <table class="profile-info margin-bottom-10">

                                        <tbody>

                                            <tr>

                                                <td><b>Date: </b></td>

                                                <td><input type="text" class="form-control" value="<?= $appointment_date ?>, <?= $day ?>" readonly /></td>

                                            </tr>

                                            <tr>

                                                <td><b>Time: </b></td>

                                                <td><input type="text" class="form-control" value="<?= date('h:i A', strtotime($appointment_time)) ?>" readonly /></td>

                                            </tr>

                                            <tr>

                                                <td><b>With: </b></td>

                                                <td>&nbsp;<?= $user->first_name ?> <?= $user->last_name ?></td>

                                            </tr>

                                            <tr>

                                                <td><b>Company: </b></td>

                                                <td>&nbsp;<?= $user->company ?></td>

                                            </tr>

                                            <tr>

                                                <td style="vertical-align: baseline;"><b>Address: </b></td>

                                                <td>&nbsp;<?= $user->address ?>, State- <?= $user->state ?>, Country- <?= $user->country ?>, <?= $user->city ?>-<?= $user->zip_code ?></td>

                                            </tr>

                                            <tr>

                                                <td><b>Phone: </b></td>

                                                <td>&nbsp;<?= $user->cellphone ?></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                                <div class="clearfix"></div>

                                <hr />

                                <div class="col-md-12 text-center padding-0">

                                    <a href="{{ url('final_appointment') }}" class="btn btn-xs btn-info" style="margin-right: 10px; width: 150px;">Confirm Appointment</a>

                                    <a href="{{ url('appointment_step1') }}" class="btn btn-xs btn-info" style="margin-right: 10px; width: 140px;">Change</a>

                                    <a href="{{ url('/') }}" class="btn btn-xs btn-info" style="margin-right: 10px; width: 140px;">Cancel</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>





@endsection