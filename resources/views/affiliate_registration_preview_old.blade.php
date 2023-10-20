@extends('layouts.main') 
@section('content')
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

@media screen and (max-width:990px) {
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
					@csrf
                        <div class="" style="padding-bottom: 20px;">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
                            </div>
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Application Preview</h4>
                            </div>

                            @if(!empty($user->code) || !empty($user->sponsor_id) )
									<div class="row gy-4" style="padding-bottom:20px;">
										<div class="col-md-6">
											
											<div class="form-group">
												<label class="form-label">Affiliate Code</label>
												
												<span class="lbl_text">{{ isset($user->code)?$user->code:'' }}</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Sponsor Id</label>
												<span class="lbl_text">{{ isset($user->sponsor_id)?$user->sponsor_id:'' }}  </span>
												
											</div>
										</div>
                                      
										
										
									</div>
									
									<div class="clearfix"></div>	
									<div class="divider"><!-- divider --></div>	
								@endif	
								   <div class="row gy-4" style="padding-bottom:20px;">
										<div class="col-md-12 text-center">
											<h6>Profile Information</h6>
										</div>
										
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">First Name</label>
												<span class="lbl_text">{{ isset($user->id)?$user->first_name:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Last Name</label>
												<span class="lbl_text">{{ isset($user->id)?$user->last_name:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Cell Phone</label>
												<span class="lbl_text">{{ isset($user->id)?$user->cellphone:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Business Telephone</label>
												<span class="lbl_text">{{ isset($user->id)?$user->business_telephone:'' }}  </span>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Religious Faith</label>
												<span class="lbl_text">{{ isset($user->id)?$user->religion:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Email</label>
												<span class="lbl_text">{{ isset($user->id)?$user->email:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Date Of Birth</label>
												<span class="lbl_text">{{ isset($user->id)?date('d-F-Y',strtotime($user->dob)):'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Street Address</label>
												<span class="lbl_text">{{ isset($user->id)?$user->address:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												<span class="lbl_text">{{ isset($user->id)?$user->zip_code:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												<span class="lbl_text">{{ isset($user->id)?$user->city:'' }}  </span>
											</div>
										</div>
										
										
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country</label>
												<span class="lbl_text">{{ isset($user->id)?$user->country:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
											<span class="lbl_text">{{ isset($user->id)?$user->state:'' }}  </span>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Business Category</label>
												<span class="lbl_text">{{ isset($user->id)?$business_category:'' }}  </span>
												  
												  
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Business Category (Type)</label>
												<span class="lbl_text">{{ isset($user->id)?$lead_category:'' }}  </span>
												  
												  
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Profile Picture</label>
		                                        <img src="{{ asset('public/images/affiliates/'.$user->image) }}" class="img img-responsive" style="width: 40px">
											</div>
										</div>
										
										<div class="col-md-4">
											
											
										</div>
									</div>

                                     <div class="clearfix"></div>	
									<div class="divider"><!-- divider --></div>	
									<div class="row gy-4" style="padding-bottom:20px;">
										
										<div class="col-md-12 text-center" style="margin-top:20px;">
											<h6>Billing Information</h6>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Street Address</label>
												
												<span class="lbl_text">{{ isset($user->id)?$user->billing_address:'' }}  </span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Zip Code</label>
												
												<span class="lbl_text">{{ isset($user->id)?$user->billing_zip_code:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for=""> City </label>
												
												<span class="lbl_text">{{ isset($user->id)?$user->billing_city:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country</label>
												
												<span class="lbl_text">{{ isset($user->id)?$user->billing_country:'' }}  </span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province</label>
											
												<span class="lbl_text">{{ isset($user->id)?$user->billing_state:'' }}  </span>
											</div>
										</div>
										
										
									</div>

									 <div class="clearfix"></div>	
	 <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Choose Package</h4>
      </div>

        <div class="row">
        @if(!empty($plans))
        @php
          $i=1;	
          
        @endphp	
		 @foreach($plans as $plan)
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
            <div class="col-md-{{ $grid }} col-md-offset-{{ $offset }}">
            	
            		
                <div class="pricingTable {{ $class }}">
                    <div class="pricingTable-header">
                        <i class="fa {{ $icon }}"></i>
                        <div class="price-value"> ${{ $plan->monthly_fee }} <span class="month">per month</span> </div>
                    </div>
                    <br>
                    <h3 class="heading">{{ $plan->name }}</h3>
                    <div class="pricing-content">
                        <ul>
                            <li></li>
                            <!--<li><b>50GB</b> Disk Space</li>-->
                            
                        </ul>
                    </div>
                    <div class="pricingTable-signup">
                    	<form></form>
        	<form action="{{ url('complete_registration') }}" method="POST"  id="form-{{$plan->id}}" >
        	 @csrf 	  
        	<input type="hidden" name="plan_id" value="{{ $plan->id }}">
        	<input type="hidden" name="fees" value="{{ $plan->monthly_fee }}">
        	<input type="hidden" name="user_id" value="{{ isset($user->id)?$user->id:'' }}">
            <a href="javascript:void(0)" class="subscribe-plan" data-id="{{ $plan->id }}" data-order="{{ isset($user->id)?$user->id:'' }}" data-price="{{ $plan->monthly_fee }}">subscribe</a>
             </form>
                    </div>
                </div>

            </div>
             @php
              $i++;
            @endphp
          @endforeach
		@endif	   
         
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
   // $elm.hide();
   // $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');

   $("#form-"+plan_id).submit();
   // $.ajax({
   //          method:"POST",
   //          url:"<?= url('complete_registration');?>",
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
@endsection