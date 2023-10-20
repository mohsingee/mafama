
<?php $__env->startSection("content"); ?>
<?php use Carbon\Carbon; ?>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/solid.min.css" integrity="sha512-xIEmv/u9DeZZRfvRS06QVP2C97Hs5i0ePXDooLa5ZPla3jOgPT/w6CzoSMPuRiumP7A/xhnUBxRmgWWwU26ZeQ==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/solid.min.js" integrity="sha512-tmaD3q45JFEAXSixAxEo5p9K8ocD26I5zy42OQ5p7ZwnIx/JaGicXVHNawlZiZTHAU7jBNTl5XyZ8IcGwPG7gQ==" crossorigin="anonymous"></script>
<link href="<?php echo e(asset('public/assets/css/material-dashboard.css?v=2.1.2')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('public/assets/demo/demo.css')); ?>" rel="stylesheet" />
<!-- <link href="<?php echo e(asset('public/assets/demo/demo.css')); ?>" rel="stylesheet" /> -->
<style type="text/css">
  #topNav #topMain>li.mega-menu div.row div {
      float: left;
  }
   .card-stats .card-header.card-header-icon .appointmenttt .card-title {

    font-size: 16px;
    font-weight: 400;
    color: purple;
}
.card [class*="card-header-"] .card-icon,  {
    padding: 10px!important;

}
.card-stats .card-header .card-category:not([class*="text-"]) {
    color: purple!important;
    font-size: 14px!important;
    font-weight: 700!important;
}
.margin-bottom-none .card {
    margin-bottom: 4px!important;
}
.col-md-9.padding-o {
    padding-left: 0;
    padding-right: 0pc;
}
.col-md-9.padding-o .content {
    padding-left: 0px;
    padding-right: 0px;
}
.col-md-9.padding-o .container-fluid {
    padding-left: 0px;
    padding-right: 2px;
}

table#datatable_sample3 thead td {
    padding-top: 8px;
    padding-bottom: 8px;
    font-size: 18px;
}
table#datatable_sample3 thead th {
    font-size: 20px;
}
.text-purple {
    color:purple!important;
    font-weight: 900;

}
.text-green {
    color: green !important;
    font-weight: 900;

}
.text-blue {
    color:blue !important;
    font-weight: 900;

}
.text-red {
    color: red !important;
    font-weight: 900;
}
.bg-purple {
    background-color: purple!important;
}

.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    padding: 6px 8px;
    vertical-align: middle;
    border-color: #ddd;
    font-size: 20px;

}

.row.qualification_data {
    padding-left: 16px;
    padding-right: 16px;
}
.card.card-stats.bg-info {
    background: #9c27b0!important;
    color: #fff!important;
}
.card.weather22 {
    height: 89px;
    margin-top: 9px;
    background: linear-gradient(337deg, #0010d4fa, #9c27b082);
}
.card.weather {
    height: 89px;
    margin-top: 9px;
    background: #06b0c5;
}
.card-body.weather-1 {
    padding: 4px;
}

.wea-table{
width: 100%;
color: #fff;
}
.wea-table tr td{
    text-align: left;
}ul.we-li {
    list-style: none;
    color: #fff;
    line-height: 22px;
    font-size: 12px;
    margin-left: -40px;
}
label.temp {
    font-size: 20px;
    font-weight: 900;
    margin-left: 16px;
    color: #fff;
}
label.wea-text {
    color: #fff;
    font-size: 12px;
    margin-top: 3px;
}
.banner-text-box h1, h2, h3, h4, h5 {
    color: #da291c!important;
    }
    h4 {
    font-size: 24px;
    letter-spacing: normal;
    margin: 0 0 14px 0;
    font-weight:900;
}
tr.bg-green1.border-bottom-tr {
    border: 2px solid red;
}

.text-light-gray,.text-light-red,.text-gray{
    color:#1212cbc4!important;
}
input.frm {
    font-size: 20px;
    padding-left: 6px;
    color: red;
}
.textbold{
    font-weight:900;
    font-size: 20px;

}
.textp{
    font-size: 16px;
   color:#1212cbc4!important;
}

#calc1 {
    /* text-decoration: underline; */
    padding: 3px 8px  7px 11px;
    border: 2px solid red;
}
#spon1,#spon2,#leadsc1,#calc1 {
    color: red!important;
}
</style>


