@extends('layouts.main')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Archives / Client Archives</h4>
                        </div>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-20">
                        <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                        <a href="{{ url('birthplace') }}" class="btn btn-md btn-info margin-right-10">My Birth Place</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                        <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <?php } ?>
                        <?php if($tools != "off"){ ?>
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                        <?php } ?>
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">My Daily
                            Briefing</a>
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>
                    <!--<ul class="nav nav-tabs nav-button-tabs nav-justified" style="padding: 15px;">
                                    <li class="active"><a href="comparison-tab1.php">Appointment</a></li>
                                    <li><a href="comparison-tab2.php">Client Management</a></li>
                                    <li><a href="comparison-tab3.php">Email Management</a></li>
                                    <li><a href="comparison-tab4.php">Financial Management</a></li>
                                    
                                </ul>-->
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#tab1" data-toggle="tab">Profile Info</a></li>
                            <li><a href="#tab2" data-toggle="tab">Tasks</a></li>
                        </ul>

                        <div class="tab-content margin-top-10"
                            style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="tab1">
                                <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th>Client Names</th>
                                            <th>Reported</th>
                                            <th>Diagnostic</th>
                                            <th>Recommendations</th>
                                            <th>Medications</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John doe</td>
                                            <td>Work hard</td>
                                            <td>Work too much</td>
                                            <td>Slow work</td>
                                            <td>B Tea Leamon</td>
                                        </tr>
                                        <!-- .nk-tb-item  -->
                                        <tr>
                                            <td>Joe S</td>
                                            <td>Work hard</td>
                                            <td>Work too much</td>
                                            <td>Slow work</td>
                                            <td>B Tea Leamon</td>
                                        </tr>
                                        <!-- .nk-tb-item  -->
                                        <tr>
                                            <td>Mary</td>
                                            <td>Work hard</td>
                                            <td>Work too much</td>
                                            <td>Slow work</td>
                                            <td>B Tea Leamon</td>
                                        </tr>
                                        <!-- .nk-tb-item  -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab2">
                                <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th>Names</th>
                                            <th>Task Description</th>
                                            <th>Shift End Outcome</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>desc..</td>
                                            <td>Completed</td>
                                            <td>Dummy Text</td>
                                        </tr>
                                        <!-- .nk-tb-item  -->
                                        <tr>
                                            <td>Mary Smith</td>
                                            <td>desc..</td>
                                            <td>Completed</td>
                                            <td>Dummy Text</td>
                                        </tr>
                                        <!-- .nk-tb-item  -->
                                        <tr>
                                            <td>Joe S</td>
                                            <td>desc..</td>
                                            <td>Completed</td>
                                            <td>Dummy Text</td>
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
