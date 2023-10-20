@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Create Revenue Account</h4>
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
                        <li><a href="{{ url('create_revenue_account') }}">Create Revenue Account</a></li>
                        <li class="active"><a href="{{ url('create_expenses_account') }}">Create Expense Account</a></li>
                        <li><a href="{{ url('invoice_setup') }}">Invoice Setup</a></li>
                        <li><a href="#">Balance Sheet</a></li>
                        <li><a href="{{ url('templates') }}">Choose a template</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <form id="" action="" method="">
                            <div class="col-md-12" style="border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Account Name (optional) </label>
                                        <input type="text" class="form-control" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Expense Type </label>
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
                                        <th>Expense Type</th>
                                        <th>Default Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Phone</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ url('create_expense_account') }}" class="btn btn-xs btn-success">Edit</a>
                                            <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td></td>
                                        <td>Electricity</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ url('create_expense_account') }}" class="btn btn-xs btn-success">Edit</a>
                                            <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td></td>
                                        <td>Credit Card</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ url('create_expense_account') }}" class="btn btn-xs btn-success">Edit</a>
                                            <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td></td>
                                        <td>Oil Purchase</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ url('create_expense_account') }}" class="btn btn-xs btn-success">Edit</a>
                                            <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td></td>
                                        <td>Fuel</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ url('create_expense_account') }}" class="btn btn-xs btn-success">Edit</a>
                                            <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td></td>
                                        <td>Water</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ url('create_expense_account') }}" class="btn btn-xs btn-success">Edit</a>
                                            <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
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


@endsection