<div class="row" style="margin: 20px 0;">
   <div class="col-md-12 padding-o">
      <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Projected Commission Calculator</h4>
         </div>
      <div class="content">
         <div class="container-fluid">
         <div class="row gy-4" style="padding-bottom:20px;">
        <div class="col-md-4">
            <input type="hidden" id="n1" value="">
            <input type="hidden" id="n2" value="">
            <input type="hidden" id="n3" value="">
            <input type="hidden" id="n4" value="">
            <input type="hidden" id="n5" value="">
            <input type="hidden" id="n6" value="">
            <input type="hidden" id="n7" value="">

            <input type="hidden" id="cn1" value="">
            <input type="hidden" id="cn2" value="">
            <input type="hidden" id="cn3" value="">
            <input type="hidden" id="cn4" value="">
            <input type="hidden" id="cn5" value="">
            <input type="hidden" id="cn6" value="">
            <input type="hidden" id="cn7" value="">

            <input type="hidden" id="btc1" value="">
            <input type="hidden" id="btc2" value="">
            <input type="hidden" id="btc3" value="">
            <input type="hidden" id="btc4" value="">
            <input type="hidden" id="btc5" value="">
            <input type="hidden" id="btc6" value="">
            <input type="hidden" id="btc7" value="">

            <input type="hidden" id="ct1" value="">
            <input type="hidden" id="ct2" value="">
            <input type="hidden" id="ct3" value="">
            <input type="hidden" id="ct4" value="">
            <input type="hidden" id="ct5" value="">
            <input type="hidden" id="ct6" value="">
            <input type="hidden" id="ct7" value="">


            <!--<input type="hidden" id="epu1" value="<?php echo e(round($share_price,2)); ?>">-->
            <!--<input type="hidden" id="epu2" value="<?php echo e(round($share_price/2,2)); ?>">-->
            <!--<input type="hidden" id="epu3" value="<?php echo e(round($share_price/3,2)); ?>">-->
            <!--<input type="hidden" id="epu4" value="<?php echo e(round($share_price/4,2)); ?>">-->
            <!--<input type="hidden" id="epu5" value="<?php echo e(round($share_price/5,2)); ?>">-->
            <!--<input type="hidden" id="epu6" value="<?php echo e(round($share_price/6,2)); ?>">-->
            <!--<input type="hidden" id="epu7" value="<?php echo e(round($share_price/7,2)); ?>">-->
            
            <input type="hidden" id="epu1" value="<?php echo e(round($share_price,2)); ?>">
            <input type="hidden" id="epu2" value="<?php echo e(round($share_price,2)); ?>">
            <input type="hidden" id="epu3" value="<?php echo e(round($share_price/2,2)); ?>">
            <input type="hidden" id="epu4" value="<?php echo e(round($share_price/3,2)); ?>">
            <input type="hidden" id="epu5" value="<?php echo e(round($share_price/4,2)); ?>">
            <input type="hidden" id="epu6" value="<?php echo e(round($share_price/5,2)); ?>">
            <input type="hidden" id="epu7" value="<?php echo e(round($share_price/6,2)); ?>">
            <div class="form-group">
                <label class="form-label text-gray">Enter below, the number of members you’ ll sponsor. (Ex. 2,3 or 4)</label>
                <input type="text" class="form-control frm" onkeyup="calc()" value="2" name="sponsoredc"autocomplete="off" >
                <br>
                <p class=" text-gray">1) If the number of  Affiliates you bring is <b id="spon1" class="textbold">0.00</b></p>
             <p class=" text-gray">2) Each one of them brings also <b id="spon2" class="textbold">0.00</b></p>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label text-gray">Enter the number of free leads each member will receive from Mafama.com, Inc. (Ex. 2,3 or 4)</label>
                <input type="text" class="form-control frm" onkeyup="calc()"  value="3" name="leadsc"autocomplete="off" >
                <br>
                 <p class=" text-gray" >3)Free Leads you receive from Mafama.com, Inc</p>
             <p class=" text-gray" >who become paid members is <b id="leadsc1" class="textbold" >0.00</b></p>


            </div>

        </div>
         <div class="col-md-4">

           <p class="textp"> then your projected commission for that month  </p>
           <p  class=" text-gray" > will be: <b id="calc1" class="textbold"></b></p>

         </div>
        </div>
            <div class="row ">

               <table class="table table-striped table-bordered table-hover" id="datatable_sample3">
                  <thead>
                     <tr>
                        <th>Level</th>
                        <th>Your Network</th>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                         <th>Earning per Unit</th>
                         <?php endif; ?>
                        <?php endif; ?>
                        <th>Commission on <br>Direct Network </th>
                        <th>Commission on <br> Free Leads</th>
                        <th>Total Commission <br> for the Month</th>
                     </tr>
                  </thead>
                  <tbody>

                     <tr class="bg-blue1" style="display:none">
                        <td class="text-gray">-</td>
                        <td class="text-gray n1">Your Affiliate Id</td>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                        <td class="text-gray epu1"><?php echo e(round($share_price,2)); ?></td>
                         <?php endif; ?>
                        <?php endif; ?>
                        <td class="text-gray cn1" >-</td>
                        <td class="text-light-gray btc1">-</td>
                        <td class="text-light-red ct1">-</td>

                     </tr>

                     <tr>
                        <td class="text-gray">LV-1</td>
                        <td class="text-gray n2">0</td>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                        <td class="text-gray epu2"><?php echo e(round($share_price/2,2)); ?></td>
                         <?php endif; ?>
                        <?php endif; ?>
                        <td class="text-gray cn2">0.00</td>
                        <td class="text-light-gray btc2">0.00</td>
                        <td class="text-light-red ct2">0.00</td>

                     </tr>
                     <tr>
                        <td class="text-gray">LV-2</td>
                        <td class="text-gray n3">0</td>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                        <td class="text-gray epu3"><?php echo e(round($share_price/3,2)); ?></td>
                         <?php endif; ?>
                        <?php endif; ?>
                        <td class="text-gray cn3">0.00</td>
                        <td class="text-light-gray btc3">0.00</td>
                        <td class="text-light-red ct3">0.00</td>
                     </tr>
                     <tr>
                        <td class="text-gray">LV-3</td>
                        <td class="text-gray n4">0</td>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                        <td class="text-gray epu4"><?php echo e(round($share_price/4,2)); ?></td>
                         <?php endif; ?>
                        <?php endif; ?>
                        <td class="text-gray cn4">0.00</td>
                        <td class="text-light-gray btc4">0.00</td>
                        <td class="text-light-red ct4">0.00</td>

                     </tr>
                     <tr>
                        <td class="text-gray">LV-4</td>
                        <td class="text-gray n5">0</td>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                        <td class="text-gray epu5"><?php echo e(round($share_price/5,2)); ?></td>
                         <?php endif; ?>
                        <?php endif; ?>
                        <td class="text-gray cn5">0.00</td>
                        <td class="text-light-gray btc5">0.00</td>
                        <td class="text-light-red ct5">0.00</td>
                     </tr>
                      <tr>
                        <td class="text-gray">LV-5</td>
                        <td class="text-gray n6">0</td>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                        <td class="text-gray epu6"><?php echo e(round($share_price/6,2)); ?></td>
                         <?php endif; ?>
                        <?php endif; ?>
                        <td class="text-gray cn6">0.00</td>
                        <td class="text-light-gray btc6">0.00</td>
                        <td class="text-light-red ct6">0.00</td>

                     </tr>
                     <tr>
                        <td class="text-gray">LV-6</td>
                        <td class="text-gray n7">0</td>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                        <td class="text-gray epu7"><?php echo e(round($share_price/7,2)); ?></td>
                         <?php endif; ?>
                        <?php endif; ?>
                        <td class="text-gray cn7">0.00</td>
                        <td class="text-light-gray btc7">0.00</td>
                        <td class="text-light-red ct7">0.00</td>

                     </tr>


                     <tr class="bg-green1 border-bottom-tr">
                        <td class="text-red ">Total</td>
                        <td class="text-red ntotal">0</td>
                        <?php if(auth::check()): ?>
                        <?php if(Auth::user()->role == "admin"): ?>
                        <td class="text-red eputotal">0.00</td>
                         <?php endif; ?>
                        <?php endif; ?>
                        <td class="text-red cntotal">0.00</td>
                        <td class="text-red btctotal">0.00</td>
                        <td class="text-red cttotal">0.00</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    calc();

