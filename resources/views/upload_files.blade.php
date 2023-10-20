@extends('layouts.main') 
@section("content")

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
                        <li><a href="{{ url('manage_assets') }}">Record / Manage Assets</a></li>
                        <li class="active"><a href="{{ url('upload_files') }}">Upload Files</a></li>
                    </ul>
                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <form action="{{ url('upload_file_submit') }}" method="POST" id="record_expense" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"> Upload file </label>
                                        <input type="file" class="form-control" name="image" />
                                    </div>
                                </div>
                                

                                <div class="col-md-6" style="margin-top: 30px;">
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
                                        <td>Sl no</td>
                                        <th>File Name</th>
                                        <th>Upload Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($files as $value){
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $value->file ?></td>
                                            <td><?= date('d F Y', strtotime($value->created_at)) ?></td>
                                            <td>
                                                <a target="_blank" class="btn btn-xs btn-primary" href="{{ asset('public/assets/files_upload') }}/{{ $value->file }}">View</a>
                                                <a id="<?= $value->id ?>" class="btn btn-xs btn-danger delete">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
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
        var url = "<?php echo url('/'); ?>/upload_files_delete";
        $.ajax({
              url: url,
              beforeSend: function(){
                    $("#loading").show();
                    $("#wrapper").hide();
                  },
              data: 'id=' + id + '&reason=' + delete_reason + '&_token={{ csrf_token() }}',
              type: "POST",
            success: function (response) {
                alert("Deleted Succesfully.");
                location.reload();
                // alert(response);
            },
            complete: function(){
                    $("#loading").hide();
                    $("#wrapper").show();
                  }
        });
    });
</script>

@endsection