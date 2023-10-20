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
                    <h4>Financial Management / Budget</h4>
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
                        <li><a href="{{ url('create_budget') }}">Create Budget Revenues</a></li>
                        <li><a href="{{ url('tab2') }}">Create Budget Expenses</a></li>
                        <li class="active"><a href="{{ url('tab3') }}">Profit/Loss Budget</a></li>
                        <li><a href="{{ url('tab4') }}">Revenue Budget</a></li>
                        <li><a href="{{ url('tab5') }}">Expenses Budget</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab3">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li><a href="{{ url('tab3') }}">Monthly</a></li>
                                <li class="active"><a href="{{ url('tab32') }}">Quarterly</a></li>
                            </ul>

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab31">
                                    <div class="">
                                        <div class="row"  style="margin: 10px 0;">
                                <div class="col-md-2">
                                    <label style="margin: 0px 0;">Choose a base year</label>
                                </div>
                                <div class="col-md-9">
                                     <?php foreach($years as $value){ ?>
                                    <a href="javascript:void(0)" data-id="<?php echo $value; ?>" id="quaterly_yearly"><span class="act"  style="margin-right: 12px;background-color: #da291c;
                                       border-color: #da291c; color: #fff; padding: 1%; border-radius: 5%">{{ $value }}</span></a>
                                    <?php } ?>
                                </div>
                            </div>
                                        <div id="" class="table-scroll">
                                             <div class="table-wrap" id="quaterlytabledata"></div>
                                            <div class="table-wrap fw2">
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
                                                            <td><?= $janmargrosstotal2 ?></td>
                                                            <td><?= $janmargrossactual ?></td>
                                                            <td><?= ($janmargrosstotal2-$janmargrossactual) ?></td>
                                                            <td><?= $aprjungrosstotal2 ?></td>
                                                            <td><?= $aprjungrossactual ?></td>
                                                            <td><?= ($aprjungrosstotal2-$aprjungrossactual) ?></td>
                                                            <td><?= $julsepgrosstotal2 ?></td>
                                                            <td><?= $julsepgrossactual ?></td>
                                                            <td><?= ($julsepgrosstotal2-$julsepgrossactual) ?></td>
                                                            <td><?= $octdecgrosstotal2 ?></td>
                                                            <td><?= $octdecgrossactual ?></td>
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
                                                            <td><?= $janmarothrevenue ?></td>
                                                            <td><?= $janmarotherrevenue ?></td>
                                                            <td><?= ($janmarothrevenue-$janmarotherrevenue) ?></td>
                                                            <td><?= $aprjunothrevenue ?></td>
                                                            <td><?= $aprjunotherrevenue ?></td>
                                                            <td><?= ($aprjunothrevenue-$aprjunotherrevenue) ?></td>
                                                            <td><?= $julsepothrevenue ?></td>
                                                            <td><?= $julsepotherrevenue ?></td>
                                                            <td><?= ($julsepothrevenue-$julsepotherrevenue) ?></td>
                                                            <td><?= $octdecothrevenue ?></td>
                                                            <td><?= $octdecotherrevenue ?></td>
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
                                                        foreach($expense as $value){
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td class="fixed-side"><?= $value->name ?></td>
                                                                <td><?= $value->janmar ?></td>
                                                                <td><?php echo $actual_janmar = App\Http\Controllers\HomeController::getjanmaractualexp($value->name); ?></td>
                                                                <td><?= ($value->janmar - $actual_janmar) ?></td>
                                                                <td><?= $value->aprjun ?></td>
                                                                <td><?php echo $actual_aprjun = App\Http\Controllers\HomeController::getaprjunactualexp($value->name); ?></td>
                                                                <td><?= ($value->aprjun - $actual_aprjun) ?></td>
                                                                <td><?= $value->julsep ?></td>
                                                                <td><?php echo $actual_julsep = App\Http\Controllers\HomeController::getjulsepactualexp($value->name); ?></td>
                                                                <td><?= ($value->julsep - $actual_julsep) ?></td>
                                                                <td><?= $value->octdec ?></td>
                                                                <td><?php echo $actual_octdec = App\Http\Controllers\HomeController::getoctdecactualexp($value->name); ?></td>
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

<script>
   $(document).on("click","#quaterly_yearly",function(){
       var year = $(this).data('id');
       // alert(year);

       $.ajax({
         url: "<?php echo url('/'); ?>/tab3_quaterly_year",
         data: 'year=' + year,
         type: "GET",
         success: function (data) {
           $('#quaterlytabledata').html(data);
           $('.fw2').hide();
           }
       });
   })
</script>

@endsection