@extends('layouts.main') 
@section("content")
<style type="text/css">
    input#transaction_date, input#reminderdate {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#transaction_date:before, input#reminderdate:before {
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input#transaction_date::-webkit-datetime-edit, input#transaction_date::-webkit-inner-spin-button, input#transaction_date::-webkit-clear-button {
        display: none;
    }
    input#reminderdate::-webkit-datetime-edit, input#reminderdate::-webkit-inner-spin-button, input#reminderdate::-webkit-clear-button {
        display: none;
    }

    input#transaction_date::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
    input#reminderdate::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
     .active1 {
    background: purple;!important;
}
th#month_record {
    cursor: pointer;
}
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Financial Management / Record Transactions</h4>
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
                <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                    <li><a href="{{ url('revenue_records') }}"> Record Revenue</a></li>
                    <li class="active"><a href="{{ url('expenses_reord') }}"> Record Expenses</a></li>
                    <li><a href="{{ url('manage_assets') }}">Record / Manage Assets</a></li>
                    <?php if($upload_files != "off"){ ?>
                        <li><a href="{{ url('upload_files') }}">Upload Files</a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                    <div class="col-md-12">
                        
                         <div class="row margin-bottom-20">
                            <form method="POST" id="record_expense" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-4">
                                    <label>Trasaction Date</label>
                                    <input type="date" name="transaction_date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="transaction_date" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Accounts / Description</label>
                                    <select class="form-control" name="account_description" id="account_description">
                                        <?php
                                            foreach($expenses_account as $value){
                                        ?>
                                                <option value="<?= $value->account_name ?>"><?= $value->account_name ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Charged / Bill</label>
                                    <?php if(count($expenses_account) > 0){ ?>
                                        <input type="number" name="total" class="form-control" value="<?php if($expenses_account[0]->amount != ""){ echo $expenses_account[0]->amount; }else{ echo 0; } ?>" id="bill" <?php if($expenses_account[0]->amount != ""){ ?> readonly <?php } ?> required>
                                    <?php }else{ ?>
                                        <input type="number" name="total" class="form-control" value="0" id="bill" required>
                                    <?php } ?>
                                </div>
                                <div class="col-md-4">
                                    <label>Amount Paid</label>
                                    <input type="number" name="amount_paid" class="form-control" value="0" id="amount_paid" required>
                                    <p id="paid_alert" style="color: red; margin-bottom: 5px"></p>
                                </div>
                                <div class="col-md-4">
                                    <label>Balance</label>
                                    <input type="text" name="balance" class="form-control" value="0" id="balance" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 padding-0 text-center margin-bottom-20">
                                <button type="submit" class="btn btn-xs btn-info" style="width: 100px;">Save</button>
                                <a href="{{ url('expenses_reord') }}" class="btn btn-xs btn-info" style="width: 100px;">Cancel</a>
                            </div>
                        </form>
                        <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <?php
                                            $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12'];

                                            ?>
                                           @foreach ($months_arr as $valuee)
                                            <th id="month_record" data-id="{{ $valuee }}" @if($cmonth == $valuee) class="active1" @endif>{{ date("M", mktime(0, 0, 0, $valuee, 10)) }}</th>
                                            @endforeach


                                        </tr>
                                    </thead>
                              </table>
                   <div class="expense_records">

                        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                            <thead>

                                    @php
                                    $charge=0;
                                    $tax=0;
                                    $shipping=0;
                                    $total=0;
                                    $amount_paid=0;
                                    $balance=0;
                                    @endphp
                                    @foreach($expense_record as $value)
                                            @php
                                            $charge +=$value->total;

                                            $amount_paid +=$value->amount_paid;
                                            $total +=$value->total;
                                            $balance +=str_replace('-', '', $value->balance);
                                            @endphp
                                     @endforeach
                                        <tr class="bg-purple">
                                            <th>Total</th>
                                            <th></th>
                                            <th>{{$charge}}</th>

                                            <th>{{$amount_paid}}</th>
                                            <th>{{$balance}}</th>
                                            <th></th>

                                        </tr>
                                <tr>
                                    <th style="text-align: center !important;">Transaction Date</th>
                                    <th>Accounts / Desc</th>
                                    <th>Charged / Bill</th>
                                    <th>Amount paid</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($expense_record as $value) {
                                ?>
                                    <tr>
                                        <td><?= date('d F Y', strtotime($value->transaction_date)); ?></td>
                                        <td><?= $value->account_description ?></td>
                                        <td><?= $value->total ?></td>
                                        <td><?= $value->amount_paid ?></td>
                                        <td> <?php
                                                if($value->balance >=0)
                                                {
                                                 echo $value->balance;
                                                }else{
                                                 echo "<span style='color:red'>".str_replace('-', '', $value->balance)."</sapn>";
                                                }
                                                ?>  
                                        </td>
                                        <td>
                                            <a href="{{ url('edit_expense_record') }}/<?= $value->id ?>" class="btn btn-xs btn-info">Edit</a>
                                            <a id="<?= $value->id ?>" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
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
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label>Reason for deleting</label>
                    <textarea class="form-control" name="delete_reason" id="delete_reason"></textarea>
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                </div>
                <input type="hidden" id="">
                <div class="col-md-12 text-center margin-top-20">
                    <a class="btn btn-info" id="delete_revenuee">Delete</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     $("#record_expense").submit(function(e) {
        e.preventDefault();
         var transaction_date = $("#transaction_date").val();
         var formData = new FormData(this);
        var bill = $("#bill").val();
        formData.append("bill", bill);
        // alert(formData);
         if(transaction_date == '<?=date('Y-m-d');?>')
         {
             $.ajax({
              type: "POST",
              beforeSend: function(){
                $("#loading").show();
                $("#wrapper").hide();
              },
              url: "expense_records_submit",
              data:  formData,
                contentType: false,
                cache: false,
                processData:false,
              success: function(html) {
                // alert(html);
              //  location.reload();
               // alert("Submitted Successfully.");
                redirect_notify("Submitted Successfully."," ",location.reload(),"success");
              },
              complete: function(){
                $("#loading").hide();
                $("#wrapper").show();
              }
            });
        }else{
            // notify(' ',"error");
           swal({
        title: 'Transaction date is not current date do you still want to process ?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: ' Yes ',
        cancelButtonText: ' No ',
        confirmButtonClass: 'btn btn-success btn-md mybtn',
        cancelButtonClass: 'btn btn-primary btn-md mybtn',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) =>
    {
        if(result.value)
        {
               $.ajax({
              type: "POST",
              beforeSend: function(){
                $("#loading").show();
                $("#wrapper").hide();
              },
              url: "expense_records_submit",
              data:  formData,
                contentType: false,
                cache: false,
                processData:false,
              success: function(html) {
                // alert(html);
              //  location.reload();
               // alert("Submitted Successfully.");
                redirect_notify("Submitted Successfully."," ",location.reload(),"success");
              },
              complete: function(){
                $("#loading").hide();
                $("#wrapper").show();
              }
            });

        }
    })
 }



    });
    $("#bill").on("input", function(){
        var bill = $(this).val();
        var amount_paid = $("#amount_paid").val();
        var balance = $("#balance").val();
        if(amount_paid != 0){
            var balance_amount = parseFloat(amount_paid) - parseFloat(bill); 
            $("#balance").val(balance_amount);
        }
        $("#balance").val("0");
    });
    $("#amount_paid").on("input", function(){
        var bill = $("#bill").val();
        var amount_paid = $(this).val();
        var balance = $("#balance").val();
        var balance_amount = parseFloat(amount_paid) - parseFloat(bill);
        $("#balance").val(balance_amount);

    });
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        $("#delete_id").val(id);
        $("#deleteModal").modal('show');
    });
    $("#delete_revenuee").on('click', function(e){
        e.preventDefault();
        var id = $("#delete_id").val();
        var delete_reason = $("#delete_reason").val();
        // alert(delete_reason);
        var url = "<?php echo url('/'); ?>/delete_expense_record";
        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'id=' + id + '&reason=' + delete_reason + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
               // alert("Deleted Succesfully.");
                  redirect_notify("Deleted Successfully."," ",location.reload(),"success");
               // location.reload();
                // alert(response);
            },
            complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
        });
    });
    $("#account_description").change(function(){
        var val = $(this).val();
        // alert(val);
        var url = "<?php echo url('/'); ?>/account_description_amount2";
        $.ajax({
              url: url,
              data: 'val=' + val + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                if(response != ""){
                    $("#bill").val(response);
                    $("#bill").attr('readonly', true);
                }
                else{
                    $("#bill").val(0);
                    $("#bill").removeAttr("readonly");
                }
            }
        });
    });
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#reminderdate').attr('max', maxDate);
        $('#transaction_date').attr('max', maxDate);
    });
    $("#transaction_date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");

 $(document).on('click','#month_record',function(){

   $("#month_record").removeClass('active1');
   $('.active1').removeClass('active1');
   var month =$(this).attr("data-id");
              $(this).addClass("active1");
     // $(".revenue_records").html("");
        if($(this).html() != 0){
            var url = "<?php echo url('/'); ?>/get_expense_by_month_page";
            $.ajax({
                  url: url,
                  beforeSend: function(){
                      //  $("#loading").show();
                       // $("#wrapper").hide();
                      },
                  data: 'month=' + month +'&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {
                    // alert(response);
                    $(".expense_records").html(response);
                },
                    complete: function(){
                       // $("#loading").hide();
                       // $("#wrapper").show();
                    }
            });
        }


 });
</script>

@endsection