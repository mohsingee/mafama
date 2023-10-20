
<?php $__env->startSection('content'); ?>
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Appointments / Change Appointments</h4>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-20">
                        <a href="#" class="btn btn-md btn-info margin-right-10">View Offers</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My Faith</a>
                        <a href="<?php echo e(url('birthplace')); ?>" class="btn btn-md btn-info margin-right-10">My Birth Place</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">Sharing</a>
                        <a href="#" class="btn btn-md btn-info margin-right-10">My City Guide</a>
                        <?php if($chat != "off"){ ?>
                        <a href="<?php echo e(url('chat')); ?>" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <?php } ?>
                        <?php if($tools != "off"){ ?>
                        <a href="<?php echo e(url('tools')); ?>" class="btn btn-md btn-info margin-right-10">Tools</a>
                        <?php } ?>
                        <a href="<?php echo e(url('calender_meeting')); ?>" class="btn btn-md btn-info margin-right-10">My Daily
                            Briefing</a>
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-md btn-info">Back</a>
                    </div>
                    <div class="col-md-12 padding-0">
                        <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#daily-tab" data-toggle="tab">Daily</a></li>
                            <li><a href="#weekly-tab" data-toggle="tab">Weekly</a></li>
                            <li><a href="#monthly-tab" data-toggle="tab">Monthly</a></li>
                            <li><a href="#quarterly-tab" data-toggle="tab">Quarterly</a></li>
                        </ul>

                        <div class="tab-content margin-top-10"
                            style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                            <div class="tab-pane fade in active" id="daily-tab">
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    foreach ($appointments as $value) {
                                        $today = date('Y-m-d');
                                        $nowtime = date('H:i');
                                        if(($value->appointment_date == $today) && ($value->appointment_time >= $nowtime)){
                                    ?>
                                        <?php 
                                        if($change_details->change_unit == "day"){
                                        ?>
                                        <tr>
                                            <td><?= $value->first_name ?></td>
                                            <td><?= $value->last_name ?></td>
                                            <td><?= $value->email ?></td>
                                            <td><?= $value->cell_phone ?></td>
                                            <td><?= date('d F Y', strtotime($value->appointment_date)) ?></td>
                                            <td><?= $value->appointment_time ?></td>
                                            <td>
                                                <?php
                                                if($value->appointment_date >= date('Y-m-d', strtotime("+".$change_details->change_time." days"))){
                                                ?>
                                                <a href="<?php echo e(url('change_appointment_step')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-success">Change</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php }else{ ?>
                                                <a class="btn btn-xs btn-success">Not Changable</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        }elseif($change_details->change_unit == "hours"){
                                        ?>
                                        <tr>
                                            <td><?= $value->first_name ?></td>
                                            <td><?= $value->last_name ?></td>
                                            <td><?= $value->email ?></td>
                                            <td><?= $value->cell_phone ?></td>
                                            <td><?= date('d F Y', strtotime($value->appointment_date)) ?></td>
                                            <td><?= $value->appointment_time ?></td>
                                            <td>
                                                <?php
                                                    if($value->appointment_date == date('Y-m-d')){
                                                        if($value->appointment_time >= date("H:i", strtotime("+".$change_details->change_time." hours"))){
                                                    ?>
                                                <a href="<?php echo e(url('change_appointment_step')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-success">Change</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php 
                                                        }else{
                                                    ?>
                                                <a class="btn btn-xs btn-success">Not Changable</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php
                                                        }
                                                    ?>
                                                <?php }elseif($value->appointment_date > date('Y-m-d')){ ?>
                                                <a href="<?php echo e(url('change_appointment_step')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-success">Change</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php
                                    }elseif($value->appointment_date > $today){
                                    ?>
                                        <?php 
                                        if($change_details->change_unit == "day"){
                                        ?>
                                        <tr>
                                            <td><?= $value->first_name ?></td>
                                            <td><?= $value->last_name ?></td>
                                            <td><?= $value->email ?></td>
                                            <td><?= $value->cell_phone ?></td>
                                            <td><?= date('d F Y', strtotime($value->appointment_date)) ?></td>
                                            <td><?= $value->appointment_time ?></td>
                                            <td>
                                                <?php
                                                if($value->appointment_date >= date('Y-m-d', strtotime("+".$change_details->change_time." days"))){
                                                ?>
                                                <a href="<?php echo e(url('change_appointment_step')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-success">Change</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php }else{ ?>
                                                <a class="btn btn-xs btn-success">Not Changable</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        }elseif($change_details->change_unit == "hours"){
                                        ?>
                                        <tr>
                                            <td><?= $value->first_name ?></td>
                                            <td><?= $value->last_name ?></td>
                                            <td><?= $value->email ?></td>
                                            <td><?= $value->cell_phone ?></td>
                                            <td><?= date('d F Y', strtotime($value->appointment_date)) ?></td>
                                            <td><?= $value->appointment_time ?></td>
                                            <td>
                                                <?php
                                                    if($value->appointment_date == date('Y-m-d')){
                                                        if($value->appointment_time >= date("H:i", strtotime("+".$change_details->change_time." hours"))){
                                                    ?>
                                                <a href="<?php echo e(url('change_appointment_step')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-success">Change</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php 
                                                        }else{
                                                    ?>
                                                <a class="btn btn-xs btn-success">Not Changable</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php
                                                        }
                                                    ?>
                                                <?php }elseif($value->appointment_date > date('Y-m-d')){ ?>
                                                <a href="<?php echo e(url('change_appointment_step')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-success">Change</a>
                                                <a href="<?php echo e(url('change_appointment_view')); ?>/<?= $value->aid ?>"
                                                    class="btn btn-xs btn-danger">View</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="weekly-tab">
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                    <thead>
                                        <?php if($weekcnt == 4){ ?>
                                        <tr>
                                            <th>1st Week</th>
                                            <th>2nd Week</th>
                                            <th>3rd Week</th>
                                        </tr>
                                        <?php }elseif ($weekcnt == 5) { ?>
                                        <tr>
                                            <th>1st Week</th>
                                            <th>2nd Week</th>
                                            <th>3rd Week</th>
                                            <th>4th Week</th>
                                        </tr>
                                        <?php }elseif ($weekcnt == 6) { ?>
                                        <tr>
                                            <th>1st Week</th>
                                            <th>2nd Week</th>
                                            <th>3rd Week</th>
                                            <th>4th Week</th>
                                            <th>5th Week</th>
                                        </tr>
                                        <?php } ?>
                                    </thead>
                                    <tbody>
                                        <?php if($weekcnt == 4){ ?>
                                        <tr>
                                            <td><?= $week1 ?></td>
                                            <td><?= $week2 ?></td>
                                            <td><?= $week3 ?></td>
                                        </tr>
                                        <?php }elseif ($weekcnt == 5) { ?>
                                        <tr>
                                            <td><?= $week1 ?></td>
                                            <td><?= $week2 ?></td>
                                            <td><?= $week3 ?></td>
                                            <td><?= $week4 ?></td>
                                        </tr>
                                        <?php }elseif ($weekcnt == 6) { ?>
                                        <tr>
                                            <td><?= $week1 ?></td>
                                            <td><?= $week2 ?></td>
                                            <td><?= $week3 ?></td>
                                            <td><?= $week4 ?></td>
                                            <td><?= $week5 ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="monthly-tab">
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                    <thead>
                                        <tr>
                                            <th>Jan</th>
                                            <th>Feb</th>
                                            <th>Mar</th>
                                            <th>Apr</th>
                                            <th>May</th>
                                            <th>Jun</th>
                                            <th>Jul</th>
                                            <th>Aug</th>
                                            <th>Sep</th>
                                            <th>Oct</th>
                                            <th>Nov</th>
                                            <th>Dec</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $jancount ?></td>
                                            <td><?= $febcount ?></td>
                                            <td><?= $marcount ?></td>
                                            <td><?= $aprcount ?></td>
                                            <td><?= $maycount ?></td>
                                            <td><?= $juncount ?></td>
                                            <td><?= $julcount ?></td>
                                            <td><?= $augcount ?></td>
                                            <td><?= $sepcount ?></td>
                                            <td><?= $octcount ?></td>
                                            <td><?= $novcount ?></td>
                                            <td><?= $deccount ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="quarterly-tab">
                                <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                                    <thead>
                                        <tr>
                                            <th>Jan-Mar</th>
                                            <th>Apr-Jun</th>
                                            <th>Jul-Sep</th>
                                            <th>Oct-Dec</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $janmarcount ?></td>
                                            <td><?= $aprjuncount ?></td>
                                            <td><?= $julsepcount ?></td>
                                            <td><?= $octdeccount ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/change_appointment.blade.php ENDPATH**/ ?>