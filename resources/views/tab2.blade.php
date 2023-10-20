@extends('layouts.main')
@section("content")
   <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>
<style>
    /* .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border-left: 1px solid #0b0b0b !important;
    border-right: 1px solid #0b0b0b !important;
}
.table>tbody>tr>td:first-child {
    border-left: 1px solid #cecece !important;
}
.table>thead>tr>th:last-child {
    border-right: 1px solid #cecece !important;
}
.table>tbody>tr>td:last-child {
    border-right: 1px solid #cecece !important;
} */
.btn-info[disabled] {
    background-color: #379fbd;
    border-color: #2e86a1;
    color: black !important;
    opacity: 1 !important;
}
.morris-hover-point {
    display: none;
}
text {
    display: none !important;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px 2px;
    line-height: 1.42857143;
    vertical-align: middle;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.form-control{
    height: 25px;
    padding: 2px;
}
table button, table input[type=text] {
    height: 25px !important;
    margin: 2px 0;
    min-width: 120px;
}
.table-scroll table{
        border-collapse: collapse;
}
tr select{
    min-width: 120px;
}
select[disabled] {
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 0.01px;
    text-overflow: '';
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
                        <li class="active"><a href="{{ url('tab2') }}">Create Budget Expenses</a></li>
                        <li><a href="{{ url('tab3') }}">Profit/Loss Budget</a></li>
                        <li><a href="{{ url('tab4') }}">Revenue Budget</a></li>
                        <li><a href="{{ url('tab5') }}">Expenses Budget</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <div class="col-md-9">
                                <p><b>Note: </b> dummy text</p>
                            </div>
                            <div class="col-md-3">
                                <label class="switch switch-danger switch-round pull-right">
                                    <b>Notification </b>
                                    <input type="checkbox" checked="" />
                                    <span class="switch-label" data-on="ON" data-off="OFF"></span>
                                </label>
                            </div>
                            <div class="clearfix"></div>

                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li class="active"><a href="#tab11" data-toggle="tab">Monthly</a></li>
                                <li><a href="#tab12" data-toggle="tab">Quarterly</a></li>
                            </ul>

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab11">
                                    <div class="">
                                        <div class="row"  style="margin: 10px 0;">
                                <div class="col-md-2">
                                    <label style="margin: 0px 0;">Choose a base year</label>
                                </div>
                                <div class="col-md-9">
                                    <?php foreach($years as $value){ ?>
                                        <a href="javascript:void(0)" id="yearlist" data-id="<?php echo $value; ?>"><span class="act"  style="margin-right: 12px;background-color: #da291c;
    border-color: #da291c; color: #fff; padding: 1%; border-radius: 5%">{{ $value }}</span></a>
                                    <?php } ?>
                                </div>
                            </div>
                                 <div class="table-wrap" id="tabledata"></div>

                                        <div id="table-scroll" class="table-scroll fw1">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered table-hover main-table" id="">
                                                    <thead>
                                                        <tr>
                                                            <th class=""></th>
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
                                                        <tr>
                                                            <th class="">
                                                                <!-- <a href="javascript:void(0);" class="add_button" title="Add field">
                                                                    <span class="glyphicon glyphicon-plus" style="text-align: center; color: white; font-size: 20px; font-weight: bold"></span>
                                                                </a> -->
                                                            </th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th>Budget</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="field_wrapper">
                                                        <?php
                                                            $currmon = date('m');
                                                            foreach ($revenue as $value) {
                                                        ?>
                                                                <tr class="odd gradeX monthly" id="row<?= $value->id ?>">
                                                                    <!-- <td class=""></td> -->
                                                                    <td class="budget_name">
                                                                        <!-- <select class="form-control" required disabled>
                                                                            <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                                                        </select>
                                                                        <p style="color: red; text-align: left; margin-bottom: 2px; display: none">*required</p> -->
                                                                        <b style="padding: 0 10px" class="bname"><?= $value->name ?></b>
                                                                    </td>
                                                                    <td class="jan">
                                                                        <input type="number" class="form-control" value="<?= $value->jan ?>" id="jan<?= $value->id ?>" <?php if($currmon >= "01"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="feb">
                                                                        <input type="number" class="form-control" value="<?= $value->feb ?>" id="feb<?= $value->id ?>" <?php if($currmon >= "02"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="mar">
                                                                        <input type="number" class="form-control" value="<?= $value->mar ?>" id="mar<?= $value->id ?>" <?php if($currmon >= "03"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="apr">
                                                                        <input type="number" class="form-control" value="<?= $value->apr ?>" id="apr<?= $value->id ?>" <?php if($currmon >= "04"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="may">
                                                                        <input type="number" class="form-control" value="<?= $value->may ?>" id="may<?= $value->id ?>" <?php if($currmon >= "05"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="jun">
                                                                        <input type="number" class="form-control" value="<?= $value->jun ?>" id="jun<?= $value->id ?>" <?php if($currmon >= "06"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="jul">
                                                                        <input type="number" class="form-control" value="<?= $value->jul ?>" id="jul<?= $value->id ?>" <?php if($currmon >= "07"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="aug">
                                                                        <input type="number" class="form-control" value="<?= $value->aug ?>" id="aug<?= $value->id ?>" <?php if($currmon >= "08"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="sep">
                                                                        <input type="number" class="form-control" value="<?= $value->sep ?>" id="sep<?= $value->id ?>" <?php if($currmon >= "09"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="oct">
                                                                        <input type="number" class="form-control" value="<?= $value->oct ?>" id="oct<?= $value->id ?>" <?php if($currmon >= "10"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="nov">
                                                                        <input type="number" class="form-control" value="<?= $value->nov ?>" id="nov<?= $value->id ?>" <?php if($currmon >= "11"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="dec">
                                                                        <input type="number" class="form-control" value="<?= $value->decem ?>" id="dec<?= $value->id ?>" <?php if($currmon >= "12"){ ?> readonly <?php } ?>>
                                                                    </td>
                                                                    <td class="budg_total">
                                                                        <?= ($value->jan + $value->feb + $value->mar + $value->apr + $value->may + $value->jun + $value->jul + $value->aug + $value->sep + $value->oct + $value->nov + $value->decem) ?>
                                                                    </td>
                                                                    <td class="showgraph" id="showgraph<?= $value->id ?>">
                                                                        <a href="{{ url('monthly_expense_chart') }}/<?= $value->id ?>"><div id="bar-chart<?= $value->id ?>" style="height: 20px; width: 50px"></div></a>
                                                                        <script type="text/javascript">
                                                                                  $(function () {
                                                                                        "use strict";

                                                                                        //BAR CHART
                                                                                        var bar = new Morris.Bar({
                                                                                          element: 'bar-chart<?= $value->id ?>',
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
                                                    </tbody>
                                                    <?php if($revenue_count == 0){ $style = "style='display:none'"; }else{ $style = "style=''"; } ?>
                                                    <tbody class="sectbody" <?= $style ?>>
                                                        <tr class="odd gradeX">

                                                            <!-- <td></td> -->
                                                            <td style="text-align:left; color:#da291c; padding: 10px; font-weight: bold">Total</td>
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
                                                            <td id="budget_total"><?= $monthtotal ?></td>

                                                            <td class="chart_monthly">
                                                                <a href="{{ url('total_monthly_expense_chart') }}"><div id="bar-chart_total" style="height: 20px; width: 50px"></div></a>
                                                                        <script type="text/javascript">
                                                                          $(function () {
                                                                                "use strict";

                                                                                //BAR CHART
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
                                                        <tr class="odd gradeX">
                                                            <!-- <td></td> -->
                                                            <td></td>
                                                            <td>
                                                                <a id="jansave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "01"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="febsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "02"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="marsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "03"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="aprsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "04"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="maysave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "05"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="junsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "06"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="julsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "07"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="augsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "08"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="sepsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "09"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="octsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "10"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="novsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "11"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td>
                                                                <a id="decsave" class="btn btn-info btn-xs savebtnmonth" style="width:60px;" <?php if($currmon >= "12"){ ?> disabled <?php } ?>>Save</a><br>
                                                                <!-- <a href="#" class="btn btn-info btn-xs" style="margin-top:5px;width:60px;">Edit</a> -->
                                                            </td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab12">
                                    <div class="row"  style="margin: 10px 0;">
                                <div class="col-md-2">
                                    <label style="margin: 0px 0;">Choose a base year</label>
                                </div>
                                <div class="col-md-9">
                                    <?php foreach($years as $value){ ?>
                                        <a href="javascript:void(0)" id="quaterly_yearly" data-id="<?php echo $value; ?>"><span class="act"  style="margin-right: 12px;background-color: #da291c;
    border-color: #da291c; color: #fff; padding: 1%; border-radius: 5%">{{ $value }}</span></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div  class="table-responsive" id="quaterlytabledata">

                           </div>
                                    <div class="table-responsive fw2" style="overflow-x: hidden; overflow-y: hidden">
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
                                                <tr>
                                                    <th class="">
                                                        <!-- <a href="javascript:void(0);" class="add_button2" title="Add field">
                                                            <span class="glyphicon glyphicon-plus" style="text-align: center; color: white; font-size: 20px; font-weight: bold"></span>
                                                        </a> -->
                                                    </th>
                                                    <th>Budget</th>
                                                    <th>Budget</th>
                                                    <th>Budget</th>
                                                    <th>Budget</th>
                                                    <th>Budget</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="field_wrapper2">
                                                <?php
                                                    foreach ($revenue_quaterly as $value) {
                                                ?>
                                                        <tr class="odd gradeX quarterly" id="roww<?= $value->id ?>">
                                                            <!-- <td class=""></td> -->
                                                            <td class="budget_name">
                                                                <!-- <select class="form-control" required disabled>
                                                                    <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                                                </select>
                                                                <p style="color: red; text-align: left; margin-bottom: 2px; display: none">*required</p> -->
                                                                <b style="padding: 0 10px" class="bname"><?= $value->name ?></b>
                                                            </td>
                                                            <td class="janmar">
                                                                <input type="number" class="form-control" value="<?= $value->janmar ?>" id="janmar<?= $value->id ?>" readonly>
                                                            </td>
                                                            <td class="aprjun">
                                                                <input type="number" class="form-control" value="<?= $value->aprjun ?>" id="aprjun<?= $value->id ?>" readonly>
                                                            </td>
                                                            <td class="julsep">
                                                                <input type="number" class="form-control" value="<?= $value->julsep ?>" id="julsep<?= $value->id ?>" readonly>
                                                            </td>
                                                            <td class="octdec">
                                                                <input type="number" class="form-control" value="<?= $value->octdec ?>" id="octdec<?= $value->id ?>" readonly>
                                                            </td>

                                                            <td class="budg_total2">
                                                                <?= ($value->janmar + $value->aprjun + $value->julsep + $value->octdec) ?>
                                                            </td>
                                                            <td class="showgraphq" id="showgraphq<?= $value->id ?>">
                                                                <a href="{{ url('quarterly_expense_chart') }}/<?= $value->id ?>"><div id="bar-chartq<?= $value->id ?>" style="height: 20px; width: 30px"></div></a>
                                                                <script type="text/javascript">
                                                                  $(function () {
                                                                        "use strict";

                                                                        //BAR CHART
                                                                        var bar = new Morris.Bar({
                                                                          element: 'bar-chartq<?= $value->id ?>',
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
                                            </tbody>
                                            <?php if($revenue_quaterly_count == 0){ $style2 = "style='display:none'"; }else{ $style2 = "style=''"; } ?>
                                            <tbody class="sectbody2" <?= $style2 ?>>
                                                <tr class="odd gradeX">

                                                    <!-- <td></td> -->
                                                    <td style="text-align:left; color:#da291c; padding: 10px; font-weight: bold">Total</td>
                                                    <td id="janmartotal"><?= $janmartotal ?></td>
                                                    <td id="aprjuntotal"><?= $aprjuntotal ?></td>
                                                    <td id="julseptotal"><?= $julseptotal ?></td>
                                                    <td id="octdectotal"><?= $octdectotal ?></td>
                                                    <td id="budget_total"><?= $quaterlytotal ?></td>

                                                    <td class="chart_quarterly">
                                                        <a href="{{ url('total_quarterly_expense_chart') }}"><div id="bar-chart_totalq" style="height: 20px; width: 30px"></div></a>
                                                        <script type="text/javascript">
                                                          $(function () {
                                                                "use strict";

                                                                //BAR CHART
                                                                var bar = new Morris.Bar({
                                                                  element: 'bar-chart_totalq',
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
                                                <!-- <tr class="odd gradeX">
                                                    <td></td>
                                                    <td>
                                                        <a id="janmarsave" class="btn btn-info btn-xs savebtnquarter" style="width:60px;">Save</a><br>
                                                    </td>
                                                    <td>
                                                        <a id="aprjunsave" class="btn btn-info btn-xs savebtnquarter" style="width:60px;">Save</a><br>
                                                    </td>
                                                    <td>
                                                        <a id="julsepsave" class="btn btn-info btn-xs savebtnquarter" style="width:60px;">Save</a><br>
                                                    </td>
                                                    <td>
                                                        <a id="octdecsave" class="btn btn-info btn-xs savebtnquarter" style="width:60px;">Save</a><br>
                                                    </td>
                                                    <td></td>
                                                    <td></td>

                                                </tr> -->
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

<script>
    // requires jquery library
    jQuery(document).ready(function () {
        jQuery(".main-table").clone(true).appendTo(".table-scroll").addClass("clone");
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 5000;
    var addButton = $('.add_button');
    var wrapper = $('.field_wrapper');
    var addButton2 = $('.add_button2');
    var wrapper2 = $('.field_wrapper2');

    var revenue_count = "<?= $revenue_count ?>";
    var x = parseFloat(revenue_count) + 1;

    var revenue_quaterly_count = "<?= $revenue_quaterly_count ?>";
    var y = parseFloat(revenue_quaterly_count) + 1;


    $(addButton).click(function(){
        $.ajax({
              url: "<?php echo url('/'); ?>/create_expenses_names",
              data: 'x=' + x + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                // fldhtml = response;
                var fieldHTML = '<tr class="odd gradeX monthly" id="row'+x+'"><td><a href="javascript:void(0);" class="remove_button"> <span class="glyphicon glyphicon-minus" style="text-align: center;font-size: 20px; font-weight: bold"></span></a></td><td class="budget_name">'+response+'<p style="color: red; text-align: left; margin-bottom: 2px; display: none">*required</p></td><td class="jan"><input type="number" class="form-control" value="0" id="jan'+x+'"></td><td class="feb"><input type="number" class="form-control" value="0" id="feb'+x+'"></td><td class="mar"><input type="number" class="form-control" value="0"  id="mar'+x+'"></td><td class="apr"><input type="number" class="form-control" value="0"  id="apr'+x+'"></td><td class="may"><input type="number" class="form-control" value="0" id="may'+x+'"></td><td class="jun"><input type="number" class="form-control" value="0" id="jun'+x+'"></td><td class="jul"><input type="number" class="form-control" value="0" id="jul'+x+'"></td><td class="aug"><input type="number" class="form-control" value="0" id="aug'+x+'"></td><td class="sep"><input type="number" class="form-control" value="0" id="sep'+x+'"></td><td class="oct"><input type="number" class="form-control" value="0" id="oct'+x+'"></td><td class="nov"><input type="number" class="form-control" value="0" id="nov'+x+'"></td><td class="dec"><input type="number" class="form-control" value="0" id="dec'+x+'"></td><td class="budg_total">0</td><td class="showgraph" id="showgraph'+x+'"></td></tr>';
                if(x < maxField){
                    x++;
                    $(wrapper).append(fieldHTML);
                    $(".sectbody").show();
                }
            }
        });

    });

    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).closest("tr").remove();
        x--;
        var month_array = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
        var i;
        var totv = 0
        for (i = 0; i <= 11; i++) {
            for(var j = 1; j < 500; j++){
                var price = $("#"+month_array[i]+j).val();
                // alert(price);
                if(price != null){
                    totv = parseFloat(totv) + parseFloat(price);
                }
            }
           $("#"+month_array[i]+"total").html(totv);
           totv = 0;
        }
        var jantotal = $("#jantotal").html();
        var febtotal = $("#febtotal").html();
        var martotal = $("#martotal").html();
        var aprtotal = $("#aprtotal").html();
        var maytotal = $("#maytotal").html();
        var juntotal = $("#juntotal").html();
        var jultotal = $("#jultotal").html();
        var augtotal = $("#augtotal").html();
        var septotal = $("#septotal").html();
        var octtotal = $("#octtotal").html();
        var novtotal = $("#novtotal").html();
        var dectotal = $("#dectotal").html();
       $.ajax({
              url: "<?php echo url('/'); ?>/getremovedgraph",
              data: 'jantotal=' + jantotal + '&febtotal=' + febtotal + '&martotal=' + martotal + '&aprtotal=' + aprtotal + '&maytotal=' + maytotal + '&juntotal=' + juntotal + '&jultotal=' + jultotal + '&augtotal=' + augtotal + '&septotal=' + septotal + '&octtotal=' + octtotal + '&novtotal=' + novtotal + '&dectotal=' + dectotal + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".chart_monthly").html(response)
            }
        });
    });


    $(addButton2).click(function(){
        $.ajax({
              url: "<?php echo url('/'); ?>/create_quarterlyexpenses_names",
              data: 'x=' + x + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                // fldhtml = response;
                var fieldHTML2 = '<tr class="odd gradeX quarterly" id="roww'+y+'"><td><a href="javascript:void(0);" class="remove_button2"> <span class="glyphicon glyphicon-minus" style="text-align: center;font-size: 20px; font-weight: bold"></span></a></td><td class="budget_name">'+response+'<p style="color: red; text-align: left; margin-bottom: 2px; display: none">*required</p></td><td class="janmar"><input type="number" class="form-control" value="0" id="janmar'+y+'"></td><td class="aprjun"><input type="number" class="form-control" value="0" id="aprjun'+y+'"></td><td class="julsep"><input type="number" class="form-control" value="0" id="julsep'+y+'"></td><td class="octdec"><input type="number" class="form-control" value="0" id="octdec'+y+'"></td><td class="budg_total2">0</td><td class="showgraphq" id="showgraphq'+y+'"></td></tr>';

                if(y < maxField){
                    y++;
                    $(wrapper2).append(fieldHTML2);
                    $(".sectbody2").show();
                }
            }
        });

    });

    $(wrapper2).on('click', '.remove_button2', function(e){
        e.preventDefault();
        $(this).closest("tr").remove();
        y--;
        var month_array = ['janmar','aprjun','julsep','octdec'];
        var i;
        var totv = 0
        for (i = 0; i <= 3; i++) {
            for(var j = 1; j < 500; j++){
                var price = $("#"+month_array[i]+j).val();
                // alert(price);
                if(price != null){
                    totv = parseFloat(totv) + parseFloat(price);
                }
            }
           $("#"+month_array[i]+"total").html(totv);
           totv = 0;
        }
        var janmartotal = $("#janmartotal").html();
        var aprjuntotal = $("#aprjuntotal").html();
        var julseptotal = $("#julseptotal").html();
        var octdectotal = $("#octdectotal").html();
       $.ajax({
              url: "<?php echo url('/'); ?>/getremovedgraphquarterly",
              data: 'janmartotal=' + janmartotal + '&aprjuntotal=' + aprjuntotal + '&julseptotal=' + julseptotal + '&octdectotal=' + octdectotal + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                $(".chart_quarterly").html(response)
            }
        });
    });
});
</script>
<script type="text/javascript">
    $(document).on("change",".monthly input[type=number]", function(){
    // $(".monthly input[type=number]").change(function(){
        // alert("hi");
      var month = $(this).closest('td').attr("class");
      var main_row = $(this).closest('tr').attr("id");
      // alert($(this).val());
      $("#"+main_row).children('.'+month).val($(this).val());
      // alert($("#"+main_row).children('.'+month).val());
      var total_row = $("#"+main_row).children('.budg_total').html();
      var jan = $("#"+main_row).children('.jan').children('input').val();
      var feb = $("#"+main_row).children('.feb').children('input').val();
      var mar = $("#"+main_row).children('.mar').children('input').val();
      var apr = $("#"+main_row).children('.apr').children('input').val();
      var may = $("#"+main_row).children('.may').children('input').val();
      var jun = $("#"+main_row).children('.jun').children('input').val();
      var jul = $("#"+main_row).children('.jul').children('input').val();
      var aug = $("#"+main_row).children('.aug').children('input').val();
      var sep = $("#"+main_row).children('.sep').children('input').val();
      var oct = $("#"+main_row).children('.oct').children('input').val();
      var nov = $("#"+main_row).children('.nov').children('input').val();
      var dec = $("#"+main_row).children('.dec').children('input').val();
      var new_total_row = parseFloat(jan) + parseFloat(feb) + parseFloat(mar) + parseFloat(apr) + parseFloat(may) + parseFloat(jun) + parseFloat(jul) + parseFloat(aug) + parseFloat(sep) + parseFloat(oct) + parseFloat(nov) + parseFloat(dec);
      $("#"+main_row).children('.budg_total').html(new_total_row);
        var mon_total = 0;
        // $('.'+month).each(function() {
        //     // alert("hi");
        //     mon_total = parseFloat(mon_total) + parseFloat($(this).children('input').val());
        // });
        // var maxcnt = $("."+month).length;
        var revenue_count = "<?= $revenue_count ?>";
        var maxcnt = parseFloat(revenue_count) + 1;
        // alert(maxcnt);
        for(var i = 1; i < 500; i++){
            var price = $("#"+month+i).val();
            // alert(price);
            if(price != null){
                mon_total = parseFloat(mon_total) + parseFloat(price);
            }
        }
       $("#"+month+"total").html(mon_total);
       var iid = $("#"+main_row).children('.showgraph').attr("id");
        var idd = iid.split('showgraph');
        var id = idd[1];
        var jantotal = $("#jantotal").html();
        var febtotal = $("#febtotal").html();
        var martotal = $("#martotal").html();
        var aprtotal = $("#aprtotal").html();
        var maytotal = $("#maytotal").html();
        var juntotal = $("#juntotal").html();
        var jultotal = $("#jultotal").html();
        var augtotal = $("#augtotal").html();
        var septotal = $("#septotal").html();
        var octtotal = $("#octtotal").html();
        var novtotal = $("#novtotal").html();
        var dectotal = $("#dectotal").html();
       $.ajax({
              url: "<?php echo url('/'); ?>/getgraphexp",
              data: 'id=' + id + '&jan=' + jan + '&feb=' + feb + '&mar=' + mar + '&apr=' + apr + '&may=' + may + '&jun=' + jun + '&jul=' + jul + '&aug=' + aug + '&sep=' + sep + '&oct=' + oct + '&nov=' + nov + '&dec=' + dec + '&jantotal=' + jantotal + '&febtotal=' + febtotal + '&martotal=' + martotal + '&aprtotal=' + aprtotal + '&maytotal=' + maytotal + '&juntotal=' + juntotal + '&jultotal=' + jultotal + '&augtotal=' + augtotal + '&septotal=' + septotal + '&octtotal=' + octtotal + '&novtotal=' + novtotal + '&dectotal=' + dectotal + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#"+main_row).children('.showgraph').html(response[0]);
                $(".chart_monthly").html(response[1])
            }
        });
    });
    // $(".savebtnmonth").click(function(){

        $(document).on('click','.savebtnmonth',function(){
            // alert("ok");
         var disabled = $(this).attr("disabled");
        if(disabled != "disabled"){
            var idd = $(this).attr("id");
            var iddd = idd.split("save");
            var month = iddd[0];
            // alert(month);
            var cnt = 0;
            var names = [];
            var prices = [];
            // $('.'+month).each(function() {
            //     var main_row = $(this).closest('tr').attr("id");
            //     alert(main_row);
            //     var name = $("#"+main_row).children('.budget_name').children('input').val();
            //     var price = $(this).children('input').val();
            //     if(name == ""){
            //         cnt++;
            //         $("#"+main_row).children('.budget_name').children('p').show();
            //     }
            //     else{
            //         $("#"+main_row).children('.budget_name').children('p').hide();
            //         // alert(name);
            //         names.push(name);
            //         prices.push(price);
            //         // alert(names);
            //     }
            // });
            var revenue_count = "<?= $revenue_count ?>";
            var maxcnt = parseFloat(revenue_count) + 1;
            for(var i = 1; i < (maxcnt+1); i++){
                var main_row = $("#"+month+i).closest('tr').attr("id");
                // alert(main_row);
                if(main_row != null){
                    // var name = $("#"+main_row).children('.budget_name').children('select').val();
                    var name = $("#"+main_row).children('.budget_name').children('.bname').html();
                    var price = $("#"+month+i).val();
                    if(name == ""){
                        cnt++;
                        $("#"+main_row).children('.budget_name').children('p').show();
                    }
                    else{
                        $("#"+main_row).children('.budget_name').children('p').hide();
                        names.push(name);
                        prices.push(price);
                    }
                }
            }
            if(cnt == 0){
                var url = "<?php echo url('/'); ?>/create_expense_monthly";
                $.ajax({
                      url: url,
                      data: 'names=' + names + '&prices=' + prices + '&month=' + month + '&_token={{ csrf_token() }}',
                      type: "POST",
                    success: function (response) {
                        // alert(response);
                        $(".remove_button").hide();
                        $("select").attr("disabled", true);
                        // alert("Saved Successfully.");
                        // location.reload();
                        redirect_notify("Submitted Successfully."," ",location.reload(),"success");

                    }
                });
            }
        }
    });
    // var mont = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];




    $(document).on("change",".quarterly input[type=number]", function(){
      var month = $(this).closest('td').attr("class");
      var main_row = $(this).closest('tr').attr("id");
      $("#"+main_row).children('.'+month).val($(this).val());
      var total_row = $("#"+main_row).children('.budg_total2').html();
      var janmar = $("#"+main_row).children('.janmar').children('input').val();
      var aprjun = $("#"+main_row).children('.aprjun').children('input').val();
      var julsep = $("#"+main_row).children('.julsep').children('input').val();
      var octdec = $("#"+main_row).children('.octdec').children('input').val();
      var new_total_row = parseFloat(janmar) + parseFloat(aprjun) + parseFloat(julsep) + parseFloat(octdec);
      $("#"+main_row).children('.budg_total2').html(new_total_row);
        var mon_total = 0;
        var revenue_quaterly_count = "<?= $revenue_quaterly_count ?>";
        var maxcnt = parseFloat(revenue_quaterly_count) + 1;
        for(var i = 1; i < 500; i++){
            var price = $("#"+month+i).val();
            if(price != null){
                mon_total = parseFloat(mon_total) + parseFloat(price);
            }
        }
       $("#"+month+"total").html(mon_total);
       var iid = $("#"+main_row).children('.showgraphq').attr("id");
        var idd = iid.split('showgraphq');
        var id = idd[1];
        // alert(id);
        var janmartotal = $("#janmartotal").html();
        var aprjuntotal = $("#aprjuntotal").html();
        var julseptotal = $("#julseptotal").html();
        var octdectotal = $("#octdectotal").html();
       $.ajax({
              url: "<?php echo url('/'); ?>/getquarrterlygraphexp",
              data: 'id=' + id + '&janmar=' + janmar + '&aprjun=' + aprjun + '&julsep=' + julsep + '&octdec=' + octdec + '&janmartotal=' + janmartotal + '&aprjuntotal=' + aprjuntotal + '&julseptotal=' + julseptotal + '&octdectotal=' + octdectotal + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                // alert(response);
                $("#"+main_row).children('.showgraphq').html(response[0]);
                $(".chart_quarterly").html(response[1]);
            }
        });
    });
    $(".savebtnquarter").click(function(){
        var idd = $(this).attr("id");
        var iddd = idd.split("save");
        var month = iddd[0];
        var cnt = 0;
        var names = [];
        var prices = [];
        var revenue_count = "<?= $revenue_count ?>";
        var maxcnt = parseFloat(revenue_count) + 1;
        for(var i = 1; i < 500; i++){
            var main_row = $("#"+month+i).closest('tr').attr("id");
            if(main_row != null){
                // var name = $("#"+main_row).children('.budget_name').children('select').val();
                var name = $("#"+main_row).children('.budget_name').children('.bname').html();
                var price = $("#"+month+i).val();
                if(name == ""){
                    cnt++;
                    $("#"+main_row).children('.budget_name').children('p').show();
                }
                else{
                    $("#"+main_row).children('.budget_name').children('p').hide();
                    names.push(name);
                    prices.push(price);
                }
            }
        }
        if(cnt == 0){
            var url = "<?php echo url('/'); ?>/create_expense_quarterly";
            $.ajax({
                  url: url,
                  data: 'names=' + names + '&prices=' + prices + '&month=' + month + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $(".remove_button2").hide();
                    $("select").attr("disabled", true);
                    // alert("Saved Successfully.");
                    redirect_notify("Submitted Successfully."," ",location.reload(),"success");
                }
            });
        }
    });
</script>


<script>
   $(document).on("click","#yearlist",function(){
       var year = $(this).data('id');
       $.ajax({
         url: "<?php echo url('/'); ?>/tab2_year",
         data: 'year=' + year,
         type: "GET",
         success: function (data) {
           $('#tabledata').html(data);
           $('.fw1').hide();
           }
       });
   })
</script>


<script>
   $(document).on("click","#quaterly_yearly",function(){
       var year = $(this).data('id');
       // alert(year);

       $.ajax({
         url: "<?php echo url('/'); ?>/tab2_quaterly_year",
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
