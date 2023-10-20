@extends('layouts.main') 
@section("content")

<?php

$segment_users = request()->segment(2);
/*echo $segment_users;*/
$data = Session::all();
$uid = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
/*echo $uid;
echo "<pre>";
Print_r($data);
echo "</Pre>";*/
$value = $segment_users;

$name = $value;
$year = date('Y');
/*echo $year;
echo "<br>";*/
// $actual_jan = DB::table('expense_record')->whereMonth('transaction_date', '01')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_feb = DB::table('expense_record')->whereMonth('transaction_date', '02')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_mar = DB::table('expense_record')->whereMonth('transaction_date', '03')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_apr = DB::table('expense_record')->whereMonth('transaction_date', '04')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_may = DB::table('expense_record')->whereMonth('transaction_date', '05')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_jun = DB::table('expense_record')->whereMonth('transaction_date', '06')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_jul = DB::table('expense_record')->whereMonth('transaction_date', '07')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_aug = DB::table('expense_record')->whereMonth('transaction_date', '08')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_sep = DB::table('expense_record')->whereMonth('transaction_date', '09')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_oct = DB::table('expense_record')->whereMonth('transaction_date', '10')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_nov = DB::table('expense_record')->whereMonth('transaction_date', '11')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_decem = DB::table('expense_record')->whereMonth('transaction_date', '12')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
// $actual_au = 0;

//  $actual_janmar = $actual_jan + $actual_feb + $actual_mar;
//  $actual_aprjun =$actual_may +$actual_apr+ $actual_jun;
//  $actual_julsep = $actual_jul  +  $actual_aug +  $actual_sep;
//  $actual_octdec = $actual_oct + $actual_nov + $actual_decem;
 $var = 0 ;
?>








<!-- <script src="{{ asset('public/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script> -->
    <link href="{{ asset('public/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Financial Managemnet / Budget</h4>
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

                <div class="col-md-12 margin-top-10 padding-0">

                    <div style="padding: 30px 0px;">
                        <div class="modal_chart" id="bar-chartm" style="height: 300px;"></div>
                        <div class="text-center">
                            <h4><?= $name ?></h4>
                        </div>
                        <script type="text/javascript">
                              $(function () {
                                    "use strict";

                                    //BAR CHART
                                    var bar = new Morris.Bar({
                                      element: 'bar-chartm',
                                      resize: true,
                                      data: [
                                        {y: 'Jan-Mar', a: <?=$var ?>, b: <?php echo $actual_janmar = App\Http\Controllers\HomeController::getjanmaractualexp($name); ?>},
                                        {y: 'Apr-Jun', a: <?=$var ?>, b: <?php echo $actual_aprjun = App\Http\Controllers\HomeController::getaprjunactualexp($name); ?>},
                                        {y: 'Jul-Sep', a: <?=$var ?>, b: <?php echo $actual_julsep = App\Http\Controllers\HomeController::getjulsepactualexp($name); ?>},
                                        {y: 'Oct-Dec', a: <?=$var ?>, b: <?php echo $actual_octdec = App\Http\Controllers\HomeController::getoctdecactualexp($name); ?>}
                                      ],
                                      barColors: ['#00a65a', '#f56954'],
                                      xkey: 'y',
                                      ykeys: ['a', 'b'],
                                      labels: ['Budget','Actual'],
                                      hideHover: 'auto',
                                      xLabelMargin: 10,
                                      padding: 30,
                                    });
                                  });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


