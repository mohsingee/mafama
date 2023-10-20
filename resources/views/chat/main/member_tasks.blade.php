@extends('layouts.main') 
@section("content")

<style type="text/css">
    .btn-success {
        background: green !important;
        border: 1px solid green;
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
</style>
<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12" style="padding-bottom: 20px;">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Client Management / Client Access</h4>
                        </div>
                        <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
                            <li><a href="{{ url('member_profile_info') }}">Profile</a></li>
                            <li class="active"><a href="{{ url('member_tasks') }}">Task</a></li>
                        </ul>
                        <div class="col-md-12 shadow-boxx tasks-divv">
                            <form method="POST" action="{{ url('client_task_submit') }}">
                                @csrf
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($tasks != '')
                                        @php
                                            $disable = "";
                                            if($tasks->client_submit != ""){
                                                $newdatetime = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($tasks->client_submit)));
                                                $now = date('Y-m-d H:i:s');
                                                if($now > $newdatetime){
                                                    $disable = "disabled";
                                                }
                                            }
                                        @endphp
                                            <tr class="clientreport2">
                                                <td width="30%">
                                                    <textarea name="task" class="form-control" rows="3" style="margin-top: 10px;" readonly>{{ $tasks->task }}</textarea>
                                                </td>
                                                 <td width="40%">
                                                    <div class="col-md-12">
                                                        <label class="checkbox" style="font-size: 14px;">
                                                            <input name="outcome" type="checkbox" {{ $disable }} value="Completed" @if($tasks->outcome == "Completed") checked @endif />
                                                            <i></i> Completed
                                                        </label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="checkbox" style="font-size: 14px;">
                                                            <input name="outcome" type="checkbox" {{ $disable }} value="Partially Completed" @if($tasks->outcome == "Partially Completed") checked @endif />
                                                            <i></i> Partially Completed
                                                        </label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="checkbox" style="font-size: 14px;">
                                                            <input name="outcome" type="checkbox" {{ $disable }} value="Not Completed" @if($tasks->outcome == "Not Completed") checked @endif />
                                                            <i></i> Not Completed
                                                        </label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="checkbox" style="font-size: 14px;">
                                                            <input name="outcome" type="checkbox" {{ $disable }} value="Carry Over" @if($tasks->outcome == "Carry Over") checked @endif />
                                                            <i></i> Duties to carry over
                                                        </label>
                                                    </div>
                                                </td>
                                                <td width="30%">
                                                    <textarea name="message" class="form-control" rows="3" style="margin-top: 10px;" required {{ $disable }}>{{ $tasks->message }}</textarea>
                                                </td>
                                            </tr>
                                        @else
                                            <tr><td colspan="3"><h5 class="text-center">No result found</h5></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                                @if($tasks != '')
                                    @if($disable == "")
                                        <div class="text-center">
                                            <input type="hidden" name="id" value="{{ $tasks->id }}">
                                            <button type="submit" class="btn btn-md btn-success report_submit">Save</button>
                                        </div>
                                    @endif
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).on('change', 'input[name=outcome]', function(){
        $(this).parent("label").parent("div").parent("td").find('input[name="outcome"]').prop('checked', false);
        $(this).prop("checked", true);
    });
</script>

@endsection