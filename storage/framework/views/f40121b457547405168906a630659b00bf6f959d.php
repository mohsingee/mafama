 
<?php $__env->startSection('content'); ?>

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
                               <!--  <a href="<?php echo e(url('/')); ?>" class="btn btn-md btn-info">Back</a> -->
                            </div>
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Payment Status</h4>
                            </div>
                        <div class="row gy-4">

                            <div class="col-md-12 text-center">
                                <?php if($message = Session::get('success')): ?>

                                 <div class="custom-alerts alert alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <?php echo $message; ?>

                                </div>
                                <?php Session::forget('success');?>
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
                        

                    <div class="row gy-4" style="padding-top:30px;">
                       <div class="col-md-12 text-center">
                        <br>
                            <a href="<?php echo e(url('/')); ?>" class="btn btn-md btn-info">Back to home</a> 
                       </div>
                     </div>
                   </div>
                </div>
            </div>
        </div>
    
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/payment_status.blade.php ENDPATH**/ ?>