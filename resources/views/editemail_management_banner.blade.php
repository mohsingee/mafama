@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Email Management Banner</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								@if(permission_access('sitebanners_edit')==1)
								<form id="" action="{{ url('email_management_banner_update') }}" method="POST" enctype="multipart/form-data">	
									@csrf
									<input type="hidden" name="id" value="<?= $banners[0]->id ?>">
									<div class="row gy-4">
										<div class="col-md-1">
											<div class="custom-control custom-control-lg custom-checkbox">
												<input type="checkbox" name="status" class="custom-control-input" id="customCheck46" value="on" <?php if($banners[0]->status == "on"){ ?> checked <?php } ?>>
												<label class="custom-control-label" for="customCheck46"></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-control-wrap">
												<div class="custom-file">
													<input type="file" name="image" class="form-control custom-file-input" id="customFileim">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<p>*Recommended: .jpg/.jpeg/.png(1280 x 720 px) </p>
											</div>
											<div style="margin-top:10px; text-align: right;">
												<img src="<?php echo asset("public/images") ?>/<?= $banners[0]->image ?>" style="width:100%;height:200px;" id="blah">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" class="form-control date-picker" placeholder="Start Date" value="<?= date('m/d/Y', strtotime($banners[0]->startdate)) ?>" name="startdate" required />
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" class="form-control date-picker" placeholder="End Date" value="<?= date('m/d/Y', strtotime($banners[0]->enddate)) ?>" name="enddate" required />
											</div>
										</div>
										
										<div class="col-md-1">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
								@endif
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