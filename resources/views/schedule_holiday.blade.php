@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Client Management / Scheduler</h4>
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
                    <li><a href="{{ url('schedule_birthday') }}">Schedule Birthday</a></li>
                    <li class="active"><a href="{{ url('schedule_holiday') }}">Schedule Holiday</a></li>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="">Please Select a holiday to schedule mail, card or video</label>
                                <select class="form-control select2 holiday_select">
                                    <?php 
                                        foreach ($holidays as $value) {
                                    ?>
                                            <option value="<?= $value->id ?>"><?= $date = date('d F', strtotime($value->date)) ?>, <?= date('Y') ?> <?= $value->holiday ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ url('add_holiday') }}" class="btn btn-info">Add New Holiday</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p style="color: red" id="emailer"></p>
                        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                            <thead>
                                <tr>
                                    <th class="table-checkbox">
                                        <input type="checkbox" class="group-checkable" data-set="#datatable_sample checkboxes" />
                                    </th>
                                    <th>Client Name</th>
                                    <th>Holiday</th>
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
                                            <tr class="">
                                                <td><input type="checkbox" class="checkboxes" value="<?= $value->id ?>" /></td>
                                                <td><?= $value->first_name ?> <?= $value->last_name ?></td>
                                                <td class="holiday_date"></td>
                                                <td><?= $value->email ?></td>
                                                <td><?= date('d M Y', strtotime($value->dob)) ?></td>
                                                <td><?= $value->cell_phone ?></td>
                                                <td><?= $value->status ?></td>
                                                <td>
                                                    <form action="{{ url('view_clientf') }}" method="post" style="padding: 0; float: left;">
                                                    @csrf
                                                        <input type="hidden" name="id" value="<?= $value->id ?>">
                                                        <input type="submit" class="btn btn-xs btn-success" value="View">
                                                    </form>
                                                    <!--<a href="view_client.php" class="btn btn-xs btn-info">View</a>-->
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                        </table>
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
                            <!-- <li><a href="#sms-tab" data-toggle="tab">Send SMS</a></li> -->
                        </ul>

                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="email-tab">
                                <form id="client_manage_submit" class="margin-bottom-0" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                    <input type="hidden" class="holiday_id" name="holiday_id" value="">
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
                                                        <a class="btn btn-xs btn-info prvbtn" style="width: 100%;">Preview</a>
                                                    </div>
                                                    <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                        <a class="btn btn-xs btn-info subbtn" style="width: 100%;">Send</a>
                                                    </div>
                                                    <input type="submit" id="submit_button" value="" style="display: none">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding: 15px">
                                            <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="card-tab">
                                <form class="margin-bottom-0" method="POST" id="manage_client_card_submit" role="form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                <input type="hidden" class="holiday_id" name="holiday_id" value="">
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
                                                            <a class="btn btn-xs btn-info prvbtn1" style="width: 100%;">Preview</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn1" style="width: 100%;">Send</a>
                                                        </div>
                                                        <input type="submit" id="submit_button1" value="" style="display: none">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding: 15px">
                                            <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card1"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="video-tab">
                                <form class="margin-bottom-0" method="POST" id="manage_client_video_submit" role="form" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" class="form-control malto" placeholder="To" name="malto" value="" />
                                    <input type="hidden" class="holiday_id" name="holiday_id" value="">
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
                                                            <a class="btn btn-xs btn-info prvbtn2" style="width: 100%;">Preview</a>
                                                        </div>
                                                        <div class="col-md-5th text-center" style="padding-left: 0px; padding-right: 5px;">
                                                            <a class="btn btn-xs btn-info subbtn2" style="width: 100%;">Send</a>
                                                        </div>
                                                        <input type="submit" id="submit_button2" value="" style="display: none">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="padding: 15px">
                                                <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
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
    $(document).on('change','.checkboxes',function(){
        if ($(this).prop('checked')) {
            $(this).addClass("checked");
            var mail_arr = []; 
            $(".checkboxes.checked").each(function() {
                var id = $(this).val();
                mail_arr.push(id);
            }); 
            // alert("hi");
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
            // alert("bye");
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
                    if(submit_value == "Send"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "schedule_holiday_submit",
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
                    var preview = '<div style="padding:10px; background-color:'+bakg+'"><div style="padding: 20px">'+user_banner+'</div><p style="margin-bottom: 0;">'+message+'</p></div>';
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
        $(".group-checkable").change(function(){
            if ($(this).prop('checked')) {
                var boxes = $('.checkboxes:not(:checked)');
                boxes.each(function(){
                    $(this).prop('checked', false);
                    $(this).trigger('click');
                });
            }
            else{
                $('.checkboxes').prop('checked', true);

                $('.checkboxes').trigger('click');
            }
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
                    if(submit_value == "Send"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "schedule_holiday_card_submit",
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
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
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
                    if(submit_value == "Send"){
                        $.ajax({
                          type: "POST",
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          url: "schedule_holiday_video_submit",
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
                          },
                          complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                          }
                        });
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
        setTimeout(function() {
            $(".holiday_select").trigger('change');
        },1000);        
        $(".holiday_select").change(function(){
            var holiday_id = $(this).val();
            $(".holiday_id").val(holiday_id);
            var url = "<?php echo url('/'); ?>/holiday_details";
            $.ajax({
                  url: url,
                  data: 'id=' + holiday_id + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    $(".holiday_date").html(response);
                }
            });
        });
    });
    
</script>
@endsection