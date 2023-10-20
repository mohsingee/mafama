@extends('layouts.main') 
@section("content")

<section>
                <div class="container">
                    <div class="row">
                        <!-- tabs content -->
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-12 margin-bottom-20">
                                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                    <h4>Settings / Block Dates</h4>
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
                                    <li><a href="{{ url('add_appointment_setting') }}">Appointment Settings</a></li>
                                    <li class="active"><a href="{{ url('manag_date_settings') }}">Manage Date Settings</a></li>
                                    
                                </ul>

                                <div class="tab-content margin-top-10"  style="  border-radius:10px;padding:10px;">
                                <form id="" action="" method="">
                                    <div class="col-md-12" style="border:1px solid #da291c !important; border-radius:10px;padding-top:30px;padding-bottom:20px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Start Date</label>
                                                <input type="text" class="form-control datepicker">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">End Date</label>
                                                <input type="text" class="form-control datepicker">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Reason</label>
                                                <select class="form-control select2">
                                                    <option>Vaccation</option>
                                                    <option>Sick</option>
                                                    <option>Reason Test</option>
                                                    <option>Reason Test1</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-12 text-center" style="margin-top:20px;margin-bottom:20px; ">
                                            <a href="#" class="btn btn-md btn-info">Save</a>
                                            
                                        </div>
                                    </div>
                                </form>
                                
                            
                            
                            <div class="col-md-12">
                                
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                    <thead>
                                        <tr>
                                            <th>Reason</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td>Reason Test</td>
                                            <td>07/09/2019</td>
                                            <td>12/09/2019</td>
                                            <td>
                                                <a href="{{ url('manag_date_settings') }}" class="btn btn-xs btn-info">Edit</a>
                                                <a href="" class="btn btn-xs btn-info">Delete</a>
                                            </td>
                                            
                                        </tr><!-- .nk-tb-item  -->
                                        <tr class="odd gradeX">
                                            <td>Reason Test1</td>
                                            <td>10/12/2019</td>
                                            <td>20/12/2019</td>
                                            <td>
                                                <a href="{{ url('manag_date_settings') }}" class="btn btn-xs btn-info">Edit</a>
                                                <a href="" class="btn btn-xs btn-info">Delete</a>
                                            </td>
                                            
                                        </tr><!-- .nk-tb-item  -->
                                        <tr class="odd gradeX">
                                            <td>Vaccation</td>
                                            <td>18/03/2020</td>
                                            <td>10/04/2020</td>
                                            <td>
                                                <a href="{{ url('manag_date_settings') }}" class="btn btn-xs btn-info">Edit</a>
                                                <a href="" class="btn btn-xs btn-info">Delete</a>
                                            </td>
                                            
                                        </tr><!-- .nk-tb-item  -->
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>

@endsection