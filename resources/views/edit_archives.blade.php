@extends('layouts.main') 
@section("content")
<style type="text/css">
    .select2.select2-container.select2-container--default.select2-container--below, .select2 {
        width: 100% !important;
    }
    p{
        margin-bottom: 2px;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Archives / Edit</h4>
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
                <ul class="nav nav-tabs nav-button-tabs nav-justified" style="">
                    <li class="active"><a href="#tab1" data-toggle="tab">Revenue Updates Report</a></li>
                    <li><a href="#tab2" data-toggle="tab">Expense Updates Report</a></li>
                    <li><a href="#tab3" data-toggle="tab">Assets Updates Report</a></li>
                </ul>

                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="tab-pane fade in active" id="tab1">
                        <div class="col-md-12" style="border-radius: 10px; padding: 20px;">
                            <div class="col-md-4 col-md-offset-4 margin-bottom-20">
                                <select class="form-control select2" id="monthlyrevenuelist">
                                    
                                </select>
                            </div>
                            <div class="clearfix"></div>
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
                                    </tr>
                                </thead>
                                <tbody id="monthly_revenue_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab2">
                        <div class="col-md-12" style="border-radius: 10px; padding: 20px;">
                            <div class="col-md-4 col-md-offset-4 margin-bottom-20">
                                <select class="form-control select2" id="monthlyexpenseslist">
                                    
                                </select>
                            </div>

                            <div class="clearfix"></div>
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
                                    </tr>
                                </thead>
                                <tbody id="monthly_expenses_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab3">
                        <div class="col-md-12" style="border-radius: 10px; padding: 20px;">
                            <div class="col-md-4 col-md-offset-4 margin-bottom-20">
                                <select class="form-control select2" id="monthlyassetlist">
                                    
                                </select>
                            </div>

                            <div class="clearfix"></div>
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
                                    </tr>
                                </thead>
                                <tbody id="monthly_asset_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="modall" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content" style="background: white">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div id= "modal-body"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#monthlyrevenuelist').each(function() {

          var year = (new Date()).getFullYear();
          var current = year;
          year -= 0;
          for (var i = 0; i < 10; i++) {
            if ((year-i) == current)
              $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
            else
              $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
          }

        });
        setTimeout(function() {
            $("#monthlyrevenuelist").trigger('change');
            $("#monthlyexpenseslist").trigger('change');
            $("#monthlyassetlist").trigger('change');
        },10);
        $("#monthlyrevenuelist").change(function(){
            // alert($(this).val());
            var year = $(this).val();
            var url = "<?php echo url('/'); ?>/monthlyrevenuelistappointment";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'year=' + year + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $("#monthly_revenue_tbody").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        });
        $('#monthlyexpenseslist').each(function() {

          var year = (new Date()).getFullYear();
          var current = year;
          year -= 0;
          for (var i = 0; i < 10; i++) {
            if ((year-i) == current)
              $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
            else
              $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
          }

        });
        $("#monthlyexpenseslist").change(function(){
            // alert($(this).val());
            var year = $(this).val();
            var url = "<?php echo url('/'); ?>/monthlyexpenseslistappointment";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'year=' + year + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $("#monthly_expenses_tbody").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        });
        $('#monthlyassetlist').each(function() {

          var year = (new Date()).getFullYear();
          var current = year;
          year -= 0;
          for (var i = 0; i < 10; i++) {
            if ((year-i) == current)
              $(this).append('<option selected value="' + (year - i) + '">' + (year - i) + '</option>');
            else
              $(this).append('<option value="' + (year - i) + '">' + (year - i) + '</option>');
          }

        });
        $("#monthlyassetlist").change(function(){
            // alert($(this).val());
            var year = $(this).val();
            var url = "<?php echo url('/'); ?>/monthlyassetlistappointment";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'year=' + year + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $("#monthly_asset_tbody").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        });
        $(document).on("click", ".revenue_det", function(){
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var account_description = id[1];
            var year = $("#monthlyrevenuelist").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_revenue_month_details";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'year=' + year + '&month=' + month + '&account_description=' + account_description + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        });
        $(document).on("click", ".expense_det", function(){
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var account_description = id[1];
            var year = $("#monthlyexpenseslist").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_expense_month_details";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'year=' + year + '&month=' + month + '&account_description=' + account_description + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        });
        $(document).on("click", ".asset_det", function(){
            var idd = $(this).attr('id');
            // alert(idd);
            var id = idd.split('n123');
            var month = id[0];
            var description = id[1];
            var year = $("#monthlyassetlist").val();
            // alert(month);
            // alert(account_description);
            // alert(year);
            var url = "<?php echo url('/'); ?>/record_asset_month_details";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'year=' + year + '&month=' + month + '&description=' + description + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $("#modal-body").html(response);
                    $("#modall").modal('show');
                },
                complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                }
            });
        });
    });
</script>

@endsection