 
<?php $__env->startSection('content'); ?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Fix Commission Setting</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="<?php echo e(url('form-submit')); ?>" method="POST">	
									<?php echo csrf_field(); ?>
									<div class="row gy-4">
										<div class="col-md-6 mr-5">
											<div class="form-group">
												<label class="form-label font-weight-bold">
													<b>When any free lead become a paid user</b>
												</label>
												<input type="text" class="form-control" placeholder="Amount" name="lead"  value="<?php echo e($fixcomm->free_lead); ?>"  required>
											</div>
											<input type="hidden" name="customSwitch1" id="cs1" value="<?php echo e($fixcomm->free_lead_status); ?>">
										</div>
										<div class="col-md-3 mt-5 ml-5">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input s1" id="customSwitch1"  <?php if($fixcomm->free_lead_status==1): ?> <?php echo e("checked"); ?><?php else: ?><?php echo e(""); ?><?php endif; ?>>
												<label class="custom-control-label" for="customSwitch1"></label>
											</div>
										</div>
										
									</div>
									<div class="row gy-4">
										<div class="col-md-6 mr-5">
											<div class="form-group">
												<label class="form-label font-weight-bold">
													<b>Other Amount</b>
												</label>
												<input type="text" class="form-control" placeholder="Amount" name="otheramount"  value="<?php echo e($fixcomm->other_amount); ?>"  required>
											</div>
										</div>
										<div class="col-md-3 mt-5 ml-5">
											<input type="hidden" name="customSwitch2" id="cs2" value="<?php echo e($fixcomm->other_amount_status); ?>">

											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="customSwitch2" <?php if($fixcomm->other_amount_status==1): ?> <?php echo e("checked"); ?><?php else: ?><?php echo e(""); ?><?php endif; ?>>
												<label class="custom-control-label" for="customSwitch2"></label>
											</div>
											
										</div>
										
									</div>
									
									<div class="row gy-4">	
										<div class="col-12">
											<input type="submit" class="btn btn-lg btn-primary" value="Save">
											
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
<script>
	$(document).on("change","#customSwitch1",function(){
		if($('#customSwitch1').is(':checked')){
			$('#cs1').val(1);
			// alert("ok");
		}else{
			$('#cs1').val(0);
			
		}
	})

	$(document).on("change","#customSwitch2",function(){
		if($('#customSwitch2').is(':checked')){
			$('#cs2').val(1);
			// alert("ok");
		}else{
			$('#cs2').val(0);
			
		}
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/admin/fix_commission_setting.blade.php ENDPATH**/ ?>