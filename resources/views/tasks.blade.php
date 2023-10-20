@extends('layouts.main') 
@section("content")
<style type="text/css">
    .btn-success {
        background: green !important;
        border: 1px solid green;
    }
    .btn-success, .btn-danger, .add_report_sec {
        height: 21px !important;
        line-height: 8px !important;
        font-size: 12px !important;
    }
    .tasks-divv {
        height: auto !important;
    }
    .tasks-divv table thead {
        background: none;
    }
    .tasks-divv table th {
        padding: 10px;

        margin: 0 10px;
    }
    .tasks-divv table td {
        padding: 0 10px;
    }
    .clientreport, .clientreport2 {
        border-bottom: 1px solid #d8d8d8;
    }
    .report_submit {
        float: right;
        right: 4px;
    }
    .confirmed {
        font-weight: bold;
        cursor: auto !important;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="" style="padding-bottom: 40px;">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Client Management / Client Access</h4>
                        </div>
                       
                        @include('lab.lab_tabs')
                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                            <input type="hidden" id="today" value="{{ date('d F Y') }}">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Client Email</th>
                                        <th>Client Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $value)
                                    @php 
                                        $tasks = App\Http\Controllers\MainController::getclienttask($value->id);
                                    @endphp
                                    <tr>
                                        <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->cellphone }}</td>
                                        <td><a class="btn btn-info report_view">View Report</a></td>
                                    </tr>
                                    <tr class="report_details" style="display: none;">
                                        <td colspan="4">
                                            <div class="col-md-12 shadow-boxx tasks-divv">
                                                <table class="profile-info margin-bottom-10" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <div class="col-md-12 text-center heading-div">
                                                                    <h4>Task Description</h4>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="col-md-12 text-center heading-div">
                                                                    <h4>Shift End Outcome</h4>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="col-md-12 text-center heading-div">
                                                                    <h4>Message</h4>
                                                                </div>
                                                            </th>
                                                            <th>
                                                                <div class="col-md-12 text-center heading-div">
                                                                    <h4>Action</h4>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="{{ $value->id }}">
                                                        @if(count($tasks) > 0)
                                                            @foreach($tasks as $task)
                                                                <tr class="clientreport">
                                                                    <td width="25%">
                                                                        <b>Date: {{ date('d F Y', strtotime($task->created_at)) }}</b>
                                                                        <textarea name="task" class="form-control tasktextarea" rows="3" style="margin-top: 10px;">{{ $task->task }}</textarea>
                                                                    </td>
                                                                    <td width="30%">
                                                                        <div class="col-md-12">
                                                                            <label class="checkbox" style="font-size: 14px;">
                                                                                <input name="outcome" type="checkbox" value="Completed" @if($task->outcome == "Completed") checked @endif />
                                                                                <i></i> Completed
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label class="checkbox" style="font-size: 14px;">
                                                                                <input name="outcome" type="checkbox" value="Partially Completed" @if($task->outcome == "Partially Completed") checked @endif />
                                                                                <i></i> Partially Completed
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label class="checkbox" style="font-size: 14px;">
                                                                                <input name="outcome" type="checkbox" value="Not Completed" @if($task->outcome == "Not Completed") checked @endif />
                                                                                <i></i> Not Completed
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label class="checkbox" style="font-size: 14px;">
                                                                                <input name="outcome" type="checkbox" value="Carry Over" @if($task->outcome == "Carry Over") checked @endif />
                                                                                <i></i> Duties to carry over
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td width="25%">
                                                                        <textarea name="message" class="form-control" rows="3" style="margin-top: 10px;">{{ $task->message }}</textarea>
                                                                    </td>
                                                                    <td width="20%">
                                                                        <div class="text-center margin-top-20">
                                                                            <input type="hidden" name="client_id" value="{{ $value->id }}">
                                                                            <input type="hidden" name="report_id" value="{{ $task->id }}">
                                                                           
                                                                            <a class="btn btn-md btn-danger delete_task" data-id="{{ $task->id }}">Delete</a>
                                                                            @if($task->status == 0)
                                                                                <a class="btn btn-md btn-success confirm_task" data-id="{{ $task->id }}">Confirm</a>
                                                                            @else
                                                                                <a class="confirmed">Confirmed</a>
                                                                            @endif
                                                                        </div> 
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="clientreport2">
                                                                <td width="25%">
                                                                    <b>Date: {{ date('d F Y') }}</b>
                                                                    <textarea name="task" class="form-control" rows="3" style="margin-top: 10px;"></textarea>
                                                                </td>
                                                                 <td width="30%">
                                                                    <div class="col-md-12">
                                                                        <label class="checkbox" style="font-size: 14px;">
                                                                            <input name="outcome" type="checkbox" value="Completed" />
                                                                            <i></i> Completed
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label class="checkbox" style="font-size: 14px;">
                                                                            <input name="outcome" type="checkbox" value="Partially Completed" />
                                                                            <i></i> Partially Completed
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label class="checkbox" style="font-size: 14px;">
                                                                            <input name="outcome" type="checkbox" value="Not Completed" />
                                                                            <i></i> Not Completed
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label class="checkbox" style="font-size: 14px;">
                                                                            <input name="outcome" type="checkbox" value="Carry Over" />
                                                                            <i></i> Duties to carry over
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td width="25%">
                                                                    <textarea name="message" class="form-control" rows="3" style="margin-top: 10px;"></textarea>
                                                                </td>
                                                                <td width="20%">
                                                                    <div class="text-center margin-top-20">
                                                                        <input type="hidden" name="client_id" value="{{ $value->id }}">
                                                                        <a class="btn btn-md btn-danger delete_task" data-id="">Delete</a>
                                                                    </div> 
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <a class="btn btn-info add_report_sec" data-id="{{ $value->id }}">Add New</a>
                                                <a class="btn btn-md btn-success report_submit">Save</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).on('click', '.report_view', function(){
        // $(this).closest('tr').next('.report_details').addClass("active");
        $('.report_details').hide();
        $(".report_view").closest('tr').css('background', 'white');
        $(this).closest('tr').css('background', '#88ffa0');
        $(this).closest('tr').next('.report_details').show();
    });
    $(document).on('click', '.add_report_sec', function(){
        var client_id = $(this).attr("data-id");
        var today = $("#today").val();
        var html = '<tr class="clientreport2"><td width="25%"><b>Date: '+today+'</b><textarea name="task" class="form-control" rows="3" style="margin-top: 10px;"></textarea></td><td width="30%"><div class="col-md-12"> <label class="checkbox" style="font-size: 14px;"> <input name="outcome" type="checkbox" value="Completed" /> <i></i> Completed </label></div><div class="col-md-12"> <label class="checkbox" style="font-size: 14px;"> <input name="outcome" type="checkbox" value="Partially Completed" /> <i></i> Partially Completed </label></div><div class="col-md-12"> <label class="checkbox" style="font-size: 14px;"> <input name="outcome" type="checkbox" value="Not Completed" /> <i></i> Not Completed </label></div><div class="col-md-12"> <label class="checkbox" style="font-size: 14px;"> <input name="outcome" type="checkbox" value="Carry Over" /> <i></i> Duties to carry over </label></div></td><td width="25%"><textarea name="message" class="form-control" rows="3" style="margin-top: 10px;"></textarea></td><td width="20%"><div class="text-center margin-top-20"> <input type="hidden" name="client_id" value="'+client_id+'"> <a class="btn btn-md btn-danger delete_task" data-id="">Delete</a></div></td></tr>';
        $(this).parent(".tasks-divv").find("tbody").append(html);
    });
    $(document).on('click', '.report_submit', function(event){
        var id =  $(this).parent(".tasks-divv").find("tbody").attr("id");
        var client_id = $(this).parent("div").find("input[name='client_id']").val();
        var sub_arr = [];
        var sub_arr3 = [];
        $("#"+id+" .clientreport").each(function(){
            var task = $(this).find("textarea[name='task']").val();
            var outcome = "";
            $(this).find("input[name='outcome']").each(function(){
                if($(this).is(":checked")){
                    outcome = $(this).val();
                }
            });
            var message = $(this).find("textarea[name='message']").val();
            var id = $(this).find("input[name='report_id']").val();
            if(task != ""){
                var sub_arr2 = {};
                sub_arr2['id'] =  id;
                sub_arr2['task'] =  task;
                sub_arr2['outcome'] = outcome;
                sub_arr2['message'] = message;
                sub_arr.push(sub_arr2);
            }else{
                alert("Please assign some task");
            }
        });
        $("#"+id+" .clientreport2").each(function(){
            var task = $(this).find("textarea[name=task]").val();
            var outcome = "";
            $(this).find("input[name='outcome']").each(function(){
                if($(this).is(":checked")){
                    outcome = $(this).val();
                }
            });
            var message = $(this).find("textarea[name=message]").val();
            if(task != ""){
                var sub_arr2 = {};
                sub_arr2['client_id'] = client_id;
                sub_arr2['task'] =  task;
                sub_arr2['outcome'] = outcome;
                sub_arr2['message'] = message;
                sub_arr3.push(sub_arr2);
            }
        });
        // console.log(sub_arr);
        if((sub_arr == "") && (sub_arr3 == "")){
            alert("Please assign some task");
        }
        else{
            $.ajax({
                url: "affiliate_client_task_submit",
                data: {'sub_arr':JSON.stringify(sub_arr), 'sub_arr3':JSON.stringify(sub_arr3), '_token': '<?= csrf_token() ?>' },
                type: 'POST',
                success: function(result) {
                    alert(result);
                    location.reload();
                }
            });
        } 
    });
    $(document).on('click', '.delete_task', function(){
        if (confirm('Are you sure ?')) {
            var id = $(this).attr("data-id");
            $(this).parent('div').parent('td').parent('tr').remove();
            if(id != ""){
                $.ajax({
                    url: "affiliate_client_task_delete",
                    data: {'id':id, '_token': '<?= csrf_token() ?>' },
                    type: 'POST',
                    success: function(result) {
                    }
                }); 
            }
        }
    });
    $(document).on('click', '.confirm_task', function(){
        if (confirm('Are you want to confirm this ?')) {
            var id = $(this).attr("data-id");
            if(id != ""){
                $.ajax({
                    url: "affiliate_client_task_confirm",
                    data: {'id':id, '_token': '<?= csrf_token() ?>' },
                    type: 'POST',
                    success: function(result) {
                        location.reload();
                    }
                }); 
            }
        }
    });
    $(document).on('change', 'input[name=outcome]', function(){
        $(this).parent("label").parent("div").parent("td").find('input[name="outcome"]').prop('checked', false);
        $(this).prop("checked", true);
    });
</script>


@endsection