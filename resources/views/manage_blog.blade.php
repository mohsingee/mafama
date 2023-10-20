@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Manage Professional Blogs</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('blog_entry') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Blog Title</label>
												<input type="text" class="form-control" placeholder="" value="" name="title" required />
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-control-wrap">
												<label class="form-label" for="">Upload Image</label>
												<div class="custom-file">
													<input type="file" name="image" class="form-control custom-file-input" id="customFile" required>
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
											
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label">Description</label>
												<textarea class="form-control summernote" placeholder="" rows="2" name="description" required></textarea>
											</div>
										</div>
										
										
										
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-sm btn-primary">Save</button>
										</div>
									</div>
								</form>
								
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
											<th class="nk-tb-col"><span class="sub-text">Blog Title</span></th>
											<th class="nk-tb-col"><span class="sub-text">Description</span></th>
											<th class="nk-tb-col"><span class="sub-text">Image</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
										$i = 1;
											foreach ($blogs as $blog) {
										?>
											<tr class="nk-tb-item">
												<td class="nk-tb-col">
													<span><?= $i ?></span>
												</td>
												<td class="nk-tb-col">
													<?= Str::limit($blog->title,255)?>
												</td>
												<td class="nk-tb-col">
													<?= Str::limit($blog->description,255)?>
												</td>
												<td class="nk-tb-col">
													<img src="{{ asset('public/assets/images/blogs') }}/<?= $blog->image ?>" style="width:200px;height:120px;">
												</td>
												<td class="nk-tb-col tb-col-md">
													<a href="{{ url('manage_blog_edit') }}/<?= $blog->id ?>" class="btn btn-sm btn-primary">Edit</a>
													<a href="{{ url('manage_blog_delete') }}/<?= $blog->id ?>" class="btn btn-sm btn-danger">Delete</a>
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