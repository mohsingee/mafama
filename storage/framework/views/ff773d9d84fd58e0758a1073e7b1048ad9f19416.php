 

 
 <style type="text/css">
     p {
         margin-bottom: 5px !important;
     }

     pre,
     ul,
     ol,
     dl,
     dd,
     blockquote,
     address,
     table,
     fieldset,
     form {
         margin-bottom: 10px !important;
     }

     /*#blahh {
        border: 2px solid white;
        padding: 2px;
        border-radius: 12px;
        margin: 10px;
    }*/
     /*.modal-body #blah {
        width: 70px !important;
        height: 70px !important;
        border: 2px solid;
        padding: 2px;
        border-radius: 12px;
    }
    @media  only screen and (max-width: 600px) {
        #blahh {
            width: 70px;
            height: 70px;
            border: 2px solid;
            padding: 2px;
            border-radius: 12px;
        }
    }*/
 </style>
 <?php $__env->startSection('abanner'); ?>
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="appndbanner" style="margin-bottom: 20px; margin-top: 20px;">
                     <div class="user_banner">
                         <table cellpadding="0" cellspacing="0" class="style1" style="width: 100%">
                             <tbody>
                                 <tr>
                                     <td id="ctl00_ucBanner1_td_banner" style="width: 100%;">
                                         <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                                             <tbody>
                                                 <tr>
                                                     <td style="vertical-align: top;">
                                                         <table border="0" cellpadding="0" cellspacing="0"
                                                             style="width: 100%;">
                                                             <tbody>
                                                                 <tr>
                                                                     <td style="text-align: left; vertical-align: top;">
                                                                         <table width="100%" border="0"
                                                                             cellspacing="0" cellpadding="0">
                                                                             <tbody>
                                                                                 <tr>
                                                                                     <td class="Slogan"
                                                                                         style="text-align: center; vertical-align: top; height: 30px; padding-bottom: 5px; padding-top: 5px;">
                                                                                         <div class="business_name"
                                                                                             style="font-weight: bold; font-size: 20px; color: rgb(255, 255, 170);">
                                                                                             <?php if($affiliate_banner->business_name != ""){ echo $affiliate_banner->business_name; } else{ echo $affiliate_details->company; ?>
                                                                                             <?php } ?></div>
                                                                                     </td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td
                                                                                         style="text-align: center; vertical-align: top; padding-left: 10px; padding-right: 10px; padding-bottom: 5px; padding-top: 5px;">
                                                                                         <div class="description"
                                                                                             style="min-height: 30px; padding: 30px 10px;">
                                                                                             <?php if ($affiliate_banner->message != '') {
                                                                                                 echo $affiliate_banner->message;
                                                                                             } ?></div>
                                                                                     </td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td class="Heading"
                                                                                         style="padding-left: 10px; padding-right: 10px; padding-bottom: 5px; padding-top: 5px;">
                                                                                         <div class="phone_no">
                                                                                             <?php if($affiliate_banner->phone_no != ""){ ?><b>Phone No:
                                                                                             </b>
                                                                                             <?= $affiliate_banner->phone_no ?><?php } else{ ?><b>Phone
                                                                                                 No: </b>
                                                                                             <?= $affiliate_details->business_telephone ?><?php } ?>
                                                                                         </div>
                                                                                         <div class="address">
                                                                                             <?php if($affiliate_banner->phone_no != ""){ ?><b>Address:
                                                                                             </b>
                                                                                             <?= $affiliate_banner->address ?><?php } else{ ?><b>Address:
                                                                                             </b>
                                                                                             <?= $affiliate_details->billing_address ?>,
                                                                                             <?= $affiliate_details->billing_city ?>
                                                                                             <?= $affiliate_details->zip_code ?><?php } ?>
                                                                                         </div>
                                                                                         <div class="web_address">
                                                                                             <?php if($affiliate_banner->web_address != ""){ ?><b>Web
                                                                                                 Address: </b>
                                                                                             <?= $affiliate_banner->web_address ?><?php } ?>
                                                                                         </div>
                                                                                     </td>
                                                                                 </tr>
                                                                             </tbody>
                                                                         </table>
                                                                     </td>
                                                                     <td style=""><img id="blahh"
                                                                             src="<?php if($affiliate_banner->img != ""){ ?><?php echo e(asset('public/videos')); ?>/<?= $affiliate_banner->img ?><?php }else{?><?php echo e(asset('public/images/affiliates')); ?>/<?= $affiliate_details->image ?> <?php } ?>"
                                                                             width="140" height="130"
                                                                             style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;">
                                                                     </td>
                                                                 </tr>
                                                             </tbody>
                                                         </table>
                                                     </td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('content'); ?>
     <link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />

     <!-- -->
     <section>
         <div class="container">
             <div class="row">
                 <!-- tabs -->
                 <?php // include 'setting_header.php';
                 ?>
                 <!-- tabs content -->
                 <div class="col-md-12 col-sm-12">
                     <div class="col-md-12">
                         <div class="heading-title heading-dotted col-md-12 margin-bottom-0 text-center">
                             <h4>Settings / Art And Culture</h4>
                         </div>
                         <div class="col-md-12 text-right margin-bottom-20">
                             <div class="margin-top-10">
                                 <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                                 <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                                 <a href="<?php echo e(url('birthplace')); ?>" class="btn btn-md btn-info margin-right-10">My Birth
                                     Place </a>
                                 <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                                 <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                                 <?php if($chat != "off"){ ?>
                                 <a href="<?php echo e(url('chat')); ?>" class="btn btn-md btn-info margin-right-10">Chat</a>
                                 <?php } ?>
                                 <?php if($tools != "off"){ ?>
                                 <a href="<?php echo e(url('tools')); ?>" class="btn btn-md btn-info margin-right-10">Tools</a>
                                 <?php } ?>
                                 <a href="<?php echo e(url('calender_meeting')); ?>" class="btn btn-md btn-info margin-right-10">My
                                     Daily
                                     Briefing</a>
                                 <a href="<?php echo e(url()->previous()); ?>" class="btn btn-md btn-info">Back</a>
                             </div>
                         </div>
                         

                         <?php //isset($edit_data) ? dd($edit_data[0]->upload_type) : '';
                         ?>
                         <div class="col-md-12"
                             style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px; background-color:#fff">

                             <div class="col-md-6">
                                 <div class="col-md-12">
                                     <h4>Upload Videos</h4>
                                 </div>
                                 <form action="<?php echo e(url('add_user_arts_and_culture')); ?>" method="POST" id=""
                                     enctype="multipart/form-data">
                                     <?php echo csrf_field(); ?>
                                     <div class="col-md-12"
                                         style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                         <div class="col-md-12">
                                             <div class="form-group">
                                                 <label class="form-label" for="">Video Title</label>
                                                 <input type="text" class="form-control" name="title"
                                                     <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'video'): ?> value="<?php echo e($edit_data[0]->title ?? ''); ?>" <?php endif; ?>>
                                                 <input type="hidden" class="form-control" name="uid"
                                                     value="<?php echo e($user_info->id); ?>">
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
                                                     <i class="fa fa-upload"></i>
                                                     <input type="file" class="form-control" name="file_url"
                                                         onchange="jQuery(this).next('input').val(this.value);"
                                                         <?php if(!isset($edit_data) || (isset($edit_data) && $edit_data[0]->upload_type != 'video')): ?> required <?php endif; ?>
                                                         accept="video/mp4,video/x-m4v,video/*" />
                                                     <input type="text" class="form-control"
                                                         placeholder="no file selected" readonly="" />
                                                     <span class="button">Choose File</span>
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
                                                 <textarea class="form-control summernote" name="description" style="height: 70px;">
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
                                 <form action="<?php echo e(url('add_user_arts_and_culture')); ?>" method="POST" id=""
                                     enctype="multipart/form-data">
                                     <?php echo csrf_field(); ?>
                                     <div class="col-md-12"
                                         style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                         <div class="col-md-12">
                                             <div class="form-group">
                                                 <label class="form-label" for="">Banner Title</label>
                                                 <input type="text" class="form-control" name="title"
                                                     <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'banner'): ?> value="<?php echo e($edit_data[0]->title ?? ''); ?>" <?php endif; ?>>

                                                 <input type="hidden" class="form-control" name="uid"
                                                     value="<?php echo e($user_info->id); ?>">
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
                                                 <label class="form-label">Banner Upload <small>(450x300px)</small></label>
                                                 <div class="fancy-file-upload fancy-file-info">
                                                     <i class="fa fa-upload"></i>
                                                     <input type="file" class="form-control"
                                                         <?php if(!isset($edit_data) || (isset($edit_data) && $edit_data[0]->upload_type != 'banner')): ?> required <?php endif; ?> name="file_url"
                                                         onchange="jQuery(this).next('input').val(this.value);" />
                                                     <input type="text" class="form-control"
                                                         placeholder="no file selected" readonly="" />
                                                     <span class="button">Choose File</span>

                                                 </div>
                                                 <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'banner'): ?>
                                                     <div> <img src="<?php echo e(asset($edit_data[0]->file_url)); ?>" width="100%"
                                                             height="auto"
                                                             style="border: 2px solid white; padding: 2px; border-radius: 12px; margin: 10px;">
                                                     </div>
                                                 <?php endif; ?>

                                             </div>
                                         </div>
                                         <div class="col-md-12">
                                             <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control summernote" name="description" placeholder="" style="height: 70px;">
                                                    <?php if(isset($edit_data) && $edit_data[0]->upload_type == 'banner'): ?>
                                                    <?php echo e($edit_data[0]->description ?? ''); ?>

                                                    <?php endif; ?>
                                                </textarea>

                                             </div>
                                         </div>





                                         <div class="col-md-2" style="margin-top: 25px;">
                                             <button type="submit" class="btn btn-md btn-info" id="">
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
                             <div class="col-md-12" style="border-top: 1px solid #da291c !important; ">
                                 <div class="col-md-12">
                                     <h4>Page Text</h4>
                                 </div>
                                 <form action="<?php echo e(url('add_user_arts_and_culture')); ?>" method="POST" id=""
                                     enctype="multipart/form-data">
                                     <?php echo csrf_field(); ?>
                                     <div class="col-md-12"
                                         style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">


                                         <div class="col-md-12">
                                             <div class="form-group">
                                                 
                                                 <textarea class="form-control summernote" name="description" placeholder="" style="height: 70px;">
                                                 <?php echo e(isset($user_birthplace_text->description) ? $user_birthplace_text->description : ''); ?>

                                                 </textarea>
                                                 <input type="hidden" class="form-control" name="uid"
                                                     value="<?php echo e($user_info->id); ?>">
                                                 <input type="hidden" class="form-control" name="upload_type"
                                                     value="<?php echo e(isset($user_birthplace_text->description) ? 'update_text' : 'text'); ?>">
                                             </div>
                                         </div>



                                         <div class="col-md-2" style="margin-top: 25px;">
                                             <button type="submit" class="btn btn-md btn-info"
                                                 id=""><?php echo e(isset($user_birthplace_text->description) ? 'Update' : 'Save'); ?></button>

                                         </div>
                                     </div>
                                 </form>
                                 <div class="clearfix"></div>
                             </div>

                             <div class="col-md-12" style="border-top: 1px solid #da291c !important; ">
                                 <div class="col-md-12">
                                     <h4>Number</h4>
                                 </div>
                                 <form action="<?php echo e(url('add_user_arts_and_culture')); ?>" method="POST" id=""
                                     enctype="multipart/form-data">
                                     <?php echo csrf_field(); ?>
                                     <div class="col-md-12"
                                         style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                                         <?php if(Auth::user()->role == "admin"): ?>
                                         <div class="col-md-6">

                                             <div class="form-group">
                                                 

                                                 

                                                 <input type="number" class="form-control" name="number"
                                                     value="<?php echo e(isset($user_birthplace_number->description) ? $user_birthplace_number->description : 0); ?>">
                                                 <input type="hidden" class="form-control" name="uid"
                                                     value="<?php echo e($user_info->id); ?>">
                                                 <input type="hidden" class="form-control" name="upload_type"
                                                     value="<?php echo e(isset($user_birthplace_number->description) ? 'update_number' : 'number'); ?>">
                                             </div>
                                         </div>
                                         <?php else: ?>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" readonly class="form-control" name="number"
                                                    value="<?php echo e(isset($user_birthplace_number->description) ? $user_birthplace_number->description : 0); ?>">
                                                <input type="hidden" class="form-control" name="uid"
                                                    value="<?php echo e($user_info->id); ?>">
                                                <input type="hidden" class="form-control" name="upload_type"
                                                    value="<?php echo e(isset($user_birthplace_number->description) ? 'update_number' : 'number'); ?>">
                                            </div>
                                        </div>
                                         <?php endif; ?>


                                         <?php if(Auth::user()->role == "admin"): ?>
                                         <div class="col-md-2">
                                             <button type="submit" class="btn btn-md btn-info"
                                                 id=""><?php echo e(isset($user_birthplace_number->description) ? 'Update' : 'Save'); ?></button>

                                         </div>
                                         <?php endif; ?>
                                     </div>
                                 </form>
                                 <div class="clearfix"></div>
                             </div>
                         </div>
                         <br><br>

                         <div class="col-md-12"
                             style="border: 1px solid #da291c !important; border-radius: 10px; margin-top:10px; padding-top: 30px; padding-bottom: 20px; background-color:#fff">
                             <div class="clearfix"></div>
                             
                             <div class="col-md-12">
                                 <h4>My Uploads</h4>
                             </div>
                             <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                 <thead>
                                     <tr>
                                         <th width="10%">Type</th>
                                         <th width="20%">Title</th>
                                         <th width="40%">File</th>
                                         <th width="20%">Description</th>
                                         <th width="20%">Dated</th>

                                         <th width="10%">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                    foreach ($user_birthplace_details as $value) {
                                        //   dd($value)
                                        if($value->upload_type != 'text' && $value->upload_type != 'number' ){
                                        ?>
                                     <tr>
                                         <td><?= $value->upload_type ?></td>
                                         <td><?= $value->title ?></td>
                                         <td>
                                             <?php if($value->upload_type == 'banner'): ?>
                                                 <img src="<?php echo e(asset($value->file_url)); ?>" width="100%" height="auto"
                                                     style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;">
                                             <?php else: ?>
                                                 <video width="100%" controls>
                                                     <source src="<?php echo e(asset($value->file_url)); ?>" type="video/mp4">
                                                 </video>
                                             <?php endif; ?>
                                         </td>
                                         <td><?= $value->description ?></td>
                                         <td><?= date('d-m-Y', strtotime($value->created_at)) ?></td>



                                         <td width="20%">
                                             <a class="btn btn-xs btn-success"
                                                 href="<?php echo e(url('edit_user_arts_and_culture') . '/' . $value->id); ?>">Edit</a>
                                             <form action="<?php echo e(url('delete_user_arts_and_culture')); ?>" method="POST"
                                                 id="" enctype="multipart/form-data"
                                                 style="display: inline-flex;">
                                                 <?php echo csrf_field(); ?>
                                                 <input type="hidden" name="id" value="<?php echo e($value->id); ?>">
                                                 <input type="submit" class="btn btn-xs btn-danger" value="Delete">
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
                     </div>
                 </div>
             </div>
     </section>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/setting/art_and_culture.blade.php ENDPATH**/ ?>