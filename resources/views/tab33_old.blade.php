@extends('layouts.main') 
@section("content")

<style>
    .table > tbody > tr > td:nth-child(3n + 4) {
        border-right: 2px solid #0b0b0b !important;
    }
    .table > thead > tr > th:nth-child(3n + 4) {
        border-right: 2px solid #0b0b0b !important;
    }
    .table > tfoot > tr > td:nth-child(3n + 4) {
        border-right: 2px solid #0b0b0b !important;
    }
    .table > thead > .top-tr > th {
        border-right: 2px solid #0b0b0b !important;
    }
    .table > tbody > tr > td:first-child {
        border-right: 2px solid #0b0b0b !important;
    }
    .table > thead > tr > th:first-child {
        border-right: 2px solid #0b0b0b !important;
    }
    .table > tfoot > tr > td:first-child {
        border-right: 2px solid #0b0b0b !important;
    }
</style>
<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Financial Management / Projection</h4>
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

                <div class="col-md-12 margin-top-40 padding-0">
                    <ul class="nav nav-tabs nav-button-tabs nav-justified">
                        <li><a href="{{ url('create_projection') }}">Create Projection Revenues</a></li>
                        <li><a href="{{ url('tab22') }}">Create Projection Expenses</a></li>
                        <li class="active"><a href="{{ url('tab33') }}">Profit/Loss Projection</a></li>
                        <li><a href="{{ url('tab44') }}">Revenue Projection</a></li>
                        <li><a href="{{ url('tab55') }}">Expenses Projection</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab3">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="{{ url('tab33') }}">Monthly</a></li>
                                <li><a href="{{ url('tab332') }}">Quarterly</a></li>
                            </ul>

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab31">
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
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
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
                                                            <td><?= $jangrosstotal2 ?></td>
                                                            <td><?= $jangrossactual ?></td>
                                                            <td><?= ($jangrosstotal2-$jangrossactual) ?></td>
                                                            <td><?= $febgrosstotal2 ?></td>
                                                            <td><?= $febgrossactual ?></td>
                                                            <td><?= ($febgrosstotal2-$febgrossactual) ?></td>
                                                            <td><?= $margrosstotal2 ?></td>
                                                            <td><?= $margrossactual ?></td>
                                                            <td><?= ($margrosstotal2-$margrossactual) ?></td>
                                                            <td><?= $aprgrosstotal2 ?></td>
                                                            <td><?= $aprgrossactual ?></td>
                                                            <td><?= ($aprgrosstotal2-$aprgrossactual) ?></td>
                                                            <td><?= $maygrosstotal2 ?></td>
                                                            <td><?= $maygrossactual ?></td>
                                                            <td><?= ($maygrosstotal2-$maygrossactual) ?></td>
                                                            <td><?= $jungrosstotal2 ?></td>
                                                            <td><?= $jungrossactual ?></td>
                                                            <td><?= ($jungrosstotal2-$jungrossactual) ?></td>
                                                            <td><?= $julgrosstotal2 ?></td>
                                                            <td><?= $julgrossactual ?></td>
                                                            <td><?= ($julgrosstotal2-$julgrossactual) ?></td>
                                                            <td><?= $auggrosstotal2 ?></td>
                                                            <td><?= $auggrossactual ?></td>
                                                            <td><?= ($auggrosstotal2-$auggrossactual) ?></td>
                                                            <td><?= $sepgrosstotal2 ?></td>
                                                            <td><?= $sepgrossactual ?></td>
                                                            <td><?= ($sepgrosstotal2-$sepgrossactual) ?></td>
                                                            <td><?= $octgrosstotal2 ?></td>
                                                            <td><?= $octgrossactual ?></td>
                                                            <td><?= ($octgrosstotal2-$octgrossactual) ?></td>
                                                            <td><?= $novgrosstotal2 ?></td>
                                                            <td><?= $novgrossactual ?></td>
                                                            <td><?= ($novgrosstotal2-$novgrossactual) ?></td>
                                                            <td><?= $decgrosstotal2 ?></td>
                                                            <td><?= $decgrossactual ?></td>
                                                            <td><?= ($decgrosstotal2-$decgrossactual) ?></td>
                                                            <td><?= $monthgrosstotal2 ?></td>
                                                            <td><?= $monthgrossactual ?></td>
                                                            <td><?= ($monthgrosstotal2-$monthgrossactual) ?></td>
                                                            <td>
                                                                <a href="{{ url('gross_revenue_chart2') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Other Revenue</td>
                                                            <td><?= $janothrevenue ?></td>
                                                            <td><?= $janotherrevenue ?></td>
                                                            <td><?= ($janothrevenue-$janotherrevenue) ?></td>
                                                            <td><?= $febothrevenue ?></td>
                                                            <td><?= $febotherrevenue ?></td>
                                                            <td><?= ($febothrevenue-$febotherrevenue) ?></td>
                                                            <td><?= $marothrevenue ?></td>
                                                            <td><?= $marotherrevenue ?></td>
                                                            <td><?= ($marothrevenue-$marotherrevenue) ?></td>
                                                            <td><?= $aprothrevenue ?></td>
                                                            <td><?= $aprotherrevenue ?></td>
                                                            <td><?= ($aprothrevenue-$aprotherrevenue) ?></td>
                                                            <td><?= $mayothrevenue ?></td>
                                                            <td><?= $mayotherrevenue ?></td>
                                                            <td><?= ($mayothrevenue-$mayotherrevenue) ?></td>
                                                            <td><?= $junothrevenue ?></td>
                                                            <td><?= $junotherrevenue ?></td>
                                                            <td><?= ($junothrevenue-$junotherrevenue) ?></td>
                                                            <td><?= $julothrevenue ?></td>
                                                            <td><?= $julotherrevenue ?></td>
                                                            <td><?= ($julothrevenue-$julotherrevenue) ?></td>
                                                            <td><?= $augothrevenue ?></td>
                                                            <td><?= $augotherrevenue ?></td>
                                                            <td><?= ($augothrevenue-$augotherrevenue) ?></td>
                                                            <td><?= $sepothrevenue ?></td>
                                                            <td><?= $sepotherrevenue ?></td>
                                                            <td><?= ($sepothrevenue-$sepotherrevenue) ?></td>
                                                            <td><?= $octothrevenue ?></td>
                                                            <td><?= $octotherrevenue ?></td>
                                                            <td><?= ($octothrevenue-$octotherrevenue) ?></td>
                                                            <td><?= $novothrevenue ?></td>
                                                            <td><?= $novotherrevenue ?></td>
                                                            <td><?= ($novothrevenue-$novotherrevenue) ?></td>
                                                            <td><?= $decothrevenue ?></td>
                                                            <td><?= $decotherrevenue ?></td>
                                                            <td><?= ($decothrevenue-$decotherrevenue) ?></td>
                                                            <td><?= $monthothrevenue ?></td>
                                                            <td><?= $monthotherrevenue ?></td>
                                                            <td><?= ($monthothrevenue-$monthotherrevenue) ?></td>
                                                            <td>
                                                                <a href="{{ url('other_revenue_chart2') }}"><i class="fa fa-bar-chart"></i></a>
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
                                                                <a href="{{ url('all_revenue_chart2') }}"><i class="fa fa-bar-chart"></i></a>
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
                                                                <td><?= $value->jan ?></td>
                                                                <td><?php echo $actual_jan = App\Http\Controllers\HomeController::getjanactualexp($value->name); ?></td>
                                                                <td><?= ($value->jan - $actual_jan) ?></td>
                                                                <td><?= $value->feb ?></td>
                                                                <td><?php echo $actual_feb = App\Http\Controllers\HomeController::getfebactualexp($value->name); ?></td>
                                                                <td><?= ($value->feb - $actual_feb) ?></td>
                                                                <td><?= $value->mar ?></td>
                                                                <td><?php echo $actual_mar = App\Http\Controllers\HomeController::getmaractualexp($value->name); ?></td>
                                                                <td><?= ($value->mar - $actual_mar) ?></td>
                                                                <td><?= $value->apr ?></td>
                                                                <td><?php echo $actual_apr = App\Http\Controllers\HomeController::getapractualexp($value->name); ?></td>
                                                                <td><?= ($value->apr - $actual_apr) ?></td>
                                                                <td><?= $value->may ?></td>
                                                                <td><?php echo $actual_may = App\Http\Controllers\HomeController::getmayactualexp($value->name); ?></td>
                                                                <td><?= ($value->may - $actual_may) ?></td>
                                                                <td><?= $value->jun ?></td>
                                                                <td><?php echo $actual_jun = App\Http\Controllers\HomeController::getjunactualexp($value->name); ?></td>
                                                                <td><?= ($value->jun - $actual_jun) ?></td>
                                                                <td><?= $value->jul ?></td>
                                                                <td><?php echo $actual_jul = App\Http\Controllers\HomeController::getjulactualexp($value->name); ?></td>
                                                                <td><?= ($value->jul - $actual_jul) ?></td>
                                                                <td><?= $value->aug ?></td>
                                                                <td><?php echo $actual_aug = App\Http\Controllers\HomeController::getaugactualexp($value->name); ?></td>
                                                                <td><?= ($value->aug - $actual_aug) ?></td>
                                                                <td><?= $value->sep ?></td>
                                                                <td><?php echo $actual_sep = App\Http\Controllers\HomeController::getsepactualexp($value->name); ?></td>
                                                                <td><?= ($value->sep - $actual_sep) ?></td>
                                                                <td><?= $value->oct ?></td>
                                                                <td><?php echo $actual_oct = App\Http\Controllers\HomeController::getoctactualexp($value->name); ?></td>
                                                                <td><?= ($value->oct - $actual_oct) ?></td>
                                                                <td><?= $value->nov ?></td>
                                                                <td><?php echo $actual_nov = App\Http\Controllers\HomeController::getnovactualexp($value->name); ?></td>
                                                                <td><?= ($value->nov - $actual_nov) ?></td>
                                                                <td><?= $value->decem ?></td>
                                                                <td><?php echo $actual_decem = App\Http\Controllers\HomeController::getdecemactualexp($value->name); ?></td>
                                                                <td><?= ($value->decem - $actual_decem) ?></td>
                                                                <td> <?= $tot = ($value->jan + $value->feb + $value->mar + $value->apr + $value->may + $value->jun + $value->jul + $value->aug + $value->sep + $value->oct + $value->nov + $value->decem) ?></td>
                                                                <td><?php echo $actual_total2 = App\Http\Controllers\HomeController::gettotalactualexp($value->name); ?></td>
                                                                <td><?= ($tot-$actual_total2) ?></td>
                                                                <td>
                                                                    <a href="{{ url('expense_variance_monthly_graph2') }}/<?= $value->name ?>"><i class="fa fa-bar-chart"></i></a>
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
                                                                <a href="{{ url('projectionexp_monthly_vary_chart') }}"><i class="fa fa-bar-chart"></i></a>
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
                                </div>

                                <div class="tab-pane fade" id="tab32">
                                    <div class="">
                                        <div id="" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered table-hover" id="">
                                                    <thead>
                                                        <tr class="top-tr">
                                                            <th class="fixed-side"></th>
                                                            <th colspan="3">Jan - Mar</th>
                                                            <th colspan="3">Apr - Jun</th>
                                                            <th colspan="3">Jul - Sep</th>
                                                            <th colspan="3">Oct - Dec</th>
                                                            <th colspan="3">Total</th>
                                                            <th>Graph</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="fixed-side"></th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
                                                            <th>Actual</th>
                                                            <th>Variance</th>
                                                            <th>Projected</th>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Other Revenue</td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="total-tr">
                                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
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
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Phone</td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Electricity</td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Credit Card</td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Fuel</td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Materials & Supplies</td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Oil Purchase</td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Car Maintenance</td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="total-tr">
                                                            <td class="fixed-side"><b>Total Expenses</b></td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                    </tbody>

                                                    <tfoot>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
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
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>
                                                                <a href="#"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // requires jquery library
    jQuery(document).ready(function () {
        jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone");
    });
</script>


@endsection