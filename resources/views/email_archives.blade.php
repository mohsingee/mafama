@extends('layouts.main') 
@section("content")
<style type="text/css">
    table, p{
        margin-bottom: 0;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Archives / Email Archives</h4>
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
                    <ul class="nav nav-tabs nav-button-tabs nav-justified">
                        <li class="active"><a href="#tab1" data-toggle="tab">Email Campaigns</a></li>
                        <li><a href="#tab2" data-toggle="tab">Send Email</a></li>
                        <li><a href="#tab3" data-toggle="tab">Send Card</a></li>
                        <li><a href="#tab4" data-toggle="tab">Send Videos</a></li>
                        <li><a href="#tab5" data-toggle="tab">Send SMS</a></li>
                        <li><a href="#tab6" data-toggle="tab">Chat</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Email id</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total</th>
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                        foreach($email_campaigns as $value){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?= $value->email ?></td>
                                            <?php
                                            $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $mailcount = \App\Http\Controllers\HomeController::get_month_count($valuee, $value->email);

                                                    $tot += $mailcount;

                                                    // echo '<td>'.$mailcount.'</td>';
                                                   
                                                    if($mailcount > 0){
                                                        echo '<td><a class="email_campaign_details" id="'.$valuee.'email_campaign'.$value->email.'">'.$mailcount.'</a></td>';
                                                    }
                                                    else{
                                                        echo '<td>'.$mailcount.'</td>';
                                                    }
                                                }
                                             ?>
                                            <td><?= $tot ?></td>
                                            <td>
                                                <a href="{{ url('monthly_email_campaign_chartt') }}/<?= $value->email ?>"><i class="fa fa-bar-chart"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <?php
                                            $totall = 0;
                                            foreach ($months_arr as $valuee) {
                                                $mailcountt = \App\Http\Controllers\HomeController::get_mail_count($valuee);

                                                $totall += $mailcountt;

                                                echo '<td>'.$mailcountt.'</td>';
                                            }
                                         ?>
                                        <td><?= $totall ?></td>

                                        <td>
                                            <a href="{{ url('monthly_email_campaign_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Email Ids</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total</th>
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                        foreach($send_email as $value){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?= $value->email ?></td>
                                            <?php
                                            $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $mailcount = \App\Http\Controllers\HomeController::email_get_month_count($valuee, $value->email);

                                                    $tot += $mailcount;

                                                    // echo '<td>'.$mailcount.'</td>';
                                                    if($mailcount > 0){
                                                        echo '<td><a class="send_email_details" id="'.$valuee.'send_email'.$value->email.'">'.$mailcount.'</a></td>';
                                                    }
                                                    else{
                                                        echo '<td>'.$mailcount.'</td>';
                                                    }
                                                }
                                             ?>
                                            <td><?= $tot ?></td>
                                            <td>
                                                <a href="{{ url('monthly_send_email_chartt') }}/<?= $value->email ?>"><i class="fa fa-bar-chart"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <?php
                                            $totall = 0;
                                            foreach ($months_arr as $valuee) {
                                                $mailcountt = \App\Http\Controllers\HomeController::email_get_mail_count($valuee);

                                                $totall += $mailcountt;

                                                echo '<td>'.$mailcountt.'</td>';
                                            }
                                         ?>
                                        <td><?= $totall ?></td>

                                        <td>
                                            <a href="{{ url('monthly_send_email_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Email Ids</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total</th>
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                        foreach($send_card as $value){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?= $value->email ?></td>
                                            <?php
                                            $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $mailcount = \App\Http\Controllers\HomeController::card_get_month_count($valuee, $value->email);

                                                    $tot += $mailcount;

                                                    // echo '<td>'.$mailcount.'</td>';
                                                    if($mailcount > 0){
                                                        echo '<td><a class="send_card_details" id="'.$valuee.'send_card'.$value->email.'">'.$mailcount.'</a></td>';
                                                    }
                                                    else{
                                                        echo '<td>'.$mailcount.'</td>';
                                                    }
                                                }
                                             ?>
                                            <td><?= $tot ?></td>
                                            <td>
                                                <a href="{{ url('monthly_send_card_chartt') }}/<?= $value->email ?>"><i class="fa fa-bar-chart"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <?php
                                            $totall = 0;
                                            foreach ($months_arr as $valuee) {
                                                $mailcountt = \App\Http\Controllers\HomeController::card_get_mail_count($valuee);

                                                $totall += $mailcountt;

                                                echo '<td>'.$mailcountt.'</td>';
                                            }
                                         ?>
                                        <td><?= $totall ?></td>

                                        <td>
                                            <a href="{{ url('monthly_send_card_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab4">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Email Ids</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total</th>
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                        foreach($send_video as $value){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?= $value->email ?></td>
                                            <?php
                                            $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $mailcount = \App\Http\Controllers\HomeController::video_get_month_count($valuee, $value->email);

                                                    $tot += $mailcount;

                                                    if($mailcount > 0){
                                                        echo '<td><a class="send_video_details" id="'.$valuee.'send_video'.$value->email.'">'.$mailcount.'</a></td>';
                                                    }
                                                    else{
                                                        echo '<td>'.$mailcount.'</td>';
                                                    }
                                                }
                                             ?>
                                            <td><?= $tot ?></td>
                                            <td>
                                                <a href="{{ url('monthly_send_video_chartt') }}/<?= $value->email ?>"><i class="fa fa-bar-chart"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <?php
                                            $totall = 0;
                                            foreach ($months_arr as $valuee) {
                                                $mailcountt = \App\Http\Controllers\HomeController::video_get_mail_count($valuee);

                                                $totall += $mailcountt;

                                                echo '<td>'.$mailcountt.'</td>';
                                            }
                                         ?>
                                        <td><?= $totall ?></td>

                                        <td>
                                            <a href="{{ url('monthly_send_video_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab5">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Email Ids</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total</th>
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                        foreach($send_sms as $value){
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?= $value->email ?></td>
                                            <?php
                                            $tot = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $mailcount = \App\Http\Controllers\HomeController::sms_get_month_count($valuee, $value->email);

                                                    $tot += $mailcount;

                                                    if($mailcount > 0){
                                                        echo '<td><a class="send_sms_details" id="'.$valuee.'send_sms'.$value->email.'">'.$mailcount.'</a></td>';
                                                    }
                                                    else{
                                                        echo '<td>'.$mailcount.'</td>';
                                                    }
                                                }
                                             ?>
                                            <td><?= $tot ?></td>
                                            <td>
                                                <a href="{{ url('monthly_send_sms_chartt') }}/<?= $value->email ?>"><i class="fa fa-bar-chart"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <?php
                                            $totall = 0;
                                            foreach ($months_arr as $valuee) {
                                                $mailcountt = \App\Http\Controllers\HomeController::sms_get_mail_count($valuee);

                                                $totall += $mailcountt;

                                                echo '<td>'.$mailcountt.'</td>';
                                            }
                                         ?>
                                        <td><?= $totall ?></td>

                                        <td>
                                            <a href="{{ url('monthly_send_sms_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details5"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab6">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Email Ids</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total</th>
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>test@gmail.com</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td>test@gmail.com</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td>test@gmail.com</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>

                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).on("click", ".email_campaign_details", function(){
        var idd = $(this).attr('id');
        var id = idd.split('email_campaign');
        var month = id[0];
        var email = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/email_campaign_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&email=' + email + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details1").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    $(document).on("click", ".send_email_details", function(){
        var idd = $(this).attr('id');
        var id = idd.split('send_email');
        var month = id[0];
        var email = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/send_email_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&email=' + email + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details2").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    
    $(document).on("click", ".send_card_details", function(){
        var idd = $(this).attr('id');
        var id = idd.split('send_card');
        var month = id[0];
        var email = id[1];
        var url = "<?php echo url('/'); ?>/send_card_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&email=' + email + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details3").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    
    $(document).on("click", ".send_video_details", function(){
        var idd = $(this).attr('id');
        var id = idd.split('send_video');
        var month = id[0];
        var email = id[1];
        var url = "<?php echo url('/'); ?>/send_video_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&email=' + email + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details4").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    
    $(document).on("click", ".send_sms_details", function(){
        var idd = $(this).attr('id');
        var id = idd.split('send_sms');
        var month = id[0];
        var email = id[1];
        var url = "<?php echo url('/'); ?>/send_sms_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&email=' + email + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details5").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
</script>

@endsection