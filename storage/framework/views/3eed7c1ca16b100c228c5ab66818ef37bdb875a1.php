
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>MAFAMA.COM</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style type="text/css" media="screen">
  body{
    background-color: #F1F4F8;
  }
  #oneTimeOffer{
    background-color: #da291c;
    color: #fff;
    padding: 1%;
  }
  #oneTimeOffer h1{
    font-size: 22px !important;
    text-align: center;
    margin-top: 0px;
  }
  .shadow1 {
  margin: 40px;
  padding: 5%;
 box-shadow:1px 1px 1px 1px hsl(0deg 0% 0% / 0.075),
      1px 2px 2px 1px hsl(0deg 0% 0% / 0.075),
      1px 4px 4px 1px hsl(0deg 0% 0% / 0.075),
      1px 8px 8px 1px hsl(0deg 0% 0% / 0.075),
      1px 16px 16px 1px hsl(0deg 0% 0% / 0.075)
    ;
}
.shadow1 .content {
  position: relative; /* This protects the inner element from being blurred */
  height: 500px;
  background-color: #fff;
}
.shadow1 h3{
  font-size: 42px;
  font-weight: 700;
}
.shadow1 p{
  font-size: 28px;
    font-weight: 700;
    text-align: center;
    margin: 0 auto;
    font-style: italic;
    line-height: 42px;
  
  
}
.disclamer{
  padding: 3%;
  text-align: justify;
}

#timer #hours,#minutes,#seconds{
  font-weight: 900;
    font-size: 30px;
}
.watch p{
  font-size: 18px;
    font-style: italic;
    padding-top: 10px;
  
}
#hours span{
  font-size: 16px;
  font-weight: 0 !important;
  font-family: "Roboto",Helvetica,sans-serif;
}
#minutes span{
font-size: 16px;
  font-weight: 0 !important;
  font-family: "Roboto",Helvetica,sans-serif;}
#seconds span{
font-size: 16px;
  font-weight: 0 !important;
  font-family: "Roboto",Helvetica,sans-serif;}



  .button-wrap.mt {
    margin-top: 20px;
}
.button-wrap {
    display: flex;
    flex: auto;
    flex-direction: column;
    align-self: center;
    justify-content: center;
    border-bottom: 1px solid #eeeeee;
    margin: 0 auto;
    padding-bottom: 50px;
    width: 100%;
}
.btn-green,.btn-green:hover {
    max-height: 120px;
    color: #fff;
    background: #da291c;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
    border: 1px solid rgba(0,0,0,0.2);
    border-radius: 3px;
    display: flex;
    flex-direction: column;
    align-items: center;
    /* flex: 1 1 100%; */
    flex: auto;
    max-width: 100%;
    margin: 0 auto;
    padding: 13px 50px;
}
.btn-green .top {
    font-weight: 700;
    line-height: 30px;
    font-size: 24px;
}
.btn-green .bottom {
    line-height: 20px;
    font-size: 18px;
    font-weight: normal;
    opacity: 0.7;
}


.btn-pink,.btn-pink:hover {
    max-height: 120px;
    color: #fff;
    background: #068306;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
    border: 1px solid rgba(0,0,0,0.2);
    border-radius: 3px;
    display: flex;
    flex-direction: column;
    align-items: center;
    /* flex: 1 1 100%; */
    flex: auto;
    max-width: 100%;
    margin: 0 auto;
    padding: 13px 50px;
}
.btn-pink .top {
    font-weight: 700;
    line-height: 38px;
    font-size: 28px;
}
.btn-pink .bottom {
    line-height: 20px;
    font-size: 18px;
    font-weight: normal;
    opacity: 0.7;
}

</style>
</head>

<body>
  <div id="oneTimeOffer" >
  <h1>
    <?php echo e($video->top_heading); ?>

  </h1>
</div>
<div class="container">

  <div class="row">
    <div class="col-sm-12">
       <div class="shadow1">
<div class="row">
    <h3 class="text-center"> <?php echo e($video->heading); ?></h3>
<p> <?php echo e($video->sub_heading); ?></p>
  </div>
   <div class="row ">
   <div id="timer" class=" col-md-offset-4">
    <!-- <div id="hours" class="col-sm-2"></div> -->
    <div id="minutes" class="col-sm-3"></div>
    <div id="seconds" class="col-sm-3"></div>
  </div>
</div>
  <div class="row button-wrap mt">

        <a href="<?php echo e($video->register_link); ?>" class="btn-green elButton" id="on-pageload" data-micromodal-trigger="checkout"   >
          <span class="top"><i class="fas fa-angle-double-right"></i> <?php echo e($video->link_text); ?> <i class="fas fa-angle-double-left"></i></span>

        </a>
  </div>
    <div class="content">
      <iframe class=" lazyloaded" src="<?php echo asset("public/videos/intro") ?>/<?= $video->video ?>" data-src="<?php echo asset("public/videos/intro") ?>/<?= $video->video ?>" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" width="100%" height="478">
      </iframe>
    </div>
    <div class="row watch">
      <p> <?php echo e($video->title); ?></p>
    </div>

     <div class="row button-wrap mt">

        <a href="<?php echo e(!empty($link)?url('affiliate_registration/'.$link):$video->register_link); ?>" class="btn-pink elButton" id="on-pageload" data-micromodal-trigger="checkout"   >
          <span class="top"><i class="fas fa-angle-double-right"></i> <?php echo e($video->title_bar); ?> <i class="fas fa-angle-double-left"></i></span>

        </a>
  </div>


</div>

 <div class="row disclamer">
  <div class="col-sm-12">
    <?php echo $video->page_content; ?>


  </div>
  </div>
   <div class="row disclamer">
  <div class="col-sm-12">
   	<br>
<?php if(!empty($video->bottom_banner)): ?>   	
<img src="<?php echo asset("public/videos/intro") ?>/<?= $video->bottom_banner ?>" class="img-responsive">
<?php endif; ?>
  </div>
  </div>
  
</div>
</div>
 
</div>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">


var timer2 = "<?php echo e($video->clock_duration); ?>";
var interval = setInterval(function() {


  var timer = timer2.split(':');
  //by parsing integer, I avoid all extra string processing
  var minutes = parseInt(timer[0], 10);
  var seconds = parseInt(timer[1], 10);
  --seconds;
  minutes = (seconds < 0) ? --minutes : minutes;
  if (minutes < 0) clearInterval(interval);
  seconds = (seconds < 0) ? 59 : seconds;
  seconds = (seconds < 10) ? '0' + seconds : seconds;
  //minutes = (minutes < 10) ?  minutes : minutes;
 // $('.countdown').html(minutes + ':' + seconds);
 $("#minutes").html(minutes + "<br><span>Minutes</span>");
  $("#seconds").html(seconds + "<br><span>Seconds</span>");
  timer2 = minutes + ':' + seconds;
}, 1000);
</script>
</body>
</html>


<?php /**PATH /home/mafamatest/public_html/resources/views/landingpage.blade.php ENDPATH**/ ?>