@extends('layouts.main') 
@section('content')
@php
   $setting=\App\Setting::general_setting();
   $share_for_step1=$setting->shareable_fields_one;
   $share_for_step2=$setting->shareable_fields_two;
@endphp 
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
                                <a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
                            </div>
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Complete Registration</h4>
                            </div>
                        <div class="row gy-4">

                            <div class="col-md-12 text-center">
                                @if ($message = Session::get('success'))
                               <!--  -->

@if(!empty(session()->get('share_step2')) && session()->get('share_step2')=='Yes')

<script type="text/javascript">
    $(window).on('load', function() {
        $('#welcomeModal').modal('show');
    });
</script>
@else
  <div class="custom-alerts alert alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      {!! $message !!}
  </div>

@endif

                                  
                           
                                @endif

                                @if ($message = Session::get('error'))
                                <div class="custom-alerts alert alert-danger fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    {!! $message !!}
                                </div>
                                <?php Session::forget('error');?>
                                @endif
                            </div>
                        </div>  
                        @if ($message = Session::get('success'))                      
                          <div class="clearfix"></div>    
                             <div class="divider"></div>    
                             <?php Session::forget('success');?>
                         @endif
                        <div class="clearfix"></div>  
                                    
                        </div>
@if(session()->get('share_link_enable'))                  
 
@if(!empty(session()->get('share_step1')) && session()->get('share_step1')=='Yes') 
@php 
$total_share=$share_for_step1;

@endphp 

@elseif(!empty(session()->get('share_step2')) && session()->get('share_step2')=='Yes') 

@php 
$total_share=$share_for_step2;
@endphp 

@endif

  <div class="row gy-4" style="padding-bottom:20px;">
     <div class="col-md-12 text-center">
          <h5>Invite your friend to join your network</h5>
     </div>
   </div> 
 <form action="{{ url('invite-users') }}" method="POST" id="" enctype="multipart/form-data">
 <input type="hidden" name="user_id" value="{{session()->get('user_id')}}">   
 @csrf
@for($i=0;$i<$total_share;$i++)    
<div class="row gy-4 clearfix">                                        
 <div class="col-md-3">
    <div class="form-group">
     <label class="form-label">First Name</label>
     <input type="text" class="form-control"  placeholder="First Name" name="user[first_name][]" required>
    </div>
</div>
 <div class="col-md-3">
    <div class="form-group">
      <label class="form-label">Last Name</label>
    <input type="text" class="form-control" placeholder="Last Name" name="user[last_name][]" required>
    </div>
</div>                       
                                    
<div class="col-md-6">
     <div class="form-group">
     <label class="form-label" for="">Email</label>
      <input type="text" class="form-control" placeholder="Email" name="user[email][]" required>                                      
    </div>
</div>
                                   
</div>                                        
@endfor
<div class="col-md-12" style="margin-top:40px; text-align:center;">

@if(!empty(session()->get('share_step2')) && session()->get('share_step2')=='Yes') 
<a href="{{ url('registration-success')}}" class="btn btn-lg btn-primary">Skip Sharing</a>

@endif
    <input type="submit" class="btn btn-lg btn-primary" value="Invite Now">
</div>                                        
</form> 

@endif

 </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<div id="welcomeModal" class="modal fade" data-backdrop="static">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">            -->
<!--            <div class="modal-header">              -->
<!--                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
<!--                <h4 class="modal-title" id="myModalLabel">Welcome to MAFAMA</h4>-->
<!--            </div>-->
<!--            <div class="modal-body ">-->
<!--                <div class="row gy-4" style="margin-top: 10px;">-->
<!--                    <div class="col-md-12">-->
<!--                      <p>{!! $message !!}</p>-->
<!--                    </div>-->
<!--                    <hr>-->
<!--                    <div class="col-md-12" style="margin-top: 30px;">-->
<!--                    <div class="embed-responsive embed-responsive-16by9">-->
<!--                      <video width="100%"  height="450" controls="true" poster="" id="video" class="get_vid" data-vid="<?=$video->id;?>" muted>-->
<!--                        <source src="<?php echo asset("public/videos") ?>/<?= $video->video ?>" type="video/mp4">-->
<!--                      </video>-->
<!--                    </div>-->
<!--                    </div>  -->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<script type="text/javascript">
$(document).on('click','.btnee',function(e){
   e.preventDefault();
   var plan_id = $(this).attr("data-id");
   var fees = $(this).attr("data-price");               
   var user_id = $(this).attr("data-order");               
   var token = $("meta[name='csrf-token']").attr("content");           
   $elm=$(this);
   $elm.hide();
   $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
   // $.ajax({
   //          method:"POST",
   //          url:"<?= url('complete_registration');?>",
   //          data:{user_id:user_id,plan_id:plan_id,fees:fees,_token:token},
   //          success:function(data)
   //          {                
   //            $(".submit-loading").remove();
   //            $elm.show();
   //            window.location.href=data;
             
   //          }
   //      })

})  




</script>
@endsection