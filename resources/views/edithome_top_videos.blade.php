@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Home page top videos</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="{{ url('home_top_video_update') }}" method="POST" enctype="multipart/form-data">	
									@csrf	
									<input type="hidden" name="id" value="<?= $videos[0]->id ?>">
									<div class="row gy-4">
										<div class="col-md-1">
											<div class="custom-control custom-control-lg custom-checkbox">
												<input type="checkbox" name="status" class="custom-control-input" id="customCheck46" value="on" <?php if($videos[0]->status == "on"){ ?> checked <?php } ?>>
												<label class="custom-control-label" for="customCheck46"></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-control-wrap">
												<div class="custom-file">
													<input type="file" name="video" class="custom-file-input" id="customFileim">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</div>
											<div style="margin-top:10px;">
												<!-- <iframe class="embed-responsive-item" src="" style="width:100%;height:200px;display: none;" id="blah"></iframe>  -->
												<video controls id="videoblah" style="width:100%;">
												  	<source src="<?php echo asset("public/videos") ?>/<?= $videos[0]->video ?>" type="video/mp4" id="blah">
												</video>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" name="startdate" class="form-control date-picker" autocomplete="off" placeholder="Start Date" value="<?= $videos[0]->startdate ?>" />
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" name="enddate" class="form-control date-picker" autocomplete="off" placeholder="End Date" value="<?= $videos[0]->enddate ?>" />
											</div>
										</div>
										
										<div class="col-md-1">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
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
	$(document).on("change", "#customFileim", function(evt) {
		$('#videoblah').show();
	  	var $source = $('#blah');
	  	$source[0].src = URL.createObjectURL(this.files[0]);
	  	$source.parent()[0].load();
	});

</script>


@endsection