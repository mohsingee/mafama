 
<?php $__env->startSection('content'); ?>

<style>
  
.borderless tr td, .borderless tr th {
    
    text-align: left;
    
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Package</h3>
						<a href="<?php echo e(url('admin')); ?>" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="<?php echo e(url('update_affiliate_package')); ?>" method="POST" id="" enctype="multipart/form-data">	
									<?php echo csrf_field(); ?>
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Package Name</label>
												<input type="text" class="form-control"   name="name" placeholder="Name " value="<?php echo e(isset($plan->id)?$plan->name:''); ?>" required>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Monthly Fee</label>
												<input type="text" class="form-control"   name="monthly_fee" placeholder="Monthly fee" value="<?php echo e(isset($plan->id)?$plan->monthly_fee:''); ?>" onkeyup="calculate_balance()" required>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Management Fee</label>
												<input type="text" class="form-control"   name="management_fee" placeholder="Management fee" value="<?php echo e(isset($plan->id)?$plan->management_fee:''); ?>" onkeyup="calculate_balance()"  required>
											</div>
										</div>

											<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Bonus 1</label>
												<input type="text" class="form-control"   name="bonus_one" placeholder="Bonus 1" value="<?php echo e(isset($plan->id)?$plan->bonus_one:''); ?>" onkeyup="calculate_balance()"  required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Bonus 2</label>
												<input type="text" class="form-control"   name="bonus_two" placeholder="Bonus 2" value="<?php echo e(isset($plan->id)?$plan->bonus_two:''); ?>" onkeyup="calculate_balance()"  required>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Bonus 3</label>
												<input type="text" class="form-control"   name="bonus_three" placeholder="Bonus 3" value="<?php echo e(isset($plan->id)?$plan->bonus_three:''); ?>" onkeyup="calculate_balance()"  required>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Bonus 4</label>
												<input type="text" class="form-control"   name="bonus_four" placeholder="Bonus 4" value="<?php echo e(isset($plan->id)?$plan->bonus_four:''); ?>" onkeyup="calculate_balance()"  required>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Prize</label>
												<input type="text" class="form-control"   name="prize" placeholder="Prize" value="<?php echo e(isset($plan->id)?$plan->prize:''); ?>" onkeyup="calculate_balance()"  required>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Other</label>
												<input type="text" class="form-control"   name="other" placeholder="Other" value="<?php echo e(isset($plan->id)?$plan->other:''); ?>" onkeyup="calculate_balance()"  required>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Balance</label>
												<input type="text" class="form-control"   name="balance" placeholder="Balance" value="<?php echo e(isset($plan->id)?$plan->balance:''); ?>" required readonly="">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Sponsor Affiliate Share Price</label>
												<input type="text" class="form-control"   name="affiliate_share_price" placeholder="affiliate_share_price" value="<?php echo e(isset($plan->id)?$plan->affiliate_share_price:''); ?>" required readonly=""  >
											</div>
										</div>
										
										
										
									 	
										
									</div>
									<div class="clearfix"></div>	
									
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="hidden" name="id" value="<?php echo e(isset($plan->id)?$plan->id:''); ?>" >
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/admin/plan.blade.php ENDPATH**/ ?>