@extends('layouts.main') 
@section("content")
<style type="text/css">
    .profile-info tr td{
        padding: 0px 5px;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-40">
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
                <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                                    <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                    <li><a href="#">Client Management</a></li>
                                    <li><a href="#">Email Management</a></li>
                                    <li><a href="#">Financial Management</a></li>
                                    
                                </ul>-->
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

                        <div class="col-xs-5th process-wizard-step active">
                            <!-- active -->
                            <div class="text-center process-wizard-stepnum">Step 5</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Click on Set Appointment to Proceed.</div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                    <form action="{{ url('appointment_additional') }}" method="POST" enctype="multipart/form-data">   
                        @csrf
                        <div class="col-md-12 margin-bottom-40 margin-top-20">
                            <div class="col-md-12 text-center margin-bottom-20">
                                <h4>Click on Set Appointment to Proceed.</h4>
                            </div>

                            <div class="col-md-12 margin-bottom-20">
                                <div class="col-md-8 col-md-offset-2 margin-bottom-20">
                                    <div class="col-md-12 shadow-boxx">
                                        <div class="col-md-12 margin-bottom-20">
                                            <label><b>Additional Comments (optional)</b></label>
                                            <textarea class="form-control" name="additional_comment" rows="2" placeholder="Enter any additional comments in this boxes, like (this appointment for my son Joe."></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="profile-info margin-bottom-10" style="width: 100%; margin-right: 0px;">
                                                <tbody>
                                                    <tr>
                                                        <td><b>Name : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="name1" required /></td>
                                                        <td><b>Email : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="email1" required /></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#modalRegister" id="bo1" class="openmodal"><i class="glyphicon glyphicon-book" style="color: #da291c;"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Name : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="name2" /></td>
                                                        <td><b>Email : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="email2" /></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#modalRegister" id="bo2" class="openmodal"><i class="glyphicon glyphicon-book" style="color: #da291c;"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Name : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="name3" /></td>
                                                        <td><b>Email : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="email3" /></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#modalRegister" id="bo3" class="openmodal"><i class="glyphicon glyphicon-book" style="color: #da291c;"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <div class="col-md-6 text-center">
                                            <table class="profile-info margin-bottom-10" style="width: 100%; margin-right: 0px;">
                                                <tbody>
                                                    <tr>
                                                        <td><b>Email : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="email1" required /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="email2" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email : </b></td>
                                                        <td><input type="text" class="form-control" value="" name="email3" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <a href="{{ url('appointment_step4') }}" class="btn btn-sm btn-info" style="margin-right: 10px; width: 200px; height: 34px">Back</a>
                                <button type="submit" class="btn btn-sm btn-info" style="margin-right: 10px; width: 200px; height: 34px;">Set Appointment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="modalRegister" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Contacts</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4" style="border-right: 1px solid #f6cbc9;">
                        <h4 style="border-bottom: 1px solid #f6cbc9; color: #da291c;">
                            <label class="checkbox chk-sm" style="color: #da291c;">
                                <input type="checkbox" value="1" id="folderall" />
                                <i></i> Select All Folder
                            </label>
                        </h4>
                        <?php 
                            foreach ($folders as $value) {
                        ?>                                        
                                <div class="col-md-12 padding-0">
                                    <label class="checkbox chk-sm">
                                        <input type="checkbox" value="<?= $value->id ?>" class="folder_check" />
                                        <i></i> <?= $value->folder_name ?>
                                    </label>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="col-md-8" style="border-right: 1px solid #f6cbc9; overflow-x: hidden; overflow-y: auto; max-height: 300px;">
                        <h4 style="border-bottom: 1px solid #f6cbc9;">
                            <label class="checkbox chk-sm" style="color: #da291c; padding-left: 0">
                                Contact Name
                            </label>
                        </h4>
                        <div id="contact_sec">
                            <?php 
                                foreach ($contacts as $valuee) {
                            ?>                                        
                                    <div class="col-md-12 padding-0">
                                        <label class="checkbox chk-sm">
                                            <input type="checkbox" value="<?= $valuee->id ?>" class="contact_mail" />
                                            <i></i><?= $valuee->first_name ?> <?= $valuee->last_name ?>
                                        </label>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                        <input type="hidden" name="bookId" id="bookId" value=""/>
                        <!-- <input type="hidden" name="" value="" id="contactid"> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.folder_check').change(function() {
            if ($(this).prop('checked')) {
                // var checkboxes = $('.folder_checkinput:checked').length;
                var folder_arr = []; 
                $(".folder_check:checked").each(function() { 
                    folder_arr.push($(this).val()); 
                });
                var contactid = $("#contactid").val();
                var url = "<?php echo url('/'); ?>/folderwisecontact";
                $.ajax({
                      url: url,
                      data: 'folder_arr=' + folder_arr + '&contactid=' + contactid + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // console.log(response);
                        $("#contact_sec").html(response);
                        // if($("#contactall").is(':checked')){
                        //     $("#contactall").prop("checked", false);
                        // } 
                    }
                });
            }
            else {

                var remfolder = $(this).val();
                var fstres = "";
                // alert(remfolder);
                var folder_arr = []; 
                $(".folder_check:checked").each(function() { 
                    folder_arr.push($(this).val()); 
                });
                var contactid = $("#contactid").val();
                var url = "<?php echo url('/'); ?>/folderwisecontact";
                $.ajax({
                      url: url,
                      data: 'folder_arr=' + folder_arr + '&contactid=' + contactid + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // console.log(response);
                        // $("#contact_sec").html(response);
                        fstres = response;
                    }
                })
                .then( function( data ) {
                    $.ajax({
                        url: "<?php echo url('/'); ?>/folderwisecontactids",
                        data: 'remfolder=' + remfolder + '&_token={{ csrf_token() }}',
                        type: "POST",
                        success: function (response) {
                            // alert(response);
                            
                            for ( var i = 0, l = response.length; i < l; i++ ) {
                                // alert(response[i]);
                                var boxes = $('.contact_mail:checked');
                                boxes.each(function(){
                                    // alert($(this).val());
                                    var vau = $(this).val();
                                    if(vau == response[i]){
                                        $(this).trigger('click');
                                    }
                                });
                            }
                            $("#contact_sec").html(fstres);
                            if($("#folderall").is(':checked')){
                                $("#folderall").prop("checked", false);
                            }
                        }
                    })
                });
            }
        });
        $("#folderall").change(function(){
            // alert("hi");
            if ($(this).prop('checked')) {
                this.setAttribute("checked", "checked");
                $('.folder_check').prop('checked', true);
            }
            else{
                this.removeAttribute("checked");
                $('.folder_check').prop('checked', false);
                var boxes = $('.contact_mail:checked');
                boxes.each(function(){
                    $(this).prop('checked', true);
                    $(this).trigger('click');
                });
            }
            $('.folder_check').trigger('change');
        });
        $(document).on('click','.contact_mail',function(){
            // alert("hi");
            if ($(this).prop('checked')) {
                // alert($(this).val());
                var id = $(this).val();
                var bookId = $("#bookId").val();
                this.setAttribute("checked", "checked");
                var url = "<?php echo url('/'); ?>/contactwisemailll";
                $.ajax({
                      url: url,
                      data: 'id=' + id + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // alert(response);
                        if(bookId == "bo1"){
                            $("input[name=name1]").val(response[1]);
                            $("input[name=email1]").val(response[0]);
                            $("#modalRegister").modal('hide');
                            $(".contact_mail").removeAttr('checked');
                        }
                        else if(bookId == "bo2"){
                            $("input[name=name2]").val(response[1]);
                            $("input[name=email2]").val(response[0]);
                            $("#modalRegister").modal('hide');
                            $(".contact_mail").removeAttr('checked');
                        }
                        else if(bookId == "bo3"){
                            $("input[name=name3]").val(response[1]);
                            $("input[name=email3]").val(response[0]);
                            $("#modalRegister").modal('hide');
                            $(".contact_mail").removeAttr('checked');
                        }
                    }
                });
            }
        });
        $(".openmodal").click(function(){
            var id = $(this).attr("id");
            $("#bookId").val(id);
        });
    });
</script>
@endsection