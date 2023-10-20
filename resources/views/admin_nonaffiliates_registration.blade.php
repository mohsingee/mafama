@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                          <h3 class="nk-block-title page-title"  style="width:980px;">Non - Affiliates Registration</h3> 
								<!--   <a href="{{ url('add_affilates_registration') }}" class="btn btn-sm btn-primary" style="float:right;">Add New</a>
							-->
                            
                        </div><!-- .nk-block-head-content -->
                        
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Profile First Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Profile Last Name</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Profile Email</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Password</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
											
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($details as $value) {
										?>
												<tr class="nk-tb-item">
													<td class="nk-tb-col">
														<span><?= $value->first_name ?></span>
														
													</td>
													<td class="nk-tb-col">
														<span><?= $value->last_name ?></span>
														
													</td>
													<td class="nk-tb-col tb-col-md">
														<span><?= $value->email ?></span>
													</td>
														<td class="nk-tb-col tb-col-md">
														<span><?= $value->show_pass ?></span>
													</td>
													<td class="nk-tb-col tb-col-md">
														<span class="bfh-countries" data-country="<?= $value->country ?>"></span>
													</td>
													<td class="nk-tb-col tb-col-md">
														<a href="{{ url('view_nonaffiliates_registration') }}/<?= $value->id ?>" class="btn btn-sm btn-primary">View</a>
														<a href="{{ url('edit_nonaffiliates_registration') }}/<?= $value->id ?>" class="btn btn-sm btn-primary">Edit</a>
														<a  data-email="<?= $value->email ?>" href="javascript:void(0)" class="btn btn-sm btn-danger deletenonaffiliate" data-list="affiliate_registrations">Delete</a>
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