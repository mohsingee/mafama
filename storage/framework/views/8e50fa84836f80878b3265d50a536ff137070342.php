 
<style type="text/css">
    p{
        margin-bottom: 5px !important;
    }
    pre, ul, ol, dl, dd, blockquote, address, table, fieldset, form {
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
                <div class="user_banner"><table cellpadding="0" cellspacing="0" class="style1" style="width: 100%"><tbody><tr><td id="ctl00_ucBanner1_td_banner" style="width: 100%;"><table border="0" cellspacing="0" cellpadding="0" style="width: 100%;"><tbody><tr><td style="vertical-align: top;"><table border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr><td style="text-align: left; vertical-align: top;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td class="Slogan" style="text-align: center; vertical-align: top; height: 30px; padding-bottom: 5px; padding-top: 5px;"><div class="business_name" style="font-weight: bold; font-size: 20px; color: rgb(255, 255, 170);"><?php if($affiliate_banner->business_name != ""){ echo $affiliate_banner->business_name; } else{ echo $affiliate_details->company; ?>  <?php } ?></div></td></tr><tr><td style="text-align: center; vertical-align: top; padding-left: 10px; padding-right: 10px; padding-bottom: 5px; padding-top: 5px;"><div class="description" style="min-height: 30px; padding: 30px 10px;"><?php if($affiliate_banner->message != ""){ echo $affiliate_banner->message; }?></div></td></tr><tr><td class="Heading" style="padding-left: 10px; padding-right: 10px; padding-bottom: 5px; padding-top: 5px;"><div class="phone_no"><?php if($affiliate_banner->phone_no != ""){ ?><b>Phone No: </b> <?= $affiliate_banner->phone_no; ?><?php } else{ ?><b>Phone No: </b> <?= $affiliate_details->business_telephone; ?><?php } ?></div><div class="address"><?php if($affiliate_banner->phone_no != ""){ ?><b>Address: </b> <?= $affiliate_banner->address; ?><?php } else{ ?><b>Address: </b> <?= $affiliate_details->billing_address ?>, <?= $affiliate_details->billing_city ?> <?= $affiliate_details->zip_code; ?><?php } ?></div><div class="web_address"><?php if($affiliate_banner->web_address != ""){ ?><b>Web Address: </b> <?= $affiliate_banner->web_address; ?><?php } ?></div></td></tr></tbody></table></td><td style=""><img id="blahh" src="<?php if($affiliate_banner->img != ""){ ?><?php echo e(asset('public/videos')); ?>/<?= $affiliate_banner->img ?><?php }else{?><?php echo e(asset('public/images/affiliates')); ?>/<?= $affiliate_details->image ?> <?php } ?>"  width="140" height="130" style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>

<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />

<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <?php // include 'setting_header.php'; ?>
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-0 text-center">
                        <h4>Settings / Banner</h4>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-20">
                        <div class="margin-top-10">
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
                                <a href="<?php echo e(url('calender_meeting')); ?>" class="btn btn-md btn-info margin-right-10">My Daily Briefing</a>
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-md btn-info">Back</a>
                            </div>
                    </div>
                    <!--<ul class="nav nav-tabs nav-button-tabs nav-justified  margin-bottom-40">
                                    <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                    <li><a href="#">Client Management</a></li>
                                    <li><a href="#">Email Management</a></li>
                                    <li><a href="#">Financial Management</a></li>
                                    
                                </ul>

                                <div class="tab-content margin-top-10"  style=" border-radius:10px;padding:10px;">-->

                    <form method="POST" id="register" role="form" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-12" style="border: 1px solid #da291c !important; border-radius: 10px; padding-top: 30px; padding-bottom: 20px;">
                            <div class="col-md-12">
                                <h4>Banner styling</h4>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Background color</label>
                                    <input
                                        class="form-control demo-input"
                                        data-huebee='{"hues": 30,
                                                "staticOpen": true }'
                                        value="<?php if($affiliate_banner->background != ''){ echo $affiliate_banner->background; } else{ ?> #F06 <?php } ?>"
                                        style="background-color: rgb(255, 0, 102); color: white;"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Font Text color</label>
                                    <input
                                        class="form-control demo-input1"
                                        data-huebee='{"hues": 30,
                                                "staticOpen": true }'
                                        value="<?php if($affiliate_banner->fontcolor != ''){ echo $affiliate_banner->fontcolor; } else{ ?> #FFA <?php } ?>"
                                        style="background-color: rgb(255, 255, 170); color: white;"
                                    />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12">
                                <h4>Company Info</h4>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Upload your company logo or a photo to go on that banner </label>
                                    <div class="fancy-file-upload fancy-file-info">
                                        <i class="fa fa-upload"></i>
                                        <input type="file" class="form-control" name="img_path" onchange="jQuery(this).next('input').val(this.value);" id="imgInp" />
                                        <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                        <span class="button">Choose File</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="checkbox">
                                    <input class="address-chk" type="checkbox" value="1" <?php if(($affiliate_banner->business_name != '') || ($affiliate_banner->address != '') || ($affiliate_banner->phone_no != '') || ($affiliate_banner->web_address != '')){ ?> checked <?php } ?> />
                                    <i></i> Profile address
                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <!-- <div class="address-div margin-top-20" <?php if(($affiliate_banner->business_name != '') || ($affiliate_banner->address != '') || ($affiliate_banner->phone_no != '') || ($affiliate_banner->web_address != '')){ ?>  <?php } else{ ?> style="display: none;" <?php } ?>> -->
                            <div class="address-div margin-top-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Business Name </label>
                                        <input type="text" class="form-control" id="business_name" name="business_name" value="<?php if($affiliate_banner->business_name != ''){ echo $affiliate_banner->business_name; } else{ echo $affiliate_details->company; ?>  <?php } ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Address </label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php if($affiliate_banner->address != ''){ echo $affiliate_banner->address; } else{ echo $affiliate_details->billing_address ?>, <?= $affiliate_details->billing_city ?> <?php echo $affiliate_details->zip_code; } ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number </label>
                                        <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php if($affiliate_banner->phone_no != ''){ echo $affiliate_banner->phone_no; } else{ echo $affiliate_details->business_telephone; } ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Web Address </label>
                                        <input type="text" class="form-control" id="web_address" name="web_address" value="<?php if($affiliate_banner->web_address != ''){ echo $affiliate_banner->web_address; } else{ ?>  <?php } ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12">
                                <h4>Enter and Format Text</h4>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control summernote" style="height: 70px;"></textarea>
                                    <a id="messagetext" class="btn" style="display: none;"></a>
                                </div>
                            </div>

                            <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                                <a class="btn btn-md btn-info prvbtn" style="width: 100px;">Preview</a>
                                <button type="submit" class="btn btn-md btn-info savebtn" style="width: 100px;">Save</button>
                                
                            </div>
                        </div>
                    </form>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</section>

