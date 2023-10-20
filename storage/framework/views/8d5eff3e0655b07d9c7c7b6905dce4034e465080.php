 
 <?php $__env->startSection('content'); ?>
     <!-- -->
     <style type="text/css">
         p {
             margin-bottom: 5px !important;
         }
         h2,h3,h4,h5,h6 {
             margin-bottom: 10px !important;
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

         .circle {
             width: 150px;
             height: 150px;
             line-height: 150px;
             border-radius: 50%;
             font-size: 24px;
             color: #fff;
             text-align: center;
             background: rgb(255, 0, 51);
             display:inline-block;
             margin:15px auto 0 auto;
         }

         .videoInsert {
             position: relative;
             right: 0;
             bottom: 0;
             min-width: auto;
             max-height: 300px;

             width: 100%;
             height: 100%;
             /* z-index: -100; */
             background-size: cover;
             overflow: hidden;
         }




         .owl-carousel img {
             height: 100%;
             width: 100%;
         }
     </style>
     <section>
         <div class="container">
             <div class="row">
                 <!-- tabs -->


                 <!-- tabs content -->
                 <div class="col-md-12 col-sm-12">
                    <div class="row text-center">
                         <?php if(!empty($primary)): ?>
                         <div class="col-md-12">
                             <h4 class="f-36"><?php echo e($primary->description); ?></h4>
                         </div>
                         <?php endif; ?>

                         <?php if(!empty($secondary)): ?>
                         <div class="col-md-12">
                             <h4 class="f-28"><?php echo e($secondary->description); ?></h4>
                         </div>
                         <?php endif; ?>
                    </div>
                     <div class="row bg-white " style="border: 1px solid #da291c !important; ">
                         <div class="col-md-5 bg-white padding-15" style="border: 1px solid #da291c !important; ">

                             <div class="owl-carousel nomargin"
                                 data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": 10000, "pagination": false, "nav": true, "dots": true, "lazyLoad": true,
                                  }'
                                 style="padding: 0 5px;">
                                 <?php
                                         if(count($admin_birthplace_banner_info)==0){
                                          ?> <p>No record found</p>
                                 <?php }else{
                                        foreach ($admin_birthplace_banner_info as $value) {
                                        ?>

                                 <div class="card text-center">
                                     <div class="card-header" style="height:100px;">
                                         <h4 class="margin-top-20 text-center " style="font-size:auto">
                                             <?php echo e(str_limit(strip_tags($value->title), 150)); ?>

                                         </h4>
                                     </div>
                                     <div class="card-body" style="height:300px">

                                         <img id="card_img" src="<?php echo e($value->file_url); ?>" width="100%" height="100%">
                                     </div>
                                     <div class="card-footer" style="height:100px;">
                                         <p class="card-text ">
                                             <?= str_limit(strip_tags($value->description), 250) ?></p>
                                     </div>
                                 </div>
                                 <?php
                                    }}

                                ?>
                             </div>
                         </div>
                         <div class="col-md-2 bg-white text-center">
                             <div class="heading-title  col-md-12 margin-bottom-0 text-center">
                                 <?php //print_r($user_info);
                                 ?>

                                 <h4 class="bg-white margin-top-20 padding-0 f-28"><b class="f-36 f_blue f-Cali">Welcome to</b><br>
                                    <span class="f-b">
                                     
                                     <?php if( isset($user_info->birth_commune) ): ?>
                                        <?php echo e(showcommuneName($user_info->birth_commune)); ?>

                                        <?php elseif( isset($user_info->birth_state) ): ?>
                                        
                                        <span class="bfh-states" data-country="<?php echo e($user_info->birth_country); ?>" data-state="<?php echo e($user_info->birth_state); ?>"><?php echo e($user_info->birth_state); ?></span>
                                    <?php endif; ?>
                                    </span>


                                 </h4>

                             </div>
                             <div class="circle text-center ">
                                 <?php if(isset($user_birthplace_number->description)): ?>
                                     $<?php echo e(number_format($user_birthplace_number->description, 2)); ?>

                                 <?php else: ?>
                                     $<?php echo e(number_format(0, 2)); ?>

                                 <?php endif; ?>
                             </div>
                             <?php if(!empty($middle)): ?>
                             <div class="margin-top-20 text-left margin-bottom-10" ><?php echo $middle->description; ?></div>
                             <?php endif; ?>
                            <h4 class="f_blue b-t-b-3 margin-bottom-0">
                                 
                                 <?php if( isset($user_info->birth_commune) ): ?>
                                 <?php echo e(showcommuneName($user_info->birth_commune)); ?>

                                 <?php elseif( isset($user_info->birth_state) ): ?>
                                 
                                 <span class="bfh-states" data-country="<?php echo e($user_info->birth_country); ?>" data-state="<?php echo e($user_info->birth_state); ?>"><?php echo e($user_info->birth_state); ?></span>
                                 <?php endif; ?>
                            </h4>
                            <?php if(!empty($footer)): ?>
                             <p class="f_blue"><?php echo e($footer->description); ?></p>
                             <?php endif; ?>
                            

                         </div>
                         <div class="col-md-5 bg-white padding-15" style="border: 1px solid #da291c !important; ">

                             <div class="owl-carousel nomargin"
                                         data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": 10000, "pagination": false, "nav": true, "dots": true, "lazyLoad": true,
                                  }'
                                         style="padding: 0;">
                                         <?php
                                          if(count($admin_birthplace_video_info)==0){
                                            ?> <p>No record found</p>
                                         <?php }else{
                                                foreach ($admin_birthplace_video_info as $value) {
                                                ?>
                                         <div class="card text-center">
                                             <div class="card-header" style="height:100px;">
                                                 <h4 class="text-center margin-top-20" style="font-size:auto">
                                                     <?php echo e(str_limit(strip_tags($value->title), 150)); ?>

                                                 </h4>
                                             </div>
                                             <div class="card-body" style="height:300px">
                                                 <video class="videoInsert" width="100%" controls>
                                                     <source src="<?php echo e(asset($value->file_url)); ?>" type="video/mp4">
                                                 </video>
                                             </div>
                                             <div class="card-footer" style="height:100px;">
                                                 <p class="card-text ">
                                                     <?= str_limit(strip_tags($value->description), 250) ?></p>
                                             </div>
                                         </div>
                                         <?php
                                            }
                                         }
                                        ?>
                                     </div>
                         </div>
                        <div class="col-md-12 text-center">
                            <a href="<?php echo e(url('leaders_board')); ?>" class="btn btn-md btn-green margin-bottom-10 margin-top-10 width-150">Click here</a>
                        </div>
                     </div>




                     <div class="col-md-12">
                         <?php echo $__env->make('center_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                         <div class="col-md-12 bg-white "
                             style="border: 1px solid #da291c !important; border-radius: 10px; margin-top:10px; padding-top: 30px; padding-bottom: 20px;">
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="owl-carousel nomargin"
                                        data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": 10000, "pagination": false, "nav": true, "dots": true, "lazyLoad": true,
                                  }'
                                         style="padding: 0 5px;">
                                         <?php
                                         if(count($user_birthplace_banner_info)==0){
                                          ?> <p>No record found</p>
                                         <?php }else{
                                                    foreach ($user_birthplace_banner_info as $value) {
                                                     ?>
                                         <div class="card text-center">
                                             <div class="card-header" style="height:100px;">
                                                 <h4 class="text-center " style="font-size:auto">
                                                     <?php echo e(str_limit(strip_tags($value->title), 150)); ?>

                                                 </h4>
                                             </div>
                                             <div class="card-body" style="height:300px">

                                                 <img id="card_img" src="<?php echo e($value->file_url); ?>" width="100%"
                                                     height="100%">
                                             </div>
                                             <div class="card-footer" style="height:100px;">
                                                 <p class="card-text ">
                                                     <?= str_limit(strip_tags($value->description), 250) ?></p>
                                             </div>
                                         </div>
                                         <?php
                                            }}
                                            ?>
                                     </div>
                                 </div>

                                 <div class="col-md-6" style="border-left: 1px solid #da291c !important; ">
                                     <div class="owl-carousel nomargin"
                                         data-plugin-options='{"items":1, "singleItem": false, "autoPlay": true, "autoPlay": 10000, "pagination": false, "nav": true, "dots": true, "lazyLoad": true,
                                  }'
                                         style="padding: 0 5px;">
                                         <?php
                                          if(count($user_birthplace_video_info)==0){
                                            ?> <p>No record found</p>
                                         <?php }else{
                                                foreach ($user_birthplace_video_info as $value) {
                                                ?>
                                         <div class="card text-center">
                                             <div class="card-header" style="height:100px;">
                                                 <h4 class="text-center " style="font-size:auto">
                                                     <?php echo e(str_limit(strip_tags($value->title), 150)); ?>

                                                 </h4>
                                             </div>
                                             <div class="card-body" style="height:300px">
                                                 <video class="videoInsert" controls>
                                                     <source src="<?php echo e(asset($value->file_url)); ?>" type="video/mp4">
                                                 </video>
                                             </div>
                                             <div class="card-footer" style="height:100px;">
                                                 <p class="card-text ">
                                                     <?= str_limit(strip_tags($value->description), 250) ?></p>
                                             </div>
                                         </div>
                                         <?php
                                            }
                                         }
                                        ?>
                                     </div>
                                 </div>


                                 <div class="col-md-12 text-center" style="border-top: 1px solid #da291c !important; ">
                                     <br>
                                     <p> <?= isset($user_birthplace_text->description) ? $user_birthplace_text->description : '' ?>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/art_and_culture.blade.php ENDPATH**/ ?>