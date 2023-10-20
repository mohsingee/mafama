<?php $__env->startSection('content'); ?>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block">
                            <div class="card card-bordered card-stretch">
                                <div class=" card-inner-lg" style="background-color:#fff">
                                    <div class="text-center" style="margin-bottom: 30px">
                                        <h4>Home Page - Transactions Tab</h4>
                                    </div>

                                    <div class="row" style="border: 1px solid #da291c !important; padding-top:30px;margin-bottom:30px; ">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <h4>Update Data</h4><br>
                                            </div>
                                            <form action="<?php echo e(url('update_admin_transactions')); ?>" method="POST"
                                                id="" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="row" style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label text-bold">Description One</label>
                                                            <textarea class="form-control editor1 description" id="description" name="description_one" style="height: 70px;">
                                                                <?php if(isset($one) && $one->upload_type == 'description_one'): ?><?php echo e($one->description ?? ''); ?><?php endif; ?>
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label text-bold">Description Two</label>
                                                            <textarea class="form-control editor1 description" id="description" name="description_two" style="height: 70px;">
                                                                <?php if(isset($two) && $two->upload_type == 'description_two'): ?><?php echo e($two->description ?? ''); ?><?php endif; ?>
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <?php if(isset($one) && $one->upload_type == 'description_one'): ?>
                                                        <input type="hidden" class="form-control" name="actions"
                                                            value="update">
                                                        <input type="hidden" class="form-control" name="description_one_id" value="<?php echo e(isset($one) ? $one->id : ''); ?>">
                                                        <input type="hidden" class="form-control" name="description_two_id" value="<?php if(isset($two) && $two->upload_type == 'description_two'): ?><?php echo e($two->id ?? ''); ?><?php endif; ?>">
                                                    <?php endif; ?>

                                                    <div class="col-md-2" style="margin-top: 25px;">
                                                        <button type="submit" class="btn btn-md btn-info" id="">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>


                                    </div>


                                </div><!-- .card-inner-group -->
                            </div><!-- .card -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replaceAll('editor1');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/admin/setting/transactions.blade.php ENDPATH**/ ?>