@extends('layouts.main') 
@section("content")
<style type="text/css">
     input#purchase_date, input#reminderdate {
        position: relative;
        /*width: 150px; height: 20px;*/
        /*color: white;*/
    }
    input#purchase_date:before, input#reminderdate:before {
        position: absolute;
        /*top: 3px; left: 3px;*/
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input#purchase_date::-webkit-datetime-edit, input#purchase_date::-webkit-inner-spin-button, input#purchase_date::-webkit-clear-button {
        display: none;
    }
    input#purchase_date::-webkit-datetime-edit, input#reminderdate::-webkit-inner-spin-button, input#reminderdate::-webkit-clear-button {
        display: none;
    }

    input#purchase_date::-webkit-calendar-picker-indicator {
        position: absolute;
        /*top: 3px;*/
        right: 0;
        color: black;
        opacity: 1;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
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
                        <li><a href="{{ url('expenses_reord') }}"> Record Expenses</a></li>
                        <li class="active"><a href="{{ url('manage_assets') }}">Record / Manage Assets</a></li>
                        <?php if($upload_files != "off"){ ?>
                            <li><a href="{{ url('upload_files') }}">Upload Files</a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <form method="POST" id="record_expense" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"> Purchase Date </label>
                                        <!--<input type="text" class="form-control datepicker" name="purchase_date" placeholder="" />-->
                                        <input type="date" name="purchase_date" class="form-control" data-date="" data-date-format="DD MMMM YYYY" value="<?= date('Y-m-d') ?>" id="purchase_date" required>
                           
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Quantity </label>
                                        <input type="number" class="form-control" placeholder="" name="quantity"  />
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="form-label">Purchase Price </label>
                                        <input type="text" class="form-control" placeholder="" name="price" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Item Description </label>
                                        <input type="text" class="form-control" placeholder="" name="description" />
                                    </div>
                                </div>

                                <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                                    <button type="submit" class="btn btn-sm btn-info">Save</button>
                                </div>
                            </div>
                        </form>

                        <div class="clearfix"></div>
                        <div class="divider divider-center divider-short">
                            <!-- divider -->
                            <i class="fa fa-star-o"></i>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <tr>
                                        <th>Purchase Date</th>
                                        <th>Item Description</th>
                                        <th>Quantity</th>
                                        <th>Purchase Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($record as $value){
                                        ?>
                                        <tr>
                                            <td><?= date('d F Y', strtotime($value->purchase_date)); ?></td>
                                            <td><?= $value->description ?></td>
                                            <td><?= $value->quantity ?></td>
                                            <td><?= $value->price ?></td>
                                            <td>
                                                <a href="{{ url('manage_assets_edit') }}/<?= $value->id ?>" class="btn btn-xs btn-success">Edit</a>
                                                <a id="<?= $value->id ?>" class="btn btn-xs btn-danger delete">Delete</a>
                                            </td>
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
        var url = "<?php echo url('/'); ?>/manage_assets_delete";
        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'id=' + id + '&reason=' + delete_reason + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                //alert("Deleted Succesfully.");
               // location.reload();
                // alert(response);
                 redirect_notify("Deleted Successfully."," ",location.reload(),"success");
            },
            complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
        });
    });
     $("#record_expense").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
              type: "POST",
              beforeSend: function(){
                $("#loading").show();
                $("#wrapper").hide();
              },
              url: "asset_records_submit",
              data:  formData,
                contentType: false,
                cache: false,
                processData:false,
              success: function(html) {
                // alert(html);
               // location.reload();
               // alert("Submitted Successfully.")
                redirect_notify("Submitted Successfully."," ",location.reload(),"success");
              },
              complete: function(){
                $("#loading").hide();
                $("#wrapper").show();
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

        $('#purchase_date').attr('max', maxDate);
    });
    $("#purchase_date").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");
</script>

@endsection