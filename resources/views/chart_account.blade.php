@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            @include('setting_header');
            <!-- tabs content -->
            <div class="col-md-9 col-sm-9">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Chart of Account</h4>
                    </div>
                    <form id="" action="" method="">
                        <div class="col-md-12" style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Revenue Name </label>
                                    <input type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Account Number (optional) </label>
                                    <input type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Default Amount (optional) </label>
                                    <input type="text" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                                <a href="#" class="btn btn-xs btn-info">Save</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
                <div class="divider divider-center divider-short">
                    <!-- divider -->
                    <i class="fa fa-star-o"></i>
                </div>

                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                        <thead>
                            <tr>
                                <th>Account Number</th>
                                <th>Revenue Name</th>
                                <th>Default Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>Test</td>
                                <td>0</td>
                                <td>
                                    <a href="{{ url('chart_account') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                            <tr>
                                <td></td>
                                <td>Test1</td>
                                <td>0</td>
                                <td>
                                    <a href="{{ url('chart_account') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                            <tr>
                                <td></td>
                                <td>Test11</td>
                                <td>0</td>
                                <td>
                                    <a href="{{ url('chart_account') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                            <tr>
                                <td></td>
                                <td>Test12</td>
                                <td>0</td>
                                <td>
                                    <a href="{{ url('chart_account') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                            <tr>
                                <td></td>
                                <td>Test13</td>
                                <td>0</td>
                                <td>
                                    <a href="{{ url('chart_account') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                            <tr>
                                <td></td>
                                <td>Test14</td>
                                <td>0</td>
                                <td>
                                    <a href="{{ url('chart_account') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection