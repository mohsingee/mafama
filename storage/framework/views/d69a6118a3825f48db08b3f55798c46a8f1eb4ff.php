 
<?php $__env->startSection('content'); ?>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:880px;">Access/Roles</h3>
					<?php if(permission_access('admin_list_add')==1): ?>
					<a href="<?php echo e(url('admin/add-new-admin')); ?>" class="btn btn-xs btn-primary" style="float:right;">Add New Admin</a>
					<?php endif; ?>
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">#ID</span></th>
											<th class="nk-tb-col"><span class="sub-text">Name</span></th>										
											<th class="nk-tb-col"><span class="sub-text">Email</span></th>										
											<th class="nk-tb-col"><span class="sub-text">Phone</span></th>										
											<th class="nk-tb-col"><span class="sub-text">City</span></th>										
											<th class="nk-tb-col"><span class="sub-text">Address</span></th>										
											<th class="nk-tb-col"><span class="sub-text">Password</span></th>										
											<th class="nk-tb-col"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php if($users->count() >0): ?>
										 <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?php echo e($role->id); ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?php echo e($role->name); ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?php echo e($role->email); ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?php echo e($role->phone); ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?php echo e($role->city); ?></span>
											</td>
												<td class="nk-tb-col">
												<span><?php echo e($role->address); ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?php echo e($role->show_pass); ?></span>
											</td>
											
											
											<td class="nk-tb-col">
												<?php if(permission_access('admin_list_edit')==1): ?>
												<a href="<?php echo e(url('admin/add-new-admin/'.$role->id)); ?>" class="btn btn-xs btn-primary">Edit</a>
												<?php endif; ?>
												<?php if(permission_access('admin_list_delete')==1): ?>
												<a data-id="<?php echo e($role->id); ?>" data-list="users" href="javascript:void(0)" class="btn btn-xs btn-success deleterow">Delete</a>
												<?php endif; ?>
											</td>
											
										</tr><!-- .nk-tb-item  -->
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php endif; ?>
										
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/admin/access_role/admin_list.blade.php ENDPATH**/ ?>