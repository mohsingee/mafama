@extends('layouts.main') 
@section("content")
<style type="text/css">
    .profile-info td {
        text-align: left !important;
        /*font-size: 12px;*/
        padding: 0 2px;
        vertical-align: baseline;
    }
    .shadow-boxx {
        border: 1px solid #da291c73 !important;
        border-radius: 10px;
        padding-top: 20px;
        padding-bottom: 20px;
        box-shadow: 1px 4px 10px 3px #da291c57;
        height: 300px;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Appointments / Steps to make appointment</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row process-wizard process-wizard-info">
                        <div class="col-xs-5th process-wizard-step complete">
                            <div class="text-center process-wizard-stepnum">Step 1</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Locate the Professional by Location or by Keyword.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step active">
                            <!-- complete -->
                            <div class="text-center process-wizard-stepnum">Step 2</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Click Make an Appointment to go to next step.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step disabled">
                            <!-- complete -->
                            <div class="text-center process-wizard-stepnum">Step 3</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Click on any available date below to view available time for that date.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step disabled">
                            <!-- active -->
                            <div class="text-center process-wizard-stepnum">Step 4</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Enter reason for Appointment.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step disabled">
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
                        
                            <div class="col-md-12 text-center margin-bottom-20">
                                <h4><?= $searchf ?></h4>
                            </div>
                            <!-- <div class="col-md-12 text-center">
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" value="clients" checked><b> Check for existing Clients </b>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" value="members"><b> Check for all Members</b>
                                </label>
                            </div> -->
                            
                            <div class="col-md-12 member_src_sec">
                                
                                <?php
                                foreach ($affiliates as $value) {
                                    ?>
                                        <div class="col-md-6 margin-bottom-20">
                                            <div class="col-md-12 shadow-boxx">
                                                <div class="col-md-4 padding-0">
                                                    <img src="{{ asset('public/images/affiliates') }}/<?= $value->image ?>" style="border: 1px solid #da291c73 !important; border-radius: 5px;" width="140" height="140" alt="featured item" />
                                                </div>
                                                <div class="col-md-8 text-center padding-0">
                                                    <table class="profile-info margin-bottom-10">
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Name: </b></td>
                                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Address: </b></td>
                                                                <td><?= $value->address ?>, State- <?= $value->state ?>, Country- <?= $value->country ?>, <?= $value->city ?>-<?= $value->zip_code ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Phone: </b></td>
                                                                <td><?= $value->cellphone ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Email: </b></td>
                                                                <td><?= $value->email ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Faith: </b></td>
                                                                <td><?= $value->religion ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Business Telephone: </b></td>
                                                                <td><?= $value->business_telephone ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr />
                                                <div class="col-md-12 text-center">
                                                    <a href="{{ url('member_appointment_step3') }}/<?= base64_encode($value->email) ?>" class="btn btn-xs btn-info" style="margin-right: 10px; width: auto;">Make Appointment</a>
                                                     <a href="{{ url('user/'.$value->username) }}" class="btn btn-xs btn-info" style="margin-right: 10px; width: 110px;">More Info</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection