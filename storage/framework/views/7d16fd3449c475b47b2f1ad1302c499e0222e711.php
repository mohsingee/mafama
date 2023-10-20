 
<?php $__env->startSection('content'); ?>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Home page videos</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<?php if(permission_access('homepage_videos_add')==1): ?>
								<form id="" action="<?php echo e(url('home_video_entry')); ?>" method="POST" enctype="multipart/form-data">	
									<?php echo csrf_field(); ?>	
									<div class="row gy-4">
										<div class="col-md-1">
											<div class="custom-control custom-control-lg custom-checkbox">
												<input type="checkbox" name="status" class="custom-control-input" id="customCheck46" value="on">
												<label class="custom-control-label" for="customCheck46"></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-control-wrap">
												<div class="custom-file">
													<input type="file" name="video" class="custom-file-input" id="customFileim"  accept="video/*" required>
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<?php if($errors->any()): ?>
												<span style="color: red"><?php echo e($errors->first()); ?></span>
												<?php endif; ?>
												<p>*Recommended: .mp4/.mkv </p>
											</div>
											<div style="margin-top:10px;">
												<!-- <iframe class="embed-responsive-item" src="" style="width:100%;height:200px;display: none;" id="blah"></iframe>  -->
												<video controls id="videoblah" style="display: none;width:100%;">
												  	<source src="" type="video/mp4" id="blah">
												</video>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" name="startdate" class="form-control date-picker" autocomplete="off" placeholder="Start Date" value="" />
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<input type="text" name="enddate" class="form-control date-picker" autocomplete="off" placeholder="End Date" value="" />
											</div>
										</div>
										
										<div class="col-md-1">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
									<?php endif; ?>
								</form>
								<!--<form>
									<div class="row gy-4" style="padding-top:30px;">
										<div class="col-md-3">
											<div class="form-group">
												<label>Play time (seconds)</label>
												<input type="number" class="form-control" placeholder="" value="3000" />
											</div>
										</div>
										<div class="col-md-1" style="margin-top:40px;">
											<a href="#" class="btn btn-sm btn-primary">Save</a>
										</div>
									</div>
								</form>-->
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
											<th class="nk-tb-col"><span class="sub-text">Video Link</span></th>
											<th class="nk-tb-col"><span class="sub-text">Start Date</span></th>
											<th class="nk-tb-col"><span class="sub-text">End Date</span></th>
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
												<iframe class="embed-responsive-item" src="<?php echo asset("public/videos") ?>/<?= $video->video ?>" width="350" height="200"></iframe>
											</td>
											<td class="nk-tb-col">
												<?= date('d M Y', strtotime($video->startdate)) ?>
											</td>
											<td class="nk-tb-col">
												<?= date('d M Y', strtotime($video->enddate)) ?>
											</td>
											<td class="nk-tb-col tb-col-md">
												<?php if(permission_access('homepage_videos_edit')==1): ?>
												<a href="<?php echo url('edithome_videos') ?>/<?= $video->id ?>" class="btn btn-sm btn-primary">Edit</a>
												<?php endif; ?>
												<?php if(permission_access('homepage_videos_delete')==1): ?>
												<a href="<?php echo url('deletehome_videos') ?>/<?= $video->id ?>" class="btn btn-sm btn-danger">Delete</a>
												<?php endif; ?>
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
	// function readURL(input) {
	//   	if(input.files && input.files[0]) {
	// 	    var reader = new FileReader();
		    
	// 	    reader.onload = function(e) {
	// 	    	$('#blah').show();
	// 		    $('#blah').attr('src', e.target.result);
	// 	    }
		    
	// 	    reader.readAsDataURL(input.files[0]); // convert to base64 string
	// 	}
	// }
	// $("#customFileim").change(function() {
	//   readURL(this);
	// });
	$(document).on("change", "#customFileim", function(evt) {
		$('#videoblah').show();
	  	var $source = $('#blah');
	  	$source[0].src = URL.createObjectURL(this.files[0]);
	  	$source.parent()[0].load();
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/home_videos.blade.php ENDPATH**/ ?>