<div id="modall" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content" style="background: white">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div  id= "modal-body"></div>
            </div>
        </div>
    </div>
</div>
<!-- / -->
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script>
// (function($) {
// $(document).ready( function() {
    
//     setTimeout(function() {
//         alert("hi");
//     },1000);
// });
// })(jQuery);
// $(document).ready(function(){
  // $(document).on("keyup", ".huebee__cursor", function(){
  //   alert("This input field has lost its focus.");
  // });
// });
$(document).ready(function(){
    <?php
        if($affiliate_banner->message != ""){
    ?>
        setTimeout(function() {
            $("#messagetext").trigger('click'); 
        },1000); 
        $("#messagetext").click(function(){
            text = '<?php echo $affiliate_banner->message ?>';
            $(".summernote").code(text);
            // $(".summernote").summernote("code", text);
        });
    <?php
        }
    ?>
    $('.demo-input').each( function( i, elem ) {
        var hueb = new Huebee( elem, {
                  
        });
        // alert(hueb);
        // hueb.on( 'change', function() {
        //     alert("hi");
        // })
    });

    $('.address-chk').change(function(){
      if($(this).prop("checked")) {
        $('.address-div').show();
      } else {
        $('.address-div').hide();
      }
    });
    $('#business_name').on('input',function(){
        var x = $(this).val();
      $(".business_name").html(x);
    });
    $('#address').on('input',function(){
       var x = $(this).val();
      $(".address").html("<div><b>Address: </b>"+x+"</div>");
    });
    $('#phone_no').on('input',function(){
       var x = $(this).val();
      $(".phone_no").html("<div><b>Phone No: </b>"+x+"</div>");
    });
    $('#web_address').on('input',function(){
       var x = $(this).val();
      $(".web_address").html("<div><b>web_address: </b>"+x+"</div>");
    });
    $(".prvbtn").click(function(){
        var business_name = $("#business_name").val();
        var address = $("#address").val();
        var phone_no = $("#phone_no").val();
        var web_address = $("#web_address").val();
        var background      = rgb2hex($(".demo-input").css("background-color"));
        var message         = $(".summernote").code();
        var fontcolor       = rgb2hex($(".demo-input1").css("background-color"));
        $(".business_name").html(business_name);
        $(".address").html("<div><b>Address: </b>"+address+"</div>");
        $(".phone_no").html("<div><b>Phone No: </b>"+phone_no+"</div>");
        $(".web_address").html("<div><b>web_address: </b>"+web_address+"</div>");
        $(".user_banner").css("background-color", background);
        $(".user_banner").css("color", fontcolor);
        $(".user_banner").css("padding", "15px");
        $(".description").html(message);
        // $(".description").css("border","1px solid "+fontcolor);
        // $(".description").css("border-radius","4px");
        $(".description").css("padding","30px 10px");
        var preview = $(".appndbanner").html();
        $("#modall #modal-body").html(preview);   
        $('#modall').modal('show');
    });
    $("#register").submit(function(e) {
            //---------------^---------------
        e.preventDefault();
        var formData = new FormData(this);
        var img = "";
        $.ajax({
            type: "POST",
            beforeSend: function(){
                $("#loading").show();
                $("#wrapper").hide();
            },
            url: "image_up_banner",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (response) {
                // alert(response);
                img = response;
            },
            complete: function(){
                $("#loading").hide();
                $("#wrapper").show();
            }
        })
        .then( function( data ) {
            var business_name = $("#business_name").val();
            var address = $("#address").val();
            var phone_no = $("#phone_no").val();
            var web_address = $("#web_address").val();
            var base_url = <?php echo json_encode(url('/')); ?>;
            if(img != ""){
                $("#blahh").attr('src', base_url+"/public/videos/"+img);
                // $("#blah").html('<img src="'+base_url+'/public/videos/'+img+'>');
            }
            var background      = rgb2hex($(".demo-input").css("background-color"));
            var message         = $(".summernote").code();
            var fontcolor       = rgb2hex($(".demo-input1").css("background-color"));
            var bgcolor = $(".demo-input").val();
            var fncolor = $(".demo-input1").val();
            // $(".business_name").html(business_name);
            // $(".address").html("<div><b>Address: </b>"+address+"</div>");
            // $(".phone_no").html("<div><b>Phone No: </b>"+phone_no+"</div>");
            // $(".web_address").html("<div><b>web_address: </b>"+web_address+"</div>");
            // $(".user_banner").css("background-color", background);
            // $(".user_banner").css("color", fontcolor);
            // $(".user_banner").css("padding", "15px");
            // $(".description").html(message);
            // $(".description").css("border","1px solid "+fontcolor);
            // $(".description").css("border-radius","4px");
            // $(".description").css("padding","30px 10px");
            var preview = $(".appndbanner").html();
            $.ajax({
                url: 'banner_submit',
                data: 'preview=' + preview + '&background=' + bgcolor + '&message=' + message + '&fontcolor=' + fncolor + '&img=' + img + '&business_name=' + business_name + '&address=' + address + '&phone_no=' + phone_no + '&web_address=' + web_address + '&_token=<?php echo e(csrf_token()); ?>',
                type: "POST",
                success: function (response) {
                    location.reload();
                    alert("Banner Saved Succesfully.");
                    // $("#imgInp").val("");
                    // $("input[type=file]").val("");
                    // $('#business_name').val("");
                    // $('#address').val("");
                    // $('#phone_no').val("");
                    // $('#web_address').val("");
                    // $('.address-chk').prop('checked', false);
                }
            }) 
        }); 
    });
});
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blahh').attr('src', e.target.result);
      // $("#blah").html('<img src="'+e.target.result+'>');
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

    function showColor(){
        var back_color = rgb2hex($(".demo-input").css("background-color"));
        // var back_color = "#fae3e2";
        var font_color = rgb2hex($(".demo-input1").css("background-color"));
        $(".user_banner").css("background-color", ""+back_color+"");
        $(".user_banner").css("color", font_color);
        $(".business_name").css("color", font_color);
        $(".phone_no").css("color", font_color);
        $(".address").css("color", font_color);
        $(".web_address").css("color", font_color);
        // var business_name = $("#business_name").val();
        // var phone_no = $("#phone_no").val();
        // var address = $("#address").val();
        // var web_address = $("#web_address").val();
        // var htm = '<div class="user_banner" style="background-color:'+back_color+' !important; fontcolor:'+font_color+' !important"><table cellpadding="0" cellspacing="0" class="style1" style="width: 100%"><tbody><tr><td id="ctl00_ucBanner1_td_banner" style="width: 100%;"><table border="0" cellspacing="0" cellpadding="0" style="width: 100%;"><tbody><tr><td style="vertical-align: top;"><table border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr><td style="text-align: left; vertical-align: top;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td class="Slogan" style="text-align: center; vertical-align: top; height: 30px; padding-bottom: 5px; padding-top: 5px;"><div class="business_name" style="font-weight: bold; font-size: 20px; color: '+font_color+' !important"><?php if($affiliate_banner->business_name != ""){ echo $affiliate_banner->business_name; } else{ echo $affiliate_details->company; ?>  <?php } ?></div></td></tr><tr><td style="text-align: center; vertical-align: top; padding-left: 10px; padding-right: 10px; padding-bottom: 5px; padding-top: 5px;"><div class="description" style="min-height: 30px; padding: 30px 10px;"><?php if($affiliate_banner->message != ""){ echo $affiliate_banner->message; }?></div></td></tr><tr><td class="Heading" style="padding-left: 10px; padding-right: 10px; padding-bottom: 5px; padding-top: 5px;"><div class="phone_no" style="color:'+font_color+' !important; text-align: center"><?php if($affiliate_banner->phone_no != ""){ ?><b style="color:'+font_color+' !important;">Phone No: </b> <?= $affiliate_banner->phone_no; ?><?php } else{ ?><b style="color:'+font_color+' !important;">Phone No: </b> <?= $affiliate_details->business_telephone; ?><?php } ?></div><div class="address" style="color:'+font_color+' !important; text-align: center"><?php if($affiliate_banner->phone_no != ""){ ?><b style="color:'+font_color+' !important;">Address: </b> <?= $affiliate_banner->address; ?><?php } else{ ?><b style="color:'+font_color+' !important;">Address: </b> <?= $affiliate_details->billing_address ?>, <?= $affiliate_details->billing_city ?> <?= $affiliate_details->zip_code; ?><?php } ?></div><div class="web_address" style="color:'+font_color+' !important; text-align: center"><?php if($affiliate_banner->web_address != ""){ ?><b style="color:'+font_color+' !important;">Web Address: </b> <?= $affiliate_banner->web_address; ?><?php } ?></div></td></tr></tbody></table></td><td style=""><img id="blahh" src="<?php if($affiliate_banner->img != ""){ ?><?php echo e(asset("public/videos")); ?>/<?= $affiliate_banner->img ?><?php }else{?><?php echo e(asset("public/images/affiliates")); ?>/<?= $affiliate_details->image ?> <?php } ?>"  width="140" height="130" style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>';
        // $(".appndbanner").html(htm);
        $(".description").html($(".summernote").code());
    }
    $(document).ready(function(){
        setInterval("showColor()", 1000);
        // $(".demo-input").bind("style", function() {
        //     alert($(this).css("background-color"));
        // });
        // $(".demo-input").on("change paste keyup", function() {
        //    alert($(this).val()); 
        // });
        // $('.note-editable').bind('contentchanged', function() {
        //   // do something after the div content has changed
        //   alert('woo');

    });
    
    $(document).on('keypress', '.note-editable', function() {
          // do something after the div content has changed
          // console.log($(this).code());
          $(".description").html($(this).code());
    });
    var hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 
    function rgb2hex(rgb) {
     rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
     return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }

    function hex(x) {
      return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
     }
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/banner.blade.php ENDPATH**/ ?>