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
                        <div class="tab-pane fade in active" id="tab1">
                         <!--    <form id="" class="" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">Test Names</label>
                                            <input type="text" class="form-control" name="test_name" required="" placeholder="Test Names"  />
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">Upload File</label>
                                            <input type="file" class="form-control" name="file"  required="" />
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <input id="id" type="hidden" name="id" value="">
                                        <button type="submit" class="btn btn-md btn-info" >Submit</button>
                                       
                                    </div>
                                </div>
                            </form> -->
                              <div class="col-md-12 padding-0 text-center margin-bottom-0" style="margin-bottom: 0px;padding-bottom: 0px">
                                        <h4 style="margin-bottom: 0px;">Resources</h4>
                            </div>
                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>Grouping by condition</th>
                                            <th> Patient</th>
                                            <th>Medications</th>
                                            <th>Recommendations</th>
                                            <th>Results/ Observation</th>
                                            <th>Time frame</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Diabetics</td>
                                            <td>310</td>
                                            <td>Ab1</td>
                                            <td>Drink Water</td>
                                            <td>Satisfactory</td>
                                            <td>6 Month</td>
                                        </tr>
                                         <tr>
                                            <td>High Blood Pressure</td>
                                            <td>415</td>
                                            <td>CC2</td>
                                            <td>Drink Juice</td>
                                             <td></td>
                                            <td></td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Cholesterol</td>
                                            <td>250</td>
                                            <td>LL70</td>
                                            <td>Eat Apple</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="clearfix"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection