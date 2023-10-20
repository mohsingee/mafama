@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Email Tutorials</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								@if(permission_access('emails_tut_add')==1)
								<form id="" action="{{ url('email_tutorials_entry') }}" method="POST" enctype="multipart/form-data">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" name="name" required />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Video</label>
												<div class="form-control-wrap">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="customFilee" name="video" required>
														<label class="custom-file-label" for="customFilee">Choose file</label>
													</div>
													<p>*Recommended: .mp4/.mkv </p>
												</div>
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
											<th class="nk-tb-col"><span class="sub-text">Tutorial Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Link </span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($videos as $video) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $video->name ?></span>
												
											</td>
											<td class="nk-tb-col">
												<video controls id="videoblah" style="height: 200px;width:350px">
												  	<source src="<?php echo asset("public/videos") ?>/<?= $video->video ?>" type="video/mp4" id="blah">
												</video>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('emails_tut_edit')==1)
												<a href="<?php echo url('editemail_tutorial') ?>/<?= $video->id ?>" class="btn btn-sm btn-primary">Edit</a>
												@endif
												@if(permission_access('emails_tut_delete')==1)
												<a href="<?php echo url('deleteemail_tutorial') ?>/<?= $video->id ?>" class="btn btn-sm btn-danger">Delete</a>
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