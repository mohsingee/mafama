@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Appointments / Cancel Appointments</h4>
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
                                        if(($value->appointment_date == $today) && ($value->appointment_time >= $nowtime)){
                                    ?>
                                    <?php 
                                            if($change_details->cancel_unit == "day"){
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
                                                        if($value->appointment_date >= date('Y-m-d', strtotime("+".$change_details->cancel_time." days"))){
                                                        ?>
                                                        <?php 
                                                            if($value->cstatus == "off"){
                                                        ?>
                                                                <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                            }else{
                                                        ?>
                                                                <a class="btn btn-xs btn-info delete" id="delete<?= $value->aid ?>">Cancel</a>
                                                                <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php 
                                                            }
                                                        }
                                                        else{ 
                                                        ?>
                                                        <?php 
                                                            if($value->cstatus == "off"){
                                                        ?>
                                                                <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                            }else{
                                                        ?>
                                                                <a class="btn btn-xs btn-success">Not Cancelable</a>
                                                                <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php 
                                                            }
                                                        } 
                                                        ?>
                                                    </td>
                                                </tr>   
                                    <?php 
                                            }elseif($change_details->cancel_unit == "hours"){
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
                                                                if($value->cstatus == "off"){
                                                        ?>
                                                                    <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                                }else{
                                                        ?>
                                                                    <a class="btn btn-xs btn-info delete" id="delete<?= $value->aid ?>">Cancel</a>
                                                                    <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php 
                                                                } 
                                                            }
                                                            else{
                                                        ?>
                                                        <?php 
                                                                if($value->cstatus == "off"){
                                                        ?>
                                                                    <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                                }else{
                                                        ?>
                                                                    <a class="btn btn-xs btn-success">Not Cancelable</a>
                                                                    <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php 
                                                                }
                                                            }
                                                        }elseif($value->appointment_date > date('Y-m-d')){
                                                            if($value->cstatus == "off"){
                                                        ?>
                                                                <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                            }else{
                                                            ?>
                                                                <a class="btn btn-xs btn-info delete" id="delete<?= $value->aid ?>">Cancel</a>
                                                                <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php } ?>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>  
                                    <?php 
                                            }
                                    ?>
                                    <?php } elseif($value->appointment_date > $today){ ?>
                                        <?php 
                                            if($change_details->cancel_unit == "day"){
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
                                                        if($value->appointment_date >= date('Y-m-d', strtotime("+".$change_details->cancel_time." days"))){
                                                        ?>
                                                        <?php 
                                                            if($value->cstatus == "off"){
                                                        ?>
                                                                <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                            }else{
                                                        ?>
                                                                <a class="btn btn-xs btn-info delete" id="delete<?= $value->aid ?>">Cancel</a>
                                                                <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php 
                                                            }
                                                        }
                                                        else{ 
                                                        ?>
                                                        <?php 
                                                            if($value->cstatus == "off"){
                                                        ?>
                                                                <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                            }else{
                                                        ?>
                                                                <a class="btn btn-xs btn-success">Not Cancelable</a>
                                                                <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php 
                                                            }
                                                        } 
                                                        ?>
                                                    </td>
                                                </tr>   
                                    <?php 
                                            }elseif($change_details->cancel_unit == "hours"){
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
                                                                if($value->cstatus == "off"){
                                                        ?>
                                                                    <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                                }else{
                                                        ?>
                                                                    <a class="btn btn-xs btn-info delete" id="delete<?= $value->aid ?>">Cancel</a>
                                                                    <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php 
                                                                } 
                                                            }
                                                            else{
                                                        ?>
                                                        <?php 
                                                                if($value->cstatus == "off"){
                                                        ?>
                                                                    <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                                }else{
                                                        ?>
                                                                    <a class="btn btn-xs btn-success">Not Cancelable</a>
                                                                    <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php 
                                                                }
                                                            }
                                                        }elseif($value->appointment_date > date('Y-m-d')){
                                                            if($value->cstatus == "off"){
                                                        ?>
                                                                <a class="btn btn-xs btn-info">Canceled</a>
                                                        <?php
                                                            }else{
                                                            ?>
                                                                <a class="btn btn-xs btn-info delete" id="delete<?= $value->aid ?>">Cancel</a>
                                                                <a href="{{ url('user_change_appointment_view') }}/<?= $value->aid ?>" class="btn btn-xs btn-danger">View</a>
                                                        <?php } ?>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>  
                                    <?php 
                                            }
                                    ?>

                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label>Reason for Canceling.</label>
                    <textarea class="form-control" name="delete_reason" id="delete_reason"></textarea>
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                </div>
                <input type="hidden" id="">
                <div class="col-md-12 text-center margin-top-20">
                    <a class="btn btn-info" id="delete_revenuee">Cancle</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        $("#delete_id").val(id);
        $("#deleteModal").modal('show');
    });
    $("#delete_revenuee").on('click', function(e){
        e.preventDefault();
        var id = $("#delete_id").val();
        var delete_reason = $("#delete_reason").val();
        // alert(delete_reason);
        var url = "<?php echo url('/'); ?>/user_delete_appointment";
        $.ajax({
              url: url,
              data: 'id=' + id + '&delete_reason=' + delete_reason + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                alert("Deleted Succesfully.");
                location.reload();
            }
        });
    });
</script>
@endsection