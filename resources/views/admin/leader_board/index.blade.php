@extends('layouts.admin')
{{-- {{ dd($user_birthplace_text) }} --}}
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<div class="nk-content bg_green">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class=" card-inner-lg" style="background-color:#fff">
                                <div class="text-center" style="margin-bottom: 30px">
                                    <h4>Leaders Board</h4>
                                </div>
                                <div class="row" style="border: 1px solid #da291c !important; padding-top:30px;margin-bottom:30px; ">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <h4>Update Data</h4>
                                        </div>
                                        <form action="{{ url('admin/setting/leadersboard') }}" method="POST"
                                            id="" enctype="multipart/form-data">
                                            <input type="hidden" name="actions" value="setting">
                                            @csrf
                                            <div class="col-md-12"
                                                style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Main Heading</label>
                                                        <input type="text" class="form-control" name="main_heading"
                                                            @if (isset($main) && $main->upload_type == 'main_heading') value="{{ $main->description ?? '' }}" @endif>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Sub Heading</label>
                                                        <input type="text" class="form-control" name="sub_heading"
                                                            @if (isset($sub) && $sub->upload_type == 'sub_heading') value="{{ $sub->description ?? '' }}" @endif>
                                                    </div>
                                                </div>

                                                @if (isset($main) && $main->upload_type == 'main_heading')
                                                    <input type="hidden" class="form-control" name="actions"
                                                        value="update">
                                                    <input type="hidden" class="form-control" name="main_heading_id"
                                                        value="{{ isset($main) ? $main->id : '' }}">
                                                    <input type="hidden" class="form-control" name="sub_heading_id"
                                                        value="@if (isset($sub) && $sub->upload_type == 'sub_heading'){{ $sub->id ?? '' }}@endif">
                                                @endif

                                                <div class="col-md-2" style="margin-top: 25px;">
                                                    <button type="submit" class="btn btn-md btn-info" id="">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="row" style="border: 1px solid #da291c !important; padding-top:30px;margin-bottom:30px; ">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <h4>Add Leaders Board</h4>
                                        </div>
                                        <hr style="margin-bottom:30px; ">
                                        <form action="{{ url('admin/add/leadersboard') }}" method="POST" id=""
                                            enctype="multipart/form-data">
                                            @csrf
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control editor" name="title"
                                                            placeholder="Enter Main Title Here" >
                                                        {{-- <textarea class="form-control editor" name="title"
                                                            placeholder="" style="height: 70px;">
                                                        </textarea> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Sub Title</label>
                                                        <input type="text" class="form-control editor" name="sub_title"
                                                            placeholder="Enter Sub Title here">
                                                        {{-- <textarea class="form-control editor" name="sub_title"
                                                            placeholder="" style="height: 70px;">
                                                        </textarea> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control editor" name="description"
                                                            placeholder="Enter Description Here" style="height: 70px;">
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="margin-top: 25px;">
                                                    <button type="submit" class="btn btn-md btn-info" id="">
                                                        Save
                                                    </button>

                                                </div>
                                        </form>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>


                                <div class="row" style="border: 1px solid #da291c !important; padding-top:30px; ">

                                    <div class="col-md-12">
                                        <h4>All Leaders Board</h4>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                        <thead>
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="20%">Title</th>
                                                <th width="30%">Sub Title</th>
                                                <th width="20%">Description</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($boards as $value) { ?>
                                            <tr>
                                                <td>
                                                    <?= $value->id ?>
                                                </td>
                                                <td>
                                                    {!!  $value->title !!}
                                                </td>
                                                <td>
                                                    {!!  $value->sub_title !!}
                                                </td>
                                                <td>
                                                    {!! $value->description !!}
                                                </td>
                                                <td width="20%">
                                                    <form action="{{ url('delete_leader_board') }}" method="POST"
                                                        id="" enctype="multipart/form-data"
                                                        style="display: inline-flex;">
                                                        @csrf
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ url('admin/edit/leadersboard') . '/' . $value->id }}">Edit</a>
                                                        &nbsp;
                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                        <input type="submit" class="btn btn-xs btn-danger"
                                                            value="Delete">
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
    CKEDITOR.replaceAll('editor');
</script>
@endsection