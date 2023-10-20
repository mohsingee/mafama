 
<?php $__env->startSection('content'); ?>
<style>
  
.borderless tr td, .borderless tr th {
    border: none !important;
    text-align: left;
    
}
</style>
 <style>body {
    background: #B1EA86;
    padding: 30px 0
}

a {
    text-decoration: none;
}

.pricingTable {
    text-align: center;
    background: #fff;
    margin: 0 -15px;
    box-shadow: 0 0 10px #ababab;
    padding-bottom: 40px;
    border-radius: 10px;
    color: #cad0de;
    transform: scale(1);
    transition: all .5s ease 0s
}

.pricingTable:hover {
    transform: scale(1.05);
    z-index: 1
}

.pricingTable .pricingTable-header {
    padding: 40px 0;
    background: #f5f6f9;
    border-radius: 10px 10px 50% 50%;
    transition: all .5s ease 0s
}

.pricingTable:hover .pricingTable-header {
    background: #ff9624
}

.pricingTable .pricingTable-header i {
    font-size: 50px;
    color: #858c9a;
    margin-bottom: 10px;
    transition: all .5s ease 0s
}

.pricingTable .price-value {
    font-size: 35px;
    color: #ff9624;
    transition: all .5s ease 0s
}

.pricingTable .month {
    display: block;
    font-size: 14px;
    color: #cad0de
}

.pricingTable:hover .month,
.pricingTable:hover .price-value,
.pricingTable:hover .pricingTable-header i {
    color: #fff
}

.pricingTable .heading {
    font-size: 24px;
    color: #ff9624;
    margin-bottom: 20px;
    text-transform: uppercase
}

.pricingTable .pricing-content ul {
    list-style: none;
    padding: 0;
    margin-bottom: 30px
}

.pricingTable .pricing-content ul li {
    line-height: 30px;
    color: #a7a8aa
}

.pricingTable .pricingTable-signup a {
    display: inline-block;
    font-size: 15px;
    color: #fff;
    padding: 10px 35px;
    border-radius: 20px;
    background: #ffa442;
    text-transform: uppercase;
    transition: all .3s ease 0s
}

.pricingTable .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #ffa442
}

.pricingTable.blue .heading,
.pricingTable.blue .price-value {
    color: #4b64ff
}

.pricingTable.blue .pricingTable-signup a,
.pricingTable.blue:hover .pricingTable-header {
    background: #4b64ff
}

.pricingTable.blue .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #4b64ff
}

.pricingTable.red .heading,
.pricingTable.red .price-value {
    color: #ff4b4b
}

.pricingTable.red .pricingTable-signup a,
.pricingTable.red:hover .pricingTable-header {
    background: #ff4b4b
}

.pricingTable.red .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #ff4b4b
}

.pricingTable.green .heading,
.pricingTable.green .price-value {
    color: #40c952
}

.pricingTable.green .pricingTable-signup a,
.pricingTable.green:hover .pricingTable-header {
    background: #40c952
}

.pricingTable.green .pricingTable-signup a:hover {
    box-shadow: 0 0 10px #40c952
}

.pricingTable.blue:hover .price-value,
.pricingTable.green:hover .price-value,
.pricingTable.red:hover .price-value {
    color: #fff
}

@media  screen and (max-width:990px) {
    .pricingTable {
        margin: 0 0 20px
    }
}
.white-mode {
    text-decoration: none;
    padding: 17px 40px;
    background-color: yellow;
    border-radius: 3px;
    color: black;
    transition: .35s ease-in-out;
    position: absolute;
    left: 15px;
    bottom: 15px
}
</style>


<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <form action="#" method="POST" id="" enctype="multipart/form-data">	
					<?php echo csrf_field(); ?>
                        <div class="" style="padding-bottom: 20px;">
                            <div class="col-md-12 text-right">
                                <a href="<?php echo e(url('/')); ?>" class="btn btn-md btn-info">Back</a>
                            </div>
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Renew Plan</h4>
                            </div>
	


        <div class="row">
        <?php if(!empty($plans)): ?>
        <?php
          $i=1;	
          
        ?>	
		 <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		 <?php
		  $class='';
		  $icon='';
		   if($i==1)
		   {
		   	 $class='';
		   	 $icon='fa-adjust';
		   }elseif($i==2){
             $class='green';
             $icon='fa-briefcase';
		   }elseif($i==3){
             $class='blue';
             $icon='fa-diamond';
		   }elseif($i==4){
             $class='red';
             $icon='fa-cube';
		   }
		   ?>
            <div class="col-md-<?php echo e($grid); ?> col-md-offset-<?php echo e($offset); ?>">
            	
            		
                <div class="pricingTable <?php echo e($class); ?>">
                    <div class="pricingTable-header">
                        <i class="fa <?php echo e($icon); ?>"></i>
                        <div class="price-value"> $<?php echo e($plan->monthly_fee); ?> <span class="month">per month</span> </div>
                    </div>
                    <br>
                    <h3 class="heading"><?php echo e($plan->name); ?></h3>
                    <div class="pricing-content">
                        <ul>
                            <li></li>
                            <!--<li><b>50GB</b> Disk Space</li>-->
                            
                        </ul>
                    </div>
                    <div class="pricingTable-signup">
                    	<form></form>
        	<form action="<?php echo e(url('update_current_plan')); ?>" method="POST"  id="form-<?php echo e($plan->id); ?>" >
        	 <?php echo csrf_field(); ?> 	  
        	<input type="hidden" name="plan_id" value="<?php echo e($plan->id); ?>">
        	<input type="hidden" name="fees" value="<?php echo e($plan->monthly_fee); ?>">
        	<input type="hidden" name="user_id" value="<?php echo e(isset($user->id)?$user->id:''); ?>">
            <a href="javascript:void(0)" class="subscribe-plan" data-id="<?php echo e($plan->id); ?>" data-order="<?php echo e(isset($user->id)?$user->id:''); ?>" data-price="<?php echo e($plan->monthly_fee); ?>">Renew</a>
             </form>
                    </div>
                </div>

            </div>
             <?php
              $i++;
            ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>	   
         
        </div>
   	
									
										
									
                        </div>
                    </form>
                       
  
                </div>
            </div>
        </div>
    </div>

                              
                              
   
</section>

<script type="text/javascript">
$(document).on('click','.subscribe-plan',function(e){
   e.preventDefault();
   var plan_id = $(this).attr("data-id");
   var fees = $(this).attr("data-price");               
   var user_id = $(this).attr("data-order");               
   var token = $("meta[name='csrf-token']").attr("content");           
   $elm=$(this);
   //$elm.hide();
   //$elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

   $("#form-"+plan_id).submit();
   // $.ajax({
   //          method:"POST",
   //          url:"<?= url('update_current_plan');?>",
   //          data:{user_id:user_id,plan_id:plan_id,fees:fees,_token:token},
   //          success:function(data)
   //          {                
	  //           $(".submit-loading").remove();
	  //           $elm.show();
	  //           window.location.href=data;
	            
   //          }
   //      })

    $(".submit-loading").remove();

})	




</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/affiliate_renewplan.blade.php ENDPATH**/ ?>