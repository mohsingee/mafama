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
                        <li class="active"><a href="{{ url('tab44') }}">Revenue Projection</a></li>
                        <li><a href="{{ url('tab55') }}">Expenses Projection</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab4">
                            <ul class="nav nav-tabs nav-button-tabs nav-justified">
                                <li><a href="{{ url('tab44') }}">Monthly</a></li>
                                <li class="active"><a href="{{ url('tab442') }}">Quarterly</a></li>
                            </ul>

                            <div class="tab-content margin-top-10">
                                <div class="tab-pane fade in active" id="tab41">
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
                                    <div class="">
                                        <div class="table-scroll" id="quaterlytabledata"></div>
                                        <div id="" class="table-scroll fw2">
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
                                                        <?php 
                                                        foreach($revenue as $value){
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td class="fixed-side"><?= $value->name ?></td>
                                                                <td><?= $value->janmar ?></td>
                                                                <td><?php echo $actual_janmar = App\Http\Controllers\HomeController::getjanmaractual($value->name); ?></td>
                                                                <td><?= ($value->janmar - $actual_janmar) ?></td>
                                                                <td><?= $value->aprjun ?></td>
                                                                <td><?php echo $actual_aprjun = App\Http\Controllers\HomeController::getaprjunactual($value->name); ?></td>
                                                                <td><?= ($value->aprjun - $actual_aprjun) ?></td>
                                                                <td><?= $value->julsep ?></td>
                                                                <td><?php echo $actual_julsep = App\Http\Controllers\HomeController::getjulsepactual($value->name); ?></td>
                                                                <td><?= ($value->julsep - $actual_julsep) ?></td>
                                                                <td><?= $value->octdec ?></td>
                                                                <td><?php echo $actual_octdec = App\Http\Controllers\HomeController::getoctdecactual($value->name); ?></td>
                                                                <td><?= ($value->octdec - $actual_octdec) ?></td>
                                                                
                                                                <td> <?= $tot = ($value->janmar + $value->aprjun + $value->julsep + $value->octdec) ?></td>
                                                                <td><?php echo $actual_total = App\Http\Controllers\HomeController::gettotalactual($value->name); ?></td>
                                                                <td><?= ($tot-$actual_total) ?></td>
                                                                <td>
                                                                    <a href="{{ url('revenue_variance_quarterly_graph2') }}/<?= $value->name ?>"><i class="fa fa-bar-chart"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
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
                                                            <td><?= $tott = ($janmartotal + $aprjuntotal + $julseptotal + $octdectotal) ?></td>
                                                            <td><?= $tott2 = ($janmartotalactual + $aprjuntotalactual + $julseptotalactual + $octdectotalactual) ?></td>
                                                            <td><?= ($tott - $tott2) ?></td>
                                                            <td>
                                                                <a href="{{ url('revenue_quarterly_vary_chart2') }}"><i class="fa fa-bar-chart"></i></a>
                                                            </td>
                                                        </tr>
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

<script>
   $(document).on("click","#quaterly_yearly",function(){
       var year = $(this).data('id');
       // alert(year);
   
       $.ajax({
         url: "<?php echo url('/'); ?>/tab44_quaterly_year",
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