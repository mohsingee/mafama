 
<?php $__env->startSection('content'); ?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Dashboard</h3>
                        </div>
                        <!-- .nk-block-head-content -->
                    </div>
                    <!-- .nk-block-between -->
                </div>
                <!-- .nk-block-head -->
               <?php if(permission_access1('dashboard_view')==1): ?>
                <div class="nk-block dashboard-block">
                    <div class="row g-gs">
                        <div class="col-md-4">
                            <div class="card card-bordered card-full alert-fill alert-warning">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h6 class="subtitle">Total Users</h6>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount"> <?php echo e($total_users); ?> </span>
                                    </div>
                                    <div class="invest-data">
                                        <div class="invest-data-amount g-2">
                                            <div class="invest-data-history">
                                                <div class="title">This Month</div>
                                                <div class="amount"><?php echo e($user_month); ?></div>
                                            </div>
                                            <div class="invest-data-history">
                                                <div class="title">This Week</div>
                                                <div class="amount"><?php echo e($user_week); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .card -->
                        </div>
                        <!-- .col -->
                        <div class="col-md-4">
                            <div class="card card-bordered card-full alert-fill alert-secondary">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h6 class="subtitle">Affiliate Users</h6>
                                        </div>
                                    </div>
                                    <div class="card-amount">
                                        <span class="amount"> <?php echo e($affiliate_users); ?> </span>
                                    </div>
                                    <div class="invest-data">
                                        <div class="invest-data-amount g-2">
                                            <div class="invest-data-history">
                                                <div class="title">This Month</div>
                                                <div class="amount"><?php echo e($aff_month); ?></div>
                                            </div>
                                            <div class="invest-data-history">
                                                <div class="title">This Week</div>
                                                <div class="amount"><?php echo e($aff_week); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .card -->
                        </div>
                        <!-- .col -->
                        <div class="col-md-4">
                            <div class="card card-bordered card-full alert-fill alert-primary align-center">
                                <div class="card-inner">
                                    <a href="<?php echo e(url('admin/affilates_registration')); ?>">
                                        <h3 style="margin-top: 25px; color: #fff;">Affiliate Users</h3>
                                    </a>
                                </div>
                            </div>
                            <!-- .card -->
                        </div>
                        <!-- .col -->
                        <div class="col-md-4">
                            <div class="card card-bordered card-full alert-fill alert-success align-center">
                                <div class="card-inner">
                                    <a href="<?php echo e(url('comm_table')); ?>">
                                        <h3 style="margin-top: 25px; color: #fff;">Commission Table</h3>
                                    </a>
                                </div>
                            </div>
                            <!-- .card -->
                        </div>
                        <!-- .col -->
                        <div class="col-md-4">
                            <div class="card card-bordered card-full alert-fill alert-gray align-center">
                                <div class="card-inner">
                                    <a href="<?php echo e(url('lead-qualifier-setting')); ?>">
                                        <h3 style="margin-top: 25px; color: #fff;">Lead Qualifier</h3>
                                    </a>
                                </div>
                            </div>
                            <!-- .card -->
                        </div>
                        <!-- .col -->
                        <div class="col-md-4">
                            <div class="card card-bordered card-full alert-fill alert-warning align-center">
                                <div class="card-inner">
                                    <a href="<?php echo e(url('admin/network')); ?>">
                                        <h3 style="margin-top: 25px; color: #fff;">Affiliate Network</h3>
                                    </a>
                                </div>
                            </div>
                            <!-- .card -->
                        </div>
                        <!-- .col -->
                        <div class="col-md-4">
                            <div class="card card-bordered card-full alert-fill alert-secondary align-center">
                                <div class="card-inner">
                                    <a href="<?php echo e(url('admin/transaction-history')); ?>">
                                        <h3 style="margin-top: 25px; color: #fff;">Transactions</h3>
                                    </a>
                                </div>
                            </div>
                            <!-- .card -->
                        </div>
                        <!-- .col -->
                        <div class="col-md-4">
                            <div class="card card-bordered card-full alert-fill alert-danger align-center">
                                <div class="card-inner">
                                    <a href="<?php echo e(url('admin_schedule_holiday')); ?>">
                                        <h3 style="margin-top: 25px; color: #fff;">Schedule Holiday</h3>
                                    </a>
                                </div>
                            </div>
                            <!-- .card -->
                        </div>
                        
                          <div class="col-md-4">
                            <a href="javacript:void(0)" class="btn btn-lg btn-info run-jobs">Run Cron Jobs</a>
                            <a href="javacript:void(0)" class="btn btn-lg btn-info run-weekly-cron-jobs">Weekly payment/balance notification</a>
                            <!-- .card -->
                        </div>
                        <!-- .col -->
                        
                    </div>
                </div>
               <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/admin.blade.php ENDPATH**/ ?>