@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Manage Department</h3>
					
				</div><!-- .nk-block-head-content -->
				@if(permission_access('create_department_add')==1)
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('department_entry') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Department Name	</label>
												<input type="text" name="department" class="form-control" placeholder="Department Name" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Abbreviation	</label>
												<input type="text" name="abbreviation" class="form-control" placeholder="Abbreviation" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Country	</label>
												<select id="countries_states1" class="form-control bfh-countries" data-country="US" name="country" required></select>
											</div>
										</div>
										<div class="col-12">

											<button type="submit" class="btn btn-lg btn-primary">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				@endif
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Department Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Abbreviation</span></th>
											<th class="nk-tb-col"><span class="sub-text">Country</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
											foreach ($departments as $department) {
										?>
												<tr class="nk-tb-item">
													<td class="nk-tb-col">
														<span><?= $i ?></span>
													</td>
													<td class="nk-tb-col">
														<span><?= $department->department ?></span>
													</td>
													<td class="nk-tb-col">
														<span><?= $department->abbreviation ?></span>
													</td>
													<td class="nk-tb-col">
														<span><?= $department->country ?></span>
													</td>
													<td class="nk-tb-col tb-col-md">
														@if(permission_access('create_department_edit')==1)
														<a href="{{ url('edit_manage_department') }}/<?= $department->id ?>" class="btn btn-sm btn-success">Edit</a>
														@endif
														@if(permission_access('create_department_delete')==1)
														<a href="{{ url('delete_manage_department') }}/<?= $department->id ?>" class="btn btn-sm btn-danger">Delete</a>
														@endif
													</td>
												</tr>
										<?php
											$i++;
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