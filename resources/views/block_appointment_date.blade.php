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
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-10 text-center">
                        <h4>Settings / Appointment Settings</h4>
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
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                        <li><a href="{{ url('add_appointment_setting') }}">Appointment Settings</a></li>
                        <li class="active"><a href="{{ url('block_appointment_date') }}">Block Appointment Date</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        
                        <div class="tab-pane  fade in active" id="tab2">
                            <div class="col-md-12 text-center">
                                <p id="success_card" style="color: green;margin: 10px; font-size: 18px; font-weight: bold"></p>
                            </div>
                            <form id="blockentry" method="POST" enctype="multipart/form-data"> 
                            @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" class="form-control startdate" name="startdate" autocomplete="off" />
                                            <p class="startdatealert" style="color: red; font-weight: bold;"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">End Date</label>
                                            <input type="date" class="form-control enddate" name="enddate" autocomplete="off" />
                                            <p class="enddatealert" style="color: red; font-weight: bold;"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Reason</label>
                                            <!-- <select class="form-control select2" style="width: 100%;">
                                                <option>Vaccation</option>
                                                <option>Sick</option>
                                                <option>Reason Test</option>
                                                <option>Reason Test1</option>
                                            </select> -->
                                            <input type="text" name="reason" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                                        <button type="submit" class="btn btn-md btn-info">Save</button>
                                    </div>
                                </div>
                            </form>

                            <div class="col-md-12 margin-top-20">
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                    <thead>
                                        <tr>
                                            <th>Reason</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="blktable">
                                        <?php 
                                        foreach($block_appointment as $value){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?= $value->reason ?></td>
                                            <td><?= date('d F Y', strtotime($value->startdate)) ?></td>
                                            <td><?= date('d F Y', strtotime($value->enddate)) ?></td>
                                            <td>
                                                <a href="{{ url('delete_block_date') }}/<?= $value->id ?>" class="btn btn-xs btn-info">Delete</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#blockentry").submit(function(e) {
            //---------------^---------------
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
              type: "POST",
              beforeSend: function(){
                $("#loading").show();
                $("#wrapper").hide();
              },
              url: "block_appointment_entry",
              data:  formData,
                contentType: false,
                cache: false,
                processData:false,
              success: function(html) {
                // alert(html);
                $(".blktable").html(html);
                $("#success_card").html("Inserted Succesfully.");
                $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                $("input[name='startdate']").val("");
                $("input[name='enddate']").val("");
                $("input[name='reason']").val("");
              },
              complete: function(){
                $("#loading").hide();
                $("#wrapper").show();
              }
            });
        });
        $(".startdate").change(function(){
            $(".startdatealert").html("");
            var date = $(this).val();
            $.ajax({
              type: "POST",
              url: "checkblockdate",
              data: 'date=' + date + '&_token={{ csrf_token() }}',
                      type: "POST",
              success: function(html) {
                // alert(html);
                if(html == "no"){
                    $(".startdate").val("");
                    $(".startdatealert").html("You have already applied for this day.");
                }
              }
            });
        });
        $(".enddate").change(function(){
            $(".enddatealert").html("");
            var date = $(this).val();
            $.ajax({
              type: "POST",
              url: "checkblockdate",
              data: 'date=' + date + '&_token={{ csrf_token() }}',
                      type: "POST",
              success: function(html) {
                // alert(html);
                if(html == "no"){
                    $(".enddate").val("");
                    $(".enddatealert").html("You have already applied for this day.");
                }
              }
            });
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
        $('.startdate').attr('min', maxDate);
        $('.enddate').attr('min', maxDate);
    });
</script>

@endsection