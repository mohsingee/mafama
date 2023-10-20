 
<?php $__env->startSection("content"); ?>
<style type="text/css">

</style>
<link href="<?php echo e(asset('public/genealogy/tree_new.css')); ?>" rel="stylesheet">
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Back Office</h4>
                    </div>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                    <?php if($chat != "off"){ ?>
                        <a href="<?php echo e(url('chat')); ?>" class="btn btn-md btn-info margin-right-10">Chat</a>
                    <?php } ?>
                    <?php if($tools != "off"){ ?>
                        <a href="<?php echo e(url('tools')); ?>" class="btn btn-md btn-info margin-right-10">Tools</a>
                    <?php } ?>
                    <a href="<?php echo e(url('calender_meeting')); ?>" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-md btn-info">Back</a>
                </div>
  <ul class="nav nav-tabs nav-button-tabs nav-justified">
                    <li class="active"><a href="#qualification" data-toggle="tab">Qualification Table</a></li>
                    <li><a href="#genealogy " data-toggle="tab">Genealogy Report </a></li>
                    <li><a href="#commission " data-toggle="tab">Commission Report </a></li>

                </ul>
            <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                <div class="tab-pane fade in active" id="qualification">
                   <table class="table table-striped table-bordered table-hover" id="datatable_sample3">
                                <thead>
                                    <tr>
                                        <th>Commissions/ Qualifications</th>
                                        <th>Commission</th>
                                        <?php if($level<=4): ?>
                                        <th>Bonus</th>
                                        <?php endif; ?>
                                        <th>Prizes</th>
                                        <th>Other</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                      $total_current=$bonus_commission+$bonus+$prize+$other;
                                      $ytd_bonus=0;
                                      ?>

                                 <tr class="bg-blue1">
                                     <td>Year to Date</td>
                                    <td>$<?php echo e($ytd_bonus_comm); ?></td>
                                      <?php if($level<=4): ?>
                                     <td>$<?php echo e($ytd_bonus); ?></td>
                                     <?php endif; ?>
                                     <td>$<?php echo e($ytd_prize); ?></td>
                                     <td>$<?php echo e($ytd_other); ?></td>
                                     <td class="text-red">
                                      <?php

                                      $total_ytd=$ytd_bonus_comm+$ytd_bonus+$ytd_prize+$ytd_other;
                                      ?>
                                     $<?php echo e($total_ytd); ?></td>
                                 </tr>

                                <?php if(Auth::check()): ?>
                                 <tr class="bg-purple1">
                                     <td>Current Month</td>
                                     <td>$<?php echo e($bonus_commission); ?></td>
                                       <?php if($level<=4): ?>
                                     <td>$<?php echo e($bonus); ?></td>
                                     <?php endif; ?>
                                     <td>$<?php echo e($prize); ?></td>
                                     <td>$<?php echo e($other); ?></td>
                                     <td class="text-red">

                                     $<?php echo e($total_current); ?></td>
                                 </tr>

                                <?php endif; ?>
                                 <tr class="bg-green1">
                                     <td>Total</td>
                                    <td class="text-red">
                                      <?php
                                      $total1=$bonus_commission+$ytd_bonus_comm;
                                      $total2=0;
                                      ?>
                                    $<?php echo e($total1); ?></td>
                                      <?php if($level<=4): ?>
                                     <td class="text-red">
                                       <?php
                                      $total2=$bonus+$ytd_bonus;
                                      ?>
                                     $<?php echo e($total2); ?></td>
                                       <?php endif; ?>
                                     <td class="text-red">
                                      <?php
                                      $total3=$prize+$ytd_prize;
                                      ?>
                                      $<?php echo e($total3); ?>


                                     </td>
                                     <td class="text-red">
                                      <?php
                                      $total4=$other+$ytd_other;
                                      ?>
                                      $<?php echo e($total4); ?>

                                     </td>
                                     <td class="text-red">
                                      <?php
                                      $total=$total1+$total2+$total3+$total4;
                                      ?>
                                     $<?php echo e($total); ?></td>
                                 </tr>
                                </tbody>
                            </table>


                    <table class="table table-striped table-bordered table-hover" id="datatable_sample3" style="margin-top:20px">
                                <thead>
                                    <tr>
                                        <th>Bonus Pool</th>
                                        <th>Direct Sponsored</th>
                                        <th>Affiliate</th>
                                         <th>Total</th>
                                         <!-- <th># Email sent</th> -->
                                        <th>Point Earned</th>
                                        <!--  <th>New Paid</th>  -->
                                    </tr>
                                    <tr>
                                        <?php if($level <=4): ?>
                                        <td> $<?php echo e(number_format($bonus_pool->price,2)); ?></td>
                                        <?php else: ?>
                                         <td>-</td>
                                        <?php endif; ?>
                                        <td>Affiliates</td>
                                        <td>Active Time<br> in days</td>
                                        <td>Active Users<br> per Qtr</td>
                                        <!--  <td>Basket I/Qtr <br> per Month</td>  -->
                                        <td>Month/Qtr</td>
                                      <!--   <td>Month/Qtr</td>  -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(Auth::check()): ?>

                                <?php if($level <=4): ?>
                                 <tr class="bg-red1">
                                     <th class="text-red">Bonus</th>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                      <td></td>

                                 </tr>

                                 <tr class="bg-purple1">
                                     <td>Qualification (Bonus)</td>
                                     <td class="text-purple"><?php echo e($bonus_condition->downline_affiliate ? $bonus_condition->downline_affiliate:''); ?></td>
                                     <td class="text-purple"><?php echo e($bonus_condition->active_days ?$bonus_condition->active_days:''); ?></td>
                                     <td class="text-purple"><?php echo e($bonus_condition->active_users ?$bonus_condition->active_users:''); ?></td>

                                     <td class="text-purple"><?php echo e($bonus_condition->point_earned?$bonus_condition->point_earned:''); ?></td>

                                 </tr>

                                  <tr class="bg-blue1">
                                     <td>Current Position</td>
                                     <td class="text-blue"><?php echo e($direct_sponsor); ?></td>
                                     <td class="text-blue"><?php echo e($user_active_days); ?></td>
                                     <td class="text-blue"><?php echo e($active_users); ?></td>
                                     <td class="text-blue"><?php echo e($earned_points); ?></td>


                                 </tr>
                                  <tr class="bg-green1">
                                     <td>Qualification Needed</td>
                                     <td class="text-green">
                                         <?php if($bonus_condition->downline_affiliate > $direct_sponsor ): ?>

                                              <?php
                                               $rem=$bonus_condition->downline_affiliate-$direct_sponsor;
                                              ?>
                                              <?php echo e($rem); ?>


                                         <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>
                                     <td class="text-green">
                                         <?php if($bonus_condition->active_days > $user_active_days ): ?>

                                              <?php
                                               $rem=$bonus_condition->active_days-$user_active_days;
                                              ?>
                                              <?php echo e($rem); ?>


                                         <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>

                                     <td class="text-green">
                                         <?php if($bonus_condition->active_users > $active_users ): ?>

                                              <?php
                                               $rem1=$bonus_condition->active_users-$active_users;
                                              ?>
                                              <?php echo e($rem1); ?>


                                         <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>
                                      <td class="text-green">
                                         <?php if($bonus_condition->point_earned > $earned_points ): ?>

                                              <?php
                                               $rem=$bonus_condition->point_earned-$earned_points;
                                              ?>
                                              <?php echo e($rem); ?>


                                         <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>


                                 </tr>
                                 <?php endif; ?>

                                  <tr class="bg-red1">
                                     <th class="text-red">Prize</th>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                      <td></td>

                                 </tr>
                                 <tr class="bg-purple1">
                                 <td>Qualification (Bonus)</td>
                                 <td class="text-purple"><?php echo e($prize_condition->downline_affiliate); ?></td>
                                 <td class="text-purple"><?php echo e($prize_condition->active_days); ?></td>
                                 <td class="text-purple"><?php echo e($prize_condition->active_users); ?></td>
                                 <td class="text-purple"><?php echo e($prize_condition->point_earned); ?></td>

                                 </tr>

                                  <tr class="bg-blue1">
                                    <td>Current Position</td>
                                    <td class="text-blue"><?php echo e($direct_sponsor); ?></td>
                                    <td class="text-blue"><?php echo e($user_active_days); ?></td>
                                    <td class="text-blue"><?php echo e($active_users); ?></td>
                                    <td class="text-blue"><?php echo e($earned_points); ?></td>


                                 </tr>
                                  <tr class="bg-green1">
                                     <td>Qualification Needed</td>
                                    <td class="text-green">
                                        <?php if($prize_condition->downline_affiliate > $direct_sponsor ): ?>

                                          <?php
                                           $rem=$prize_condition->downline_affiliate-$direct_sponsor;
                                          ?>
                                              <?php echo e($rem); ?>

                                        <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>
                                    <td class="text-green">
                                        <?php if($prize_condition->active_days > $user_active_days ): ?>

                                          <?php
                                           $rem=$prize_condition->active_days-$user_active_days;
                                          ?>
                                              <?php echo e($rem); ?>

                                        <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>

                                     <td class="text-green">
                                        <?php if($prize_condition->active_users > $active_users ): ?>

                                          <?php
                                           $rem1=$prize_condition->active_users-$active_users;
                                          ?>
                                              <?php echo e($rem1); ?>

                                        <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>
                                     <td class="text-green">
                                        <?php if($prize_condition->point_earned > $earned_points ): ?>

                                          <?php
                                           $rem=$prize_condition->point_earned-$earned_points;
                                          ?>
                                              <?php echo e($rem); ?>

                                        <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>



                                 </tr>

                                  <tr class="bg-red1">
                                     <th class="text-red">Other</th>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                      <td></td>

                                 </tr>
                                  <tr class="bg-purple1">
                                    <td>Qualification (Bonus)</td>
                                    <td class="text-purple"><?php echo e($other_condition->downline_affiliate); ?></td>
                                    <td class="text-purple"><?php echo e($other_condition->active_days); ?></td>
                                     <td class="text-purple"><?php echo e($other_condition->active_users); ?></td>
                                     <td class="text-purple"><?php echo e($other_condition->point_earned); ?></td>

                                 </tr>

                                  <tr class="bg-blue1">
                                     <td >Current Position</td>
                                    <td class="text-blue"><?php echo e($direct_sponsor); ?></td>
                                     <td class="text-blue"><?php echo e($user_active_days); ?></td>
                                     <td class="text-blue"><?php echo e($active_users); ?></td>
                                     <td class="text-blue"><?php echo e($earned_points); ?></td>


                                 </tr>
                                  <tr class="bg-green1">
                                     <td>Qualification Needed</td>
                                     <td class="text-green">
                                        <?php if($other_condition->downline_affiliate > $direct_sponsor ): ?>

                                          <?php
                                           $rem=$other_condition->downline_affiliate-$direct_sponsor;
                                          ?>
                                              <?php echo e($rem); ?>

                                        <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>
                                     <td class="text-green">
                                        <?php if($other_condition->active_days > $user_active_days ): ?>

                                          <?php
                                           $rem=$other_condition->active_days-$user_active_days;
                                          ?>
                                              <?php echo e($rem); ?>

                                        <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>

                                      <td class="text-green">
                                        <?php if($other_condition->active_users > $active_users ): ?>

                                          <?php
                                           $rem1=$other_condition->active_users-$active_users;
                                          ?>
                                              <?php echo e($rem1); ?>

                                        <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>

                                      <td class="text-green">
                                        <?php if($other_condition->point_earned > $earned_points ): ?>

                                          <?php
                                           $rem=$other_condition->point_earned-$earned_points;
                                          ?>
                                              <?php echo e($rem); ?>

                                        <?php else: ?>
                                            -
                                         <?php endif; ?>
                                     </td>


                                 </tr>

                                <?php endif; ?>
                                </tbody>
                            </table>

                </div>
                  <div  class="tab-pane fade in" id="genealogy">
                      <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">

                                 <div class="row">
                            <div class="col-md-12">
                                <table style="width:100%">
                                    <tr>
                                        <td width="20%" class="ntest1 back-to-home" style="display:none">
                                            <a href="javascript:void(0);" class="back-btn-c1 ntest return-btn" onclick="return get_child(<?=Auth::user()->id;?>,<?=Auth::user()->id;?>)" ><i class="fa fa-angle-left btn-g"></i> Back </a>
                                        <span ></span>
                                        </td>
                                        <td width="20%" class="ntest1">
                                            <a href="javascript:void(0);" class="back-btn-c1 ntest" onclick="return get_child(<?=Auth::user()->id;?>,<?=Auth::user()->id;?>)" ><i class="fa fa-home btn-g"></i> Home </a>

                                        </td>
                                        <td width="20%" align="left"><span class="ntest">Jump to user</span>  </td>
                                        <td width="20%"><input type="text" class="form-control" id="sponserid" placeholder="Insert User Id"></td>
                                        <td>
                                             <button class="bbn" id="SearchID"><i class="fa fa-search btn-g"></i></button>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                        </div>

                         <div class="row">


                         <div class="col-sm-12"  >

                            <hr>
                             <div class="pan-container" >
                              <ul class="tree" id="genealogy_id">
                                           <?php if(!empty($networks)): ?>
                                           <?php echo $networks; ?>

                                            <?php endif; ?>

                                  </ul>
                               <div class="clearfix"></div>
                            </div>


                         </div>
                        </div>


                            </div>
                        </div>
                    </div>
                </div>
                  </div>
                <div  class="tab-pane fade in" id="commission">

                        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Datetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php if(Auth::check()): ?>
                                   <?php
                                   $i=1
                                   ?>
                                   <?php if($transactions->count() >0 ): ?>
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       <td><?php echo e($i++); ?>.</td>
                                       <td><b>$</b><?php echo e($trans->amount); ?></td>
                                       <td><?php echo $trans->description; ?></td>
                                       <td><?php echo e(date_formate($trans->created_at)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan=""></td>
                                        <td colspan=""></td>
                                        <td colspan=""></td>
                                        <td colspan=""></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                    </div>
            </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/genealogy/treeview.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/back_office_page.blade.php ENDPATH**/ ?>