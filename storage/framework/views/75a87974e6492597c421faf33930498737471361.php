<?php $__env->startSection('content'); ?>

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Home page banner for text</h3>

				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="<?php echo e(url('text_banner_update')); ?>" method="POST" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<input type="hidden" name="id" value="<?= $banners[0]->id ?>">
									<div class="row gy-4">
										<div class="col-md-1">
											<div class="custom-control custom-control-lg custom-checkbox">
												<input type="checkbox" name="status" class="custom-control-input" id="customCheck46" value="on" <?php if($banners[0]->status == "on"){ ?> checked <?php } ?>>
												<label class="custom-control-label" for="customCheck46"></label>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-control-wrap">
												<div class="custom-file">
													<input type="file" name="image" class="form-control custom-file-input" id="customFileim" reqiured>
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<p>*Recommended: .jpg/.jpeg/.png(600 x 500 px) </p>
											</div>
											<div style="margin-top:10px; text-align: right;">
												<img src="<?php echo asset("public/images") ?>/<?= $banners[0]->image ?>" style="width:100%;height:200px;" id="blah">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Banner Text" value="<?= $banners[0]->text ?>" name="text" required />
											</div>
										</div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="url" class="form-control" placeholder="Banner Link" value="<?= $banners[0]->link ?>" name="link" />
                                            </div>
                                        </div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" class="form-control date-picker" placeholder="Start Date" name="startdate" value="<?= $banners[0]->startdate ?>" required autocomplete="off" />
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" class="form-control date-picker" placeholder="End Date" value="<?= $banners[0]->enddate ?>" name="enddate" required  autocomplete="off"/>
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/edittext_banner.blade.php ENDPATH**/ ?>