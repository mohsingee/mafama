@extends('layouts.main') 
@section("content")

<style>

    .full-row td {
        border-left: 0px !important;
        border-right: 0px !important;
    }
    .full-row th {
        border-left: 0px !important;
        border-right: 0px !important;
    }
    .table-scroll {
        position: relative;
        width: 100%;
        margin: auto;
        overflow: hidden;
    }
    .table-wrap {
        width: 100%;
        overflow: auto;
    }
    .table-scroll table {
        width: 100%;
        margin: auto;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-scroll th,
    .table-scroll td {
        padding: 5px 10px;

        white-space: nowrap;
        vertical-align: top;
    }
    .table-scroll thead,
    .table-scroll tfoot {
    }
    .clone {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
    }
    .clone th,
    .clone td {
        visibility: hidden;
    }
    .clone td,
    .clone th {
    }
    .clone tbody th {
        visibility: visible;
    }
    .clone .fixed-side {
        text-align: left !important;
        visibility: visible;
    }
    .clone thead,
    .clone tfoot {
    }
    .fixed-side {
        text-align: left !important;
    }
</style>
<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Archives / Financical Management</h4>
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

                <div class="col-md-12 margin-top-40 padding-0">
                    <ul class="nav nav-tabs nav-button-tabs nav-justified">
                        <li class="active"><a href="#tab1" data-toggle="tab">Profit/Loss Budget</a></li>
                        <li><a href="#tab2" data-toggle="tab">Profit/Loss Projection</a></li>
                        <li><a href="#tab3" data-toggle="tab">Manage Assets</a></li>
                        <li><a href="#tab4" data-toggle="tab">Comparison Mode</a></li>
                        <li><a href="#tab5" data-toggle="tab">Payment/ Balance</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <!-- <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="#tab11" data-toggle="tab">Monthly</a></li>
                                <li><a href="#tab12" data-toggle="tab">Quarterly</a></li>
                            </ul> -->

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
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <!-- <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="#tab21" data-toggle="tab">Monthly</a></li>
                                <li><a href="#tab22" data-toggle="tab">Quarterly</a></li>
                            </ul> -->

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
                                                            
                                                            <?php if($ejangrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="janerevbudgt"><?= $ejangrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejangrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($ejangrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="01erevactual"><?= $ejangrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejangrossactual ?></td>
                                                            <?php } ?> 
                                                            <td><?= ($ejangrosstotal2-$ejangrossactual) ?></td>

                                                            <?php if($efebgrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="feberevbudgt"><?= $efebgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $efebgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($efebgrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="02erevactual"><?= $efebgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $efebgrossactual ?></td>
                                                            <?php } ?> 
                                                            <td><?= ($efebgrosstotal2-$efebgrossactual) ?></td>

                                                            <?php if($emargrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="marerevbudgt"><?= $emargrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $emargrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($emargrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="03erevactual"><?= $emargrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $emargrossactual ?></td>
                                                            <?php } ?> 
                                                            <td><?= ($emargrosstotal2-$emargrossactual) ?></td>

                                                            <?php if($eaprgrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="aprerevbudgt"><?= $eaprgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eaprgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($eaprgrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="04erevactual"><?= $eaprgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eaprgrossactual ?></td>
                                                            <?php } ?> 
                                                            <td><?= ($eaprgrosstotal2-$eaprgrossactual) ?></td>

                                                            <?php if($emaygrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="mayerevbudgt"><?= $emaygrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $emaygrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($emaygrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="05erevactual"><?= $emaygrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $emaygrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($emaygrosstotal2-$emaygrossactual) ?></td>

                                                            <?php if($ejungrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="junerevbudgt"><?= $ejungrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejungrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($ejungrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="06erevactual"><?= $ejungrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejungrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($ejungrosstotal2-$ejungrossactual) ?></td>

                                                            <?php if($ejulgrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="julerevbudgt"><?= $ejulgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejulgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($ejulgrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="07erevactual"><?= $ejulgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejulgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($ejulgrosstotal2-$ejulgrossactual) ?></td>

                                                            <?php if($eauggrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="augerevbudgt"><?= $eauggrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eauggrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($eauggrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="08erevactual"><?= $eauggrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eauggrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($eauggrosstotal2-$eauggrossactual) ?></td>

                                                            <?php if($esepgrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="seperevbudgt"><?= $esepgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $esepgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($esepgrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="09erevactual"><?= $esepgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $esepgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($esepgrosstotal2-$esepgrossactual) ?></td>

                                                            <?php if($eoctgrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="octerevbudgt"><?= $eoctgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eoctgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($eoctgrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="10erevactual"><?= $eoctgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eoctgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($eoctgrosstotal2-$eoctgrossactual) ?></td>

                                                            <?php if($enovgrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="noverevbudgt"><?= $enovgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $enovgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($enovgrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="11erevactual"><?= $enovgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $enovgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($enovgrosstotal2-$enovgrossactual) ?></td>

                                                            <?php if($edecgrosstotal2 != 0){ ?>
                                                                <td><a class="emonth_revenue" id="decemerevbudgt"><?= $edecgrosstotal2 ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $edecgrosstotal2 ?></td>
                                                            <?php } ?>
                                                            <?php if($edecgrossactual != 0){ ?>
                                                                <td><a class="actual_emonth_revenue" id="12erevactual"><?= $edecgrossactual ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $edecgrossactual ?></td>
                                                            <?php } ?>
                                                            <td><?= ($edecgrosstotal2-$edecgrossactual) ?></td>

                                                            <td><?= $emonthgrosstotal2 ?></td>
                                                            <td><?= $emonthgrossactual ?></td>
                                                            <td><?= ($emonthgrosstotal2-$emonthgrossactual) ?></td>
                                                            <td>
                                                                <a href="{{ url('gross_revenue_chart2') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="odd gradeX">
                                                            <td class="fixed-side">Other Revenue</td>
                                                            <?php if($ejanothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="janeotherbudgt"><?= $ejanothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejanothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($ejanotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="01eotheractual"><?= $ejanotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejanotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($ejanothrevenue-$ejanotherrevenue) ?></td>

                                                            <?php if($efebothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="febeotherbudgt"><?= $efebothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $efebothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($efebotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="02eotheractual"><?= $efebotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $efebotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($efebothrevenue-$efebotherrevenue) ?></td>

                                                            <?php if($emarothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="mareotherbudgt"><?= $emarothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $emarothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($emarotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="03eotheractual"><?= $emarotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $emarotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($emarothrevenue-$emarotherrevenue) ?></td>

                                                            <?php if($eaprothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="apreotherbudgt"><?= $eaprothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eaprothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($eaprotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="04eotheractual"><?= $eaprotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eaprotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($eaprothrevenue-$eaprotherrevenue) ?></td>

                                                            <?php if($emayothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="mayeotherbudgt"><?= $emayothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $emayothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($emayotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="05eotheractual"><?= $emayotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $emayotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($emayothrevenue-$emayotherrevenue) ?></td>

                                                            <?php if($ejunothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="juneotherbudgt"><?= $ejunothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejunothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($ejunotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="06eotheractual"><?= $ejunotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejunotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($ejunothrevenue-$ejunotherrevenue) ?></td>

                                                            <?php if($ejulothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="juleotherbudgt"><?= $ejulothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejulothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($ejulotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="07eotheractual"><?= $ejulotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $ejulotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($ejulothrevenue-$ejulotherrevenue) ?></td>

                                                            <?php if($eaugothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="augeotherbudgt"><?= $eaugothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eaugothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($eaugotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="08eotheractual"><?= $eaugotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eaugotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($eaugothrevenue-$eaugotherrevenue) ?></td>

                                                            <?php if($esepothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="sepeotherbudgt"><?= $esepothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $esepothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($esepotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="09eotheractual"><?= $esepotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $esepotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($esepothrevenue-$esepotherrevenue) ?></td>

                                                            <?php if($eoctothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="octeotherbudgt"><?= $eoctothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eoctothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($eoctotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="10eotheractual"><?= $eoctotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $eoctotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($eoctothrevenue-$eoctotherrevenue) ?></td>


                                                            <?php if($enovothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="noveotherbudgt"><?= $enovothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $enovothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($enovotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="11eotheractual"><?= $enovotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $enovotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($enovothrevenue-$enovotherrevenue) ?></td>

                                                            <?php if($edecothrevenue != 0){ ?>
                                                                <td><a class="eother_revenue" id="decemeotherbudgt"><?= $edecothrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $edecothrevenue ?></td>
                                                            <?php } ?>
                                                            <?php if($edecotherrevenue != 0){ ?>
                                                                <td><a class="actual_eother_revenue" id="12eotheractual"><?= $edecotherrevenue ?></a></td>
                                                            <?php }else{ ?>
                                                                <td><?= $edecotherrevenue ?></td>
                                                            <?php } ?>
                                                            <td><?= ($edecothrevenue-$edecotherrevenue) ?></td>

                                                            <td><?= $emonthothrevenue ?></td>
                                                            <td><?= $emonthotherrevenue ?></td>
                                                            <td><?= ($emonthothrevenue-$emonthotherrevenue) ?></td>
                                                            <td>
                                                                <a href="{{ url('other_revenue_chart2') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        <tr class="total-tr">
                                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                                            <td><?= $ejantotal ?></td>
                                                            <td><?= $ejantotalactual ?></td>
                                                            <td><?= ($ejantotal-$ejantotalactual) ?></td>
                                                            <td><?= $efebtotal ?></td>
                                                            <td><?= $efebtotalactual ?></td>
                                                            <td><?= ($efebtotal-$efebtotalactual) ?></td>
                                                            <td><?= $emartotal ?></td>
                                                            <td><?= $emartotalactual ?></td>
                                                            <td><?= ($emartotal-$emartotalactual) ?></td>
                                                            <td><?= $eaprtotal ?></td>
                                                            <td><?= $eaprtotalactual ?></td>
                                                            <td><?= ($eaprtotal-$eaprtotalactual) ?></td>
                                                            <td><?= $emaytotal ?></td>
                                                            <td><?= $emaytotalactual ?></td>
                                                            <td><?= ($emaytotal-$emaytotalactual) ?></td>
                                                            <td><?= $ejuntotal ?></td>
                                                            <td><?= $ejuntotalactual ?></td>
                                                            <td><?= ($ejuntotal-$ejuntotalactual) ?></td>
                                                            <td><?= $ejultotal ?></td>
                                                            <td><?= $ejultotalactual ?></td>
                                                            <td><?= ($ejultotal-$ejultotalactual) ?></td>
                                                            <td><?= $eaugtotal ?></td>
                                                            <td><?= $eaugtotalactual ?></td>
                                                            <td><?= ($eaugtotal-$eaugtotalactual) ?></td>
                                                            <td><?= $eseptotal ?></td>
                                                            <td><?= $eseptotalactual ?></td>
                                                            <td><?= ($eseptotal-$eseptotalactual) ?></td>
                                                            <td><?= $eocttotal ?></td>
                                                            <td><?= $eocttotalactual ?></td>
                                                            <td><?= ($eocttotal-$eocttotalactual) ?></td>
                                                            <td><?= $enovtotal ?></td>
                                                            <td><?= $enovtotalactual ?></td>
                                                            <td><?= ($enovtotal-$enovtotalactual) ?></td>
                                                            <td><?= $edectotal ?></td>
                                                            <td><?= $edectotalactual ?></td>
                                                            <td><?= ($edectotal-$edectotalactual) ?></td>
                                                            <td><?= $emonthtotal ?></td>
                                                            <td><?= $emonthtotalactual ?></td>
                                                            <td><?= ($emonthtotal-$emonthtotalactual) ?></td>
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
                                                        foreach($eexpense as $evalue){
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td class="fixed-side"><?= $evalue->name ?></td>
                                                                <?php if($evalue->jan != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="janeexpense<?= $evalue->name ?>"><?= $evalue->jan ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->jan ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_jan = App\Http\Controllers\HomeController::getjanactualexp($evalue->name);
                                                                if($eactual_jan!= 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="01eactualexpense<?= $evalue->name ?>"><?= $eactual_jan ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_jan ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->jan - $eactual_jan) ?></td>

                                                                <?php if($evalue->feb != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="febeexpense<?= $evalue->name ?>"><?= $evalue->feb ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->feb ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_feb = App\Http\Controllers\HomeController::getfebactualexp($evalue->name);
                                                                if($eactual_feb != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="02eactualexpense<?= $evalue->name ?>"><?= $eactual_feb ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_feb ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->feb - $eactual_feb) ?></td>
                                                                
                                                                <?php if($evalue->mar != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="mareexpense<?= $evalue->name ?>"><?= $evalue->mar ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->mar ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_mar = App\Http\Controllers\HomeController::getmaractualexp($evalue->name);
                                                                if($eactual_mar != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="03eactualexpense<?= $evalue->name ?>"><?= $eactual_mar ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_mar ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->mar - $eactual_mar) ?></td>

                                                                <?php if($evalue->apr != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="apreexpense<?= $evalue->name ?>"><?= $evalue->apr ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->apr ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_apr = App\Http\Controllers\HomeController::getapractualexp($evalue->name);
                                                                if($eactual_apr != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="04eactualexpense<?= $evalue->name ?>"><?= $eactual_apr ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_apr ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->apr - $eactual_apr) ?></td>


                                                                <?php if($evalue->may != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="mayeexpense<?= $evalue->name ?>"><?= $evalue->may ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->may ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_may = App\Http\Controllers\HomeController::getmayactualexp($evalue->name);
                                                                if($eactual_may != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="05eactualexpense<?= $evalue->name ?>"><?= $eactual_may ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_may ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->may - $eactual_may) ?></td>


                                                                <?php if($evalue->jun != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="juneexpense<?= $evalue->name ?>"><?= $evalue->jun ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->jun ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_jun = App\Http\Controllers\HomeController::getjunactualexp($evalue->name);
                                                                if($eactual_jun != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="06eactualexpense<?= $evalue->name ?>"><?= $eactual_jun ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_jun ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->jun - $eactual_jun) ?></td>


                                                                <?php if($evalue->jul != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="juleexpense<?= $evalue->name ?>"><?= $evalue->jul ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->jul ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_jul = App\Http\Controllers\HomeController::getjulactualexp($evalue->name);
                                                                if($eactual_jul != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="07eactualexpense<?= $evalue->name ?>"><?= $eactual_jul ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_jul ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->jul - $eactual_jul) ?></td>


                                                                <?php if($evalue->aug != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="augeexpense<?= $evalue->name ?>"><?= $evalue->aug ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->aug ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_aug = App\Http\Controllers\HomeController::getaugactualexp($evalue->name);
                                                                if($eactual_aug != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="08eactualexpense<?= $evalue->name ?>"><?= $eactual_aug ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_aug ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->aug - $eactual_aug) ?></td>


                                                                <?php if($evalue->sep != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="sepeexpense<?= $evalue->name ?>"><?= $evalue->sep ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->sep ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_sep = App\Http\Controllers\HomeController::getsepactualexp($evalue->name);
                                                                if($eactual_sep != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="09eactualexpense<?= $evalue->name ?>"><?= $eactual_sep ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_sep ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->sep - $eactual_sep) ?></td>


                                                                <?php if($evalue->oct != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="octeexpense<?= $evalue->name ?>"><?= $evalue->oct ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->oct ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_oct = App\Http\Controllers\HomeController::getoctactualexp($evalue->name);
                                                                if($eactual_oct != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="10eactualexpense<?= $evalue->name ?>"><?= $eactual_oct ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_oct ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->oct - $eactual_oct) ?></td>


                                                                <?php if($evalue->nov != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="noveexpense<?= $evalue->name ?>"><?= $evalue->nov ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->nov ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_nov = App\Http\Controllers\HomeController::getnovactualexp($evalue->name);
                                                                if($eactual_nov != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="11eactualexpense<?= $evalue->name ?>"><?= $eactual_nov ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_nov ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->nov - $eactual_nov) ?></td>


                                                                <?php if($evalue->decem != 0){ ?>
                                                                    <td><a class="emonthly_expense" id="deceemexpense<?= $evalue->name ?>"><?= $evalue->decem ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $evalue->decem ?></td>
                                                                <?php } ?>

                                                                <?php
                                                                $eactual_decem = App\Http\Controllers\HomeController::getdecemactualexp($evalue->name);
                                                                if($eactual_decem != 0){ ?>
                                                                    <td><a class="eactual_monthly_expense" id="12eactualexpense<?= $evalue->name ?>"><?= $eactual_decem ?></a></td>
                                                                <?php }else{ ?>
                                                                    <td><?= $eactual_decem ?></td>
                                                                <?php } ?>
                                                                <td><?= ($evalue->decem - $eactual_decem) ?></td>

                                                                <td> <?= $etot = ($evalue->jan + $evalue->feb + $evalue->mar + $evalue->apr + $evalue->may + $evalue->jun + $evalue->jul + $evalue->aug + $evalue->sep + $evalue->oct + $evalue->nov + $evalue->decem) ?></td>
                                                                <td><?php echo $eactual_total2 = App\Http\Controllers\HomeController::gettotalactualexp($evalue->name); ?></td>
                                                                <td><?= ($etot-$eactual_total2) ?></td>
                                                                <td>
                                                                    <a href="{{ url('expense_variance_monthly_graph2') }}/<?= $evalue->name ?>"><i class="fa fa-bar-chart"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr class="total2-tr">
                                                            <td class="fixed-side" style=""><b>Total Expense</b></td>
                                                            <td><?= $ejantotal2 ?></td>
                                                            <td><?= $ejantotal2actual ?></td>
                                                            <td><?= ($ejantotal2-$ejantotal2actual) ?></td>
                                                            <td><?= $efebtotal2 ?></td>
                                                            <td><?= $efebtotal2actual ?></td>
                                                            <td><?= ($efebtotal2-$efebtotal2actual) ?></td>
                                                            <td><?= $emartotal2 ?></td>
                                                            <td><?= $emartotal2actual ?></td>
                                                            <td><?= ($emartotal2-$emartotal2actual) ?></td>
                                                            <td><?= $eaprtotal2 ?></td>
                                                            <td><?= $eaprtotal2actual ?></td>
                                                            <td><?= ($eaprtotal2-$eaprtotal2actual) ?></td>
                                                            <td><?= $emaytotal2 ?></td>
                                                            <td><?= $emaytotal2actual ?></td>
                                                            <td><?= ($emaytotal2-$emaytotal2actual) ?></td>
                                                            <td><?= $ejuntotal2 ?></td>
                                                            <td><?= $ejuntotal2actual ?></td>
                                                            <td><?= ($ejuntotal2-$ejuntotal2actual) ?></td>
                                                            <td><?= $ejultotal2 ?></td>
                                                            <td><?= $ejultotal2actual ?></td>
                                                            <td><?= ($ejultotal2-$ejultotal2actual) ?></td>
                                                            <td><?= $eaugtotal2 ?></td>
                                                            <td><?= $eaugtotal2actual ?></td>
                                                            <td><?= ($eaugtotal2-$eaugtotal2actual) ?></td>
                                                            <td><?= $eseptotal2 ?></td>
                                                            <td><?= $eseptotal2actual ?></td>
                                                            <td><?= ($eseptotal2-$eseptotal2actual) ?></td>
                                                            <td><?= $eocttotal2 ?></td>
                                                            <td><?= $eocttotal2actual ?></td>
                                                            <td><?= ($eocttotal2-$eocttotal2actual) ?></td>
                                                            <td><?= $enovtotal2 ?></td>
                                                            <td><?= $enovtotal2actual ?></td>
                                                            <td><?= ($enovtotal2-$enovtotal2actual) ?></td>
                                                            <td><?= $edectotal2 ?></td>
                                                            <td><?= $edectotal2actual ?></td>
                                                            <td><?= ($edectotal2-$edectotal2actual) ?></td>
                                                            <td><?= $etott = ($ejantotal2 + $efebtotal2 + $emartotal2 + $eaprtotal2 + $emaytotal2 + $ejuntotal2 + $ejultotal2 + $eaugtotal2 + $eseptotal2 + $eocttotal2 + $enovtotal2 + $edectotal2) ?></td>
                                                            <td><?= $etott2 = ($ejantotal2actual + $efebtotal2actual + $emartotal2actual + $eaprtotal2actual + $emaytotal2actual + $ejuntotal2actual + $ejultotal2actual + $eaugtotal2actual + $eseptotal2actual + $eocttotal2actual + $enovtotal2actual + $edectotal2actual) ?></td>
                                                            <td><?= ($etott - $etott2) ?></td>
                                                            <td>
                                                                <a href="{{ url('projectionexp_monthly_vary_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                                                            <td><?= ($ejantotal-$ejantotal2) ?></td>
                                                            <td><?= ($ejantotalactual-$ejantotal2actual) ?></td>
                                                            <td><?= (($ejantotal-$ejantotal2)-($ejantotalactual-$ejantotal2actual)) ?></td>
                                                            <td><?= ($efebtotal-$efebtotal2) ?></td>
                                                            <td><?= ($efebtotalactual-$efebtotal2actual) ?></td>
                                                            <td><?= (($efebtotal-$efebtotal2)-($efebtotalactual-$efebtotal2actual)) ?></td>
                                                            <td><?= ($emartotal-$emartotal2) ?></td>
                                                            <td><?= ($emartotalactual-$emartotal2actual) ?></td>
                                                            <td><?= (($emartotal-$emartotal2)-($emartotalactual-$emartotal2actual)) ?></td>
                                                            <td><?= ($eaprtotal-$eaprtotal2) ?></td>
                                                            <td><?= ($eaprtotalactual-$eaprtotal2actual) ?></td>
                                                            <td><?= (($eaprtotal-$eaprtotal2)-($eaprtotalactual-$eaprtotal2actual)) ?></td>
                                                           <td><?= ($emaytotal-$emaytotal2) ?></td>
                                                            <td><?= ($emaytotalactual-$emaytotal2actual) ?></td>
                                                            <td><?= (($emaytotal-$emaytotal2)-($emaytotalactual-$emaytotal2actual)) ?></td>
                                                            <td><?= ($ejuntotal-$ejuntotal2) ?></td>
                                                            <td><?= ($ejuntotalactual-$ejuntotal2actual) ?></td>
                                                            <td><?= (($ejuntotal-$ejuntotal2)-($ejuntotalactual-$ejuntotal2actual)) ?></td>
                                                            <td><?= ($ejultotal-$ejultotal2) ?></td>
                                                            <td><?= ($ejultotalactual-$ejultotal2actual) ?></td>
                                                            <td><?= (($ejultotal-$ejultotal2)-($ejultotalactual-$ejultotal2actual)) ?></td>
                                                            <td><?= ($eaugtotal-$eaugtotal2) ?></td>
                                                            <td><?= ($eaugtotalactual-$eaugtotal2actual) ?></td>
                                                            <td><?= (($eaugtotal-$eaugtotal2)-($eaugtotalactual-$eaugtotal2actual)) ?></td>
                                                            <td><?= ($eseptotal-$eseptotal2) ?></td>
                                                            <td><?= ($eseptotalactual-$eseptotal2actual) ?></td>
                                                            <td><?= (($eseptotal-$eseptotal2)-($eseptotalactual-$eseptotal2actual)) ?></td>
                                                            <td><?= ($eocttotal-$eocttotal2) ?></td>
                                                            <td><?= ($eocttotalactual-$eocttotal2actual) ?></td>
                                                            <td><?= (($eocttotal-$eocttotal2)-($eocttotalactual-$eocttotal2actual)) ?></td>
                                                            <td><?= ($enovtotal-$enovtotal2) ?></td>
                                                            <td><?= ($enovtotalactual-$enovtotal2actual) ?></td>
                                                            <td><?= (($enovtotal-$enovtotal2)-($enovtotalactual-$enovtotal2actual)) ?></td>
                                                            <td><?= ($edectotal-$edectotal2) ?></td>
                                                            <td><?= ($edectotalactual-$edectotal2actual) ?></td>
                                                            <td><?= (($edectotal-$edectotal2)-($edectotalactual-$edectotal2actual)) ?></td>
                                                            <td><?= ($emonthtotal-$etott) ?></td>
                                                            <td><?= ($emonthtotalactual-$etott2) ?></td>
                                                            <td><?= (($emonthtotal-$etott)-($emonthtotalactual-$etott2)) ?></td>
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
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div id="monthly_details2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab3">
                            <!-- <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="#tab31" data-toggle="tab">Monthly</a></li>
                                <li><a href="#tab32" data-toggle="tab">Quarterly</a></li>
                            </ul> -->

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab31">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="">
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
                                                <?php
                                                $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                                foreach($assets as $value){
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $value->description ?></td>
                                                    <?php
                                                    $tot = 0;
                                                        foreach ($months_arr as $valuee) {
                                                            $appcount = \App\Http\Controllers\HomeController::finance_get_month_count($valuee, $value->description);

                                                            $tot += $appcount;
                                                            if($appcount > 0){
                                                                echo '<td><a class="month_asset_details" id="'.$valuee.'asset'.$value->description.'">'.$appcount.'</a></td>';
                                                            }
                                                            else{
                                                                echo '<td>'.$appcount.'</td>';
                                                            }
                                                        }
                                                    ?>
                                                    <td><?= $tot ?></td>
                                                    <td>
                                                        <a href="{{ url('monthly_asset_chartt') }}/<?= $value->description ?>"><i class="fa fa-bar-chart"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade in" id="tab32">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="">
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
                                                <?php
                                                $months_arr = ['01','04','07','10']; 
                                                foreach($assets as $value){
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $value->description ?></td>
                                                    <?php
                                                    $tot = 0;
                                                        foreach ($months_arr as $valuee) {
                                                            $appcount = \App\Http\Controllers\HomeController::finance_get_quarterly_count($valuee, $value->description);

                                                            $tot += $appcount;

                                                            echo '<td>'.$appcount.'</td>';
                                                        }
                                                    ?>
                                                    <td><?= $tot ?></td>
                                                    <td>
                                                        <a href="{{ url('monthly_asset_chartt') }}/<?= $value->description ?>"><i class="fa fa-bar-chart"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
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

                        <div class="tab-pane fade" id="tab4">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="#tab41" data-toggle="tab">Monthly</a></li>
                                <li><a href="#tab42" data-toggle="tab">Quarterly</a></li>
                            </ul>

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab41">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="">
                                            <thead>
                                                <tr>
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

                                <div class="tab-pane" id="tab42">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="">
                                            <thead>
                                                <tr>
                                                    <th>Jan - Mar</th>
                                                    <th>Apr - Jun</th>
                                                    <th>Jul - Sep</th>
                                                    <th>Oct - Dec</th>
                                                    <th>Total</th>
                                                    <th>Graph</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX">
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

                        <div class="tab-pane fade" id="tab5">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="#tab51" data-toggle="tab">Monthly</a></li>
                                <li><a href="#tab52" data-toggle="tab">Quarterly</a></li>
                            </ul>

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab51">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="">
                                            <thead>
                                                <tr>
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

                                <div class="tab-pane" id="tab52">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="">
                                            <thead>
                                                <tr>
                                                    <th>Jan - Mar</th>
                                                    <th>Apr - Jun</th>
                                                    <th>Jul - Sep</th>
                                                    <th>Oct - Dec</th>
                                                    <th>Total</th>
                                                    <th>Graph</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX">
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
    $(document).on("click", ".emonth_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('erevbudgt');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/erevenue_budget_details";

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
    $(document).on("click", ".actual_emonth_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('erevactual');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/erevenue_actual_details";

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
    
    $(document).on("click", ".eother_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('eotherbudgt');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/eother_revenue_monthly_details";

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
    $(document).on("click", ".actual_eother_revenue", function(){
        var idd = $(this).attr('id');
        var id = idd.split('eotheractual');
        var month = id[0];
        // alert(month);
        var url = "<?php echo url('/'); ?>/eother_revenue_actual_details";

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
    $(document).on("click", ".emonthly_expense", function(){
        var idd = $(this).attr('id');
        var id = idd.split('eexpense');
        var month = id[0];
        var name = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/emonthly_expense_details";

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
    $(document).on("click", ".eactual_monthly_expense", function(){
        var idd = $(this).attr('id');
        var id = idd.split('eactualexpense');
        var month = id[0];
        var name = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/eexpense_actual_details";

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
    
    $(document).on("click", ".month_asset_details", function(){
        var idd = $(this).attr('id');
        var id = idd.split('asset');
        var month = id[0];
        var name = id[1];
        // alert(month);
        var url = "<?php echo url('/'); ?>/monthly_asset_details";

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
                $("#monthly_details3").html(response);
            },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
        });
    });
</script>

@endsection