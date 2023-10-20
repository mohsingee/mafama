@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            @if(Auth::id() != "")
                @if(Auth::user()->role != "client" )

                    <div class="col-md-3 col-sm-3">
                         @if(Auth::user()->role != "affiliate_user")
                        <ul class="nav nav-tabs nav-stacked nav-alternate">
                           @if(Auth::user()->level !='')
                           <li class="active">
                                <a href="{{ url('back-office') }}">
                                    Back Office
                                </a>
                            </li>
                            @else

                            <li class="active">
                                <a href="javascript:void(0)">
                                    Back Office
                                </a>
                            </li>

                            @endif
                            <li>
                                <a href="#tab_t" data-toggle="tab">
                                    Transactions
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('change_password_front') }}">
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('user_access_rights') }}">
                                    User Access
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('blog') }}">
                                    Blog
                                </a>
                            </li>
                            <?php if(Auth::id() != ""){ ?>
                            <?php if((Auth::user()->role == "affiliate")){ ?>
                            <li>
                                <a href="{{ url('front_dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <?php }} ?>
                        </ul>
                        @endif
                    </div>
                @endif
            @else
                <div class="col-md-3"></div>
            @endif

            <!-- tabs content -->
            <!-- @if(Auth::id() != "")
                @if(Auth::user()->role != "client")
                    <div class="col-md-9 col-sm-9">
                @else
                    <div class="col-md-12 col-sm-12">
                @endif
            @else
                <div class="col-md-12 col-sm-12">
            @endif -->
            <div class="col-md-9 col-sm-9">   

                <div class="tab-content tab-stacked nav-alternate">
                    <div id="tab_g" class="tab-pane active">
                        @if(Auth::check()) 
                        @if(Auth::user()->role != "client")
                      <div class="col-md-12 col-sm-12 padding-0" style="margin-bottom: 20px;">
                    <div class="row">
                        <!--<div class="col-md-4">
										<div class="outer-divv" >
											<div class="">
												<a href="#">
													<img src="{{ asset('public/images/maxresdefault.jpg') }}" style="width:100%;height:180px;" alt="">
												</a>
											</div>
											<h5 class="box-heading">Text <span style="float:right;">5 Star</span></h5>
										</div>
									</div>
									<div class="col-md-4">
										<div class="outer-divv" >
											<div class="">
												<a href="#">
													<img src="{{ asset('public/images/maxresdefault.jpg') }}" style="width:100%;height:180px;" alt="">
												</a>
											</div>
											<h5 class="box-heading">Text <span style="float:right;">5 Star</span></h5>
										</div>
									</div>
									<div class="col-md-4">
										<div class="outer-divv" >
											<div class="">
												<a href="#">
													<img src="{{ asset('public/images/maxresdefault.jpg') }}" style="width:100%;height:180px;" alt="">
												</a>
											</div>
											<h5 class="box-heading">Text <span style="float:right;">5 Star</span></h5>
										</div>
									</div>-->
                        <div class="col-md-12">
                            <div class="owl-carousel text-center owl-testimonial nomargin" data-plugin-options='{"items":4, "singleItem": false, "autoPlay": 4000, "navigation": false, "pagination": false, "transitionStyle":"fade"}'>
                                  <?php 
                                    foreach ($recent_achievers as $slide) {
                                        $img=\App\User::get_user_profile_pic($slide->email);
                                ?>
                                <div class="testimonial">
                                    <div class="col-md-12 testimonial-bordered">
                                        <figure>
                                        <img class="rounded" src="<?= $img;?>" alt="" style="width: 60px !important;height:60px !important" />
                                        </figure>
                                        <div class="testimonial-content nopadding">
                                          
                                            <cite>
                                                <?= $slide->username ?>
                                                <span class="text-success">New Member</span>{{-- <span><b>$</b><= $slide->amount ></span> --}}
                                            </cite>
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
                @endif
                @endif
                <div class="row">
                    <div class="owl-carousel text-center owl-testimonial nomargin" data-plugin-options='{"items":2, "singleItem": false, "autoPlay": <?= $slidetime2[0]->playtime ?>, "navigation": false, "pagination": false, "transitionStyle":"fade"}'>
                        <?php 
                            foreach ($text_banners as $banner) {
                        ?>
                        <div class="col-md-12 col-sm-12 margin-bottom-40">
                            <img class="img-responsive" src="<?php echo asset("public/images") ?>/<?= $banner->image ?>" alt="" style="height: 350px;" />
                            <h4 class="text-center"><a href=""><?= $banner->text ?></a></h4>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <!-- POST ITEM -->
                    <?php 
                        foreach ($home_videos as $video) {
                    ?>
                    <div class="blog-post-item col-md-6 col-sm-6">
                        <!-- VIDEO -->
                        <div class="margin-bottom-20">
                            <div class="embed-responsive embed-responsive-16by9">
                                <!-- <iframe class="embed-responsive-item" src="<?php //echo asset("public/videos") ?>/<?= $video->video ?>" width="800" height="450"></iframe> -->
                                <video width="100%"  height="450" controls autoplay muted>
                                    <source src="<?php echo asset("public/videos") ?>/<?= $video->video ?>" type="video/mp4">
                                </video>
                            </div>
                        </div>

                        <!-- <h2 class="text-center"><a href="">BLOG VIDEO POST</a></h2> -->
                        <!--<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>

									<a href="blog-single-default.html" class="btn btn-reveal btn-default">
										<i class="fa fa-plus"></i>
										<span>Read More</span>
									</a>-->
                    </div>
                    <?php
                        }
                    ?>
                    <!-- /POST ITEM -->

                </div>
                    </div>
                     <div id="tab_t" class="tab-pane">
                        <h4>Transactions</h4>
                        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Datetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @if(Auth::check())
                                 
                                
                                   @php
                                   $i=1
                                   @endphp
                                   @if($transactions->count() >0 )
                                    @foreach($transactions as $trans)
                                    <tr>
                                       <td>{{$i++}}.</td>
                                       <td><b>$</b>{{$trans->amount}}</td> 
                                       <td>{!! $trans->description !!}</td> 
                                       <td>{{date_formate($trans->created_at)}}</td>
                                    </tr>    
                                    @endforeach  
                                @endif    
                                    @else 
                                    <tr>
                                        <td colspan=""></td>
                                        <td colspan=""></td>
                                        <td colspan=""></td>
                                        <td colspan=""></td>
                                    </tr>
                                    @endif                    
                                </tbody>
                            </table>
                    </div>
                    <div id="tab_h" class="tab-pane">
                        <h4>Change Password</h4>
                        <p></p>
                    </div>

                    <div id="tab_i" class="tab-pane">
                        <h4>User Access</h4>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="ex1" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">
                <a href="{{ url('front_dashboard') }}"><button type="button" class="close"><span aria-hidden="true">&times;</span></button></a>
                <h4 class="modal-title" id="myModalLabel">Welcome to Mafama.</h4>
            </div>
            <form id="form-id" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body ">
                    <?php if($abanner != ""){ ?>
                        <div class="col-md-12">
                            <div style="padding: 0 10px">{!! $abanner->preview !!}</div>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <?php
                        if((Auth::id() != "") && (Auth::user()->role == "affiliate")){
                        ?>
                            <ul style="list-style: none; padding: 0; margin-bottom: 0px">
                                <?php 
                                    foreach ($details as $value) {
                                        ?>
                                            <li class="affiliate_popup1" style="padding: 10px; float: left; margin-bottom: 10px;" id="po<?= $value->id ?>">{!! $value->preview !!}</li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        <?php } ?>
                        <p style="color: red; margin-bottom: 10px" id="newslettererror"></p>
                        <input type="hidden" name="popup1" id="popup1">
                    </div>
                    @if($popup_setting != "")
                        @if($popup_setting->email_status == '1')
                            @php $mailstatus = ""; @endphp
                            @if($popup_mail != "")
                                @php
                                    $new_time = date("Y-m-d H:i:s", strtotime('+'.$popup_setting->time_difference.' hours', strtotime($popup_mail->created_at)));
                                    $now = date('Y-m-d H:i:s');
                                    if($now >= $new_time){
                                        $mailstatus = "on";
                                    }
                                @endphp
                            @else
                                @php $mailstatus = "on"; @endphp
                            @endif
                            @if($mailstatus != "")
                                <?php if($folders != ""){ ?>
                                    <div class="col-md-12" style="margin-bottom: 10px;">
                                        <label><b>Folders</b></label>
                                        <ul class="folderul">
                                            <?php 
                                                foreach ($folders as $value) {
                                            ?>                                        
                                                    <li>
                                                        <label class="checkbox chk-sm">
                                                            <input type="checkbox" value="<?= $value->id ?>" class="folder_check" <?php if(($value->uid == "default")){ ?> checked <?php } ?> />
                                                            <i></i> <?= $value->folder_name ?>
                                                        </label>
                                                    </li>
                                            <?php
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <div style="display: none;">
                                        <h4 style="border-bottom: 1px solid #f6cbc9;">
                                            <label class="checkbox chk-sm" style="color: #da291c;">
                                                <input type="checkbox" value="1" id="contactall" />
                                                <i></i> Select All
                                            </label>
                                        </h4>
                                        <div id="contact_sec">
                                            
                                        </div>
                                        <input type="hidden" name="" value="" id="contactid">
                                    </div>
                                <?php } ?>
                                <!-- <div class="col-md-12">
                                    <input type="hidden" class="form-control" placeholder="To" id="malto" name="malto" />
                                    <div class="email-id-row">
                                        <span class="to-input">To</span>
                                        <div class="all-mail"></div>
                                        <input type="text" name="email" class="enter-mail-id" placeholder="Enter the email id .." />
                                    </div>
                                    <p style="color: red; margin-bottom: 0px" id="emailer"></p>
                                </div> -->
                                <div class="col-md-12 margin-top-20">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" placeholder="To" id="malto" name="malto" />
                                        <div class="email-id-row">
                                            <span class="to-input">To</span>
                                            <div class="all-mail"></div>
                                            <input type="text" name="email" class="enter-mail-id" placeholder="Enter the email id .." />
                                        </div>
                                    </div>
                                    <p style="color: red; margin-bottom: 0px" id="emailer"></p>
                                </div>
                                <div class="col-md-12 margin-top-20">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject" id="subject">
                                </div>
                                <div class="col-md-12 text-center margin-top-20">
                                    <a class="btn btn-info subbtn">Send Now</a>
                                    <!-- <a class="btn btn-info dateonsub">Send On</a> -->
                                    <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                                </div>
                                <!-- <div class="col-md-12 dateon" style="margin-top: 10px; display: none;">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-6" style="padding: 0 10px; ">
                                            <input type="date" class="form-control" name="sendon" id="sendon">
                                            <p style="color: red" id="send_on_alert"></p>
                                        </div>
                                        <div class="col-md-2" style="padding: 0; ">
                                            <a class="btn btn-xs btn-info subbtn" style="height: 40px; width: 100%; padding: 8px; font-size: 14px;">Send On</a>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                </div> -->
                                <div class="col-md-12 text-center" style="padding: 15px">
                                    <span style="color: green; font-size: 15px; font-weight: 600;" id="success_card"></span>
                                </div>
                                <input type="submit" id="submit_button" value="" style="display: none">
                            @endif
                        @endif
                    @endif
                    <div class="clearfix"></div>
                </div>

                <!-- Modal Footer -->
            </form>
        </div>
    </div>
</div>
<div id="ex2" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <a href="{{ url('front_dashboard') }}"><button type="button" class="close"><span aria-hidden="true">&times;</span></button></a>
                <h4 class="modal-title" id="myModalLabel">Todays's Schedule</h4>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="col-md-12">
                        <div style="padding: 5px; border: 1px solid #da291c; border-radius: 4px; margin-bottom: 20px">
                            <h5>Birthdays</h5>
                            <?php
                            if(count($birthdays) > 0){
                            ?>
                            <?php
                                foreach ($birthdays as $value) {
                            ?>
                                <p><?= $value->first_name ?> <?= $value->last_name ?>'s birthday is here.</p>
                            <?php
                                }
                            }else{
                            ?>
                            <p>NO Result Found</p>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <?php 
                    foreach ($meeting_task as $value) {
                    ?>
                        <div class="col-md-12">
                            <div style="padding: 5px; border: 1px solid #da291c; border-radius: 4px; margin-bottom: 20px">
                                <h5><?= $value->title ?></h5>
                                <p><?= $value->description ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="javascript:void();" class="btn btn-md btn-info margin-right-10 popupmodall"  data-toggle="modal" data-target="#ex1" style="display: none;"></a>
<script type="text/javascript">
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
        // alert(maxDate);
        $('#reminderdate').attr('min', maxDate);
        $('#sendon').attr('min', maxDate);
    });
</script>
<!-- / -->
<?php
        $popup = Session::get('popup');
        if($popup ==1){
        // if (isset($_SESSION['popup'])) {
        ?>
        <script>
            $(document).ready(function() {
                // alert("hi");
                setTimeout(function() {
                    $(".popupmodall").trigger('click');
                    $('.folder_check').trigger('change');
                    folder_check_doc();
                },1000);
                // $( ".popupmodall" ).click();
                // $(".enter-mail-id").keydown(function (e) {
                //     if (e.keyCode == 13 || e.keyCode == 32) {
                //         var getValue = $(this).val();
                //         $('.all-mail').append('<span class="email-ids"><span class="ema">'+ getValue +'</span><span class="cancel-email">x</span></span>');
                //         var mail_arr = []; 
                //         $(".email-ids .ema").each(function() { 
                //             mail_arr.push($(this).html()); 
                //         });
                //         // alert(mail_arr);
                //         $('#malto').val(mail_arr);
                //         $(this).val('');
                //         $("#emailer").html("");
                //     }
                // });
                // $(document).on('click','.cancel-email',function(){
                //     $(this).parent().remove();
                //     var mail_arr = []; 
                //     $(".email-ids .ema").each(function() { 
                //         mail_arr.push($(this).html()); 
                //     });
                //     $('#malto').val(mail_arr);
                // });
                $(document).on('click',".affiliate_popup1",function(){
                    $("#popup1").val($(this).attr("id"));
                    $(this).css("border", "3px solid #da291c");
                    $("#newslettererror").hide();
                    $("#newslettererror").html("");
                });
                $(".dateonsub").click(function(){
                    $(".dateon").show();
                    $(".reminderon").hide();
                });
                $(".subbtn").click(function() {
                    var submit_value = $(this).text();
                    // alert(submit_value);
                    $("#submit_button").val(submit_value);
                    $("#submit_button").trigger('click');
                });
                $("#form-id").submit(function(e) {
                    //---------------^---------------
                    e.preventDefault();
                    if($("#malto").val() == ""){
                        $("#emailer").html("Please enter atleast one email id !!");
                        
                    }
                    else if($("#popup1").val() == ""){
                        $("#newslettererror").html("Please select one newsletter !!");
                    }
                    else{

                        $("#emailer").html("");
                        var pop = $("#popup1").val();
                        var message = $("#"+pop).html();
                            var submit_value  = $("#submit_button").val();
                            var formData = new FormData(this);
                            formData.append("message", message);
                            if(submit_value == "Send Now"){
                                $.ajax({
                                  type: "POST",
                                  beforeSend: function(){
                                    $("#loading").show();
                                    $("#wrapper").hide();
                                  },
                                  url: "popup_mail",
                                  data:  formData,
                                    contentType: false,
                                    cache: false,
                                    processData:false,
                                  success: function(html) {
                                    // alert(html);
                                    $("#success_card").html(html);
                                    $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                    $('#malto').val("");
                                    $('#subject').val("");
                                    $(".email-ids").remove("");
                                  },
                                  complete: function(){
                                    $("#loading").hide();
                                    $("#wrapper").show();
                                  }
                                });
                            }
                            else if(submit_value == "Send On"){
                                if($("#sendon").val() == "")
                                {
                                    $("#send_on_alert").html("Date is required!");
                                }
                                else{
                                    $.ajax({
                                      type: "POST",
                                      beforeSend: function(){
                                        $("#loading").show();
                                        $("#wrapper").hide();
                                      },
                                      url: "popup_mail_date",
                                      data:  formData,
                                        contentType: false,
                                        cache: false,
                                        processData:false,
                                      success: function(html) {
                                        // alert(html);
                                        $("#success_card").html(html);
                                        $('#success_card').fadeIn('fast').delay(20000).fadeOut('fast');
                                        $('#malto').val("");
                                        $('#subject').val("");
                                        $(".email-ids").remove("");
                                        $("#sendon").val("");
                                        $(".dateon").hide();
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
            });
            $(window).ready(function() { 
                $("#form-id").on("keypress", function (event) { 
                    var keyPressed = event.keyCode || event.which; 
                    if (keyPressed === 13) { 
                        // alert("You pressed the Enter key!!"); 
                        event.preventDefault(); 
                        return false; 
                    } 
                }); 
            }); 
        </script>
        <?php
            Session::put('popup', "");
            // $_SESSION["popup"] = "";
        }
        ?>
        <script type="text/javascript">
            function folder_check_doc(){
                // var checkboxes = $('.folder_checkinput:checked').length;
                // alert("hi");
                var folder_arr = []; 
                $(".folder_check:checked").each(function() { 
                    folder_arr.push($(this).val()); 
                });
                // alert(folder_arr);
                var contactid = $("#contactid").val();
                var url = "<?php echo url('/'); ?>/folderwisecontact";
                $.ajax({
                      url: url,
                      data: 'folder_arr=' + folder_arr + '&contactid=' + contactid + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // alert(response);
                        // console.log(response);
                        $("#contact_sec").html(response);
                        $("#contactall").prop("checked", true);
                        // $("#contactall").trigger("change");
                        var boxes = $('.contact_mail:not(:checked)');
                        boxes.each(function(){
                            $(this).prop('checked', false);
                            $(this).trigger('click');
                        });
                        // if($("#contactall").is(':checked')){
                        //     $("#contactall").prop("checked", false);
                        // } 
                    }
                });
            }
            $("#folderall").change(function(){
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
        $(document).on("change", "#contactall", function(){
            if ($(this).prop('checked')) {
                // alert("bi");
                var boxes = $('.contact_mail:not(:checked)');
                boxes.each(function(){
                    $(this).prop('checked', false);
                    $(this).trigger('click');
                });
            }
            else{
                // alert("hi");
                $('.contact_mail').prop('checked', true);

                $('.contact_mail').trigger('click');
            }
        });
        $(document).on("change", '.folder_check', function() {
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
                        $("#contactall").prop("checked", true);
                        // $("#contactall").trigger("change");
                        var boxes = $('.contact_mail:not(:checked)');
                        boxes.each(function(){
                            $(this).prop('checked', false);
                            $(this).trigger('click');
                        });
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
            // $("#contactall").prop("checked", true);
            // $(".contact_mail").prop("checked", false);
        });
        $(".enter-mail-id").keydown(function (e) {
            if (e.keyCode == 13 || e.keyCode == 32) {
            //alert('You Press enter');
                var getValue = $(this).val();
                $('.all-mail').append('<span class="email-ids"><span class="ema">'+ getValue +'</span><span class="cancel-email">x</span></span>');
                var mail_arr = []; 
                $(".email-ids .ema").each(function() { 
                    mail_arr.push($(this).html()); 
                });
                // alert(mail_arr);
                $('#malto').val(mail_arr);
                $(this).val('');
            }
        });
        $(document).on('click','.cancel-email',function(){
              
              $(this).parent().remove();
              var mail_arr = []; 
                $(".email-ids .ema").each(function() { 
                    mail_arr.push($(this).html()); 
                });
                // alert(mail_arr);
                $('#malto').val(mail_arr);
        
        });
        // $(".contact_mail").click(function(){
        $(document).on('click','.contact_mail',function(){
            // alert("hi");
            if ($(this).prop('checked')) {
                // alert($(this).val());
                var id = $(this).val();
                this.setAttribute("checked", "checked");
                var url = "<?php echo url('/'); ?>/contactwisemail";
                $.ajax({
                      url: url,
                      data: 'id=' + id + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // alert(response);
                        $('.all-mail').append('<span class="email-ids"><span class="ema">'+ response +'</span><span class="cancel-email">x</span></span>');
                        var mail_arr = []; 
                        $(".email-ids .ema").each(function() { 
                            mail_arr.push($(this).html()); 
                        });
                        // alert(mail_arr);
                        $('#malto').val(mail_arr);
                        // $("#contact_sec").html(response);
                        var contactids = $("#contactid").val();
                        if(contactids == ""){
                            $("#contactid").val(id);
                        }
                        else{
                            var contactid = contactids.split(',');
                            contactid.push(id);
                            $("#contactid").val(contactid);
                        }
                    }
                });
            }
            else{
                var id = $(this).val();
                this.removeAttribute("checked");

                var url = "<?php echo url('/'); ?>/contactwisemaild";
                var smail = "";
                var mails = $("#malto").val();
                $.ajax({
                      url: "<?php echo url('/'); ?>/contactwisemail",
                      data: 'id=' + id + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        smail = response;
                    }
                })
                .done( function( data ) {
                    // Handles successful responses only
                } )
                .fail( function( reason ) {
                    console.info( reason );
                } )
                .then( function( data ) {
                    $.ajax({
                          url: url,
                          data: 'id=' + id + '&mails=' + mails + '&_token={{ csrf_token() }}',
                          type: "POST",
                        success: function (response) {
                            $(".email-ids .ema").each(function() {
                                var ddemail = $(this).html();
                                // alert(smail);
                                if(ddemail == smail){
                                    // alert(smail);
                                    $(this).parent().remove();

                                      // var mail_arr = []; 
                                      //   $(".email-ids .ema").each(function() { 
                                      //       mail_arr.push($(this).html()); 
                                      //   });
                                      //   $('#malto').val(mail_arr);
                                }
                            });   
                            var box = [];
                            var boxes = $('.contact_mail:checked');
                            boxes.each(function(){
                                // alert($(this).val());
                                box.push($(this).val());
                            }); 
                            $("#contactid").val(box);   
                            if($("#contactall").is(':checked')){
                                $("#contactall").prop("checked", false);
                            }    
                            // $('#malto').val(response);         
                        }
                    });
                });
            }
        });
        </script>
@endsection
