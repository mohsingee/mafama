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
$actual_jan = DB::table('expense_record')->whereMonth('transaction_date', '01')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_feb = DB::table('expense_record')->whereMonth('transaction_date', '02')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_mar = DB::table('expense_record')->whereMonth('transaction_date', '03')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_apr = DB::table('expense_record')->whereMonth('transaction_date', '04')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_may = DB::table('expense_record')->whereMonth('transaction_date', '05')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_jun = DB::table('expense_record')->whereMonth('transaction_date', '06')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_jul = DB::table('expense_record')->whereMonth('transaction_date', '07')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_aug = DB::table('expense_record')->whereMonth('transaction_date', '08')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_sep = DB::table('expense_record')->whereMonth('transaction_date', '09')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_oct = DB::table('expense_record')->whereMonth('transaction_date', '10')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_nov = DB::table('expense_record')->whereMonth('transaction_date', '11')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_decem = DB::table('expense_record')->whereMonth('transaction_date', '12')->whereYear('transaction_date', $year)->where('account_description', $value)->where('uid', $uid)->sum('amount_paid');
$actual_au = 0;

$mon = array($actual_jan,$actual_feb,$actual_mar,$actual_apr,$actual_may,$actual_jun,$actual_jul,$actual_aug,$actual_sep,$actual_oct, $actual_nov, $actual_decem);

$sort_arr = arsort($mon);

$rev = array_sum($mon);

$total = max($mon);


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
                    <h4>Financial Management & Analysis</h4>
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
                        <!-- <div class="modal_chart" id="bar-chartm" style="height: 300px;"></div>
                        <div class="text-center">
                            <h4><?php echo $name;

                            ?></h4>
                        </div> -->
                        <div class="col-md-12 margin-top-10 padding-0">

                            <div style="display: flex">

                                <div class="container bg-white col-md-8 mx-auto">
                                    <div>
                                        <h3 style="text-align: center; margin-bottom:0px">
                                            {{$name}} : {{$rev}}
                                        </h3>
                                        <h4 style="text-align: center">
                                            For {{$year}}
                                        </h4>
                                    </div>
                                    <table>
                                        <style>
                                            td{
                                                padding: 1px 2px 7px 2px;
                                            }
                                        </style>
                                        @foreach ($mon as $ind => $gd)
                                        @php
                                        // dd($mon);
                                            $rgbColor = array();
                                            foreach(array('r', 'g', 'b') as $color){
                                                $rgbColor[$color] = mt_rand(0, 255);
                                            }
                                        @endphp
                                            <tr>
                                                <td style="text-align:left; color:#da291c">{{date('F', mktime(0, 0, 0, $ind+1, 10))}}</td>
                                                <td>
                                                    <div class="badge" style="background: #0000df">
                                                        <div style="padding-left:5px;padding-right:5px;">
                                                            {{$gd}}
                                                        </div>


                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="width: 400px; display:flex">
                                                        <div class="grp_{{$loop->index}}" style="border-radius:2px; width: {{$gd/$total * 100}}%; background: rgb(<?= implode(",", $rgbColor); ?>); height: 20px;color:white">
                                                        </div>
                                                        <div style="margin-left: 5px">
                                                            @if ($gd != 0)
                                                            {{round($gd/$rev * 100, 2)}}%

                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <script type="text/javascript">
                              $(function () {
                                    "use strict";

                                    //BAR CHART
                                    var bar = new Morris.Bar({
                                      element: 'bar-chartm',
                                      resize: true,
                                      data: [
                                        {y: 'Jan', a: <?= $actual_jan ?>, b: <?php echo $actual_jan = App\Http\Controllers\HomeController::getjanactualexp($name); ?>},
                                        {y: 'Feb', a: <?= $actual_feb ?>, b: <?php echo $actual_feb = App\Http\Controllers\HomeController::getfebactualexp($name); ?>},
                                        {y: 'Mar', a: <?= $actual_mar ?>, b: <?php echo $actual_mar = App\Http\Controllers\HomeController::getmaractualexp($name); ?>},
                                        {y: 'Apr', a: <?= $actual_apr ?>, b: <?php echo $actual_apr = App\Http\Controllers\HomeController::getapractualexp($name); ?>},
                                        {y: 'May', a: <?= $actual_may ?>, b: <?php echo $actual_may = App\Http\Controllers\HomeController::getmayactualexp($name); ?>},
                                        {y: 'Jun', a: <?= $actual_jun ?>, b: <?php echo $actual_jun = App\Http\Controllers\HomeController::getjunactualexp($name); ?>},
                                        {y: 'Jul', a: <?= $actual_jul ?>, b: <?php echo $actual_jul = App\Http\Controllers\HomeController::getjulactualexp($name); ?>},
                                        {y: 'Aug', a: <?= $actual_au ?>, b: <?php echo $actual_aug = App\Http\Controllers\HomeController::getaugactualexp($name); ?>},
                                        {y: 'Sep', a: <?= $actual_sep ?>, b: <?php echo $actual_sep = App\Http\Controllers\HomeController::getsepactualexp($name); ?>},
                                        {y: 'Oct', a: <?= $actual_oct ?>, b: <?php echo $actual_oct = App\Http\Controllers\HomeController::getoctactualexp($name); ?>},
                                        {y: 'Nov', a: <?= $actual_nov ?>, b: <?php echo $actual_nov = App\Http\Controllers\HomeController::getnovactualexp($name); ?>},
                                        {y: 'Dec', a: <?= $actual_decem ?>, b: <?php echo $actual_decem = App\Http\Controllers\HomeController::getdecemactualexp($name); ?>}
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
                        </script> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


