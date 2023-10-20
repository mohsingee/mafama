@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Appointments / Change Appointments</h4>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                    <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                    <?php } ?>
                    <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                    <?php } ?>
                    <!-- <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a> -->
                </div>
                <div class="col-md-12 padding-0">
                    
                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="daily-tab">
                            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
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
                                        $change_details = App\Http\Controllers\MainController::getappointmentdetailstemp($value->aid);
                                        $today = date('Y-m-d');
                                        $nowtime = date('H:i');
                                        if(($value->appointment_date >= $today) && ($value->appointment_time >= $nowtime)){
                                    ?>
                                    <?php 
                                    if($change_details->change_unit == "day"){
                                    ?>
                                    <tr>
                                        <td><?= $value->first_name ?></td>
                                        <td><?= $value->last_name ?></td>
                                        <td><?= $value->email ?></td>
                                        <td><?= $value->work_phone ?></td>
                                        <td><?= date('d F Y', strtotime($value->appointment_date)) ?></td>
                                        <td><?= $value->appointment_time ?></td>
                                        <td>
                                            <?php
                                            if($value->appointment_date >= date('Y-m-d', strtotime("+".$change_details->change_time." days"))){
                                            ?>
                                                <a href="{{ url('user_change_appointment_step') }}/<?= $value->aid ?>" class="btn btn-xs btn-success">Change</a>
                                                <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                            <?php }else{ ?>
                                                <a class="btn btn-xs btn-success">Not Changable</a>
                                                <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                            <?php } ?>
                                        </td>
                                    </tr>   
                                    <?php 
                                    }elseif($change_details->change_unit == "hours"){
                                    ?>
                                        <tr>
                                            <td><?= $value->first_name ?></td>
                                            <td><?= $value->last_name ?></td>
                                            <td><?= $value->email ?></td>
                                            <td><?= $value->work_phone ?></td>
                                            <td><?= date('d F Y', strtotime($value->appointment_date)) ?></td>
                                            <td><?= $value->appointment_time ?></td>
                                            <td>
                                                <?php
                                                if($value->appointment_date == date('Y-m-d')){
                                                    if($value->appointment_time >= date("H:i", strtotime("+".$change_details->change_time." hours"))){
                                                ?>
                                                        <a href="{{ url('user_change_appointment_step') }}/<?= $value->aid ?>" class="btn btn-xs btn-success">Change</a>
                                                        <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                <?php 
                                                    }else{
                                                ?>
                                                    <a class="btn btn-xs btn-success">Not Changable</a>
                                                    <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                <?php
                                                    }
                                                ?>
                                                <?php }elseif($value->appointment_date > date('Y-m-d')){ ?>
                                                        <a href="{{ url('user_change_appointment_step') }}/<?= $value->aid ?>" class="btn btn-xs btn-success">Change</a>
                                                        <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                <?php } ?>
                                            </td>
                                        </tr>  
                                    <?php 
                                    }
                                    ?>
                                    <?php
                                    }
                                    ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection