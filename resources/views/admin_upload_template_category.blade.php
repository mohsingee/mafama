@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Upload Client Template</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
									 @if(permission_access('templates_upload_add')==1)
								<form id="" action="{{ url('uploadtemplate_entry') }}" method="POST" enctype="multipart/form-data">	
								@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Upload Category</label>
												<div class="custom-file">
													<input type="file" multiple="" class="custom-file-input" id="customFile" name="image" required>
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category template1</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="category" required>
													<?php 
													foreach ($categories as $value) {
													?>
													  	<option value="<?= $value->category ?>"><?= $value->category ?></option>
													<?php
													}
													?>
												</select>
												@if($errors->any())
													<p style="color: red">{{$errors->first()}}</p>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category Description</label>
												<input type="text" class="form-control" name="description" required>
											</div>
										</div>
										
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
								@endif
							</div>
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
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Template Category</span></th>
											<th class="nk-tb-col"><span class="sub-text">Category Desc</span></th>
											<th class="nk-tb-col"><span class="sub-text">Category Thumbnail</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($templates as $template) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $template->category ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $template->description ?></span>
											</td>
											<td class="nk-tb-col">
												<img src="<?= asset('public/images')?>/<?= $template->image ?>" style="width:200px;height:120px;">
											</td>
											<td class="nk-tb-col tb-col-md">
											 @if(permission_access('templates_upload_edit')==1)
												<a href="<?php echo url('edituploadtemplate') ?>/<?= $template->id ?>" class="btn btn-sm btn-primary">Edit</a>
												@endif
												@if(permission_access('templates_upload_delete')==1)
												<a href="<?php echo url('deleteuploadtemplate') ?>/<?= $template->id ?>" class="btn btn-sm btn-danger">Delete</a>
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