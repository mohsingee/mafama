@extends('layouts.admin')
{{-- {{ dd($user_birthplace_text) }} --}}
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class=" card-inner-lg" style="background-color:#fff">
                                <div class="text-center" style="margin-bottom: 30px">
                                    <h4>User's Leaders Board</h4>
                                </div>


                                <div class="row" style="border: 1px solid #da291c !important; padding-top:30px; ">

                                    <div class="col-md-12">
                                        <h4>All Leaders Board</h4>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="card-inner">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>User Name</th>
                                                <th>User Email</th>
                                                <th>Phone</th>
                                                <th>Leader Board</th>
                                                <th>Picture (User Data)</th>
                                                <th>Description (15 Words)</th>
                                                <th>Experience (4 Words)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($boards as $value) { ?>
                                            <tr>
                                                <td>
                                                    <?= $value->first_name.' '.$value->last_name ?>
                                                </td>
                                                <td>
                                                    {{ $value->username }}
                                                </td>
                                                <td>
                                                    {{ $value->email }}
                                                </td>
                                                <td>
                                                    {{ $value->cellphone }}
                                                </td>
                                                <td>
                                                    {{ $value->title}}
                                                </td>
                                                <td>
                                                    @if(!empty($value->file_url))
                                                    <img src="{{ asset($value->file_url) }}" class="blah-" style="width:150px">
                                                    @else
                                                    <img src="{{ asset('images/logo1.jpg') }}" alt="" style="width:150px" />
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $value->other }}
                                                </td>
                                                <td>
                                                    {{ $value->rp_description }}
                                                </td>
                                                <td width="20%">
                                                    @if($value->status==1)
                                                    <button class="btn btn-xs btn-danger bg_green">Approved</button>
                                                    @else
                                                    <form action="{{ url('approve_user_leader_board') }}" method="POST"
                                                        id="" enctype="multipart/form-data"
                                                        style="display: inline-flex;">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                        <input type="submit" class="btn btn-xs btn-secondary"
                                                            value="Approve">
                                                    </form>
                                                    @endif
                                                    <form action="{{ url('delete_user_leader_board') }}" method="POST"
                                                        id="" enctype="multipart/form-data"
                                                        style="display: inline-flex;">
                                                        @csrf
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
                                    </div>
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