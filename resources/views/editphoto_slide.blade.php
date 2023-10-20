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
								<form id="" action="{{ url('photo_slide_update') }}" method="POST" enctype="multipart/form-data">
								@csrf	
									<input type="hidden" name="id" value="<?= $slides[0]->id ?>">
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" name="name" placeholder="Name" value="<?= $slides[0]->name ?>" reqiured />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Comment</label>
												<input type="text" class="form-control" name="comment" placeholder="Comment" value="<?= $slides[0]->comment ?>" reqiured />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Rating</label>
												<input type="text" class="form-control" name="rating" placeholder="Rating" value="<?= $slides[0]->rating ?>" reqiured />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-control-wrap">
												<label class="form-label" for="">Upload Photo(Recommended size: 300 x 300 px)</label>
												<div class="custom-file">
													<input type="file" name="image" class="form-control custom-file-input" id="customFileim">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<p>*Recommended extension: .jpg/.jpeg/.png </p>
											</div>
											<div style="margin-top:10px; text-align: right;">
												<img src="<?php echo asset("public/assets/images/demo/people/300x300") ?>/<?= $slides[0]->image ?>" style="width:200px;height:200px;" id="blah">
											</div>
										</div>
										
										
										
										<div class="col-md-12 text-center">
											<input type="submit" value="Update" class="btn btn-sm btn-primary">
										</div>
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
				
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