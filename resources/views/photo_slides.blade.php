@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Photo Slides</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								 @if(permission_access('aff_feedback_add')==1)
								<form id="" action="{{ url('photo_slide_entry') }}" method="POST" enctype="multipart/form-data">
								@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" name="name" placeholder="Name" value="" reqiured />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Comment</label>
												<input type="text" class="form-control" name="comment" placeholder="Comment" value="" reqiured />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Rating</label>
												<input type="text" class="form-control" name="rating" placeholder="Rating" value="" reqiured />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-control-wrap">
												<label class="form-label" for="">Upload Photo(Recommended size: 300 x 300 px)</label>
												<div class="custom-file">
													<input type="file" name="image" class="form-control custom-file-input" id="customFileim" reqiured>
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<p>*Recommended extension: .jpg/.jpeg/.png </p>
											</div>
											<div style="margin-top:10px; text-align: right;">
												<img src="" style="width:200px;height:200px;display: none;" id="blah">
											</div>
										</div>
										
										
										
										<div class="col-md-12 text-center">
											<input type="submit" value="Save" class="btn btn-sm btn-primary">
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
											<th class="nk-tb-col"><span class="sub-text">Name</span></th>
											<th class="nk-tb-col"><span class="sub-text">Comment</span></th>
											<th class="nk-tb-col"><span class="sub-text">Rating</span></th>
											<th class="nk-tb-col"><span class="sub-text">Photo</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($slides as $slide) {
						                ?>
											<tr class="nk-tb-item">
												<td class="nk-tb-col">
													<span><?= $i ?></span>
												</td>
												<td class="nk-tb-col">
													<?= $slide->name ?>
												</td>
												<td class="nk-tb-col">
													<?= $slide->comment ?>
												</td>
												<td class="nk-tb-col">
													<?= $slide->rating ?>
												</td>
												<td class="nk-tb-col">
													<img src="<?php echo asset("public/assets/images/demo/people/300x300") ?>/<?= $slide->image ?>" style="width:120px;height:120px;">
												</td>
												<td class="nk-tb-col tb-col-md">
													 @if(permission_access('aff_feedback_edit')==1)
													<a href="<?php echo url('editphoto_slide') ?>/<?= $slide->id ?>" class="btn btn-sm btn-primary">Edit</a>
													 @endif
													  @if(permission_access('aff_feedback_delete')==1)
													<a href="<?php echo url('deletephoto_slide') ?>/<?= $slide->id ?>" class="btn btn-sm btn-danger">Delete</a>
													@endif
													 @if(permission_access('aff_feedback_edit')==1)
													<?php if($slide->status == 'deactive'){ ?>
												    <a href="<?php echo url('showhome_photoslide') ?>/<?= $slide->id ?>" class="btn btn-sm btn-primary">Show</a>
												<?php }else{ ?>
												    <a href="<?php echo url('hidehome_photoslide') ?>/<?= $slide->id ?>" class="btn btn-sm btn-warning">Hide</a>
												<?php } ?>
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
<script type="text/javascript">
	function readURL(input) {
	  	if(input.files && input.files[0]) {
		    var reader = new FileReader();
		    
		    reader.onload = function(e) {
		    	$('#blah').show();
			    $('#blah').attr('src', e.target.result);
		    }
		    
		    reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}
	$("#customFileim").change(function() {
	  readURL(this);
	});
</script>
@endsection