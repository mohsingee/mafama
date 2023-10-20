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
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <form action="{{ url('user_report_search_result') }}" method="POST">
                                        @csrf
                                        {{-- <input type="hidden" name="id" value="{{ $id }}"> --}}
                                        <div class="row gy-4">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Country of Residence</label>
                                                    <select id="countries_states1" class="form-control bfh-countries"
                                                        data-country="{{ !empty($id) ? $result->country : 'US' }}"
                                                        name="country"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">State/Commune of Birth</label>
                                                    <select class="form-control bfh-states" data-country="countries_states1"
                                                        name="state"></select>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">City of Residence</label>
                                                    <input type="text" class="form-control" name="city"
                                                        value="">
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
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="col-md-12">

                                </div>
                                <div class="card-inner">

                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Full Name & Picture</span></th>
                                                <th class="nk-tb-col"><span class="sub-text">Date of Birth</span></th>
                                                <th class="nk-tb-col">State/Commune of Birth</th>
                                                <th class="nk-tb-col">Country of Residence</th>
                                                <th class="nk-tb-col">City of Residence</th>
                                                <th class="nk-tb-col">Biz Name if any</th>
                                                <th class="nk-tb-col" width="20%"> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                            foreach($user_list as $value){
                                //   print_r($value);
                            ?>
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col">
                                                    @if (isset($value->image))
                                                        <img src="{{ $value->image }}" width="50" height="50"
                                                            style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;">
                                                        <br>
                                                    @endif
                                                    <?= $value->first_name . ' ' . $value->last_name ?>
                                                </td>
                                                <td><?= date('d F', strtotime($value->dob)) ?></td>

                                                <td><?= (isset($value->birth_state) ? $value->birth_state : isset($value->birth_commune)) ? showcommuneName($value->birth_commune) : '' ?>
                                                </td>
                                                <td><?= $value->birth_country != '' ? getCountryName($value->birth_country) : '' ?>

                                                </td>
                                                <td><?= $value->birth_city ?></td>
                                                <td class="nk-tb-col"></td>
                                                <td class="nk-tb-col" width="20%">
                                                    <a href="{{ url('admin_birthplace_view') }}/<?= base64_encode($value->email) ?>"
                                                        class="btn btn-xs btn-info">View Birthplace</a>
                                                    <a href="#" class="btn btn-xs btn-info">Delete</a>
                                                    <a href="#" class="btn btn-xs btn-success">Save</a>
                                                    @if ($value->status == 1)
                                                        <a href="#" class="btn btn-xs btn-danger">Block</a>
                                                    @else
                                                        <a href="#" class="btn btn-xs btn-primary">Un-Block</a>
                                                    @endif

                                                    <a href="#" class="btn btn-xs btn-warning">Contact</a>
                                                    <a href="#" class="btn btn-xs btn-warning"> More info</a>

                                                </td>
                                            </tr>
                                            <?php 
                                             
                                }
                            ?>
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
@endsection
