@extends('layouts.admin')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <!--   <h3 class="nk-block-title page-title"  style="width:980px;">Affilates Registration
                                                                                                                                                                                                            <a href="{{ url('add_affilates_registration') }}" class="btn btn-sm btn-primary" style="float:right;">Add New</a>
                                                                                                                                                                                                           </h3> -->

                            </div><!-- .nk-block-head-content -->

                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    {{-- <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <form action="{{ url('user_report_search_result') }}" method="POST">
                                        @csrf
                                    
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Country of Residence</label>
                                <select id="countries_states1" class="form-control bfh-countries"
                                    data-country="{{ !empty($id) ? $result->country : 'US' }}" name="country"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">State/Commune of Birth</label>
                                <input type="text" class="form-control" name="state" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">City of Residence</label>
                                <input type="text" class="form-control" name="city" required value="">
                            </div>
                        </div>



                    </div><br>

                    <div class="col-12">

                        <button type="submit" class="btn btn btn-primary">Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div> --}}
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="col-md-12">

                                </div>
                                <div class="card-inner">
                                    <div class="col-md-12"
                                        style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <h4>Upload Videos</h4>
                                            </div>
                                            <form action="{{ url('add_user_birthplace_details') }}" method="POST"
                                                id="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-12"
                                                    style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="">Video Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                value="">
                                                            <input type="hidden" class="form-control" name="uid"
                                                                value="{{ Auth::id() }}">
                                                            <input type="hidden" class="form-control" name="upload_type"
                                                                value="video">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Video Upload</label>
                                                            <div class="fancy-file-upload fancy-file-info">
                                                                <i class="fa fa-upload"></i>
                                                                <input type="file" class="form-control" name="file_url"
                                                                    onchange="jQuery(this).next('input').val(this.value);"
                                                                    required accept="video/*" />
                                                                <input type="text" class="form-control"
                                                                    placeholder="no file selected" readonly="" />
                                                                <span class="button">Choose File</span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control summernote" name="description" style="height: 70px;"></textarea>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="margin-top: 25px;">
                                                        <button type="submit" class="btn btn-md btn-info"
                                                            id="">Save</button>

                                                    </div>
                                                </div>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="col-md-6" style="border-left: 1px solid #da291c !important; ">
                                            <div class="col-md-12">
                                                <h4>Upload Banner</h4>
                                            </div>
                                            <form action="{{ url('add_user_birthplace_details') }}" method="POST"
                                                id="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-12"
                                                    style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="">Banner Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                value="">
                                                            <input type="hidden" class="form-control" name="uid"
                                                                value="{{ Auth::id() }}">
                                                            <input type="hidden" class="form-control" name="upload_type"
                                                                value="banner">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Banner Upload</label>
                                                            <div class="fancy-file-upload fancy-file-info">
                                                                <i class="fa fa-upload"></i>
                                                                <input type="file" class="form-control" required
                                                                    name="file_url"
                                                                    onchange="jQuery(this).next('input').val(this.value);" />
                                                                <input type="text" class="form-control"
                                                                    placeholder="no file selected" readonly="" />
                                                                <span class="button">Choose File</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control summernote" name="description" placeholder="" style="height: 70px;"></textarea>

                                                        </div>
                                                    </div>



                                                    <div class="col-md-2" style="margin-top: 25px;">
                                                        <button type="submit" class="btn btn-md btn-info"
                                                            id="">Save</button>

                                                    </div>
                                                </div>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="col-md-12"
                                        style="border: 1px solid #da291c !important; border-radius: 10px; margin-top:10px; padding-top: 30px; padding-bottom: 20px;">
                                        <div class="clearfix"></div>
                                        {{-- {{ dd($user_birthplace_details) }} --}}
                                        <div class="col-md-12">
                                            <h4>User Uploads</h4>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover"
                                            id="datatable_sample">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Title</th>
                                                    <th>File</th>
                                                    <th>Description</th>
                                                    <th width="20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                        foreach ($user_birthplace_details as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $value->upload_type ?></td>
                                                    <td><?= $value->title ?></td>
                                                    <td>
                                                        @if ($value->upload_type == 'banner')
                                                            <img src="{{ asset($value->file_url) }}" width="50"
                                                                height="50"
                                                                style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;">
                                                        @else
                                                            <video width="100%" controls>
                                                                <source src="{{ $value->file_url }}" type="video/mp4">
                                                            </video>
                                                        @endif
                                                    </td>
                                                    <td><?= $value->description ?></td>


                                                    <td width="20%">

                                                        <form action="{{ url('delete_user_birthplace_details') }}"
                                                            method="POST" id="" enctype="multipart/form-data"
                                                            style="display: inline-flex;">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $value->id }}">
                                                            <input type="submit" class="btn btn-xs btn-danger"
                                                                value="Delete">
                                                        </form>

                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blahh').attr('src', e.target.result);
                        // $("#blah").html('<img src="'+e.target.result+'>');
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
        });
    @endsection
