 
<?php $__env->startSection('content'); ?>
<?php
   $setting=\App\Setting::general_setting();
   $share_for_step1=$setting->shareable_fields_one;
   $share_for_step2=$setting->shareable_fields_two;
?> 
<style>
  
.borderless tr td, .borderless tr th {
    border: none !important;
    text-align: left;
    
}
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                   
                        <div class="" style="padding-bottom: 20px;">
                            <div class="col-md-12 text-right">
                                <a href="<?php echo e(url('/')); ?>" class="btn btn-md btn-info">Back</a>
                            </div>
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Complete Registration</h4>
                            </div>
                        <div class="row gy-4">

                            <div class="col-md-12 text-center">
                                <?php if($message = Session::get('success')): ?>
                               <!--  -->

<?php if(!empty(session()->get('share_step2')) && session()->get('share_step2')=='Yes'): ?>

<script type="text/javascript">
    $(window).on('load', function() {
        $('#welcomeModal').modal('show');
    });
</script>
<?php else: ?>
  <div class="custom-alerts alert alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      <?php echo $message; ?>

  </div>

<?php endif; ?>

                                  
                           
                                <?php endif; ?>

                                <?php if($message = Session::get('error')): ?>
                                <div class="custom-alerts alert alert-danger fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <?php echo $message; ?>

                                </div>
                                <?php Session::forget('error');?>
                                <?php endif; ?>
                            </div>
                        </div>  
                        <?php if($message = Session::get('success')): ?>                      
                          <div class="clearfix"></div>    
                             <div class="divider"></div>    
                             <?php Session::forget('success');?>
                         <?php endif; ?>
                        <div class="clearfix"></div>  
                                    
                        </div>
<?php if(session()->get('share_link_enable')): ?>                  
 
<?php if(!empty(session()->get('share_step1')) && session()->get('share_step1')=='Yes'): ?> 
<?php 
$total_share=$share_for_step1;

?> 

<?php elseif(!empty(session()->get('share_step2')) && session()->get('share_step2')=='Yes'): ?> 

<?php 
$total_share=$share_for_step2;
?> 

<?php endif; ?>

  <div class="row gy-4" style="padding-bottom:20px;">
     <div class="col-md-12 text-center">
          <h5>Invite your friend to join your network</h5>
     </div>
   </div> 
 <form action="<?php echo e(url('invite-users')); ?>" method="POST" id="" enctype="multipart/form-data">
 <input type="hidden" name="user_id" value="<?php echo e(session()->get('user_id')); ?>">   
 <?php echo csrf_field(); ?>
<?php for($i=0;$i<$total_share;$i++): ?>    
<div class="row gy-4 clearfix">                                        
 <div class="col-md-3">
    <div class="form-group">
     <label class="form-label">First Name</label>
     <input type="text" class="form-control"  placeholder="First Name" name="user[first_name][]" required>
    </div>
</div>
 <div class="col-md-3">
    <div class="form-group">
      <label class="form-label">Last Name</label>
    <input type="text" class="form-control" placeholder="Last Name" name="user[last_name][]" required>
    </div>
</div>                       
                                    
<div class="col-md-6">
     <div class="form-group">
     <label class="form-label" for="">Email</label>
      <input type="text" class="form-control" placeholder="Email" name="user[email][]" required>                                      
    </div>
</div>
                                   
</div>                                        
<?php endfor; ?>
<div class="col-md-12" style="margin-top:40px; text-align:center;">

<?php if(!empty(session()->get('share_step2')) && session()->get('share_step2')=='Yes'): ?> 
<a href="<?php echo e(url('registration-success')); ?>" class="btn btn-lg btn-primary">Skip Sharing</a>

<?php endif; ?>
    <input type="submit" class="btn btn-lg btn-primary" value="Invite Now">
</div>                                        
</form> 

<?php endif; ?>

 </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<div id="welcomeModal" class="modal fade" data-backdrop="static">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">            -->
<!--            <div class="modal-header">              -->
<!--                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
<!--                <h4 class="modal-title" id="myModalLabel">Welcome to MAFAMA</h4>-->
<!--            </div>-->
<!--            <div class="modal-body ">-->
<!--                <div class="row gy-4" style="margin-top: 10px;">-->
<!--                    <div class="col-md-12">-->
<!--                      <p><?php echo $message; ?></p>-->
<!--                    </div>-->
<!--                    <hr>-->
<!--                    <div class="col-md-12" style="margin-top: 30px;">-->
<!--                    <div class="embed-responsive embed-responsive-16by9">-->
<!--                      <video width="100%"  height="450" controls="true" poster="" id="video" class="get_vid" data-vid="<?=$video->id;?>" muted>-->
<!--                        <source src="<?php echo asset("public/videos") ?>/<?= $video->video ?>" type="video/mp4">-->
<!--                      </video>-->
<!--                    </div>-->
<!--                    </div>  -->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<script type="text/javascript">
$(document).on('click','.btnee',function(e){
   e.preventDefault();
   var plan_id = $(this).attr("data-id");
   var fees = $(this).attr("data-price");               
   var user_id = $(this).attr("data-order");               
   var token = $("meta[name='csrf-token']").attr("content");           
   $elm=$(this);
   $elm.hide();
   $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
   // $.ajax({
   //          method:"POST",
   //          url:"<?= url('complete_registration');?>",
   //          data:{user_id:user_id,plan_id:plan_id,fees:fees,_token:token},
   //          success:function(data)
   //          {                
   //            $(".submit-loading").remove();
   //            $elm.show();
   //            window.location.href=data;
             
   //          }
   //      })

})  




</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/paywithpaypal.blade.php ENDPATH**/ ?>