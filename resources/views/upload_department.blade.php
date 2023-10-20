@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Manage Department</h3>
					
				</div><!-- .nk-block-head-content -->
				@if(permission_access('upload_department_add')==1)
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('department_upload_entry') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Upload Department	</label>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="customFile" name="image">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Department Name	</label>
												<select class="form-control" name="department_id">
													<?php 
														foreach ($departments as $department) 
														{
													?>
															<option value="<?= $department->id ?>"><?= $department->department ?></option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
										<!-- <div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Abbreviation	</label>
												<input type="text" class="form-control" placeholder="Abbreviation">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Country	</label>
												<select class="form-control">
													<option>Afghanistan</option>
													<option>Albania</option>
													<option>Algeria</option>
													<option>American Samoa</option>
													<option>Andorra</option>
												</select>
											</div>
										</div> -->
										
										
										
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
											<th class="nk-tb-col"><span class="sub-text">Thumbnail</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
											foreach ($uploads as $upload) {
										?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $upload->department ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $upload->abbreviation ?></span>
											</td>
											<td class="nk-tb-col">
												<img src="<?php echo asset('public/assets/images/departments') ?>/<?= $upload->image ?>" style="width:200px;height:120px;">
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('upload_department_edit')==1)
												<a href="{{ url('upload_department_edit') }}/<?= $upload->did ?>" class="btn btn-sm btn-success">Edit</a>
												@endif
												@if(permission_access('upload_department_delete')==1)
												<a href="{{ url('upload_department_delete') }}/<?= $upload->did ?>" class="btn btn-sm btn-danger">Delete</a>
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