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
                <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                    <li class="active"><a href="{{ url('profit_loss_stmt') }}">Profit / Loss Statement</a></li>
                    <li><a href="{{ url('revenue_report') }}">Revenue Report</a></li>
                    <li><a href="{{ url('expenses_report') }}">Expense Report</a></li>
                    <li><a href="{{ url('balancesheet_report') }}">Balance Sheet</a></li>
                    <li><a href="{{ url('paymentbalance_report') }}">Payment / Balance</a></li>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#weekly" data-toggle="tab">Weekly</a></li>
                            <li><a href="#monthly" data-toggle="tab">Monthly</a></li>
                            <li><a href="#quarterly" data-toggle="tab">Quarterly</a></li>
                            <!-- <li><a href="#sms-tab" data-toggle="tab">Send SMS</a></li> -->
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="weekly">
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
                        <div class="tab-pane fade in" id="monthly">
                            <div class="">
                                        <div id="" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered table-hover main-table" id="">
                                                    <thead>
                                                        <tr class="top-tr">
                                                            <th class="fixed-side"></th>
                                                            <th colspan="3">Jan</th>
                                                            <th colspan="3">Feb</th>
                                                            <th colspan="3">Mar</th>
                                                            <th colspan="3">Apr</th>
                                                            <th colspan="3">May</th>
                                                            <th colspan="3">Jun</th>
                                                            <th colspan="3">Jul</th>
                                                            <th colspan="3">Aug</th>
                                                            <th colspan="3">Sep</th>
                                                            <th colspan="3">Oct</th>
                                                            <th colspan="3">Nov</th>
                                                            <th colspan="3">Dec</th>
                                                            <th colspan="3">Total</th>
                                                            <th>Graph</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="fixed-side"></th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Gross Revenue</td>
                                                            <?php if($jangrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="janrevbudgt"><?= $jangrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $jangrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($jangrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="01revactual"><?= $jangrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $jangrossactual ?></td>
                                                            <?php } ?> 
                                                            <td><?= ($jangrosstotal2-$jangrossactual) ?></td>

                                                            <?php if($febgrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="febrevbudgt"><?= $febgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $febgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($febgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="02revactual"><?= $febgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $febgrossactual ?></td>
                                                            <?php } ?> 
                                                            <td><?= ($febgrosstotal2-$febgrossactual) ?></td>

                                                            <?php if($margrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="marrevbudgt"><?= $margrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $margrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($margrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="03revactual"><?= $margrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $margrossactual ?></td>
                                                            <?php } ?> 
                                                            <td><?= ($margrosstotal2-$margrossactual) ?></td>

                                                            <?php if($aprgrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="aprrevbudgt"><?= $aprgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($aprgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="04revactual"><?= $aprgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprgrossactual ?></td>
                                                            <?php } ?> 
                                                            <td><?= ($aprgrosstotal2-$aprgrossactual) ?></td>

                                                            <?php if($maygrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="mayrevbudgt"><?= $maygrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $maygrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($maygrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="05revactual"><?= $maygrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $maygrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($maygrosstotal2-$maygrossactual) ?></td>

                                                            <?php if($jungrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="junrevbudgt"><?= $jungrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $jungrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($jungrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="06revactual"><?= $jungrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $jungrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($jungrosstotal2-$jungrossactual) ?></td>

                                                            <?php if($julgrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="julrevbudgt"><?= $julgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($julgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="07revactual"><?= $julgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($julgrosstotal2-$julgrossactual) ?></td>

                                                            <?php if($auggrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="augrevbudgt"><?= $auggrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $auggrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($auggrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="08revactual"><?= $auggrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $auggrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($auggrosstotal2-$auggrossactual) ?></td>

                                                            <?php if($sepgrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="seprevbudgt"><?= $sepgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $sepgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($sepgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="09revactual"><?= $sepgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $sepgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($sepgrosstotal2-$sepgrossactual) ?></td>

                                                            <?php if($octgrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="octrevbudgt"><?= $octgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($octgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="10revactual"><?= $octgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($octgrosstotal2-$octgrossactual) ?></td>

                                                            <?php if($novgrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="novrevbudgt"><?= $novgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $novgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($novgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="11revactual"><?= $novgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $novgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($novgrosstotal2-$novgrossactual) ?></td>

                                                            <?php if($decgrosstotal2 != 0){ ?>
                                                                <td><a class="month_revenue" id="decemrevbudgt"><?= $decgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $decgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($decgrossactual != 0){ ?>
                                                                <td><a class="actual_month_revenue" id="12revactual"><?= $decgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $decgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($decgrosstotal2-$decgrossactual) ?></td>

                                                            <td><?= $monthgrosstotal2 ?></td>
                                                            <td><?= $monthgrossactual ?></td>
                                                            <td><?= ($monthgrosstotal2-$monthgrossactual) ?></td>
                                                            <td>
                                                                <a href="{{ url('gross_revenue_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Other Revenue</td>
                                                            <?php if($janothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="janotherbudgt"><?= $janothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $janothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($janotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="01otheractual"><?= $janotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $janotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($janothrevenue-$janotherrevenue) ?></td>

                                                            <?php if($febothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="febotherbudgt"><?= $febothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $febothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($febotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="02otheractual"><?= $febotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $febotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($febothrevenue-$febotherrevenue) ?></td>

                                                            <?php if($marothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="marotherbudgt"><?= $marothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $marothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($marotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="03otheractual"><?= $marotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $marotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($marothrevenue-$marotherrevenue) ?></td>

                                                            <?php if($aprothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="aprotherbudgt"><?= $aprothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($aprotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="04otheractual"><?= $aprotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($aprothrevenue-$aprotherrevenue) ?></td>

                                                            <?php if($mayothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="mayotherbudgt"><?= $mayothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $mayothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($mayotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="05otheractual"><?= $mayotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $mayotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($mayothrevenue-$mayotherrevenue) ?></td>

                                                            <?php if($junothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="junotherbudgt"><?= $junothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $junothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($junotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="06otheractual"><?= $junotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $junotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($junothrevenue-$junotherrevenue) ?></td>

                                                            <?php if($julothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="julotherbudgt"><?= $julothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($julotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="07otheractual"><?= $julotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($julothrevenue-$julotherrevenue) ?></td>

                                                            <?php if($augothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="augotherbudgt"><?= $augothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $augothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($augotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="08otheractual"><?= $augotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $augotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($augothrevenue-$augotherrevenue) ?></td>

                                                            <?php if($sepothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="sepotherbudgt"><?= $sepothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $sepothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($sepotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="09otheractual"><?= $sepotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $sepotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($sepothrevenue-$sepotherrevenue) ?></td>

                                                            <?php if($octothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="octotherbudgt"><?= $octothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($octotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="10otheractual"><?= $octotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($octothrevenue-$octotherrevenue) ?></td>


                                                            <?php if($novothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="novotherbudgt"><?= $novothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $novothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($novotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="11otheractual"><?= $novotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $novotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($novothrevenue-$novotherrevenue) ?></td>

                                                            <?php if($decothrevenue != 0){ ?>
                                                                <td><a class="other_revenue" id="decemotherbudgt"><?= $decothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $decothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($decotherrevenue != 0){ ?>
                                                                <td><a class="actual_other_revenue" id="12otheractual"><?= $decotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $decotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($decothrevenue-$decotherrevenue) ?></td>

                                                            <td><?= $monthothrevenue ?></td>
                                                            <td><?= $monthotherrevenue ?></td>
                                                            <td><?= ($monthothrevenue-$monthotherrevenue) ?></td>
                                                            <td>
                                                                <a href="{{ url('other_revenue_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="total-tr">
                                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                                            <td><?= $jantotal ?></td>
                                                            <td><?= $jantotalactual ?></td>
                                                            <td><?= ($jantotal-$jantotalactual) ?></td>
                                                            <td><?= $febtotal ?></td>
                                                            <td><?= $febtotalactual ?></td>
                                                            <td><?= ($febtotal-$febtotalactual) ?></td>
                                                            <td><?= $martotal ?></td>
                                                            <td><?= $martotalactual ?></td>
                                                            <td><?= ($martotal-$martotalactual) ?></td>
                                                            <td><?= $aprtotal ?></td>
                                                            <td><?= $aprtotalactual ?></td>
                                                            <td><?= ($aprtotal-$aprtotalactual) ?></td>
                                                            <td><?= $maytotal ?></td>
                                                            <td><?= $maytotalactual ?></td>
                                                            <td><?= ($maytotal-$maytotalactual) ?></td>
                                                            <td><?= $juntotal ?></td>
                                                            <td><?= $juntotalactual ?></td>
                                                            <td><?= ($juntotal-$juntotalactual) ?></td>
                                                            <td><?= $jultotal ?></td>
                                                            <td><?= $jultotalactual ?></td>
                                                            <td><?= ($jultotal-$jultotalactual) ?></td>
                                                            <td><?= $augtotal ?></td>
                                                            <td><?= $augtotalactual ?></td>
                                                            <td><?= ($augtotal-$augtotalactual) ?></td>
                                                            <td><?= $septotal ?></td>
                                                            <td><?= $septotalactual ?></td>
                                                            <td><?= ($septotal-$septotalactual) ?></td>
                                                            <td><?= $octtotal ?></td>
                                                            <td><?= $octtotalactual ?></td>
                                                            <td><?= ($octtotal-$octtotalactual) ?></td>
                                                            <td><?= $novtotal ?></td>
                                                            <td><?= $novtotalactual ?></td>
                                                            <td><?= ($novtotal-$novtotalactual) ?></td>
                                                            <td><?= $dectotal ?></td>
                                                            <td><?= $dectotalactual ?></td>
                                                            <td><?= ($dectotal-$dectotalactual) ?></td>
                                                            <td><?= $monthtotal ?></td>
                                                            <td><?= $monthtotalactual ?></td>
                                                            <td><?= ($monthtotal-$monthtotalactual) ?></td>
                                                            <td>
                                                                <a href="{{ url('all_revenue_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->

                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php 
                                                        foreach($expense as $value){
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td class="fixed-side"><?= $value->name ?></td>
                                                                <?php if($value->jan != 0){ ?>
                                                                    <td><a class="monthly_expense" id="janexpense<?= $value->name ?>"><?= $value->jan ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->jan ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_jan = App\Http\Controllers\HomeController::getjanactualexp($value->name);
                                                                if($actual_jan!= 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="01actualexpense<?= $value->name ?>"><?= $actual_jan ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_jan ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->jan - $actual_jan) ?></td>

                                                                <?php if($value->feb != 0){ ?>
                                                                    <td><a class="monthly_expense" id="febexpense<?= $value->name ?>"><?= $value->feb ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->feb ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_feb = App\Http\Controllers\HomeController::getfebactualexp($value->name);
                                                                if($actual_feb != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="02actualexpense<?= $value->name ?>"><?= $actual_feb ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_feb ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->feb - $actual_feb) ?></td>
                                                                
                                                                <?php if($value->mar != 0){ ?>
                                                                    <td><a class="monthly_expense" id="marexpense<?= $value->name ?>"><?= $value->mar ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->mar ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_mar = App\Http\Controllers\HomeController::getmaractualexp($value->name);
                                                                if($actual_mar != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="03actualexpense<?= $value->name ?>"><?= $actual_mar ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_mar ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->mar - $actual_mar) ?></td>

                                                                <?php if($value->apr != 0){ ?>
                                                                    <td><a class="monthly_expense" id="aprexpense<?= $value->name ?>"><?= $value->apr ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->apr ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_apr = App\Http\Controllers\HomeController::getapractualexp($value->name);
                                                                if($actual_apr != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="04actualexpense<?= $value->name ?>"><?= $actual_apr ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_apr ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->apr - $actual_apr) ?></td>


                                                                <?php if($value->may != 0){ ?>
                                                                    <td><a class="monthly_expense" id="mayexpense<?= $value->name ?>"><?= $value->may ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->may ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_may = App\Http\Controllers\HomeController::getmayactualexp($value->name);
                                                                if($actual_may != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="05actualexpense<?= $value->name ?>"><?= $actual_may ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_may ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->may - $actual_may) ?></td>


                                                                <?php if($value->jun != 0){ ?>
                                                                    <td><a class="monthly_expense" id="junexpense<?= $value->name ?>"><?= $value->jun ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->jun ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_jun = App\Http\Controllers\HomeController::getjunactualexp($value->name);
                                                                if($actual_jun != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="06actualexpense<?= $value->name ?>"><?= $actual_jun ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_jun ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->jun - $actual_jun) ?></td>


                                                                <?php if($value->jul != 0){ ?>
                                                                    <td><a class="monthly_expense" id="julexpense<?= $value->name ?>"><?= $value->jul ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->jul ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_jul = App\Http\Controllers\HomeController::getjulactualexp($value->name);
                                                                if($actual_jul != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="07actualexpense<?= $value->name ?>"><?= $actual_jul ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_jul ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->jul - $actual_jul) ?></td>


                                                                <?php if($value->aug != 0){ ?>
                                                                    <td><a class="monthly_expense" id="augexpense<?= $value->name ?>"><?= $value->aug ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->aug ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_aug = App\Http\Controllers\HomeController::getaugactualexp($value->name);
                                                                if($actual_aug != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="08actualexpense<?= $value->name ?>"><?= $actual_aug ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_aug ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->aug - $actual_aug) ?></td>


                                                                <?php if($value->sep != 0){ ?>
                                                                    <td><a class="monthly_expense" id="sepexpense<?= $value->name ?>"><?= $value->sep ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->sep ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_sep = App\Http\Controllers\HomeController::getsepactualexp($value->name);
                                                                if($actual_sep != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="09actualexpense<?= $value->name ?>"><?= $actual_sep ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_sep ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->sep - $actual_sep) ?></td>


                                                                <?php if($value->oct != 0){ ?>
                                                                    <td><a class="monthly_expense" id="octexpense<?= $value->name ?>"><?= $value->oct ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->oct ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_oct = App\Http\Controllers\HomeController::getoctactualexp($value->name);
                                                                if($actual_oct != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="10actualexpense<?= $value->name ?>"><?= $actual_oct ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_oct ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->oct - $actual_oct) ?></td>


                                                                <?php if($value->nov != 0){ ?>
                                                                    <td><a class="monthly_expense" id="novexpense<?= $value->name ?>"><?= $value->nov ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->nov ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_nov = App\Http\Controllers\HomeController::getnovactualexp($value->name);
                                                                if($actual_nov != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="11actualexpense<?= $value->name ?>"><?= $actual_nov ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_nov ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->nov - $actual_nov) ?></td>


                                                                <?php if($value->decem != 0){ ?>
                                                                    <td><a class="monthly_expense" id="decemexpense<?= $value->name ?>"><?= $value->decem ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->decem ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_decem = App\Http\Controllers\HomeController::getdecemactualexp($value->name);
                                                                if($actual_decem != 0){ ?>
                                                                    <td><a class="actual_monthly_expense" id="12actualexpense<?= $value->name ?>"><?= $actual_decem ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_decem ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->decem - $actual_decem) ?></td>

                                                                <td> <?= $tot = ($value->jan + $value->feb + $value->mar + $value->apr + $value->may + $value->jun + $value->jul + $value->aug + $value->sep + $value->oct + $value->nov + $value->decem) ?></td>
                                                                <td><?php echo $actual_total2 = App\Http\Controllers\HomeController::gettotalactualexp($value->name); ?></td>
                                                                <td><?= ($tot-$actual_total2) ?></td>
                                                                <td>
                                                                    <a href="{{ url('expense_variance_monthly_graph') }}/<?= $value->name ?>"><i class="fa fa-bar-chart"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr class="total2-tr">
                                                            <td class="fixed-side" style=""><b>Total Expenses</b></td>
                                                            <td><?= $jantotal2 ?></td>
                                                            <td><?= $jantotal2actual ?></td>
                                                            <td><?= ($jantotal2-$jantotal2actual) ?></td>
                                                            <td><?= $febtotal2 ?></td>
                                                            <td><?= $febtotal2actual ?></td>
                                                            <td><?= ($febtotal2-$febtotal2actual) ?></td>
                                                            <td><?= $martotal2 ?></td>
                                                            <td><?= $martotal2actual ?></td>
                                                            <td><?= ($martotal2-$martotal2actual) ?></td>
                                                            <td><?= $aprtotal2 ?></td>
                                                            <td><?= $aprtotal2actual ?></td>
                                                            <td><?= ($aprtotal2-$aprtotal2actual) ?></td>
                                                            <td><?= $maytotal2 ?></td>
                                                            <td><?= $maytotal2actual ?></td>
                                                            <td><?= ($maytotal2-$maytotal2actual) ?></td>
                                                            <td><?= $juntotal2 ?></td>
                                                            <td><?= $juntotal2actual ?></td>
                                                            <td><?= ($juntotal2-$juntotal2actual) ?></td>
                                                            <td><?= $jultotal2 ?></td>
                                                            <td><?= $jultotal2actual ?></td>
                                                            <td><?= ($jultotal2-$jultotal2actual) ?></td>
                                                            <td><?= $augtotal2 ?></td>
                                                            <td><?= $augtotal2actual ?></td>
                                                            <td><?= ($augtotal2-$augtotal2actual) ?></td>
                                                            <td><?= $septotal2 ?></td>
                                                            <td><?= $septotal2actual ?></td>
                                                            <td><?= ($septotal2-$septotal2actual) ?></td>
                                                            <td><?= $octtotal2 ?></td>
                                                            <td><?= $octtotal2actual ?></td>
                                                            <td><?= ($octtotal2-$octtotal2actual) ?></td>
                                                            <td><?= $novtotal2 ?></td>
                                                            <td><?= $novtotal2actual ?></td>
                                                            <td><?= ($novtotal2-$novtotal2actual) ?></td>
                                                            <td><?= $dectotal2 ?></td>
                                                            <td><?= $dectotal2actual ?></td>
                                                            <td><?= ($dectotal2-$dectotal2actual) ?></td>
                                                            <td><?= $tott = ($jantotal2 + $febtotal2 + $martotal2 + $aprtotal2 + $maytotal2 + $juntotal2 + $jultotal2 + $augtotal2 + $septotal2 + $octtotal2 + $novtotal2 + $dectotal2) ?></td>
                                                            <td><?= $tott2 = ($jantotal2actual + $febtotal2actual + $martotal2actual + $aprtotal2actual + $maytotal2actual + $juntotal2actual + $jultotal2actual + $augtotal2actual + $septotal2actual + $octtotal2actual + $novtotal2actual + $dectotal2actual) ?></td>
                                                            <td><?= ($tott - $tott2) ?></td>
                                                            <td>
                                                                <a href="{{ url('expense_monthly_vary_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                                                            <td><?= ($jantotal-$jantotal2) ?></td>
                                                            <td><?= ($jantotalactual-$jantotal2actual) ?></td>
                                                            <td><?= (($jantotal-$jantotal2)-($jantotalactual-$jantotal2actual)) ?></td>
                                                            <td><?= ($febtotal-$febtotal2) ?></td>
                                                            <td><?= ($febtotalactual-$febtotal2actual) ?></td>
                                                            <td><?= (($febtotal-$febtotal2)-($febtotalactual-$febtotal2actual)) ?></td>
                                                            <td><?= ($martotal-$martotal2) ?></td>
                                                            <td><?= ($martotalactual-$martotal2actual) ?></td>
                                                            <td><?= (($martotal-$martotal2)-($martotalactual-$martotal2actual)) ?></td>
                                                            <td><?= ($aprtotal-$aprtotal2) ?></td>
                                                            <td><?= ($aprtotalactual-$aprtotal2actual) ?></td>
                                                            <td><?= (($aprtotal-$aprtotal2)-($aprtotalactual-$aprtotal2actual)) ?></td>
                                                           <td><?= ($maytotal-$maytotal2) ?></td>
                                                            <td><?= ($maytotalactual-$maytotal2actual) ?></td>
                                                            <td><?= (($maytotal-$maytotal2)-($maytotalactual-$maytotal2actual)) ?></td>
                                                            <td><?= ($juntotal-$juntotal2) ?></td>
                                                            <td><?= ($juntotalactual-$juntotal2actual) ?></td>
                                                            <td><?= (($juntotal-$juntotal2)-($juntotalactual-$juntotal2actual)) ?></td>
                                                            <td><?= ($jultotal-$jultotal2) ?></td>
                                                            <td><?= ($jultotalactual-$jultotal2actual) ?></td>
                                                            <td><?= (($jultotal-$jultotal2)-($jultotalactual-$jultotal2actual)) ?></td>
                                                            <td><?= ($augtotal-$augtotal2) ?></td>
                                                            <td><?= ($augtotalactual-$augtotal2actual) ?></td>
                                                            <td><?= (($augtotal-$augtotal2)-($augtotalactual-$augtotal2actual)) ?></td>
                                                            <td><?= ($septotal-$septotal2) ?></td>
                                                            <td><?= ($septotalactual-$septotal2actual) ?></td>
                                                            <td><?= (($septotal-$septotal2)-($septotalactual-$septotal2actual)) ?></td>
                                                            <td><?= ($octtotal-$octtotal2) ?></td>
                                                            <td><?= ($octtotalactual-$octtotal2actual) ?></td>
                                                            <td><?= (($octtotal-$octtotal2)-($octtotalactual-$octtotal2actual)) ?></td>
                                                            <td><?= ($novtotal-$novtotal2) ?></td>
                                                            <td><?= ($novtotalactual-$novtotal2actual) ?></td>
                                                            <td><?= (($novtotal-$novtotal2)-($novtotalactual-$novtotal2actual)) ?></td>
                                                            <td><?= ($dectotal-$dectotal2) ?></td>
                                                            <td><?= ($dectotalactual-$dectotal2actual) ?></td>
                                                            <td><?= (($dectotal-$dectotal2)-($dectotalactual-$dectotal2actual)) ?></td>
                                                            <td><?= ($monthtotal-$tott) ?></td>
                                                            <td><?= ($monthtotalactual-$tott2) ?></td>
                                                            <td><?= (($monthtotal-$tott)-($monthtotalactual-$tott2)) ?></td>
                                                            <td>
                                                                <!-- <a href="#"><i class="fa fa-bar-chart"></i></a> -->
                                                            </td>
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
                        <div class="tab-pane fade in" id="quarterly">
                            <div class="">
                                        <div id="" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered table-hover main-table" id="">
                                                    <thead>
                                                        <tr class="top-tr">
                                                            <th class="fixed-side"></th>
                                                            <th colspan="3">Jan-Mar</th>
                                                            <th colspan="3">Apr-Jun</th>
                                                            <th colspan="3">Jul-Sep</th>
                                                            <th colspan="3">Oct-Dec</th>
                                                            <th colspan="3">Total</th>
                                                            <th>Graph</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="fixed-side"></th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Budget</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Gross Revenue</td>
                                                            <?php if($janmargrosstotal2 != 0){ ?>
                                                                <td><a class="quarter_revenue" id="janmarqrevbudgt"><?= $janmargrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $janmargrosstotal2 ?></td>
                                                            <?php } ?>

                                                            <?php if($janmargrossactual != 0){ ?>
                                                                <td><a class="actual_quarter_revenue" id="01qrevactual"><?= $janmargrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $janmargrossactual ?></td>
                                                            <?php } ?>

                                                            <td><?= ($janmargrosstotal2-$janmargrossactual) ?></td>


                                                            <?php if($aprjungrosstotal2 != 0){ ?>
                                                                <td><a class="quarter_revenue" id="aprjunqrevbudgt"><?= $aprjungrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprjungrosstotal2 ?></td>
                                                            <?php } ?>

                                                            <?php if($aprjungrossactual != 0){ ?>
                                                                <td><a class="actual_quarter_revenue" id="04qrevactual"><?= $aprjungrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprjungrossactual ?></td>
                                                            <?php } ?>

                                                            <td><?= ($aprjungrosstotal2-$aprjungrossactual) ?></td>


                                                            <?php if($julsepgrosstotal2 != 0){ ?>
                                                                <td><a class="quarter_revenue" id="julsepqrevbudgt"><?= $julsepgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julsepgrosstotal2 ?></td>
                                                            <?php } ?>

                                                            <?php if($julsepgrossactual != 0){ ?>
                                                                <td><a class="actual_quarter_revenue" id="07qrevactual"><?= $julsepgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julsepgrossactual ?></td>
                                                            <?php } ?>

                                                            <td><?= ($julsepgrosstotal2-$julsepgrossactual) ?></td>


                                                            <?php if($octdecgrosstotal2 != 0){ ?>
                                                                <td><a class="quarter_revenue" id="octdecqrevbudgt"><?= $octdecgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octdecgrosstotal2 ?></td>
                                                            <?php } ?>

                                                            <?php if($octdecgrossactual != 0){ ?>
                                                                <td><a class="actual_quarter_revenue" id="10qrevactual"><?= $octdecgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octdecgrossactual ?></td>
                                                            <?php } ?>

                                                            <td><?= ($octdecgrosstotal2-$octdecgrossactual) ?></td>


                                                            <td><?= $monthgrosstotal2 ?></td>
                                                            <td><?= $monthgrossactual ?></td>
                                                            <td><?= ($monthgrosstotal2-$monthgrossactual) ?></td>
                                                            <td>
                                                                <a href="{{ url('gross_quarter_revenue_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Other Revenue</td>
                                                            <?php if($janmarothrevenue != 0){ ?>
                                                                <td><a class="quarterother_revenue" id="janmarqotherbudgt"><?= $janmarothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $janmarothrevenue ?></td>
                                                            <?php } ?>

                                                            <?php if($janmarotherrevenue != 0){ ?>
                                                                <td><a class="quarteractual_other_revenue" id="01qotheractual"><?= $janmarotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $janmarotherrevenue ?></td>
                                                            <?php } ?>

                                                            <td><?= ($janmarothrevenue-$janmarotherrevenue) ?></td>



                                                            <?php if($aprjunothrevenue != 0){ ?>
                                                                <td><a class="quarterother_revenue" id="aprjunqotherbudgt"><?= $aprjunothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprjunothrevenue ?></td>
                                                            <?php } ?>

                                                            <?php if($aprjunotherrevenue != 0){ ?>
                                                                <td><a class="quarteractual_other_revenue" id="04qotheractual"><?= $aprjunotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $aprjunotherrevenue ?></td>
                                                            <?php } ?>

                                                            <td><?= ($aprjunothrevenue-$aprjunotherrevenue) ?></td>


                                                            <?php if($julsepothrevenue != 0){ ?>
                                                                <td><a class="quarterother_revenue" id="julsepqotherbudgt"><?= $julsepothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julsepothrevenue ?></td>
                                                            <?php } ?>

                                                            <?php if($julsepotherrevenue != 0){ ?>
                                                                <td><a class="quarteractual_other_revenue" id="07qotheractual"><?= $julsepotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $julsepotherrevenue ?></td>
                                                            <?php } ?>

                                                            <td><?= ($julsepothrevenue-$julsepotherrevenue) ?></td>


                                                            <?php if($octdecothrevenue != 0){ ?>
                                                                <td><a class="quarterother_revenue" id="octdecqotherbudgt"><?= $octdecothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octdecothrevenue ?></td>
                                                            <?php } ?>

                                                            <?php if($octdecotherrevenue != 0){ ?>
                                                                <td><a class="quarteractual_other_revenue" id="10qotheractual"><?= $octdecotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $octdecotherrevenue ?></td>
                                                            <?php } ?>

                                                            <td><?= ($octdecothrevenue-$octdecotherrevenue) ?></td>

                                                            <td><?= $monthothrevenue ?></td>
                                                            <td><?= $monthotherrevenue ?></td>
                                                            <td><?= ($monthothrevenue-$monthotherrevenue) ?></td>
                                                            <td>
                                                                <a href="{{ url('other_quarter_revenue_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="total-tr">
                                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                                            <td><?= $janmartotal ?></td>
                                                            <td><?= $janmartotalactual ?></td>
                                                            <td><?= ($janmartotal-$janmartotalactual) ?></td>
                                                            <td><?= $aprjuntotal ?></td>
                                                            <td><?= $aprjuntotalactual ?></td>
                                                            <td><?= ($aprjuntotal-$aprjuntotalactual) ?></td>
                                                            <td><?= $julseptotal ?></td>
                                                            <td><?= $julseptotalactual ?></td>
                                                            <td><?= ($julseptotal-$julseptotalactual) ?></td>
                                                            <td><?= $octdectotal ?></td>
                                                            <td><?= $octdectotalactual ?></td>
                                                            <td><?= ($octdectotal-$octdectotalactual) ?></td>
                                                            <td><?= $monthtotal ?></td>
                                                            <td><?= $monthtotalactual ?></td>
                                                            <td><?= ($monthtotal-$monthtotalactual) ?></td>
                                                            <td>
                                                                <a href="{{ url('all_quarter_revenue_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->

                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php 
                                                        foreach($expensess as $value){
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td class="fixed-side"><?= $value->name ?></td>

                                                                <?php if($value->janmar != 0){ ?>
                                                                    <td><a class="quarterly_expense" id="janmarqexpense<?= $value->name ?>"><?= $value->janmar ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->janmar ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_janmar = App\Http\Controllers\HomeController::getjanmaractualexp($value->name);
                                                                if($actual_janmar!= 0){ ?>
                                                                    <td><a class="actual_quarterly_expense" id="01qactualexpense<?= $value->name ?>"><?= $actual_janmar ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_janmar ?></td>
                                                                <?php } ?>
                                                                <td><?= ($value->janmar - $actual_janmar) ?></td>



                                                                <?php if($value->aprjun != 0){ ?>
                                                                    <td><a class="quarterly_expense" id="aprjunqexpense<?= $value->name ?>"><?= $value->aprjun ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->aprjun ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_aprjun = App\Http\Controllers\HomeController::getaprjunactualexp($value->name);
                                                                if($actual_aprjun!= 0){ ?>
                                                                    <td><a class="actual_quarterly_expense" id="04qactualexpense<?= $value->name ?>"><?= $actual_aprjun ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_aprjun ?></td>
                                                                <?php } ?>

                                                                <td><?= ($value->aprjun - $actual_aprjun) ?></td>

                                                                <?php if($value->julsep != 0){ ?>
                                                                    <td><a class="quarterly_expense" id="julsepqexpense<?= $value->name ?>"><?= $value->julsep ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->julsep ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_julsep = App\Http\Controllers\HomeController::getjulsepactualexp($value->name);
                                                                if($actual_julsep!= 0){ ?>
                                                                    <td><a class="actual_quarterly_expense" id="07qactualexpense<?= $value->name ?>"><?= $actual_julsep ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_julsep ?></td>
                                                                <?php } ?>

                                                                <td><?= ($value->julsep - $actual_julsep) ?></td>


                                                                <?php if($value->octdec != 0){ ?>
                                                                    <td><a class="quarterly_expense" id="octdecqexpense<?= $value->name ?>"><?= $value->octdec ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $value->octdec ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $actual_octdec = App\Http\Controllers\HomeController::getoctdecactualexp($value->name);
                                                                if($actual_octdec!= 0){ ?>
                                                                    <td><a class="actual_quarterly_expense" id="10qactualexpense<?= $value->name ?>"><?= $actual_octdec ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $actual_octdec ?></td>
                                                                <?php } ?>

                                                                <td><?= ($value->octdec - $actual_octdec) ?></td>

                                                                <td> <?= $tot = ($value->janmar + $value->aprjun + $value->julsep + $value->octdec) ?></td>
                                                                <td><?php echo $actual_total2 = App\Http\Controllers\HomeController::gettotalactualexp($value->name); ?></td>
                                                                <td><?= ($tot-$actual_total2) ?></td>
                                                                <td>
                                                                    <a href="{{ url('expense_variance_quarterly_graph') }}/<?= $value->name ?>"><i class="fa fa-bar-chart"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr class="total2-tr">
                                                            <td class="fixed-side" style=""><b>Total Expenses</b></td>
                                                            <td><?= $janmartotal2 ?></td>
                                                            <td><?= $janmartotal2actual ?></td>
                                                            <td><?= ($janmartotal2-$janmartotal2actual) ?></td>
                                                            <td><?= $aprjuntotal2 ?></td>
                                                            <td><?= $aprjuntotal2actual ?></td>
                                                            <td><?= ($aprjuntotal2-$aprjuntotal2actual) ?></td>
                                                            <td><?= $julseptotal2 ?></td>
                                                            <td><?= $julseptotal2actual ?></td>
                                                            <td><?= ($julseptotal2-$julseptotal2actual) ?></td>
                                                            <td><?= $octdectotal2 ?></td>
                                                            <td><?= $octdectotal2actual ?></td>
                                                            <td><?= ($octdectotal2-$octdectotal2actual) ?></td>
                                                            <td><?= $tott = ($janmartotal2 + $aprjuntotal2 + $julseptotal2 + $octdectotal2) ?></td>
                                                            <td><?= $tott2 = ($janmartotal2actual + $aprjuntotal2actual + $julseptotal2actual + $octdectotal2actual) ?></td>
                                                            <td><?= ($tott - $tott2) ?></td>
                                                            <td>
                                                                <a href="{{ url('expense_quarterly_vary_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                                                            <td><?= ($janmartotal-$janmartotal2) ?></td>
                                                            <td><?= ($janmartotalactual-$janmartotal2actual) ?></td>
                                                            <td><?= (($janmartotal-$janmartotal2)-($janmartotalactual-$janmartotal2actual)) ?></td>
                                                            <td><?= ($aprjuntotal-$aprjuntotal2) ?></td>
                                                            <td><?= ($aprjuntotalactual-$aprjuntotal2actual) ?></td>
                                                            <td><?= (($aprjuntotal-$aprjuntotal2)-($aprjuntotalactual-$aprjuntotal2actual)) ?></td>
                                                            <td><?= ($julseptotal-$julseptotal2) ?></td>
                                                            <td><?= ($julseptotalactual-$julseptotal2actual) ?></td>
                                                            <td><?= (($julseptotal-$julseptotal2)-($julseptotalactual-$julseptotal2actual)) ?></td>
                                                            <td><?= ($octdectotal-$octdectotal2) ?></td>
                                                            <td><?= ($octdectotalactual-$octdectotal2actual) ?></td>
                                                            <td><?= (($octdectotal-$octdectotal2)-($octdectotalactual-$octdectotal2actual)) ?></td>
                                                            <td><?= ($monthtotal-$tott) ?></td>
                                                            <td><?= ($monthtotalactual-$tott2) ?></td>
                                                            <td><?= (($monthtotal-$tott)-($monthtotalactual-$tott2)) ?></td>
                                                            <td>
                                                                <!-- <a href="#"><i class="fa fa-bar-chart"></i></a> -->
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details2"></div>
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

<script type="text/javascript">
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
</script>
@endsection