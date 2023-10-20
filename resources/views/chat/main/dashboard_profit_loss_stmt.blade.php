@extends('layouts.main') 
@section("content")
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>
<style type="text/css">
    text {
        display: none !important;
    }
    .table-scrollable {
        overflow-x: auto;
    }
    .morris-hover-point {
        display: none;
    }
    table a{
        color: #da291c;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-10 text-center">
                    <h4>Financial Management / Reports</h4>
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
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#weekly" data-toggle="tab">Weekly</a></li>
                            <li><a href="#monthly" data-toggle="tab">Monthly</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="weekly">
                            
                            <div class="">
                                        <div id="" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered table-hover main-table" id="">
                                                    <thead>
                                                        <?php if($weekcnt == 3){ ?>
                                                            <tr class="top-tr">
                                                                <th class="fixed-side"></th>
                                                                <th>1st Week</th>
                                                                <th>2nd Week</th>
                                                                <th>3rd Week</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        <?php }elseif ($weekcnt == 4) { ?>
                                                            <tr class="top-tr">
                                                                <th class="fixed-side"></th>
                                                                <th>1st Week</th>
                                                                <th>2nd Week</th>
                                                                <th>3rd Week</th>
                                                                <th>4th Week</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        <?php }elseif ($weekcnt == 5) { ?>
                                                            <tr class="top-tr">
                                                                <th class="fixed-side"></th>
                                                                <th>1st Week</th>
                                                                <th>2nd Week</th>
                                                                <th>3rd Week</th>
                                                                <th>4th Week</th>
                                                                <th>5th Week</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        <?php } ?>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php if($weekcnt == 3){ ?>
                                                                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php }elseif ($weekcnt == 4) { ?>
                                                                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php }elseif ($weekcnt == 5) { ?>
                                                                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php } ?>
                                                        </tr>
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Gross Revenue</td>
                                                            <?php if($weekcnt == 3){ ?>
                                                                    <td class="grossweek" id="gweek0"><?= $week1 ?></td>
                                                                    <td class="grossweek" id="gweek1"><?= $week2 ?></td>
                                                                    <td class="grossweek" id="gweek2"><?= $week3 ?></td>
                                                                    <td>{{ ($week1+$week2+$week3) }}</td>
                                                            <?php }elseif ($weekcnt == 4) { ?>
                                                                    <td class="grossweek" id="gweek0"><?= $week1 ?></td>
                                                                    <td class="grossweek" id="gweek1"><?= $week2 ?></td>
                                                                    <td class="grossweek" id="gweek2"><?= $week3 ?></td>
                                                                    <td class="grossweek" id="gweek3"><?= $week4 ?></td>
                                                                    <td>{{ ($week1+$week2+$week3+$week4) }}</td>
                                                            <?php }elseif ($weekcnt == 5) { ?>
                                                                    <td class="grossweek" id="gweek0"><?= $week1 ?></td>
                                                                    <td class="grossweek" id="gweek1"><?= $week2 ?></td>
                                                                    <td class="grossweek" id="gweek2"><?= $week3 ?></td>
                                                                    <td class="grossweek" id="gweek3"><?= $week4 ?></td>
                                                                    <td class="grossweek" id="gweek4"><?= $week5 ?></td>
                                                                    <td>{{ ($week1+$week2+$week3+$week4+$week5) }}</td>
                                                            <?php } ?>
                                                            
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Other Revenue</td>

                                                            <?php if($weekcnt == 3){ ?>
                                                                    <td class="otherrweek" id="oweek0"><?= $week1s ?></td>
                                                                    <td class="otherrweek" id="oweek1"><?= $week2s ?></td>
                                                                    <td class="otherrweek" id="oweek2"><?= $week3s ?></td>
                                                                    <td>{{ ($week1s+$week2s+$week3s) }}</td>
                                                            <?php }elseif ($weekcnt == 4) { ?>
                                                                    <td class="otherrweek" id="owee0"><?= $week1s ?></td>
                                                                    <td class="otherrweek" id="oweek1"><?= $week2s ?></td>
                                                                    <td class="otherrweek" id="oweek2"><?= $week3s ?></td>
                                                                    <td class="otherrweek" id="oweek3"><?= $week4s ?></td>
                                                                    <td>{{ ($week1s+$week2s+$week3s+$week4s) }}</td>
                                                            <?php }elseif ($weekcnt == 5) { ?>
                                                                    <td class="otherrweek" id="oweek0"><?= $week1s ?></td>
                                                                    <td class="otherrweek" id="oweek1"><?= $week2s ?></td>
                                                                    <td class="otherrweek" id="oweek2"><?= $week3s ?></td>
                                                                    <td class="otherrweek" id="oweek3"><?= $week4s ?></td>
                                                                    <td class="otherrweek" id="oweek4"><?= $week5s ?></td>
                                                                    <td>{{ ($week1s+$week2s+$week3s+$week4s+$week5s) }}</td>
                                                            <?php } ?>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="total-tr">
                                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                                            <?php if($weekcnt == 3){ ?>
                                                                    <td><?= $week1 + $week1s ?></td>
                                                                    <td><?= $week2 + $week2s ?></td>
                                                                    <td><?= $week3 + $week3s ?></td>
                                                                    <td>{{ ($week1+$week2+$week3+$week1s+$week2s+$week3s) }}</td>
                                                            <?php }elseif ($weekcnt == 4) { ?>
                                                                    <td><?= $week1 + $week1s ?></td>
                                                                    <td><?= $week2 + $week2s ?></td>
                                                                    <td><?= $week3 + $week3s ?></td>
                                                                    <td><?= $week4 + $week4s ?></td>
                                                                    <td>{{ ($week1+$week2+$week3+$week4+$week1s+$week2s+$week3s+$week4s) }}</td>
                                                            <?php }elseif ($weekcnt == 5) { ?>
                                                                    <td><?= $week1 + $week1s ?></td>
                                                                    <td><?= $week2 + $week2s ?></td>
                                                                    <td><?= $week3 + $week3s ?></td>
                                                                    <td><?= $week4 + $week4s ?></td>
                                                                    <td><?= $week5 + $week5s ?></td>
                                                                    <td>{{ ($week1+$week2+$week3+$week4+$week5+$week1s+$week2s+$week3s+$week4s+$week5s) }}</td>
                                                            <?php } ?>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->

                                                        <tr>
                                                            <?php if($weekcnt == 3){ ?>
                                                                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php }elseif ($weekcnt == 4) { ?>
                                                                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php }elseif ($weekcnt == 5) { ?>
                                                                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php } ?>
                                                        </tr>
                                                        <?php 
                                                        foreach($expensess as $value){
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td class="fixed-side"><?= $value->name ?></td>

                                                                <?php
                                                                echo $actual_week = App\Http\Controllers\MainController::getweekactualexp($value->name);
                                                                ?>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr class="total2-tr">
                                                            <td class="fixed-side" style=""><b>Total Expenses</b></td>
                                                            <?php
                                                                echo $actual_week_total = App\Http\Controllers\MainController::getweekactualexptotal();
                                                                ?>
                                                        </tr>
                                                    </tbody>

                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                                                            <?php
                                                                echo $actual_week_diff = App\Http\Controllers\MainController::getweekactualexpdiff();
                                                                ?>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="monthly">
                            <div class="">
                                        <div id="" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered table-hover main-table" id="">
                                                    <thead>
                                                        <tr class="top-tr">
                                                            <th class="fixed-side"></th>
                                                            <th>Month of {{ date('F') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Gross Revenue</td>
                                                            @if(date('m') == "01")
                                                            <?php if($jangrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="01revactual"><?= $jangrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $jangrossactual ?></td>
                                                            <?php } ?> 
                                                            @elseif(date('m') == "02")
                                                            <?php if($febgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="02revactual"><?= $febgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $febgrossactual ?></td>
                                                            <?php } ?> 
                                                            @elseif(date('m') == "03")
                                                            <?php if($margrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="03revactual"><?= $margrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $margrossactual ?></td>
                                                            <?php } ?> 
                                                            @elseif(date('m') == "04")
                                                            <?php if($aprgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="04revactual"><?= $aprgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprgrossactual ?></td>
                                                            <?php } ?> 
                                                            @elseif(date('m') == "05")
                                                            <?php if($maygrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="05revactual"><?= $maygrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $maygrossactual ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "06")
                                                            <?php if($jungrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="06revactual"><?= $jungrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $jungrossactual ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "07")
                                                            <?php if($julgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="07revactual"><?= $julgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julgrossactual ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "08")
                                                            <?php if($auggrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="08revactual"><?= $auggrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $auggrossactual ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "09")
                                                            <?php if($sepgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="09revactual"><?= $sepgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $sepgrossactual ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "10")
                                                            <?php if($octgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="10revactual"><?= $octgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octgrossactual ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "11")
                                                            <?php if($novgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="11revactual"><?= $novgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $novgrossactual ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "12")
                                                            <?php if($decgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="12revactual"><?= $decgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $decgrossactual ?></td>
                                                            <?php } ?>
                                                            @endif
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Other Revenue</td>
                                                            @if(date('m') == "01")
                                                            <?php if($janotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="01otheractual"><?= $janotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $janotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "02")
                                                            <?php if($febotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="02otheractual"><?= $febotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $febotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "03")
                                                            <?php if($marotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="03otheractual"><?= $marotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $marotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "04")
                                                            <?php if($aprotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="04otheractual"><?= $aprotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "05")
                                                            <?php if($mayotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="05otheractual"><?= $mayotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $mayotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "06")
                                                            <?php if($junotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="06otheractual"><?= $junotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $junotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "07")
                                                            <?php if($julotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="07otheractual"><?= $julotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "08")
                                                            <?php if($augotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="08otheractual"><?= $augotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $augotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "09")
                                                            <?php if($sepotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="09otheractual"><?= $sepotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $sepotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "10")
                                                            <?php if($octotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="10otheractual"><?= $octotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "11")

                                                            <?php if($novotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="11otheractual"><?= $novotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $novotherrevenue ?></td>
                                                            <?php } ?>
                                                            @elseif(date('m') == "12")
                                                            <?php if($decotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="12otheractual"><?= $decotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $decotherrevenue ?></td>
                                                            <?php } ?>
                                                            @endif
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="total-tr">
                                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                                            @if(date('m') == "01")
                                                            <td><?= $jantotalactual ?></td>
                                                            @elseif(date('m') == "02")
                                                            <td><?= $febtotalactual ?></td>
                                                            @elseif(date('m') == "03")
                                                            <td><?= $martotalactual ?></td>
                                                            @elseif(date('m') == "04")
                                                            <td><?= $aprtotalactual ?></td>
                                                            @elseif(date('m') == "05")
                                                            <td><?= $maytotalactual ?></td>
                                                            @elseif(date('m') == "06")
                                                            <td><?= $juntotalactual ?></td>
                                                            @elseif(date('m') == "07")
                                                            <td><?= $jultotalactual ?></td>
                                                            @elseif(date('m') == "08")
                                                            <td><?= $augtotalactual ?></td>
                                                            @elseif(date('m') == "09")
                                                            <td><?= $septotalactual ?></td>
                                                            @elseif(date('m') == "10")
                                                            <td><?= $octtotalactual ?></td>
                                                            @elseif(date('m') == "11")
                                                            <td><?= $novtotalactual ?></td>
                                                            @elseif(date('m') == "12")
                                                            <td><?= $dectotalactual ?></td>
                                                            @endif
                                                        </tr>
                                                        <!-- .nk-tb-item  -->

                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php 
                                                        foreach($expense as $value){
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td class="fixed-side"><?= $value->name ?></td>
                                                                @if(date('m') == "01")
                                                                <?php
                                                                $actual_jan = App\Http\Controllers\HomeController::getjanactualexp($value->name);
                                                                if($actual_jan!= 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="01actualexpense<?= $value->name ?>"><?= $actual_jan ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_jan ?></td>
                                                                <?php } ?>

                                                                @elseif(date('m') == "02")

                                                                <?php
                                                                $actual_feb = App\Http\Controllers\HomeController::getfebactualexp($value->name);
                                                                if($actual_feb != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="02actualexpense<?= $value->name ?>"><?= $actual_feb ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_feb ?></td>
                                                                <?php } ?>
                                                                
                                                                @elseif(date('m') == "03")

                                                                <?php
                                                                $actual_mar = App\Http\Controllers\HomeController::getmaractualexp($value->name);
                                                                if($actual_mar != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="03actualexpense<?= $value->name ?>"><?= $actual_mar ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_mar ?></td>
                                                                <?php } ?>

                                                                @elseif(date('m') == "04")

                                                                <?php
                                                                $actual_apr = App\Http\Controllers\HomeController::getapractualexp($value->name);
                                                                if($actual_apr != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="04actualexpense<?= $value->name ?>"><?= $actual_apr ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_apr ?></td>
                                                                <?php } ?>

                                                                @elseif(date('m') == "05")
                                                                

                                                                <?php
                                                                $actual_may = App\Http\Controllers\HomeController::getmayactualexp($value->name);
                                                                if($actual_may != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="05actualexpense<?= $value->name ?>"><?= $actual_may ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_may ?></td>
                                                                <?php } ?>

                                                                @elseif(date('m') == "06")
                                                                

                                                                <?php
                                                                $actual_jun = App\Http\Controllers\HomeController::getjunactualexp($value->name);
                                                                if($actual_jun != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="06actualexpense<?= $value->name ?>"><?= $actual_jun ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_jun ?></td>
                                                                <?php } ?>

                                                                @elseif(date('m') == "07")
                                                                
                                                                <?php
                                                                $actual_jul = App\Http\Controllers\HomeController::getjulactualexp($value->name);
                                                                if($actual_jul != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="07actualexpense<?= $value->name ?>"><?= $actual_jul ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_jul ?></td>
                                                                <?php } ?>

                                                                @elseif(date('m') == "08")
                                                                

                                                                <?php
                                                                $actual_aug = App\Http\Controllers\HomeController::getaugactualexp($value->name);
                                                                if($actual_aug != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="08actualexpense<?= $value->name ?>"><?= $actual_aug ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_aug ?></td>
                                                                <?php } ?>


                                                                @elseif(date('m') == "09")

                                                                <?php
                                                                $actual_sep = App\Http\Controllers\HomeController::getsepactualexp($value->name);
                                                                if($actual_sep != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="09actualexpense<?= $value->name ?>"><?= $actual_sep ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_sep ?></td>
                                                                <?php } ?>

                                                                @elseif(date('m') == "10")
                                                                
                                                                <?php
                                                                $actual_oct = App\Http\Controllers\HomeController::getoctactualexp($value->name);
                                                                if($actual_oct != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="10actualexpense<?= $value->name ?>"><?= $actual_oct ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_oct ?></td>
                                                                <?php } ?>

                                                                @elseif(date('m') == "11")
                                                                

                                                                <?php
                                                                $actual_nov = App\Http\Controllers\HomeController::getnovactualexp($value->name);
                                                                if($actual_nov != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="11actualexpense<?= $value->name ?>"><?= $actual_nov ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_nov ?></td>
                                                                <?php } ?>


                                                                @elseif(date('m') == "12")

                                                                <?php
                                                                $actual_decem = App\Http\Controllers\HomeController::getdecemactualexp($value->name);
                                                                if($actual_decem != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="12actualexpense<?= $value->name ?>"><?= $actual_decem ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_decem ?></td>
                                                                <?php } ?>

                                                                @endif
                                                            </tr>
                                                        <?php } ?>
                                                        <tr class="total2-tr">
                                                            <td class="fixed-side" style=""><b>Total Expenses</b></td>
                                                            @if(date('m') == "01")
                                                            <td><?= $jantotal2actual ?></td>
                                                            @elseif(date('m') == "02")
                                                            <td><?= $febtotal2actual ?></td>
                                                            @elseif(date('m') == "03")
                                                            <td><?= $martotal2actual ?></td>
                                                            @elseif(date('m') == "04")
                                                            <td><?= $aprtotal2actual ?></td>
                                                            @elseif(date('m') == "05")
                                                            <td><?= $maytotal2actual ?></td>
                                                            @elseif(date('m') == "06")
                                                            <td><?= $juntotal2actual ?></td>
                                                            @elseif(date('m') == "07")
                                                            <td><?= $jultotal2actual ?></td>
                                                            @elseif(date('m') == "08")
                                                            <td><?= $augtotal2actual ?></td>
                                                            @elseif(date('m') == "09")
                                                            <td><?= $septotal2actual ?></td>
                                                            @elseif(date('m') == "10")
                                                            <td><?= $octtotal2actual ?></td>
                                                            @elseif(date('m') == "11")
                                                            <td><?= $novtotal2actual ?></td>
                                                            @elseif(date('m') == "12")
                                                            <td><?= $dectotal2actual ?></td>
                                                            @endif
                                                        </tr>
                                                    </tbody>

                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                                                            @if(date('m') == "01")
                                                            <td><?= ($jantotalactual-$jantotal2actual) ?></td>
                                                            @elseif(date('m') == "02")
                                                            <td><?= ($febtotalactual-$febtotal2actual) ?></td>
                                                            @elseif(date('m') == "03")
                                                            <td><?= ($martotalactual-$martotal2actual) ?></td>
                                                            @elseif(date('m') == "04")
                                                            <td><?= ($aprtotalactual-$aprtotal2actual) ?></td>
                                                            @elseif(date('m') == "05")
                                                            <td><?= ($maytotalactual-$maytotal2actual) ?></td>
                                                            @elseif(date('m') == "06")
                                                            <td><?= ($juntotalactual-$juntotal2actual) ?></td>
                                                            @elseif(date('m') == "07")
                                                            <td><?= ($jultotalactual-$jultotal2actual) ?></td>
                                                            @elseif(date('m') == "08")
                                                            <td><?= ($augtotalactual-$augtotal2actual) ?></td>
                                                            @elseif(date('m') == "09")
                                                            <td><?= ($septotalactual-$septotal2actual) ?></td>
                                                            @elseif(date('m') == "10")
                                                            <td><?= ($octtotalactual-$octtotal2actual) ?></td>
                                                            @elseif(date('m') == "11")
                                                            <td><?= ($novtotalactual-$novtotal2actual) ?></td>
                                                            @elseif(date('m') == "12")
                                                            <td><?= ($dectotalactual-$dectotal2actual) ?></td>
                                                            @endif
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;margin-bottom: 10px;">
                            <h4>Weekly Report</h4>
                            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <?php if($weekcnt == 4){ ?>
                                        <tr>
                                            <th>1st Week</th>
                                            <th>2nd Week</th>
                                            <th>3rd Week</th>
                                        </tr>
                                    <?php }elseif ($weekcnt == 5) { ?>
                                        <tr>
                                            <th>1st Week</th>
                                            <th>2nd Week</th>
                                            <th>3rd Week</th>
                                            <th>4th Week</th>
                                        </tr>
                                    <?php }elseif ($weekcnt == 6) { ?>
                                        <tr>
                                            <th>1st Week</th>
                                            <th>2nd Week</th>
                                            <th>3rd Week</th>
                                            <th>4th Week</th>
                                            <th>5th Week</th>
                                        </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php if($weekcnt == 4){ ?>
                                        <tr>
                                            <td><?= $week1 ?></td>
                                            <td><?= $week2 ?></td>
                                            <td><?= $week3 ?></td>
                                        </tr>
                                    <?php }elseif ($weekcnt == 5) { ?>
                                        <tr>
                                            <td><?= $week1 ?></td>
                                            <td><?= $week2 ?></td>
                                            <td><?= $week3 ?></td>
                                            <td><?= $week4 ?></td>
                                        </tr>
                                    <?php }elseif ($weekcnt == 6) { ?>
                                        <tr>
                                            <td><?= $week1 ?></td>
                                            <td><?= $week2 ?></td>
                                            <td><?= $week3 ?></td>
                                            <td><?= $week4 ?></td>
                                            <td><?= $week5 ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;margin-bottom: 10px;">
                            <h4>Monthly Report</h4>
                            <table class="table table-striped table-bordered table-hover report-table" id="report-table">
                                    <thead>
                                        <tr>
                                            <th></th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="total-tr">
                                            <td><b>Total Revenue</b></td>
                                            <td id="jantotal"><?= $jantotal ?></td>
                                            <td id="febtotal"><?= $febtotal ?></td>
                                            <td id="martotal"><?= $martotal ?></td>
                                            <td id="aprtotal"><?= $aprtotal ?></td>
                                            <td id="maytotal"><?= $maytotal ?></td>
                                            <td id="juntotal"><?= $juntotal ?></td>
                                            <td id="jultotal"><?= $jultotal ?></td>
                                            <td id="augtotal"><?= $augtotal ?></td>
                                            <td id="septotal"><?= $septotal ?></td>
                                            <td id="octtotal"><?= $octtotal ?></td>
                                            <td id="novtotal"><?= $novtotal ?></td>
                                            <td id="dectotal"><?= $dectotal ?></td>
                                            <td class="total-td"><?= $monthtotal ?></td>
                                            
                                                
                                        </tr>
                                        
                                        <tr class="total-tr">
                                            <td><b>Total Expenses</b></td>
                                            <td id="jantotall"><?= $jantotall ?></td>
                                            <td id="febtotall"><?= $febtotall ?></td>
                                            <td id="martotall"><?= $martotall ?></td>
                                            <td id="aprtotall"><?= $aprtotall ?></td>
                                            <td id="maytotall"><?= $maytotall ?></td>
                                            <td id="juntotall"><?= $juntotall ?></td>
                                            <td id="jultotall"><?= $jultotall ?></td>
                                            <td id="augtotall"><?= $augtotall ?></td>
                                            <td id="septotall"><?= $septotall ?></td>
                                            <td id="octtotall"><?= $octtotall ?></td>
                                            <td id="novtotall"><?= $novtotall ?></td>
                                            <td id="dectotall"><?= $dectotall ?></td>
                                            <td class="total-td"><?= $monthtotall ?></td>
                                            
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><b>Estimated Profit / Loss</b></td>
                                            <td><?= $jantotal - $jantotall ?></td>
                                            <td><?= $febtotal - $febtotall ?></td>
                                            <td><?= $martotal - $martotall ?></td>
                                            <td><?= $aprtotal - $aprtotall ?></td>
                                            <td><?= $maytotal - $maytotall ?></td>
                                            <td><?= $juntotal - $juntotall ?></td>
                                            <td><?= $jultotal - $jultotall ?></td>
                                            <td><?= $augtotal - $augtotall ?></td>
                                            <td><?= $septotal - $septotall ?></td>
                                            <td><?= $octtotal - $octtotall ?></td>
                                            <td><?= $novtotal - $novtotall ?></td>
                                            <td><?= $dectotal - $dectotall ?></td>
                                            <td><?= $monthtotal - $monthtotall ?></td>
                                        </tr>
                                        
                                    </tfoot>
                                </table>
                        </div>
                        <div style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px; margin-bottom: 10px">
                            <h4>Quarterly Report</h4>
                            <table class="table table-striped table-bordered table-hover report-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Jan - Mar</th>
                                            <th>Apr - Jun</th>
                                            <th>Jul - Sep</th>
                                            <th>Oct - Dec</th>
                                            <th>Total</th>
                                            <th>Graph</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="total-tr">
                                            <td><b>Total Revenue</b></td>
                                            <td id="janmartotal"><?= $janmartotal ?></td>
                                            <td id="aprjuntotal"><?= $aprjuntotal ?></td>
                                            <td id="julseptotal"><?= $julseptotal ?></td>
                                            <td id="octdectotal"><?= $octdectotal ?></td>
                                            <td class="total-td"><?= $quaterlytotal ?></td>
                                        </tr>
                                        <tr class="total-tr">
                                            <td><b>Total Expenses</b></td>
                                            <td id="janmartotall"><?= $janmartotall ?></td>
                                            <td id="aprjuntotall"><?= $aprjuntotall ?></td>
                                            <td id="julseptotall"><?= $julseptotall ?></td>
                                            <td id="octdectotall"><?= $octdectotall ?></td>
                                            <td class="total-td"><?= $quaterlytotall ?></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><b>Estimated Profit / Loss</b></td>
                                            <td><?= $janmartotal - $janmartotall ?></td>
                                            <td><?= $aprjuntotal - $aprjuntotall ?></td>
                                            <td><?= $julseptotal - $julseptotall ?></td>
                                            <td><?= $octdectotal - $octdectotall ?></td>
                                            <td><?= $quaterlytotal - $quaterlytotall ?></td>
                                        </tr>
                                        
                                    </tfoot>
                                </table>
                        </div>
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#tab1" data-toggle="tab">Monthly</a></li>
                            <li><a href="#tab2" data-toggle="tab">Quarterly</a></li>
                        </ul>

                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="tab1">
                                <table class="table table-striped table-bordered table-hover report-table" id="report-table">
                                    <thead>
                                        <tr>
                                            <th></th>
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
                                        <tr>
                                            <td colspan="15" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Gross Revenue</b></td>
                                            <td id="alljantotal"><?= $alljantotal ?></td>
                                            <td id="allfebtotal"><?= $allfebtotal ?></td>
                                            <td id="allmartotal"><?= $allmartotal ?></td>
                                            <td id="allaprtotal"><?= $allaprtotal ?></td>
                                            <td id="allmaytotal"><?= $allmaytotal ?></td>
                                            <td id="alljuntotal"><?= $alljuntotal ?></td>
                                            <td id="alljultotal"><?= $alljultotal ?></td>
                                            <td id="allaugtotal"><?= $allaugtotal ?></td>
                                            <td id="allseptotal"><?= $allseptotal ?></td>
                                            <td id="allocttotal"><?= $allocttotal ?></td>
                                            <td id="allnovtotal"><?= $allnovtotal ?></td>
                                            <td id="alldectotal"><?= $alldectotal ?></td>
                                            <td class="total-td"><?= $allmonthtotal ?></td>
                                            
                                            <td class="chart_monthly">
                                                <a href="{{ url('all_monthly_budget_chart') }}"><div id="allbar-chart_total" style="height: 20px;  width: 70px; margin: 0 auto"></div></a>
                                                <script type="text/javascript">
                                                  $(function () {
                                                        "use strict";

                                                        
                                                        var bar = new Morris.Bar({
                                                          element: 'allbar-chart_total',
                                                          resize: true,
                                                          data: [
                                                            {y: '', a: <?= $alljantotal ?>},
                                                            {y: '', a: <?= $allfebtotal ?>},
                                                            {y: '', a: <?= $allmartotal ?>},
                                                            {y: '', a: <?= $allaprtotal ?>},
                                                            {y: '', a: <?= $allmaytotal ?>},
                                                            {y: '', a: <?= $alljuntotal ?>},
                                                            {y: '', a: <?= $alljultotal ?>},
                                                            {y: '', a: <?= $allaugtotal ?>},
                                                            {y: '', a: <?= $allseptotal ?>},
                                                            {y: '', a: <?= $allocttotal ?>},
                                                            {y: '', a: <?= $allnovtotal ?>},
                                                            {y: '', a: <?= $alldectotal ?>}
                                                          ],
                                                          barColors: ['#da291c'],
                                                          xkey: 'y',
                                                          ykeys: ['a'],
                                                          labels: ['', ''],
                                                          hideHover: 'auto',
                                                          padding: 1,
                                                        });
                                                      });
                                                </script>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><b>Other Revenue</b></td>
                                            <td id="otherjantotal"><?= $otherjantotal ?></td>
                                            <td id="otherfebtotal"><?= $otherfebtotal ?></td>
                                            <td id="othermartotal"><?= $othermartotal ?></td>
                                            <td id="otheraprtotal"><?= $otheraprtotal ?></td>
                                            <td id="othermaytotal"><?= $othermaytotal ?></td>
                                            <td id="otherjuntotal"><?= $otherjuntotal ?></td>
                                            <td id="otherjultotal"><?= $otherjultotal ?></td>
                                            <td id="otheraugtotal"><?= $otheraugtotal ?></td>
                                            <td id="otherseptotal"><?= $otherseptotal ?></td>
                                            <td id="otherocttotal"><?= $otherocttotal ?></td>
                                            <td id="othernovtotal"><?= $othernovtotal ?></td>
                                            <td id="otherdectotal"><?= $otherdectotal ?></td>
                                            <td class="total-td"><?= $othermonthtotal ?></td>
                                            
                                            <td class="chart_monthly">
                                                <a href="{{ url('other_monthly_budget_chart') }}"><div id="otherbar-chart_total" style="height: 20px;  width: 70px; margin: 0 auto"></div></a>
                                                <script type="text/javascript">
                                                  $(function () {
                                                        "use strict";

                                                        
                                                        var bar = new Morris.Bar({
                                                          element: 'otherbar-chart_total',
                                                          resize: true,
                                                          data: [
                                                            {y: '', a: <?= $otherjantotal ?>},
                                                            {y: '', a: <?= $otherfebtotal ?>},
                                                            {y: '', a: <?= $othermartotal ?>},
                                                            {y: '', a: <?= $otheraprtotal ?>},
                                                            {y: '', a: <?= $othermaytotal ?>},
                                                            {y: '', a: <?= $otherjuntotal ?>},
                                                            {y: '', a: <?= $otherjultotal ?>},
                                                            {y: '', a: <?= $otheraugtotal ?>},
                                                            {y: '', a: <?= $otherseptotal ?>},
                                                            {y: '', a: <?= $otherocttotal ?>},
                                                            {y: '', a: <?= $othernovtotal ?>},
                                                            {y: '', a: <?= $otherdectotal ?>}
                                                          ],
                                                          barColors: ['#da291c'],
                                                          xkey: 'y',
                                                          ykeys: ['a'],
                                                          labels: ['', ''],
                                                          hideHover: 'auto',
                                                          padding: 1,
                                                        });
                                                      });
                                                </script>
                                            </td>

                                        </tr>
                                        <tr class="total-tr">
                                            <td><b>Total Revenue</b></td>
                                            <td id="jantotal"><?= $jantotal ?></td>
                                            <td id="febtotal"><?= $febtotal ?></td>
                                            <td id="martotal"><?= $martotal ?></td>
                                            <td id="aprtotal"><?= $aprtotal ?></td>
                                            <td id="maytotal"><?= $maytotal ?></td>
                                            <td id="juntotal"><?= $juntotal ?></td>
                                            <td id="jultotal"><?= $jultotal ?></td>
                                            <td id="augtotal"><?= $augtotal ?></td>
                                            <td id="septotal"><?= $septotal ?></td>
                                            <td id="octtotal"><?= $octtotal ?></td>
                                            <td id="novtotal"><?= $novtotal ?></td>
                                            <td id="dectotal"><?= $dectotal ?></td>
                                            <td class="total-td"><?= $monthtotal ?></td>
                                            
                                            <td class="chart_monthly">
                                                <a href="{{ url('total_monthly_budget_chart') }}"><div id="bar-chart_total" style="height: 20px;  width: 70px; margin: 0 auto"></div></a>
                                                <script type="text/javascript">
                                                  $(function () {
                                                        "use strict";

                                                        
                                                        var bar = new Morris.Bar({
                                                          element: 'bar-chart_total',
                                                          resize: true,
                                                          data: [
                                                            {y: '', a: <?= $jantotal ?>},
                                                            {y: '', a: <?= $febtotal ?>},
                                                            {y: '', a: <?= $martotal ?>},
                                                            {y: '', a: <?= $aprtotal ?>},
                                                            {y: '', a: <?= $maytotal ?>},
                                                            {y: '', a: <?= $juntotal ?>},
                                                            {y: '', a: <?= $jultotal ?>},
                                                            {y: '', a: <?= $augtotal ?>},
                                                            {y: '', a: <?= $septotal ?>},
                                                            {y: '', a: <?= $octtotal ?>},
                                                            {y: '', a: <?= $novtotal ?>},
                                                            {y: '', a: <?= $dectotal ?>}
                                                          ],
                                                          barColors: ['#da291c'],
                                                          xkey: 'y',
                                                          ykeys: ['a'],
                                                          labels: ['', ''],
                                                          hideHover: 'auto',
                                                          padding: 1,
                                                        });
                                                      });
                                                </script>
                                            </td>
                                                
                                        </tr>
                                        <tr>
                                            <td colspan="15" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                        </tr>

                                        <?php
                                            foreach ($expenses as $value) {
                                        ?>
                                                <tr>
                                                    <td><b><?= $value->name ?></b></td>
                                                    <td><?= $value->jan ?></td>
                                                    <td><?= $value->feb ?></td>
                                                    <td><?= $value->mar ?></td>
                                                    <td><?= $value->apr ?></td>
                                                    <td><?= $value->may ?></td>
                                                    <td><?= $value->jun ?></td>
                                                    <td><?= $value->jul ?></td>
                                                    <td><?= $value->aug ?></td>
                                                    <td><?= $value->sep ?></td>
                                                    <td><?= $value->oct ?></td>
                                                    <td><?= $value->nov ?></td>
                                                    <td><?= $value->decem ?></td>
                                                    <td class="total-td">
                                                        <?= ($value->jan + $value->feb + $value->mar + $value->apr + $value->may + $value->jun + $value->jul + $value->aug + $value->sep + $value->oct + $value->nov + $value->decem) ?>
                                                    </td>
                                                    <td class="showgraphh" id="showgraphh<?= $value->id ?>">
                                                        <a href="{{ url('monthly_expense_chart') }}/<?= $value->id ?>"><div id="bar-charth<?= $value->id ?>" style="height: 20px; width: 70px; margin: 0 auto"></div></a>
                                                        <script type="text/javascript">
                                                              $(function () {
                                                                    "use strict";

                                                                    
                                                                    var bar = new Morris.Bar({
                                                                      element: 'bar-charth<?= $value->id ?>',
                                                                      resize: true,
                                                                      data: [
                                                                        {y: '', a: <?= $value->jan ?>},
                                                                        {y: '', a: <?= $value->feb ?>},
                                                                        {y: '', a: <?= $value->mar ?>},
                                                                        {y: '', a: <?= $value->apr ?>},
                                                                        {y: '', a: <?= $value->may ?>},
                                                                        {y: '', a: <?= $value->jun ?>},
                                                                        {y: '', a: <?= $value->jul ?>},
                                                                        {y: '', a: <?= $value->aug ?>},
                                                                        {y: '', a: <?= $value->sep ?>},
                                                                        {y: '', a: <?= $value->oct ?>},
                                                                        {y: '', a: <?= $value->nov ?>},
                                                                        {y: '', a: <?= $value->decem ?>}
                                                                      ],
                                                                      barColors: ['#da291c'],
                                                                      xkey: 'y',
                                                                      ykeys: ['a'],
                                                                      labels: ['', ''],
                                                                      hideHover: 'auto',
                                                                      padding: 1,
                                                                    });
                                                                  });
                                                        </script>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                        <tr class="total-tr">
                                            <td><b>Total Expenses</b></td>
                                            <td id="jantotall"><?= $jantotall ?></td>
                                            <td id="febtotall"><?= $febtotall ?></td>
                                            <td id="martotall"><?= $martotall ?></td>
                                            <td id="aprtotall"><?= $aprtotall ?></td>
                                            <td id="maytotall"><?= $maytotall ?></td>
                                            <td id="juntotall"><?= $juntotall ?></td>
                                            <td id="jultotall"><?= $jultotall ?></td>
                                            <td id="augtotall"><?= $augtotall ?></td>
                                            <td id="septotall"><?= $septotall ?></td>
                                            <td id="octtotall"><?= $octtotall ?></td>
                                            <td id="novtotall"><?= $novtotall ?></td>
                                            <td id="dectotall"><?= $dectotall ?></td>
                                            <td class="total-td"><?= $monthtotall ?></td>
                                            
                                            <td class="chart_monthly">
                                                <a href="{{ url('total_monthly_expense_chart') }}"><div id="bar-chart_totall" style="height: 20px;  width: 70px; margin: 0 auto"></div></a>
                                                        <script type="text/javascript">
                                                          $(function () {
                                                                "use strict";

                                                                
                                                                var bar = new Morris.Bar({
                                                                  element: 'bar-chart_totall',
                                                                  resize: true,
                                                                  data: [
                                                                    {y: '', a: <?= $jantotall ?>},
                                                                    {y: '', a: <?= $febtotall ?>},
                                                                    {y: '', a: <?= $martotall ?>},
                                                                    {y: '', a: <?= $aprtotall ?>},
                                                                    {y: '', a: <?= $maytotall ?>},
                                                                    {y: '', a: <?= $juntotall ?>},
                                                                    {y: '', a: <?= $jultotall ?>},
                                                                    {y: '', a: <?= $augtotall ?>},
                                                                    {y: '', a: <?= $septotall ?>},
                                                                    {y: '', a: <?= $octtotall ?>},
                                                                    {y: '', a: <?= $novtotall ?>},
                                                                    {y: '', a: <?= $dectotall ?>}
                                                                  ],
                                                                  barColors: ['#da291c'],
                                                                  xkey: 'y',
                                                                  ykeys: ['a'],
                                                                  labels: ['', ''],
                                                                  hideHover: 'auto',
                                                                  padding: 1,
                                                                });
                                                              });
                                                        </script>
                                            </td>
                                                
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><b>Estimated Profit / Loss</b></td>
                                            <td><?= $jantotal - $jantotall ?></td>
                                            <td><?= $febtotal - $febtotall ?></td>
                                            <td><?= $martotal - $martotall ?></td>
                                            <td><?= $aprtotal - $aprtotall ?></td>
                                            <td><?= $maytotal - $maytotall ?></td>
                                            <td><?= $juntotal - $juntotall ?></td>
                                            <td><?= $jultotal - $jultotall ?></td>
                                            <td><?= $augtotal - $augtotall ?></td>
                                            <td><?= $septotal - $septotall ?></td>
                                            <td><?= $octtotal - $octtotall ?></td>
                                            <td><?= $novtotal - $novtotall ?></td>
                                            <td><?= $dectotal - $dectotall ?></td>
                                            <td><?= $monthtotal - $monthtotall ?></td>
                                            <td class="chart_monthlyy">
                                                <a href="{{ url('monthly_profit_loss_chart') }}"><div id="bar-chart_totally" style="height: 30px;  width: 70px; margin: 0 auto"></div></a>
                                                <script type="text/javascript">
                                                  $(function () {
                                                        "use strict";

                                                        
                                                        var bar = new Morris.Bar({
                                                          element: 'bar-chart_totally',
                                                          resize: true,
                                                          data: [
                                                            {y: '', a: <?= $jantotal - $jantotall ?>},
                                                            {y: '', a: <?= $febtotal - $febtotall ?>},
                                                            {y: '', a: <?= $martotal - $martotall ?>},
                                                            {y: '', a: <?= $aprtotal - $aprtotall ?>},
                                                            {y: '', a: <?= $maytotal - $maytotall ?>},
                                                            {y: '', a: <?= $juntotal - $juntotall ?>},
                                                            {y: '', a: <?= $jultotal - $jultotall ?>},
                                                            {y: '', a: <?= $augtotal - $augtotall ?>},
                                                            {y: '', a: <?= $septotal - $septotall ?>},
                                                            {y: '', a: <?= $octtotal - $octtotall ?>},
                                                            {y: '', a: <?= $novtotal - $novtotall ?>},
                                                            {y: '', a: <?= $dectotal - $dectotall ?>}
                                                          ],
                                                          barColors: ['#da291c'],
                                                          xkey: 'y',
                                                          ykeys: ['a'],
                                                          labels: ['', ''],
                                                          hideHover: 'auto',
                                                          padding: 1,
                                                        });
                                                      });
                                                </script>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="tab2">
                                <table class="table table-striped table-bordered table-hover report-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Jan - Mar</th>
                                            <th>Apr - Jun</th>
                                            <th>Jul - Sep</th>
                                            <th>Oct - Dec</th>
                                            <th>Total</th>
                                            <th>Graph</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="15" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Gross Revenue</b></td>
                                            <td id="alljanmartotal"><?= $alljanmartotal ?></td>
                                            <td id="allaprjuntotal"><?= $allaprjuntotal ?></td>
                                            <td id="alljulseptotal"><?= $alljulseptotal ?></td>
                                            <td id="alloctdectotal"><?= $alloctdectotal ?></td>
                                            <td class="total-td"><?= $allquaterlytotal ?></td>
                                            
                                            <td class="chart_quarterly">
                                                <a href="{{ url('all_quarterly_budget_chart') }}"><div id="allbar-chart_quarterlyy" style="height: 20px;  width: 30px; margin: 0 auto"></div></a>
                                                        <script type="text/javascript">
                                                          $(function () {
                                                                "use strict";
                                                                var bar = new Morris.Bar({
                                                                  element: 'allbar-chart_quarterlyy',
                                                                  resize: true,
                                                                  data: [
                                                                    {y: '', a: <?= $alljanmartotal ?>},
                                                                    {y: '', a: <?= $allaprjuntotal ?>},
                                                                    {y: '', a: <?= $alljulseptotal ?>},
                                                                    {y: '', a: <?= $alloctdectotal ?>}
                                                                  ],
                                                                  barColors: ['#da291c'],
                                                                  xkey: 'y',
                                                                  ykeys: ['a'],
                                                                  labels: ['', ''],
                                                                  hideHover: 'auto',
                                                                  padding: 1,
                                                                });
                                                              });
                                                        </script>
                                            </td>
                                                
                                        </tr>
                                        <tr>
                                            <td><b>Other Revenue</b></td>
                                            <td id="otherjanmartotal"><?= $otherjanmartotal ?></td>
                                            <td id="otheraprjuntotal"><?= $otheraprjuntotal ?></td>
                                            <td id="otherjulseptotal"><?= $otherjulseptotal ?></td>
                                            <td id="otheroctdectotal"><?= $otheroctdectotal ?></td>
                                            <td class="total-td"><?= $otherquaterlytotal ?></td>
                                            
                                            <td class="chart_quarterly">
                                                <a href="{{ url('other_quarterly_budget_chart') }}"><div id="otherbar-chart_quarterlyy" style="height: 20px;  width: 30px; margin: 0 auto"></div></a>
                                                        <script type="text/javascript">
                                                          $(function () {
                                                                "use strict";

                                                                
                                                                var bar = new Morris.Bar({
                                                                  element: 'otherbar-chart_quarterlyy',
                                                                  resize: true,
                                                                  data: [
                                                                    {y: '', a: <?= $otherjanmartotal ?>},
                                                                    {y: '', a: <?= $otheraprjuntotal ?>},
                                                                    {y: '', a: <?= $otherjulseptotal ?>},
                                                                    {y: '', a: <?= $otheroctdectotal ?>}
                                                                  ],
                                                                  barColors: ['#da291c'],
                                                                  xkey: 'y',
                                                                  ykeys: ['a'],
                                                                  labels: ['', ''],
                                                                  hideHover: 'auto',
                                                                  padding: 1,
                                                                });
                                                              });
                                                        </script>
                                            </td>
                                                
                                        </tr>
                                        <tr class="total-tr">
                                            <td><b>Total Revenue</b></td>
                                            <td id="janmartotal"><?= $janmartotal ?></td>
                                            <td id="aprjuntotal"><?= $aprjuntotal ?></td>
                                            <td id="julseptotal"><?= $julseptotal ?></td>
                                            <td id="octdectotal"><?= $octdectotal ?></td>
                                            <td class="total-td"><?= $quaterlytotal ?></td>
                                            
                                            <td class="chart_quarterly">
                                                <a href="{{ url('total_quarterly_budget_chart') }}"><div id="bar-chart_quarterlyy" style="height: 20px;  width: 30px; margin: 0 auto"></div></a>
                                                        <script type="text/javascript">
                                                          $(function () {
                                                                "use strict";

                                                                
                                                                var bar = new Morris.Bar({
                                                                  element: 'bar-chart_quarterlyy',
                                                                  resize: true,
                                                                  data: [
                                                                    {y: '', a: <?= $janmartotal ?>},
                                                                    {y: '', a: <?= $aprjuntotal ?>},
                                                                    {y: '', a: <?= $julseptotal ?>},
                                                                    {y: '', a: <?= $octdectotal ?>}
                                                                  ],
                                                                  barColors: ['#da291c'],
                                                                  xkey: 'y',
                                                                  ykeys: ['a'],
                                                                  labels: ['', ''],
                                                                  hideHover: 'auto',
                                                                  padding: 1,
                                                                });
                                                              });
                                                        </script>
                                            </td>
                                                
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="15" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                        </tr>
                                        <?php
                                            foreach ($expenses_quaterly as $value) {
                                        ?>
                                                <tr>
                                                    <td><b><?= $value->name ?></b></td>
                                                    <td><?= $value->janmar ?></td>
                                                    <td><?= $value->aprjun ?></td>
                                                    <td><?= $value->julsep ?></td>
                                                    <td><?= $value->octdec ?></td>
                                                    <td class="total-td">
                                                        <?= ($value->janmar + $value->aprjun + $value->julsep + $value->octdec) ?>
                                                    </td>
                                                    <td class="showgraphqqq" id="showgraphqqq<?= $value->id ?>">
                                                        <a href="{{ url('quarterly_expense_chart') }}/<?= $value->id ?>"><div id="bar-chartqqq<?= $value->id ?>" style="height: 20px; width: 30px; margin: 0 auto"></div></a>
                                                        <script type="text/javascript">
                                                                  $(function () {
                                                                        "use strict";

                                                                        
                                                                        var bar = new Morris.Bar({
                                                                          element: 'bar-chartqqq<?= $value->id ?>',
                                                                          resize: true,
                                                                          data: [
                                                                            {y: '', a: <?= $value->janmar ?>},
                                                                            {y: '', a: <?= $value->aprjun ?>},
                                                                            {y: '', a: <?= $value->julsep ?>},
                                                                            {y: '', a: <?= $value->octdec ?>}
                                                                          ],
                                                                          barColors: ['#da291c'],
                                                                          xkey: 'y',
                                                                          ykeys: ['a'],
                                                                          labels: ['', ''],
                                                                          hideHover: 'auto',
                                                                          padding: 1,
                                                                        });
                                                                      });
                                                        </script>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                        <tr class="total-tr">
                                            <td><b>Total Expenses</b></td>
                                            <td id="janmartotall"><?= $janmartotall ?></td>
                                            <td id="aprjuntotall"><?= $aprjuntotall ?></td>
                                            <td id="julseptotall"><?= $julseptotall ?></td>
                                            <td id="octdectotall"><?= $octdectotall ?></td>
                                            <td class="total-td"><?= $quaterlytotall ?></td>
                                            
                                            <td class="chart_quarterly">
                                                <a href="{{ url('total_quarterly_expense_chart') }}"><div id="bar-chart_quarterllyy" style="height: 20px;  width: 30px; margin: 0 auto"></div></a>
                                                        <script type="text/javascript">
                                                          $(function () {
                                                                "use strict";

                                                                
                                                                var bar = new Morris.Bar({
                                                                  element: 'bar-chart_quarterllyy',
                                                                  resize: true,
                                                                  data: [
                                                                    {y: '', a: <?= $janmartotall ?>},
                                                                    {y: '', a: <?= $aprjuntotall ?>},
                                                                    {y: '', a: <?= $julseptotall ?>},
                                                                    {y: '', a: <?= $octdectotall ?>}
                                                                  ],
                                                                  barColors: ['#da291c'],
                                                                  xkey: 'y',
                                                                  ykeys: ['a'],
                                                                  labels: ['', ''],
                                                                  hideHover: 'auto',
                                                                  padding: 1,
                                                                });
                                                              });
                                                        </script>
                                            </td>
                                                
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><b>Estimated Profit / Loss</b></td>
                                            <td><?= $janmartotal - $janmartotall ?></td>
                                            <td><?= $aprjuntotal - $aprjuntotall ?></td>
                                            <td><?= $julseptotal - $julseptotall ?></td>
                                            <td><?= $octdectotal - $octdectotall ?></td>
                                            <td><?= $quaterlytotal - $quaterlytotall ?></td>
                                            <td class="chart_quarterly">
                                                <a href="{{ url('quarterly_profit_loss_chart') }}"><div id="bar-chart_quarterllyyy" style="height: 20px;  width: 30px; margin: 0 auto"></div></a>
                                                        <script type="text/javascript">
                                                          $(function () {
                                                                "use strict";

                                                                
                                                                var bar = new Morris.Bar({
                                                                  element: 'bar-chart_quarterllyyy',
                                                                  resize: true,
                                                                  data: [
                                                                    {y: '', a: <?= $janmartotal - $janmartotall ?>},
                                                                    {y: '', a: <?= $aprjuntotal - $aprjuntotall ?>},
                                                                    {y: '', a: <?= $julseptotal - $julseptotall ?>},
                                                                    {y: '', a: <?= $octdectotal - $octdectotall ?>}
                                                                  ],
                                                                  barColors: ['#da291c'],
                                                                  xkey: 'y',
                                                                  ykeys: ['a'],
                                                                  labels: ['', ''],
                                                                  hideHover: 'auto',
                                                                  padding: 1,
                                                                });
                                                              });
                                                        </script>
                                            </td>
                                        </tr>
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if($weekcnt == 3){ ?>
    <input type="hidden" name="" value="{{ $startdates[0] }}" id="startdates0">
    <input type="hidden" name="" value="{{ $startdates[1] }}" id="startdates1">
    <input type="hidden" name="" value="{{ $startdates[2] }}" id="startdates2">
    <input type="hidden" name="" value="{{ $enddates[0] }}" id="enddates0">
    <input type="hidden" name="" value="{{ $enddates[1] }}" id="enddates1">
    <input type="hidden" name="" value="{{ $enddates[2] }}" id="enddates2">
<?php }elseif ($weekcnt == 4) { ?>
    <input type="hidden" name="" value="{{ $startdates[0] }}" id="startdates0">
    <input type="hidden" name="" value="{{ $startdates[1] }}" id="startdates1">
    <input type="hidden" name="" value="{{ $startdates[2] }}" id="startdates2">
    <input type="hidden" name="" value="{{ $startdates[3] }}" id="startdates3">
    <input type="hidden" name="" value="{{ $enddates[0] }}" id="enddates0">
    <input type="hidden" name="" value="{{ $enddates[1] }}" id="enddates1">
    <input type="hidden" name="" value="{{ $enddates[2] }}" id="enddates2">
    <input type="hidden" name="" value="{{ $enddates[3] }}" id="enddates3">
<?php }elseif ($weekcnt == 5) { ?>
    <input type="hidden" name="" value="{{ $startdates[0] }}" id="startdates0">
    <input type="hidden" name="" value="{{ $startdates[1] }}" id="startdates1">
    <input type="hidden" name="" value="{{ $startdates[2] }}" id="startdates2">
    <input type="hidden" name="" value="{{ $startdates[3] }}" id="startdates3">
    <input type="hidden" name="" value="{{ $startdates[4] }}" id="startdates4">
    <input type="hidden" name="" value="{{ $enddates[0] }}" id="enddates0">
    <input type="hidden" name="" value="{{ $enddates[1] }}" id="enddates1">
    <input type="hidden" name="" value="{{ $enddates[2] }}" id="enddates2">
    <input type="hidden" name="" value="{{ $enddates[3] }}" id="enddates3">
    <input type="hidden" name="" value="{{ $enddates[4] }}" id="enddates4">
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        // alert("hi");
        setTimeout(function() {
            table_data_check();
        },1000);
    });
    function table_data_check(){
        $("table tbody td").each(function() { 
            if (!$(this).hasClass("fixed-side")) {
                var val = $(this).html();
                if(val != 0){
                    $(this).css('color', '#da291c');
                }
            }
        });
        $("table tbody td.grossweek").each(function() { 
            var val = $(this).html();
            if(val != 0){
                $(this).css('cursor', 'pointer');
            }
        });
        $("table tbody td.otherrweek").each(function() { 
            var val = $(this).html();
            if(val != 0){
                $(this).css('cursor', 'pointer');
            }
        });
    }
    $(document).on("click", ".month_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('revbudgt');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/revenue_budget_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    $(document).on("click", ".actual_month_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('revactual');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/revenue_actual_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    
    $(document).on("click", ".other_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('otherbudgt');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/other_revenue_monthly_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    $(document).on("click", ".actual_other_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('otheractual');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/other_revenue_actual_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    $(document).on("click", ".monthly_expense", function(){
        var idd = $(this).attr('id');
        var id = idd.split('expense');
        var month = id[0];
        var name = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/monthly_expense_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&name=' + name + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    $(document).on("click", ".actual_monthly_expense", function(){
        var idd = $(this).attr('id');
        var id = idd.split('actualexpense');
        var month = id[0];
        var name = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/expense_actual_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&name=' + name + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#monthly_details").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
    $(document).on("click", ".quarter_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('qrevbudgt');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/quarterrevenue_budget_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&_token={{ csrf_token() }}',
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
    $(document).on("click", ".actual_quarter_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('qrevactual');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/quarterrevenue_actual_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&_token={{ csrf_token() }}',
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
    
    $(document).on("click", ".quarterother_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('qotherbudgt');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/other_revenue_quarterly_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&_token={{ csrf_token() }}',
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
    $(document).on("click", ".quarteractual_other_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('qotheractual');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/quarterother_revenue_actual_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&_token={{ csrf_token() }}',
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
    $(document).on("click", ".quarterly_expense", function(){
        var idd = $(this).attr('id');
        var id = idd.split('qexpense');
        var month = id[0];
        var name = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/quarterly_expense_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&name=' + name + '&_token={{ csrf_token() }}',
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
    $(document).on("click", ".actual_quarterly_expense", function(){
        var idd = $(this).attr('id');
        var id = idd.split('qactualexpense');
        var month = id[0];
        var name = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/quarterexpense_actual_details";

        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'month=' + month + '&name=' + name + '&_token={{ csrf_token() }}',
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
    $(".grossweek").click(function(){
        $("#monthly_details3").html("");
        if($(this).html() != 0){
            var val = $(this).attr("id");
            var vall = val.split("gweek");
            var weekc = vall[1];
            var startday = $("#startdates"+weekc).val();
            var endday = $("#enddates"+weekc).val();

            var url = "<?php echo url('/'); ?>/grossweekdetails";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'startday=' + startday + '&endday=' + endday + '&_token={{ csrf_token() }}',
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
        }
    });
    $(".otherrweek").click(function(){
        $("#monthly_details3").html("");
        if($(this).html() != 0){
            var val = $(this).attr("id");
            var vall = val.split("oweek");
            var weekc = vall[1];
            var startday = $("#startdates"+weekc).val();
            var endday = $("#enddates"+weekc).val();

            var url = "<?php echo url('/'); ?>/otherrweekdetails";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'startday=' + startday + '&endday=' + endday + '&_token={{ csrf_token() }}',
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
        }
    });
    $(".expenseweek").click(function(){
        $("#monthly_details3").html("");
        if($(this).html() != 0){
            var val = $(this).attr("id");
            var vall = val.split("eweek");
            var name = vall[0];
            var weekc = vall[1];
            var startday = $("#startdates"+weekc).val();
            var endday = $("#enddates"+weekc).val();

            var url = "<?php echo url('/'); ?>/expenseweekdetails";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'startday=' + startday + '&endday=' + endday + '&name=' + name + '&_token={{ csrf_token() }}',
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
        }
    });
</script>
@endsection