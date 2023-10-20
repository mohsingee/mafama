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
                        <li><a href="{{ url('tab33') }}">Profit/Loss Projection</a></li>
                        <li><a href="{{ url('tab44') }}">Revenue Projection</a></li>
                        <li class="active"><a href="{{ url('tab55') }}">Expenses Projection</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab5">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="{{ url('tab55') }}">Monthly</a></li>
                                <li><a href="{{ url('tab552') }}">Quarterly</a></li>
                            </ul>

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab51">
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
                                                        foreach($revenue as $value){
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
                                                                <td><?php echo $actual_total = App\Http\Controllers\HomeController::gettotalactualexp($value->name); ?></td>
                                                                <td><?= ($tot-$actual_total) ?></td>
                                                                <td>
                                                                    <a href="{{ url('expense_variance_monthly_graph2') }}/<?= $value->name ?>"><i class="fa fa-bar-chart"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr class="total-tr">
                                                            <td class="fixed-side" style=""><b>Total Expenses</b></td>
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
                                                            <td><?= $tott = ($jantotal + $febtotal + $martotal + $aprtotal + $maytotal + $juntotal + $jultotal + $augtotal + $septotal + $octtotal + $novtotal + $dectotal) ?></td>
                                                            <td><?= $tott2 = ($jantotalactual + $febtotalactual + $martotalactual + $aprtotalactual + $maytotalactual + $juntotalactual + $jultotalactual + $augtotalactual + $septotalactual + $octtotalactual + $novtotalactual + $dectotalactual) ?></td>
                                                            <td><?= ($tott - $tott2) ?></td>
                                                            <td>
                                                                <a href="{{ url('projectionexp_monthly_vary_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab52">
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
                                                            <td class="fixed-side">Credit card</td>
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
                                                            <td class="fixed-side" style=""><b>Total Expenses</b></td>
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