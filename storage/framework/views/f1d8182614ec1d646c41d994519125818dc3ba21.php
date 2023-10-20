 
<?php $__env->startSection('content'); ?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom: 20px;">
                    <h3 class="nk-block-title page-title">Show / Hide Home Page Links</h3>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <form id="">
                                    <div class="row gy-4">
                                        <div class="col-md-12">
                                            <div class="row gy-4">
                                                <div class="col-md-3">
                                                    <label><h5>Setting</h5></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <?php if(permission_access('hide_links_edit')==1): ?>
                                                    <div class="custom-control custom-control custom-switch" style="float: right;">
                                                        <input type="checkbox" class="custom-control-input mainmenustatus" <?php if($settingsstatus == "checked"){ ?> checked="" <?php } ?>id="customSwitchsetting" />
                                                        <label class="custom-control-label" for="customSwitchsetting"></label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <?php 
							                  	foreach($settings as $setting) {
							                ?>
	                                            <div class="row gy-4">
	                                                <div class="col-md-6">
	                                                    <label><?= $setting->menu ?></label>
	                                                </div>
	                                                <div class="col-md-6">
	                                                    <div class="custom-control custom-control-sm custom-switch">
	                                                        <input type="checkbox" class="custom-control-input customSwitch customSwitchse" <?php if($setting->status == 'on'){ ?>checked="" <?php } ?> id="customSwitch<?= $setting->id ?>" />
	                                                        <label class="custom-control-label" for="customSwitch<?= $setting->id ?>"></label>
	                                                    </div>
	                                                </div>
	                                            </div>
                                            <?php 
                                        		}
                                        	?>
                                        </div>
                                        <hr />
                                        <div class="col-md-12">
                                            <div class="row gy-4">
                                                <div class="col-md-4">
                                                    <label><h5>Appointment</h5></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php if(permission_access('hide_links_edit')==1): ?>
                                                    <div class="custom-control custom-control custom-switch" style="float: right;">
                                                        <input type="checkbox" class="custom-control-input mainmenustatus" <?php if($appointmentstatus == "checked"){ ?> checked="" <?php } ?> id="customSwitchappointment" />
                                                        <label class="custom-control-label" for="customSwitchappointment"></label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <?php 
                                            	foreach ($appointments as $appointment) {
                                            ?>
                                            <div class="row gy-4">
                                                <div class="col-md-6">
                                                    <label><?= $appointment->menu ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-control-sm custom-switch">
                                                        <input type="checkbox" class="custom-control-input customSwitch customSwitchap" <?php if($appointment->status == 'on'){ ?>checked="" <?php } ?> id="customSwitch<?= $appointment->id ?>" />
                                                        <label class="custom-control-label" for="customSwitch<?= $appointment->id ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        		}
                                        	?>
                                        </div>
                                        <hr />
                                        <div class="col-md-12">
                                            <div class="row gy-4">
                                                <div class="col-md-5">
                                                    <label><h5>Client Management</h5></label>
                                                </div>
                                                <div class="col-md-7">
                                                    <?php if(permission_access('hide_links_edit')==1): ?>
                                                    <div class="custom-control custom-control custom-switch" style="float: right;">
                                                        <input type="checkbox" class="custom-control-input mainmenustatus" <?php if($clientmanagemetstatus == "checked"){ ?> checked="" <?php } ?> id="customSwitchclientmanagement" />
                                                        <label class="custom-control-label" for="customSwitchclientmanagement"></label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <?php 
                                            	foreach ($clientmanagements as $clientmanagement) {
                                            ?>
                                            <div class="row gy-4">
                                                <div class="col-md-6">
                                                    <label><?= $clientmanagement->menu ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-control-sm custom-switch">
                                                        <input type="checkbox" class="custom-control-input customSwitch customSwitchcm" <?php if($clientmanagement->status == 'on'){ ?>checked="" <?php } ?> id="customSwitch<?= $clientmanagement->id ?>" />
                                                        <label class="custom-control-label" for="customSwitch<?= $clientmanagement->id ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        		}
                                        	?>
                                        </div>
                                        <hr />
                                        <div class="col-md-12">
                                            <div class="row gy-4">
                                                <div class="col-md-5">
                                                    <label><h5>Email Management</h5></label>
                                                </div>
                                                <div class="col-md-7">
                                                    <?php if(permission_access('hide_links_edit')==1): ?>
                                                    <div class="custom-control custom-control custom-switch" style="float: right;">
                                                        <input type="checkbox" class="custom-control-input mainmenustatus" <?php if($emailmanagementstatus == "checked"){ ?> checked="" <?php } ?> id="customSwitchemailmanagement" />
                                                        <label class="custom-control-label" for="customSwitchemailmanagement"></label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <?php 
                                            	foreach ($emailmanagements as $emailmanagement) {
                                            ?>
                                            <div class="row gy-4">
                                                <div class="col-md-6">
                                                    <label><?= $emailmanagement->menu ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-control-sm custom-switch">
                                                        <input type="checkbox" class="custom-control-input customSwitch customSwitchem" <?php if($emailmanagement->status == 'on'){ ?>checked="" <?php } ?> id="customSwitch<?= $emailmanagement->id ?>" />
                                                        <label class="custom-control-label" for="customSwitch<?= $emailmanagement->id ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                            	}
                                            ?>
                                        </div>
                                        <hr />
                                        <div class="col-md-12">
                                            <div class="row gy-4">
                                                <div class="col-md-5">
                                                    <label><h5>Financial Management</h5></label>
                                                </div>
                                                <div class="col-md-7">
                                                    <?php if(permission_access('hide_links_edit')==1): ?>
                                                    <div class="custom-control custom-control custom-switch" style="float: right;">
                                                        <input type="checkbox" class="custom-control-input mainmenustatus"<?php if($financialmanagementstatus == "checked"){ ?> checked="" <?php } ?> id="customSwitchfinancialmanagement" />
                                                        <label class="custom-control-label" for="customSwitchfinancialmanagement"></label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <?php 
                                            	foreach ($financialmanagements as $financialmanagement) {
                                            ?>
                                            <div class="row gy-4">
                                                <div class="col-md-6">
                                                    <label><?= $financialmanagement->menu ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-control-sm custom-switch">
                                                        <input type="checkbox" class="custom-control-input customSwitch customSwitchfm" <?php if($financialmanagement->status == 'on'){ ?>checked="" <?php } ?> id="customSwitch<?= $financialmanagement->id ?>" />
                                                        <label class="custom-control-label" for="customSwitch<?= $financialmanagement->id ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        		} 
                                        	?>
                                        </div>
                                        <hr />
                                        <div class="col-md-12">
                                            <div class="row gy-4">
                                                <div class="col-md-4">
                                                    <label><h5>Archives</h5></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php if(permission_access('hide_links_edit')==1): ?>
                                                    <div class="custom-control custom-control custom-switch" style="float: right;">
                                                        <input type="checkbox" class="custom-control-input mainmenustatus" <?php if($archivesstatus == "checked"){ ?> checked="" <?php } ?>  id="customSwitcharchives" />
                                                        <label class="custom-control-label" for="customSwitcharchives"></label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <?php 
                                            	foreach ($archives as $archive) {
                                            ?>
                                            <div class="row gy-4">
                                                <div class="col-md-6">
                                                    <label><?= $archive->menu ?></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-control-sm custom-switch">
                                                        <input type="checkbox" class="custom-control-input customSwitch customSwitchar" <?php if($archive->status == 'on'){ ?>checked="" <?php } ?> id="customSwitch<?= $archive->id ?>" />
                                                        <label class="custom-control-label" for="customSwitch<?= $archive->id ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        		}
                                        	?>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="row gy-4">
                                        <div class="col-md-12 text-center">
                                            <a href="#" class="btn btn-lg btn-primary">Save</a>
                                        </div>
                                    </div>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(".customSwitch").change(function(){
	    if($(this).prop("checked") == true){
	    	var fid = this.id;
	    	var lid = fid.split('Switch');
	    	var id = lid[1];
	    	// alert(id);
            var url = "<?php echo url('/'); ?>/hideunhidestatus";
            $.ajax({
                url: url,
                data: 'id=' + id + '&_token=<?php echo e(csrf_token()); ?>',
                type: "POST",
                success: function (data) {
	       			$(this).attr('checked', true);
                    alert("Unhide Successfully");
                }
            });
	    }else{
	       var fid = this.id;
	    	var lid = fid.split('Switch');
	    	var id = lid[1];
	    	// alert(id);
            var url = "<?php echo url('/'); ?>/hideunhidestatuss";
            $.ajax({
                url: url,
                data: 'id=' + id + '&_token=<?php echo e(csrf_token()); ?>',
                type: "POST",
                success: function (data) {
	       			$(this).removeAttr('checked');
                    alert("Hide Successfully");
                }
            });
	    }
	});
	$(".mainmenustatus").change(function(){
		 if($(this).prop("checked") == true){
	    	var fid = this.id;
	    	var lid = fid.split('Switch');
	    	var id = lid[1];
	    	// alert(id);
            var url = "<?php echo url('/'); ?>/allunhide";
            $.ajax({
                url: url,
                data: 'id=' + id + '&_token=<?php echo e(csrf_token()); ?>',
                type: "POST",
                success: function (data) {
                	$(".customSwitch"+data).attr('checked', true);
                    alert("Unhide Successfully");
           //      	var id = $(".customSwitch"+data).attr("id");
           //      	// alert(id);
           //      	var flg = id.split('Switch');
           //      	var flgg = flg[1];
           //      	for(var i = 0; i < 100; i++){
		       		// 	$("#customSwitch1").prop("checked");
		       		// 	flgg++;
		       		// }
                }
            });
	    }else{
	       var fid = this.id;
	    	var lid = fid.split('Switch');
	    	var id = lid[1];
	    	// alert(id);
            var url = "<?php echo url('/'); ?>/allhide";
            $.ajax({
                url: url,
                data: 'id=' + id + '&_token=<?php echo e(csrf_token()); ?>',
                type: "POST",
                success: function (data) {
	       			$(".customSwitch"+data).removeAttr('checked');
                    alert("Hide Successfully");
                }
            });
	    }
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/hide_unhide.blade.php ENDPATH**/ ?>