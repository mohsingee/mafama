 
<?php $__env->startSection('content'); ?>


<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Religion</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="" action="<?php echo e(url('religion_update')); ?>" method="POST" enctype="multipart/form-data">	
								<?php echo csrf_field(); ?>
									<input type="hidden" name="id" value="<?= $religion[0]->id ?>">
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Religion</label>
												<input type="text" class="form-control" placeholder="Category Name" name="religion" value="<?= $religion[0]->category ?>" required>
												<?php if($errors->any()): ?>
													<p style="color: red"><?php echo e($errors->first()); ?></p>
												<?php endif; ?>
											</div>
										</div>
										
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Update">
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/editreligion.blade.php ENDPATH**/ ?>