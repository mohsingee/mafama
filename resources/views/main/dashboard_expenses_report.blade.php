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
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="monthly">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Expenses Name</th>
                                            <th>Date</th>
                                            <th>Month of {{ date('F') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $months_arr = [date('m')]; 
                                            foreach($revenue as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td class="fixed-side"><?= $value->account_description ?></td>
                                                <td><?=date('d M Y', strtotime($value->transaction_date));?></td>
                                                <?php
                                                $tot = 0;
                                                    foreach ($months_arr as $valuee) {
                                                        $count = \App\Http\Controllers\MainController::get_month_count_expense($valuee, $value->account_description);

                                                        $tot += $count;

                                                        // echo '<td>'.$count.'</td>';
                                                       
                                                        if($count > 0){
                                                            echo '<td><a class="revenue_month" id="'.$valuee.'revenue_month'.$value->account_description.'">'.$count.'</a></td>';
                                                        }
                                                        else{
                                                            echo '<td>'.$count.'</td>';
                                                        }
                                                    }
                                                 ?>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="fixed-side" style=""><b>Total Expense</b></td>
                                            <td class="" style=""><b></b></td>
                                            <?php
                                            $tot2 = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $count2 = \App\Http\Controllers\MainController::get_month_totall_expense($valuee);

                                                    $tot2 += $count2;

                                                    echo '<td>'.$count2.'</td>';
                                                }
                                             ?>
                                        </tr>                                    
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <div id="monthly_details"></div>
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

            var url = "<?php echo url('/'); ?>/expensemonthdetails";

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

            var url = "<?php echo url('/'); ?>/expensequarterdetails";

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
@endsection