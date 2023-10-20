@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 margin-bottom-20">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Templates</h4>
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
                    <form id="" action="" method="">
                        <div class="col-md-12" style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name </label>
                                    <input type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Select Category </label>
                                    <select class="form-control select2">
                                        <option>Cat 1</option>
                                        <option>Cat 2</option>
                                        <option>Cat 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Description </label>
                                    <input type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Upload</label>
                                    <div class="fancy-file-upload fancy-file-info">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                        <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                                <a href="#" class="btn btn-md btn-info">Save</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Thumbnail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Test</td>
                                <td>Cat1</td>
                                <td>Dummy Text</td>
                                <td><img src="images/maxresdefault.jpg" style="width: 200px; height: 100px;" /></td>
                                <td>
                                    <a href="{{ url('templates') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                            <tr>
                                <td>Test1</td>
                                <td>Cat1</td>
                                <td>Dummy Text</td>
                                <td><img src="images/maxresdefault.jpg" style="width: 200px; height: 100px;" /></td>
                                <td>
                                    <a href="{{ url('templates') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                            <tr>
                                <td>Test11</td>
                                <td>Cat1</td>
                                <td>Dummy Text</td>
                                <td><img src="images/maxresdefault.jpg" style="width: 200px; height: 100px;" /></td>
                                <td>
                                    <a href="{{ url('templates') }}" class="btn btn-xs btn-success">Edit</a>
                                    <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- .nk-tb-item  -->
                            <tr>
                                <td>Test12</td>
                                <td>Cat1</td>
                                <td>Dummy Text</td>
                                <td><img src="images/maxresdefault.jpg" style="width: 200px; height: 100px;" /></td>
                                <td>
                                    <a href="{{ url('templates') }}" class="btn btn-xs btn-success">Edit</a>
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