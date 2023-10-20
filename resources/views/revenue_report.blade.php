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
    #datatable_sample_filter {
        display: none;
    }
    table td a {
        color: #da291c !important
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-10 text-center">
                        <h4>Financial Management / Reports</h4>
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
                <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                    <li><a href="{{ url('profit_loss_stmt') }}">Profit / Loss Statement</a></li>
                    <li class="active"><a href="{{ url('revenue_report') }}">Revenue Report</a></li>
                    <li><a href="{{ url('expenses_report') }}">Expense Report</a></li>
                    <li><a href="{{ url('balancesheet_report') }}">Balance Sheet</a></li>
                    <li><a href="{{ url('paymentbalance_report') }}">Payment / Balance</a></li>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#monthly" data-toggle="tab">Monthly</a></li>
                            <li><a href="#quarterly" data-toggle="tab">Quarterly</a></li>
                            <!-- <li><a href="#sms-tab" data-toggle="tab">Send SMS</a></li> -->
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="monthly">
                                 <div class="row"  style="margin: 10px 0;">
                              <div class="col-md-2">
                                 <label style="margin: 0px 0;">Choose a base year</label>
                              </div>
                              <div class="col-md-9">
                                 <?php foreach($years as $value){ ?>
                                 <a href="javascript:void(0)" data-id="<?php echo $value; ?>" id="monthlyyearlist"><span class="act"  style="margin-right: 12px;background-color: #da291c;
                                    border-color: #da291c; color: #fff; padding: 1%; border-radius: 5%">{{ $value }}</span></a>
                                 <?php } ?>
                              </div>
                           </div>
                           <div id="monthlydata">

                           </div>
                                <table class="table table-striped table-bordered table-hover fw2">
                                    <thead>
                                        <tr>
                                            <th>Revenue Name</th>
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
                                        <?php
                                            $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12'];
                                            foreach($revenue_account as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td class="fixed-side"><?= $value->account_name ?></td>
                                                <?php
                                                $tot = 0;
                                                    foreach ($months_arr as $valuee) {
                                                        $count = \App\Http\Controllers\MainController::get_month_count_revenue($valuee, $value->account_name);

                                                        $tot += $count;

                                                        // echo '<td>'.$count.'</td>';

                                                        if($count > 0){
                                                            echo '<td><a class="revenue_month" id="'.$valuee.'revenue_month'.$value->account_name.'">'.$count.'</a></td>';
                                                        }
                                                        else{
                                                            echo '<td>'.$count.'</td>';
                                                        }
                                                    }
                                                 ?>
                                                <td><?= $tot ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                            <?php
                                            $tot2 = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $count2 = \App\Http\Controllers\MainController::get_month_totall_revenue($valuee);

                                                    $tot2 += $count2;

                                                    echo '<td>'.$count2.'</td>';
                                                }
                                             ?>
                                            <td><?= $tot2 ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <div id="monthly_details"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="quarterly">
                                <div class="row"  style="margin: 10px 0;">
                              <div class="col-md-2">
                                 <label style="margin: 0px 0;">Choose a base year</label>
                              </div>
                              <div class="col-md-9">
                                 <?php foreach($years as $value){ ?>
                                 <a href="javascript:void(0)" data-id="<?php echo $value; ?>" id="quaterlyyearlist"><span class="act"  style="margin-right: 12px;background-color: #da291c;
                                    border-color: #da291c; color: #fff; padding: 1%; border-radius: 5%">{{ $value }}</span></a>
                                 <?php } ?>
                              </div>
                           </div>
                           <div id="quaterlydata">

                           </div>
                                <table class="table table-striped table-bordered table-hover fw3">
                                    <thead>
                                        <tr>
                                            <th>Revenue Name</th>
                                            <th>Jan-Mar</th>
                                            <th>Apr-Jun</th>
                                            <th>Jul-Sep</th>
                                            <th>Oct-Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $months_arr2 = ['01','04','07','10'];
                                            foreach($revenue as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td class="fixed-side"><?= $value->account_description ?></td>
                                                <?php
                                                $tot = 0;
                                                    foreach ($months_arr2 as $valuee) {
                                                        $count = \App\Http\Controllers\MainController::get_quarter_count_revenue($valuee, $value->account_description);

                                                        $tot += $count;

                                                        // echo '<td>'.$count.'</td>';

                                                        if($count > 0){
                                                            echo '<td><a class="revenue_quarter" id="'.$valuee.'revenue_quarter'.$value->account_description.'">'.$count.'</a></td>';
                                                        }
                                                        else{
                                                            echo '<td>'.$count.'</td>';
                                                        }
                                                    }
                                                 ?>
                                                <td><?= $tot ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                            <?php
                                            $tot3 = 0;
                                                foreach ($months_arr2 as $valuee) {
                                                    $count3 = \App\Http\Controllers\MainController::get_quarter_totall_revenue($valuee);

                                                    $tot3 += $count3;
                                                    echo '<td>'.$count3.'</td>';
                                                }
                                             ?>
                                            <td><?= $tot3 ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <div id="monthly_details2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
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
    }
    $(".revenue_month").click(function(){
        $("#monthly_details").html("");
        if($(this).html() != 0){
            var val = $(this).attr("id");
            var vall = val.split("revenue_month");
            var month = vall[0];
            var description = vall[1];

            var url = "<?php echo url('/'); ?>/revenuemonthdetails";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'month=' + month + '&description=' + description + '&_token={{ csrf_token() }}',
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
        }
    });
    $(".revenue_quarter").click(function(){
        $("#monthly_details2").html("");
        if($(this).html() != 0){
            var val = $(this).attr("id");
            var vall = val.split("revenue_quarter");
            var month = vall[0];
            var description = vall[1];

            var url = "<?php echo url('/'); ?>/revenuequarterdetails";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'month=' + month + '&description=' + description + '&_token={{ csrf_token() }}',
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
        }
    });
</script>

<script>
   $(document).ready(function(){
    //    var year = $(this).data('id');
       var year = $('#monthlyyearlist').data('id');
       $.ajax({
         url: "<?php echo url('/'); ?>/revenue_report_monthly",
         data: 'year=' + year,
         type: "GET",
         success: function (data) {
           $('#monthlydata').html(data);
           $('.fw2').hide();
           }
       });
   })
</script>

<script>
   $(document).on("click","#quaterlyyearlist",function(){
       var year = $(this).data('id');
       $.ajax({
         url: "<?php echo url('/'); ?>/revenue_report_quaterly",
         data: 'year=' + year,
         type: "GET",
         success: function (data) {
           $('#quaterlydata').html(data);
           $('.fw3').hide();
           }
       });
   })
</script>
@endsection
