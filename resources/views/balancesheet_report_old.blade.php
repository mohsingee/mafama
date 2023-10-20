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
                    <li><a href="{{ url('revenue_report') }}">Revenue Report</a></li>
                    <li><a href="{{ url('expenses_report') }}">Expense Report</a></li>
                    <li class="active"><a href="{{ url('balancesheet_report') }}">Balance Sheet</a></li>
                    <li><a href="{{ url('paymentbalance_report') }}">Payment / Balance</a></li>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
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
                                    foreach($client as $value){
                                ?>
                                    <tr class="odd gradeX">
                                        <td class="fixed-side"><?= $value->first_name ?> <?= $value->last_name ?></td>
                                        <?php
                                        $tot = 0;
                                            foreach ($months_arr as $valuee) {
                                                $balance = \App\Http\Controllers\HomeController::get_month_balance($valuee, $value->email);

                                                $tot += $balance;

                                                echo '<td>'.$balance.'</td>';
                                            }
                                         ?>
                                        <td><?= $tot ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
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
</script>

@endsection