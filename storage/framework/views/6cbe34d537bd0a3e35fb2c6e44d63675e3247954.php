 
<?php $__env->startSection('content'); ?>

<div class="nk-content">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:935px;">Country Status Setting</h3>
					<a href="<?php echo e(url('admin')); ?>" class="btn btn-sm btn-primary" style="float:right;">Back</a>
				</div>
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
									<form action="<?php echo e(url('add-country-status-setting')); ?>" method="POST" enctype="multipart/form-data">	
									<?php echo csrf_field(); ?>
									<input type="hidden" name="id" value="<?php echo e($id); ?>">
									<div class="row gy-4">
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Country</label>
												<select id="countries_states1" class="form-control bfh-countries" data-country="<?php echo e(!empty($id)?$result->country:"US"); ?>" name="country" required></select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Affiliate Commission Amount</label>
												<input type="number" class="form-control" name="affiliate_commission" min="0" value="<?php echo e(!empty($id)?$result->affiliate_commission:""); ?>" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Deduct Amount</label>
												<input type="number" class="form-control" name="deduct_amount" min="0" value="<?php echo e(!empty($id)?$result->deduct_amount:""); ?>" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Active Status</label><br>
												<div class="custom-control custom-switch">
															<input type="checkbox" class="custom-control-input" id="customSwitch1" name="status" <?php echo e((!empty($id) && $result->status==1)?"checked":""); ?>>
															<label class="custom-control-label" for="customSwitch1"></label>
														</div>
											</div>
										</div>
										<!--// software developer Ravi coding START -->

											<div class="col-md-3">
											<div class="form-group">
												<label class="form-label">Show Billing</label><br>
												<div class="custom-control custom-switch">
															<input type="checkbox" class="custom-control-input" id="customSwitch2" name="billing_status" <?php echo e((!empty($id) && $result->billing_status==1)?"checked":""); ?>>
															<label class="custom-control-label" for="customSwitch2"></label>
												</div>
											</div>
										</div>
                                        <!--// software developer Ravi coding END -->

									</div><br>
									
										<div class="col-12">

											<button type="submit" class="btn btn btn-primary">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div><br>
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                        
							<div class="card-inner card-inner-lg">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr  class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Country</span></th> 
                                                                             
                                       <th class="nk-tb-col"><span class="sub-text">Affiliate Commission Amount</span></th>

                                       	<th class="nk-tb-col"><span class="sub-text">Deduct Amount</span></th>

                                       	<th class="nk-tb-col"><span class="sub-text">Status</span></th>

                                       	<th class="nk-tb-col"><span class="sub-text">Action</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                   <?php if(!empty($settings)): ?>
                                   	<?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   	<tr class="nk-tb-item">
                                   		<td class="nk-tb-col"><?php echo e(getCountryName($setting->country)); ?></td>
                                   		<td class="nk-tb-col"><?php echo e($setting->affiliate_commission); ?></td>
                                   		<td class="nk-tb-col"><?php echo e($setting->deduct_amount); ?></td>
                                   		<td class="nk-tb-col">
                                   			<?php if($setting->status==1): ?>
                                   				<span class="badge badge-success">Active</span>
                                   			<?php else: ?>
                                   				<span class="badge badge-danger">Not active</span>
                                   			<?php endif; ?>
                                   		</td>
                                   		<td class="nk-tb-col">
                                   			<a href="<?php echo e(url('update-country-status-setting/'.$setting->id)); ?>" title="" class="btn btn-sm btn-success">Edit</a>
                                   		</td>
                                   	</tr>
                                   	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php endif; ?>
                                 </tbody>
                              	</table>
							</div>
						</div>
					</div>
				</div>
				<div class="nk-block">
						<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
									<form action="<?php echo e(url('add-country-status-setting-message')); ?>" method="POST" enctype="multipart/form-data">	
									<?php echo csrf_field(); ?>
									<input type="hidden" name="id" value="<?php echo e($c_user_id); ?>">
									<div class="row gy-12">
										<div class="col-md-12">
										
												<label class="form-label">Non Country users message</label>
										
										</div>
										<div class="col-md-8">
											<div class="form-group">
												
												<textarea  class="form-control w-100" name="non_country_user_message" required><?php echo e($non_country->value); ?></textarea>
											</div>
										</div>
									</div><br>
									
										<div class="col-12">

											<button type="submit" class="btn btn btn-primary">Update message</button>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/admin/country_status_setting.blade.php ENDPATH**/ ?>