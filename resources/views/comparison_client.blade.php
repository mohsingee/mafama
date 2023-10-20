@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Client Management / Client Comparisons</h4>
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
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-button-tabs nav-justified">
                        <li class="active"><a href="#tab1" data-toggle="tab">Management Client Profile</a></li>
                        <li><a href="#tab2" data-toggle="tab">View Client Profiles</a></li>
                        <li><a href="#tab3" data-toggle="tab">Client List</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Client Names</th>
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
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>

                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Client Names</th>
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
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>

                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <table class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Client Names</th>
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
                                        <th>Graph</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td>Test</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr class="odd gradeX">
                                        <td style="color: #da291c;"><b>Total</b></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>

                                        <td>
                                            <a href="#"><i class="fa fa-bar-chart"></i></a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection