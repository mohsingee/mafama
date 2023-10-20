@extends('layouts.main') 
@section("content")

<style>
    .heading-div {
        background-color: #da291c;
        border-radius: 5px;
    }
    .heading-div h4 {
        color: #fff;
        margin-top: 10px;
        margin-bottom: 10px;
        font-weight: 400;
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
                            <li class="active"><a href="{{ url('member_profile_info') }}">Profile</a></li>
                            <li><a href="{{ url('member_tasks') }}">Task</a></li>
                        </ul>
                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                            <div class="col-md-3">
                                <div class="col-md-12 shadow-boxx">
                                    <form method="POST" action="{{ url('client_report_submit') }}">
                                        @csrf
                                        <div class="col-md-12 text-center heading-div">
                                            <h4>Client's Reporting</h4>
                                        </div>
                                        <div class="col-md-12 text-center padding-0 margin-top-20">
                                            <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                <tbody>
                                                   <!--  <tr>
                                                        <td><b>Date : </b></td>
                                                        <td>12-04-2020</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Taken By : </b></td>
                                                        <td>John doe</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Reviewed By : </b></td>
                                                        <td>Joe S</td>
                                                    </tr> -->
                                                    <!-- <tr>
                                                        <td colspan="2">
                                                            <select class="form-control" style="margin-top: 10px;">
                                                                <option>Fever</option>
                                                                <option>Toothache</option>
                                                                <option>Other</option>
                                                            </select>
                                                        </td>
                                                    </tr> -->
                                                    <tr>
                                                        <td colspan="2"><textarea required name="report" @if(isset($reports)) readonly="readonly" @endif class="form-control" rows="4" style="margin-top: 10px;">@if(isset($reports)) {{ $reports->report }} @endif</textarea></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr />
                                        <div class="col-md-12 text-center padding-0">
                                            <button type="submit" class="btn btn-xs btn-info">Save </button>
                                            @if($reports != "")
                                                @if($reports->created_at == $reports->updated_at)
                                                    <a class="btn btn-xs btn-info edit_report">Edit</a>
                                                @else
                                                    @php
                                                        $newdatetime = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($reports->updated_at)));
                                                        $now = date('Y-m-d H:i:s');
                                                    @endphp
                                                    @if($now <= $newdatetime)
                                                        <a class="btn btn-xs btn-info edit_report">Edit</a>
                                                    @endif
                                                @endif
                                            @else
                                                <a class="btn btn-xs btn-info edit_report">Edit</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if(isset($diagonostic))
                                @if($diagonostic->status == 1)
                                    <div class="col-md-3">
                                        <div class="col-md-12 shadow-boxx">
                                            <form method="POST" action="{{ url('client_diagnostic_report_submit') }}">
                                                @csrf
                                                <div class="col-md-12 text-center heading-div">
                                                    <h4>Diagnostic</h4>
                                                </div>
                                                <div class="col-md-12 text-center padding-0 margin-top-20">
                                                    <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                        <tbody>
                                                            <!-- <tr>
                                                                <td><b>Date : </b></td>
                                                                <td>12-04-2020</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Taken By : </b></td>
                                                                <td>John doe</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Reviewed By : </b></td>
                                                                <td>Joe S</td>
                                                            </tr> -->
                                                            <!-- <tr>
                                                                <td colspan="2">
                                                                    <select class="form-control" style="margin-top: 10px;">
                                                                        <option>Fever</option>
                                                                        <option>Toothache</option>
                                                                        <option>Other</option>
                                                                    </select>
                                                                </td>
                                                            </tr> -->
                                                            <tr>
                                                                <td colspan="2"><textarea required name="report" @if(isset($diagonostic)) readonly="readonly" @endif class="form-control" rows="4" style="margin-top: 10px;">@if(isset($diagonostic)) {{ $diagonostic->report }} @endif</textarea></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr />
                                                
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="col-md-3">
                                    <div class="col-md-12 shadow-boxx">
                                        <form method="POST" action="{{ url('client_diagnostic_report_submit') }}">
                                            @csrf
                                            <div class="col-md-12 text-center heading-div">
                                                <h4>Diagnostic</h4>
                                            </div>
                                            <div class="col-md-12 text-center padding-0 margin-top-20">
                                                <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                    <tbody>
                                                        <!-- <tr>
                                                            <td><b>Date : </b></td>
                                                            <td>12-04-2020</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Taken By : </b></td>
                                                            <td>John doe</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Reviewed By : </b></td>
                                                            <td>Joe S</td>
                                                        </tr> -->
                                                        <!-- <tr>
                                                            <td colspan="2">
                                                                <select class="form-control" style="margin-top: 10px;">
                                                                    <option>Fever</option>
                                                                    <option>Toothache</option>
                                                                    <option>Other</option>
                                                                </select>
                                                            </td>
                                                        </tr> -->
                                                        <tr>
                                                            <td colspan="2"><textarea required name="report" @if(isset($diagonostic)) readonly="readonly" @endif class="form-control" rows="4" style="margin-top: 10px;">@if(isset($diagonostic)) {{ $diagonostic->report }} @endif</textarea></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr />
                                           <!--  <div class="col-md-12 text-center padding-0">
                                                <button type="submit" class="btn btn-xs btn-info">Save </button>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                            @endif
                            @if(isset($recommendation))
                                @if($recommendation->status == 1)
                                    <div class="col-md-3">
                                        <div class="col-md-12 shadow-boxx">
                                            <form method="POST" action="{{ url('client_recommendation_submit') }}">
                                                @csrf
                                                <div class="col-md-12 text-center heading-div">
                                                    <h4>Recommendations</h4>
                                                </div>
                                                <div class="col-md-12 text-center padding-0 margin-top-20">
                                                    <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                        <tbody>
                                                            <!-- <tr>
                                                                <td><b>Date : </b></td>
                                                                <td>12-04-2020</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Taken By : </b></td>
                                                                <td>John doe</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Reviewed By : </b></td>
                                                                <td>Joe S</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <select class="form-control" style="margin-top: 10px;">
                                                                        <option>Fever</option>
                                                                        <option>Toothache</option>
                                                                        <option>Other</option>
                                                                    </select>
                                                                </td>
                                                            </tr> -->
                                                            <tr>
                                                                <td colspan="2"><textarea required name="report" @if(isset($recommendation)) readonly="readonly" @endif class="form-control" rows="4" style="margin-top: 10px;">@if(isset($recommendation)) {{ $recommendation->report }} @endif</textarea></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr />
                                                
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="col-md-3">
                                    <div class="col-md-12 shadow-boxx">
                                        <form method="POST" action="{{ url('client_recommendation_submit') }}">
                                            @csrf
                                            <div class="col-md-12 text-center heading-div">
                                                <h4>Recommendations</h4>
                                            </div>
                                            <div class="col-md-12 text-center padding-0 margin-top-20">
                                                <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                    <tbody>
                                                        <!-- <tr>
                                                            <td><b>Date : </b></td>
                                                            <td>12-04-2020</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Taken By : </b></td>
                                                            <td>John doe</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Reviewed By : </b></td>
                                                            <td>Joe S</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <select class="form-control" style="margin-top: 10px;">
                                                                    <option>Fever</option>
                                                                    <option>Toothache</option>
                                                                    <option>Other</option>
                                                                </select>
                                                            </td>
                                                        </tr> -->
                                                        <tr>
                                                            <td colspan="2"><textarea required name="report" @if(isset($recommendation)) readonly="readonly" @endif class="form-control" rows="4" style="margin-top: 10px;">@if(isset($recommendation)) {{ $recommendation->report }} @endif</textarea></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr />
                                            
                                        </form>
                                    </div>
                                </div>
                            @endif

                            @if(isset($medication))
                                @if($medication->status == 1)
                                    <div class="col-md-3">
                                        <div class="col-md-12 shadow-boxx">
                                            <form method="POST" action="{{ url('client_medication_submit') }}">
                                                @csrf
                                                <div class="col-md-12 text-center heading-div">
                                                    <h4>Medications</h4>
                                                </div>
                                                <div class="col-md-12 text-center padding-0 margin-top-20">
                                                    <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                        <tbody>
                                                            <!-- <tr>
                                                                <td><b>Date : </b></td>
                                                                <td>12-04-2020</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Taken By : </b></td>
                                                                <td>John doe</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Reviewed By : </b></td>
                                                                <td>Joe S</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <select class="form-control" style="margin-top: 10px;">
                                                                        <option>Fever</option>
                                                                        <option>Toothache</option>
                                                                        <option>Other</option>
                                                                    </select>
                                                                </td>
                                                            </tr> -->
                                                            <tr>
                                                                <td colspan="2"><textarea required name="report" @if(isset($medication)) readonly="readonly" @endif class="form-control" rows="4" style="margin-top: 10px;">@if(isset($medication)) {{ $medication->report }} @endif</textarea></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr />
                                                
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="col-md-3">
                                    <div class="col-md-12 shadow-boxx">
                                        <form method="POST" action="{{ url('client_medication_submit') }}">
                                            @csrf
                                            <div class="col-md-12 text-center heading-div">
                                                <h4>Medications</h4>
                                            </div>
                                            <div class="col-md-12 text-center padding-0 margin-top-20">
                                                <table class="profile-info margin-bottom-10" style="width: 100%;">
                                                    <tbody>
                                                        <!-- <tr>
                                                            <td><b>Date : </b></td>
                                                            <td>12-04-2020</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Taken By : </b></td>
                                                            <td>John doe</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Reviewed By : </b></td>
                                                            <td>Joe S</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <select class="form-control" style="margin-top: 10px;">
                                                                    <option>Fever</option>
                                                                    <option>Toothache</option>
                                                                    <option>Other</option>
                                                                </select>
                                                            </td>
                                                        </tr> -->
                                                        <tr>
                                                            <td colspan="2"><textarea required name="report" @if(isset($medication)) readonly="readonly" @endif class="form-control" rows="4" style="margin-top: 10px;">@if(isset($medication)) {{ $medication->report }} @endif</textarea></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr />
                                            
                                        </form>
                                    </div>
                                </div>
                            @endif

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).on('click', '.edit_report', function(){
        // alert($(this).closest('.shadow-boxx').html());
        $(this).closest('.shadow-boxx').find('textarea').removeAttr('readonly');
    });
</script>

@endsection