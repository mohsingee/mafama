<div class="col-md-12 text-left margin-bottom-20 padding-0">
    <div class="margin-top-10">
        <?php if(userAccess('enable_state')==true): ?>
        <a href="<?php echo e(url('birthplace')); ?>"
            class="btn btn-md btn-info <?php echo e(Request::is('birthplace') ? 'bg_green' : 'bg_blue'); ?>">City Project</a>
        <?php endif; ?>
        <?php if(userAccess('enable_diaspo_connection')==true): ?>
        <a href="<?php echo e(url('birthplace_list')); ?>"
            class="btn btn-md btn-info <?php echo e(Request::is('birthplace_list') ? 'bg_green' : 'bg_blue'); ?>">Diaspo-Connection</a>
        <?php endif; ?>

        <?php if(userAccess('enable_gallery_of_leaders')==true): ?>
        <a href="<?php echo e(url('leaders_board_details')); ?>"
            class="btn btn-md btn-info <?php echo e(Request::is('leaders_board_details') ? 'bg_green' : 'bg_blue'); ?>">Leaders
            Board</a>
        <?php endif; ?>

        <?php if(userAccess('enable_arts_culture')==true): ?>
        <a href="<?php echo e(url('art-and-culture')); ?>"
            class="btn btn-md btn-info <?php echo e(Request::is('art-and-culture') ? 'bg_green' : 'bg_blue'); ?>">Art and
            Culture</a>
        <?php endif; ?>

        <?php if(userAccess('enable_shopping')==true): ?>
        <a href="#" class="btn btn-md btn-info bg_blue">Shopping</a>
        <?php endif; ?>

        <?php if(userAccess('enable_top_city_news')==true): ?>
        <a href="<?php echo e(url('top_city_news')); ?>"
            class="btn btn-md btn-info <?php echo e(Request::is('top_city_news') ? 'bg_green' : 'bg_blue'); ?>">Top City News</a>
        <?php endif; ?>
        <?php if(userAccess('enable_faith')==true): ?>
        <a href="<?php echo e(url('my_faith')); ?>"
            class="btn btn-md btn-info <?php echo e(Request::is('my_faith') ? 'bg_green' : 'bg_blue'); ?>">My Faith</a>
        <?php endif; ?>
        <?php if(userAccess('enable_city_guide')==true): ?>
        <a href="#" class="btn btn-md btn-info bg_blue">City Guide</a>
        <?php endif; ?>
        <?php if(userAccess('enable_city_management')==true): ?>
        <a href="#" class="btn btn-md btn-info bg_blue">City Management</a>
        <?php endif; ?>
    </div>
</div>
<div class="col-md-12 text-right margin-bottom-20 padding-0">
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-md btn-info">Back</a>
</div><?php /**PATH /home/mafamatest/public_html/resources/views/center_nav.blade.php ENDPATH**/ ?>