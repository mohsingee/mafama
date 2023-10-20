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
                                    <h4>Leaders Board</h4>
                                </div>

                                <div class="row" style="border: 1px solid #da291c !important; padding-top:30px;margin-bottom:30px; ">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <h4>Add Leaders Board</h4>
                                        </div>
                                        <hr style="margin-bottom:30px; ">
                                        <form action="<?php echo e(url('update_leadersboard')); ?>" method="POST" id=""
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo e($board->id); ?>">
                                            <?php echo csrf_field(); ?>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control editor" name="title"
                                                            placeholder="Enter Main Title Here" value="<?php if(isset($board)): ?> <?php echo e($board->title ?? ''); ?> <?php endif; ?>" >
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Sub Title</label>
                                                        <input type="text" class="form-control editor" name="sub_title"
                                                            placeholder="Enter Sub Title here" value="<?php if(isset($board)): ?> <?php echo e($board->sub_title ?? ''); ?> <?php endif; ?>">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control editor" name="description"
                                                            placeholder="" style="height: 70px;">
                                                            <?php if(isset($board)): ?> <?php echo e($board->description ?? ''); ?> <?php endif; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="margin-top: 25px;">
                                                    <button type="submit" class="btn btn-md btn-info" id="">
                                                        Update
                                                    </button>

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
    CKEDITOR.replaceAll('editor');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/admin/leader_board/edit.blade.php ENDPATH**/ ?>