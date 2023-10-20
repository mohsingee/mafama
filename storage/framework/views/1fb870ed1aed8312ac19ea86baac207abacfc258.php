<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
<style type="text/css">
    .panel.price,
    .panel.price>.panel-heading {
        border-radius: 0px;
        -moz-transition: all .3s ease;
        -o-transition: all .3s ease;
        -webkit-transition: all .3s ease;
    }

    .panel.price:hover {
        box-shadow: 0px 0px 30px rgba(0, 0, 0, .2);
    }

    .panel.price:hover>.panel-heading {
        box-shadow: 0px 0px 30px rgba(0, 0, 0, .2) inset;
    }


    .panel.price>.panel-heading {
        box-shadow: 0px 5px 0px rgba(50, 50, 50, .2) inset;
        text-shadow: 0px 3px 0px rgba(50, 50, 50, .6);
    }

    .price .list-group-item {
        border-bottom-: 1px solid rgba(250, 250, 250, .5);
    }

    .panel.price .list-group-item:last-child {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .panel.price .list-group-item:first-child {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }

    .price .panel-footer {
        color: #fff;
        border-bottom: 0px;
        background-color: rgba(0, 0, 0, .1);
        box-shadow: 0px 3px 0px rgba(0, 0, 0, .3);
    }


    .panel.price .btn {
        box-shadow: 0 -1px 0px rgba(50, 50, 50, .2) inset;
        border: 0px;
    }

    /* green panel */


    .price.panel-green>.panel-heading {
        color: #fff;
        background-color: #57AC57;
        border-color: #71DF71;
        border-bottom: 1px solid #71DF71;
    }


    .price.panel-green>.panel-body {
        color: #fff;
        background-color: #65C965;
    }


    .price.panel-green>.panel-body .lead {
        text-shadow: 0px 3px 0px rgba(50, 50, 50, .3);
    }

    .price.panel-green .list-group-item {
        color: #333;
        background-color: rgba(50, 50, 50, .01);
        font-weight: 600;
        text-shadow: 0px 1px 0px rgba(250, 250, 250, .75);
    }

    /* blue panel */


    .price.panel-blue>.panel-heading {
        color: #fff;
        background-color: #608BB4;
        border-color: #78AEE1;
        border-bottom: 1px solid #78AEE1;
    }


    .price.panel-blue>.panel-body {
        color: #fff;
        background-color: #73A3D4;
    }


    .price.panel-blue>.panel-body .lead {
        text-shadow: 0px 3px 0px rgba(50, 50, 50, .3);
    }

    .price.panel-blue .list-group-item {
        color: #333;
        background-color: rgba(50, 50, 50, .01);
        font-weight: 600;
        text-shadow: 0px 1px 0px rgba(250, 250, 250, .75);
    }

    /* red price */


    .price.panel-red>.panel-heading {
        color: #fff;
        background-color: #D04E50;
        border-color: #FF6062;
        border-bottom: 1px solid #FF6062;
    }


    .price.panel-red>.panel-body {
        color: #fff;
        background-color: #EF5A5C;
    }




    .price.panel-red>.panel-body .lead {
        text-shadow: 0px 3px 0px rgba(50, 50, 50, .3);
    }

    .price.panel-red .list-group-item {
        color: #333;
        background-color: rgba(50, 50, 50, .01);
        font-weight: 600;
        text-shadow: 0px 1px 0px rgba(250, 250, 250, .75);
    }

    /* grey price */


    .price.panel-grey>.panel-heading {
        color: #fff;
        background-color: #6D6D6D;
        border-color: #B7B7B7;
        border-bottom: 1px solid #B7B7B7;
    }


    .price.panel-grey>.panel-body {
        color: #fff;
        background-color: #808080;
    }



    .price.panel-grey>.panel-body .lead {
        text-shadow: 0px 3px 0px rgba(50, 50, 50, .3);
    }

    .price.panel-grey .list-group-item {
        color: #333;
        background-color: rgba(50, 50, 50, .01);
        font-weight: 600;
        text-shadow: 0px 1px 0px rgba(250, 250, 250, .75);
    }

    /* white price */
    .flex-parent {
        display: flex;
    }

    .flex-item {
        padding: .5em;
    }

    .price.panel-white>.panel-heading {
        color: #333;
        background-color: #f9f9f9;
        border-color: #ccc;
        border-bottom: 1px solid #ccc;
        text-shadow: 0px 2px 0px rgba(250, 250, 250, .7);
        min-height: 100px;
    }

    .panel.panel-white.price:hover>.panel-heading {
        box-shadow: 0px 0px 30px rgba(0, 0, 0, .05) inset;
    }

    .price.panel-white>.panel-body {
        color: #fff;
        background-color: #dfdfdf;
    }

    .price.panel-white>.panel-body .lead {
        text-shadow: 0px 2px 0px rgba(250, 250, 250, .8);
        color: #666;
    }

    .price:hover.panel-white>.panel-body .lead {
        text-shadow: 0px 2px 0px rgba(250, 250, 250, .9);
        color: #333;
    }

    .price.panel-white .list-group-item {
        color: #333;
        background-color: rgba(50, 50, 50, .01);
        font-weight: 600;
        text-shadow: 0px 1px 0px rgba(250, 250, 250, .75);
    }

    .price.panel-white .list-group-item input,
    .price.panel-white .list-group-item textarea {
        width: 100%;
        border: 1px solid #ddd;
        padding: 5px 10px;
    }

    .desc_li {
        min-height: 300px;
    }

    .nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #ffffff; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none;  color: #5a4080 !important; background: #fff; }
        .nav-tabs > li > a::after { content: "";  height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
    .tab-nav > li > a::after { background: ##5a4080 none repeat scroll 0% 0%; color: #fff; }
    
    .nav-tabs > li  {width:25%; text-align:center;}
    .tab-pane .inner_div{
        background: white;
    }
    .tab-pane img{
        height: 165px;
        width: 90%;
        margin-top: 15px;
    }
    .nav>li>a:focus, .nav>li>a:hover{
        background-color: #fff !important;
    }
</style>
<!-- -->
<section>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="row text-center">
                    <?php if(!empty($main)): ?>
                    <div class="col-md-12">
                        <h4 class="f-36"><?php echo e($main->description); ?></h4>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($sub)): ?>
                    <div class="col-md-12">
                        <h4 class="f-28"><?php echo e($sub->description); ?></h4>
                    </div>
                    <hr style="width:50%">
                    <?php endif; ?>
                    <?php if( isset($user_info->birth_commune) ): ?>
                    <div class="col-md-12">
                        <h4 class="f-28"><?php echo e(showcommuneName($user_info->birth_commune)); ?></h4>
                    </div>
                    <hr style="width:50%">
                    
                    <?php elseif( isset($user_info->birth_state) ): ?>
                    <div class="col-md-12">
                        <h4 class="f-28"><span class="bfh-states" data-country="<?php echo e($user_info->birth_country); ?>" data-state="<?php echo e($user_info->birth_state); ?>"><?php echo e($user_info->birth_state); ?></span></h4>
                    </div>
                    <hr style="width:50%">
                    <?php endif; ?>
               </div>

               <div class="col-md-12"> 
                <!-- Nav tabs -->
                <div class="card">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php if(isset($first_row_name->id)): ?>
                        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><span><?php echo e(($first_row_name->title!='')?$first_row_name->title:'No title'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if(isset($second_row_name->id)): ?>
                        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><span><?php echo e(($second_row_name->title!='')?$second_row_name->title:'No title'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if(isset($third_row_name->id)): ?>
                        <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><span><?php echo e(($third_row_name->title!='')?$third_row_name->title:'No title'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if(isset($fourth_row_name->id)): ?>
                        <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"><span><?php echo e(($fourth_row_name->title!='')?$fourth_row_name->title:'No title'); ?></span></a></li>
                        <?php endif; ?>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php if(isset($first_row_name->id)): ?>
                        <div role="tabpanel" class="tab-pane active" id="tab1">
                            <?php if(count($first_row)>0): ?>
                                <?php $__currentLoopData = $first_row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 margin-bottom-10 text-center">
                                    <div class="inner_div">
                                        <?php if(!empty($item->file_url)): ?>
                                        <img src="<?php echo e(asset($item->file_url)); ?>" class="blah-">
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('images/logo1.jpg')); ?>" alt="" />
                                        <?php endif; ?>
                                    </div>
                                    <!-- PRICE ITEM -->
                                    <div class="panel price panel-white">
                                        <ul class="list-group list-group-flush text-center">

                                            <?php if($item->name!=''): ?>
                                            <li class="list-group-item">
                                                <?php echo e($item->name.' '.$item->last_name); ?>

                                            </li>
                                            <?php endif; ?>
                                            <?php if($item->title!=''): ?>
                                            <li class="list-group-item">
                                                <?php echo e($item->title); ?>

                                            </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <div class="col-md-12 col-lg-12 ">
                                <div class="alert alert-danger text-center" role="alert">
                                    No Records Found
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <?php if(isset($second_row_name->id)): ?>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            <?php if(count($second_row)>0): ?>
                                <?php $__currentLoopData = $second_row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 margin-bottom-10 text-center">
                                    <div class="inner_div">
                                        <?php if(!empty($item->file_url)): ?>
                                        <img src="<?php echo e(asset($item->file_url)); ?>" class="blah-" >
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('images/logo1.jpg')); ?>" alt=""  />
                                        <?php endif; ?>
                                    </div>
                                    <!-- PRICE ITEM -->
                                    <div class="panel price panel-white">
                                        <ul class="list-group list-group-flush text-center">

                                            <?php if($item->name!=''): ?>
                                            <li class="list-group-item">
                                                <?php echo e($item->name.' '.$item->last_name); ?>

                                            </li>
                                            <?php endif; ?>
                                            <?php if($item->title!=''): ?>
                                            <li class="list-group-item">
                                                <?php echo e($item->title); ?>

                                            </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <div class="col-md-12 col-lg-12 ">
                                <div class="alert alert-danger text-center" role="alert">
                                    No Records Found
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($third_row_name->id)): ?>
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            <?php if(count($third_row)>0): ?>
                                <?php $__currentLoopData = $third_row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 margin-bottom-10 text-center">
                                    <div class="inner_div">
                                        <?php if(!empty($item->file_url)): ?>
                                        <img src="<?php echo e(asset($item->file_url)); ?>" class="blah-" >
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('images/logo1.jpg')); ?>" alt=""  />
                                        <?php endif; ?>
                                    </div>
                                    <!-- PRICE ITEM -->
                                    <div class="panel price panel-white">
                                        <ul class="list-group list-group-flush text-center">

                                            <?php if($item->name!=''): ?>
                                            <li class="list-group-item">
                                                <?php echo e($item->name.' '.$item->last_name); ?>

                                            </li>
                                            <?php endif; ?>
                                            <?php if($item->title!=''): ?>
                                            <li class="list-group-item">
                                                <?php echo e($item->title); ?>

                                            </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <div class="col-md-12 col-lg-12 ">
                                <div class="alert alert-danger text-center" role="alert">
                                    No Records Found
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($fourth_row_name->id)): ?>
                        <div role="tabpanel" class="tab-pane" id="tab4">
                            <?php if(count($fourth_row)>0): ?>
                                <?php $__currentLoopData = $fourth_row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 margin-bottom-10 text-center">
                                    <div class="inner_div">
                                        <?php if(!empty($item->file_url)): ?>
                                        <img src="<?php echo e(asset($item->file_url)); ?>" class="blah-" >
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('images/logo1.jpg')); ?>" alt=""  />
                                        <?php endif; ?>
                                    </div>
                                    <!-- PRICE ITEM -->
                                    <div class="panel price panel-white">
                                        <ul class="list-group list-group-flush text-center">

                                            <?php if($item->name!=''): ?>
                                            <li class="list-group-item">
                                                <?php echo e($item->name.' '.$item->last_name); ?>

                                            </li>
                                            <?php endif; ?>
                                            <?php if($item->title!=''): ?>
                                            <li class="list-group-item">
                                                <?php echo e($item->title); ?>

                                            </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <div class="col-md-12 col-lg-12 ">
                                <div class="alert alert-danger text-center" role="alert">
                                    No Records Found
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                </div>
                <!-- First Row -->
                
                <!-- First Row End -->
                <div class="col-md-12">
                    <?php echo $__env->make('center_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

            </div>
        </div>
        </form>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
             $(".group-checkable").change(function() {
                 if ($(this).prop('checked')) {
                     var boxes = $('.checkboxes:not(:checked)');
                     boxes.each(function() {
                         $(this).prop('checked', false);
                         $(this).trigger('click');
                     });
                 } else {
                     $('.checkboxes').prop('checked', true);

                     $('.checkboxes').trigger('click');
                 }
             });

         });
</script>
<script>
    $(document).ready(function() {
            $(".owl-prev").html('<i class="fa fa-chevron-left"></i>');
            $(".owl-next").html('<i class="fa fa-chevron-right"></i>');
        });
        function readURL(input) {
            let dataId = $(input).attr("data-id");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.'+dataId).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imgInp").change(function(){
            readURL(this);
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/leaders_board_details.blade.php ENDPATH**/ ?>