function calc(){
  var sponsor = $("input[name='sponsoredc']").val() ? parseFloat($("input[name='sponsoredc']").val()) : 0;
  var leadsc = $("input[name='leadsc']").val() ? parseFloat($("input[name='leadsc']").val()) : 0;
        $("#spon1").text(sponsor);
        $("#spon2").text(sponsor);
        $("#leadsc1").text(leadsc);
  var n1 = 1;//$(".n1").val() ? parseFloat($(".n1").val()) : 0;
         //  $(".n1").text(price_format1(n1));
           $("#n1").val(n1);
           $(".n2").text(price_format1(sponsor*n1));
           $("#n2").val(sponsor*n1);
  var n2 = $("#n2").val() ? parseFloat($("#n2").val()) : 0;
           $(".n3").text(price_format1(sponsor*n2));
           $("#n3").val(sponsor*n2);
  var n3 = $("#n3").val() ? parseFloat($("#n3").val()) : 0;
           $(".n4").text(price_format1(sponsor*n3));
           $("#n4").val(sponsor*n3);
  var n4 = $("#n4").val() ? parseFloat($("#n4").val()) : 0;
           $(".n5").text(price_format1(sponsor*n4)) ;
           $("#n5").val(sponsor*n4) ;
  var n5 = $("#n5").val() ? parseFloat($("#n5").val()) : 0;
           $(".n6").text(price_format1(sponsor*n5));
           $("#n6").val(sponsor*n5);
  var n6 = $("#n6").val() ? parseFloat($("#n6").val()) : 0;
           $(".n7").text(price_format1(sponsor*n6));
           $("#n7").val(sponsor*n6);
  var n7 = $("#n7").val() ? parseFloat($("#n7").val()) : 0;

  var sum1=n1+n2+n3+n4+n5+n6+n7;
  var ntotal = $(".ntotal").text(price_format1(sum1));


  var epu1 = $("#epu1").val() ? parseFloat($("#epu1").val()) : 0;
  var epu2 = $("#epu2").val() ? parseFloat($("#epu2").val()) : 0;
  var epu3 = $("#epu3").val() ? parseFloat($("#epu3").val()) : 0;
  var epu4 = $("#epu4").val() ? parseFloat($("#epu4").val()) : 0;
  var epu5 = $("#epu5").val() ? parseFloat($("#epu5").val()) : 0;
  var epu6 = $("#epu6").val() ? parseFloat($("#epu6").val()) : 0;
  var epu7 = $("#epu7").val() ? parseFloat($("#epu7").val()) : 0;

  var epusum=epu1+epu2+epu3+epu4+epu5+epu6+epu7;
  var eputotal= $(".eputotal").text(price_format(epusum));
           // $(".cn1").text(price_format(n1*epu1));
           
            $(".cn2").text(price_format(n2*epu2));
            $(".cn3").text(price_format(n3*epu3));
            $(".cn4").text(price_format(n4*epu4));
            $(".cn5").text(price_format(n5*epu5));
            $(".cn6").text(price_format(n6*epu6));
            $(".cn7").text(price_format(n7*epu7));

            $("#cn1").val(n1*epu1);
            $("#cn2").val(n2*epu2);
            $("#cn3").val(n3*epu3);
            $("#cn4").val(n4*epu4);
            $("#cn5").val(n5*epu5);
            $("#cn6").val(n6*epu6);
            $("#cn7").val(n7*epu7);
  var cn1 = $("#cn1").val() ? parseFloat($("#cn1").val()) : 0;
  var cn2 = $("#cn2").val() ? parseFloat($("#cn2").val()) : 0;
  var cn3 = $("#cn3").val() ? parseFloat($("#cn3").val()) : 0;
  var cn4 = $("#cn4").val() ? parseFloat($("#cn4").val()) : 0;
  var cn5 = $("#cn5").val() ? parseFloat($("#cn5").val()) : 0;
  var cn6 = $("#cn6").val() ? parseFloat($("#cn6").val()) : 0;
  var cn7 = $("#cn7").val() ? parseFloat($("#cn7").val()) : 0;

  var cntsum=cn1+cn2+cn3+cn4+cn5+cn6+cn7;
  var cntotal = $(".cntotal").text('$'+price_format(cntsum));

           // $(".btc1").text(price_format(n1*leadsc*epu1));
            $(".btc2").text(price_format(n2*leadsc*epu2));
            $(".btc3").text(price_format(n3*leadsc*epu3));
            $(".btc4").text(price_format(n4*leadsc*epu4));
            $(".btc5").text(price_format(n5*leadsc*epu5));
            $(".btc6").text(price_format(n6*leadsc*epu6));
            $(".btc7").text(price_format(n7*leadsc*epu7));

            $("#btc1").val(n1*leadsc*epu1);
            $("#btc2").val(n2*leadsc*epu2);
            $("#btc3").val(n3*leadsc*epu3);
            $("#btc4").val(n4*leadsc*epu4);
            $("#btc5").val(n5*leadsc*epu5);
            $("#btc6").val(n6*leadsc*epu6);
            $("#btc7").val(n6*leadsc*epu7);

  var btc1 = $("#btc1").val() ? parseFloat($("#btc1").val()) : 0;
  var btc2 = $("#btc2").val() ? parseFloat($("#btc2").val()) : 0;
  var btc3 = $("#btc3").val() ? parseFloat($("#btc3").val()) : 0;
  var btc4 = $("#btc4").val() ? parseFloat($("#btc4").val()) : 0;
  var btc5 = $("#btc5").val() ? parseFloat($("#btc5").val()) : 0;
  var btc6 = $("#btc6").val() ? parseFloat($("#btc6").val()) : 0;
  var btc7 = $("#btc7").val() ? parseFloat($("#btc7").val()) : 0;

  var btcsum=btc1+btc2+btc3+btc4+btc5+btc6+btc7;
  var btctotal = $(".btctotal").text('$'+price_format(btcsum));

           // $(".ct1").text(price_format(cn1+btc1));
            $(".ct2").text(price_format(cn2+btc2));
            $(".ct3").text(price_format(cn3+btc3));
            $(".ct4").text(price_format(cn4+btc4));
            $(".ct5").text(price_format(cn5+btc5));
            $(".ct6").text(price_format(cn6+btc6));
            $(".ct7").text(price_format(cn7+btc7));

            $("#ct1").val(cn1+btc1);
            $("#ct2").val(cn2+btc2);
            $("#ct3").val(cn3+btc3);
            $("#ct4").val(cn4+btc4);
            $("#ct5").val(cn5+btc5);
            $("#ct6").val(cn6+btc6);
            $("#ct7").val(cn7+btc7);

  var ct1 = $("#ct1").val() ? parseFloat($("#ct1").val()) : 0;
  var ct2 = $("#ct2").val() ? parseFloat($("#ct2").val()) : 0;
  var ct3 = $("#ct3").val() ? parseFloat($("#ct3").val()) : 0;
  var ct4 = $("#ct4").val() ? parseFloat($("#ct4").val()) : 0;
  var ct5 = $("#ct5").val() ? parseFloat($("#ct5").val()) : 0;
  var ct6 = $("#ct6").val() ? parseFloat($("#ct6").val()) : 0;
  var ct7 = $("#ct7").val() ? parseFloat($("#ct7").val()) : 0;

    var ctsum=ct1+ct2+ct3+ct4+ct5+ct6+ct7;
  var cttotal = $(".cttotal").text('$'+price_format(ctsum));
  $("#calc1").text('$'+price_format(ctsum));

}


function price_format1(nStr)
{
  const options = {
  minimumFractionDigits: 0,
  maximumFractionDigits: 0
  };

  const formatted = Number(nStr).toLocaleString('en', options);
  console.log(formatted);

    return  formatted;
}

function price_format(nStr)
{
  const options = {
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
  };

  const formatted = Number(nStr).toLocaleString('en', options);
  console.log(formatted);

    return  formatted;
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mafamatest/public_html/resources/views/main/calculator.blade.php ENDPATH**/ ?>