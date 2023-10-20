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
                                        <h4>Arts And Culture Setting</h4>
                                    </div>

                                    <div class="row" style="border: 1px solid #da291c !important; padding-top:30px;margin-bottom:30px; ">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <h4>Update Data</h4>
                                            </div>
                                            <form action="<?php echo e(url('update_admin_arts_and_culture')); ?>" method="POST"
                                                id="" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="col-md-12"
                                                    style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="">Primary Heading</label>
                                                            <input type="text" class="form-control" name="main_heading"
                                                                <?php if(isset($main) && $main->upload_type == 'main_heading'): ?> value="<?php echo e($main->description ?? ''); ?>" <?php endif; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="">Secondary Heading</label>
                                                            <input type="text" class="form-control" name="sub_heading"
                                                                <?php if(isset($sub) && $sub->upload_type == 'sub_heading'): ?> value="<?php echo e($sub->description ?? ''); ?>" <?php endif; ?>>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="">Banner Footer Heading</label>
                                                            <input type="text" class="form-control" name="footer_heading"
                                                                <?php if(isset($footer) && $footer->upload_type == 'footer_heading'): ?> value="<?php echo e($footer->description ?? ''); ?>" <?php endif; ?>>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Middle Content</label>
                                                            <textarea class="form-control editor1 description" id="description" name="description" style="height: 70px;">
                                                                <?php if(isset($description) && $description->upload_type == 'description'): ?><?php echo e($description->description ?? ''); ?><?php endif; ?>
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <?php if(isset($main) && $main->upload_type == 'main_heading'): ?>
                                                        <input type="hidden" class="form-control" name="actions"
                                                            value="update">
                                                        <input type="hidden" class="form-control" name="main_heading_id"
                                                            value="<?php echo e(isset($main) ? $main->id : ''); ?>">
                                                        <input type="hidden" class="form-control" name="sub_heading_id"
                                                            value="<?php if(isset($sub) && $sub->upload_type == 'sub_heading'): ?><?php echo e($sub->id ?? ''); ?><?php endif; ?>">
                                                        <input type="hidden" class="form-control" name="footer_heading_id"
                                                            value="<?php if(isset($footer) && $footer->upload_type == 'footer_heading'): ?><?php echo e($footer->id ?? ''); ?><?php endif; ?>">
                                                        <input type="hidden" class="form-control"  name="description_heading_id"
                                                            value="<?php if(isset($description) && $description->upload_type == 'description'): ?><?php echo e($description->id ?? ''); ?><?php endif; ?>">
                                                    <?php endif; ?>

                                                    <div class="col-md-2" style="margin-top: 25px;">
                                                        <button type="submit" class="btn btn-md btn-info" id="">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <h4>Upload Videos</h4>
                                            </div>
                                            <form action="<?php echo e(url('add_admin_arts_and_culture')); ?>" method="POST"
                                                id="" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="col-md-12"
                                                    style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="">Video Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'video'): ?> value="<?php echo e($edit_data[0]->title ?? ''); ?>" <?php endif; ?>>
                                                            <input type="hidden" class="form-control" name="uid"
                                                                value="<?php echo e(Auth::id()); ?>">
                                                            <input type="hidden" class="form-control" name="upload_type"
                                                                value="video">
                                                            <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'video'): ?>
                                                                <input type="hidden" class="form-control" name="actions"
                                                                    value="update">
                                                                <input type="hidden" class="form-control" name="eid"
                                                                    value="<?php echo e(isset($edit_data) ? $edit_data[0]->id : ''); ?>">
                                                            <?php endif; ?>


                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Video Upload <small disabled>(file
                                                                    type
                                                                    MP4)</small></label>
                                                            <div class="fancy-file-upload fancy-file-info">
                                                                
                                                                <input type="file" class="form-control" name="file_url"
                                                                    onchange="jQuery(this).next('input').val(this.value);"
                                                                    <?php if(!isset($edit_data) || (isset($edit_data) && $edit_data[0]->upload_type != 'video')): ?> required <?php endif; ?>
                                                                    accept="video/mp4,video/x-m4v,video/*" />
                                                                
                                                            </div>
                                                            <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'video'): ?>
                                                                <div> <video width="100%" controls>
                                                                        <source src="<?php echo e(asset($edit_data[0]->file_url)); ?>"
                                                                            type="video/mp4">
                                                                    </video>
                                                                </div>
                                                            <?php endif; ?>


                                                        </div>

                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control " name="description" style="height: 70px;">
                                                 <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'video'): ?>
                                                    <?php echo e($edit_data[0]->description ?? ''); ?>

                                                    <?php endif; ?>

                                                 </textarea>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-2" style="margin-top: 25px;">
                                                        <button type="submit" class="btn btn-md btn-info" id="">

                                                            <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'video'): ?>
                                                                Update
                                                            <?php else: ?>
                                                                Save
                                                            <?php endif; ?>
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="col-md-6" style="border-left: 1px solid #da291c !important; ">
                                            <div class="col-md-12">
                                                <h4>Upload Banner</h4>
                                            </div>
                                            <form action="<?php echo e(url('add_admin_arts_and_culture')); ?>" method="POST"
                                                id="" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="col-md-12"
                                                    style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="">Banner Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'banner'): ?> value="<?php echo e($edit_data[0]->title ?? ''); ?>" <?php endif; ?>>

                                                            <input type="hidden" class="form-control" name="uid"
                                                                value="<?php echo e(Auth::id()); ?>">
                                                            <input type="hidden" class="form-control" name="upload_type"
                                                                value="banner">
                                                            <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'banner'): ?>
                                                                <input type="hidden" class="form-control" name="actions"
                                                                    value="update">
                                                                <input type="hidden" class="form-control" name="eid"
                                                                    value="<?php echo e(isset($edit_data) ? $edit_data[0]->id : ''); ?>">
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Banner
                                                                Upload<small>(450x300px)</small></label>
                                                            <div class="fancy-file-upload fancy-file-info">
                                                                
                                                                <input type="file" class="form-control"
                                                                    <?php if(!isset($edit_data) || (isset($edit_data) && $edit_data[0]->upload_type != 'banner')): ?> required <?php endif; ?>
                                                                    name="file_url"
                                                                    onchange="jQuery(this).next('input').val(this.value);" />
                                                                

                                                            </div>
                                                            <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'banner'): ?>
                                                                <div> <img src="<?php echo e(asset($edit_data[0]->file_url)); ?>"
                                                                        width="100%" height="auto"
                                                                        style="border: 2px solid white; padding: 2px; border-radius: 12px; margin: 10px;">
                                                                </div>
                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control " name="description" placeholder="" style="height: 70px;">

                                            <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'banner'): ?>
                                            <?php echo e($edit_data[0]->description ?? ''); ?>

                                            <?php endif; ?>
                                        </textarea>

                                                        </div>
                                                    </div>





                                                    <div class="col-md-2" style="margin-top: 25px;">
                                                        <button type="submit" class="btn btn-md btn-info"
                                                            id="">
                                                            <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'banner'): ?>
                                                                Update
                                                            <?php else: ?>
                                                                Save
                                                            <?php endif; ?>
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>


                                    <div class="row" style="border: 1px solid #da291c !important; padding-top:30px; ">

                                        <div class="col-md-12">
                                            <h4>My Uploads</h4>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover"
                                            id="datatable_sample">
                                            <thead>
                                                <tr>
                                                    <th width="10%">Type</th>
                                                    <th width="20%">Title</th>
                                                    <th width="30%">File</th>
                                                    <th width="20%">Description</th>
                                                    <th width="20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        foreach ($user_birthplace_details as $value)
                                                        {
                                                            //    dd($value)
                                                            if($value->upload_type != 'text' && $value->upload_type != 'heading'){
                                                            ?>
                                                <tr>
                                                    <td><?= $value->upload_type ?></td>
                                                    <td><?= $value->title ?></td>
                                                    <td>
                                                        <?php if($value->upload_type == 'banner'): ?>
                                                            <img src="<?php echo e(asset($value->file_url)); ?>" width="100%"
                                                                height="auto"
                                                                style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;">
                                                        <?php else: ?>
                                                            <video width="100%" controls>
                                                                <source src="<?php echo e(asset($value->file_url)); ?>"
                                                                    type="video/mp4">
                                                            </video>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $value->description ?></td>


                                                    <td width="20%">


                                                        <form action="<?php echo e(url('delete_admin_arts_and_culture')); ?>"
                                                            method="POST" id="" enctype="multipart/form-data"
                                                            style="display: inline-flex;">
                                                            <?php echo csrf_field(); ?>
                                                            <a class="btn btn-xs btn-info"
                                                                href="<?php echo e(url('edit_admin_arts_and_culture') . '/' . $value->id); ?>">Edit</a>
                                                            &nbsp;
                                                            <input type="hidden" name="id"
                                                                value="<?php echo e($value->id); ?>">
                                                            <input type="submit" class="btn btn-xs btn-danger"
                                                                value="Delete">
                                                        </form>

                                                    </td>
                                                </tr>
                                                <?php
                                                            }
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
    </div>
    <script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
	 CKEDITOR.replace('description');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/admin/setting/arts_and_culture.blade.php ENDPATH**/ ?>