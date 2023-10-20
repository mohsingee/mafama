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

                          
									
									<!--<div class="clearfix"></div>	-->
									<!--<div class="divider"><!-- divider </div>	-->
								
											<div class="col-md-12 text-center heading-title" style="margin-top: 10px; margin-bottom: 10px;">
										<h4 style="color: black;">Profile Information</h4>
									</div>
										    <!--text edit-->
                                <p class="text-center">This is an opportunity to verify and confirm the information you entered. If any information is not correct, click on the “Edit” button to change it NOW. Note: Most information cannot be changed later.</p>
                            <!--edit button-->
                            <div style="display: flex; align-items: center; justify-content: center; margin-top: 10px; margin-bottom: 20px;">
                                <button class="btn btn-primary" type="button" onclick="history.back()">
                                Edit
                            </button>
                            </div>
                            <div style="background-color: white; box-shadow: 0px 60px 100px -10px rgba(35, 47, 70, 0.06); border-radius: 10px; padding: 10px; padding-left: 30px; padding-right: 30px; display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 10px;">
                                <!--img and user main detail-->
                                    <div class="" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px;">
                                     
                                     <div style="display: flex; align-items: center; justify-content: center; background-color:black; width: 100px; height: 100px; border-radius: 50px; overflow: hidden;">
		                                        <img src="{{ asset('public/images/affiliates/'.$user->image) }}" style="width: 100%; height: 100%;">
                                     </div>
                                     <!---->
                                         <span class="text-center heading-title" >
                                             <h4 style="color: black; margin: 0px;">
                                             {{ isset($user->id)?$user->first_name:'' }}  {{ isset($user->id)?$user->last_name:'' }}  
                                             </h4>
                                             </span>
                                         <span class="text-center" style="color: grey; margin-bottom: 10px;">
                                             {{ isset($user->id)?$user->email:'' }}
                                             </span>
								</div>
                                <!--main detail end-->
								   <div class="row gy-4" style="padding-bottom:20px;">
								       <!--affiliate code and sponsorid start-->
									@if(!empty($user->code) || !empty($user->sponsor_id) )
										<div class="col-md-4">
											
											<div class="form-group">
												<label class="form-label">Affiliate Code</label>
												
												<span class="lbl_text">{{ isset($user->code)?$user->code:'' }}</span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label">Sponsor Id</label>
												<span class="lbl_text">{{ isset($user->sponsor_id)?$user->sponsor_id:'' }}  </span>
												
											</div>
										</div>
                                      @endif	
										<!--affiliate code and sponsorid end-->
									
										<!--birth country etc start-->
											<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Country of Birth</label>
												<span class="lbl_text bfh-countries" data-country="{{ isset($user->id)?$user->birth_country:'' }}">  </span>
											</div>
										</div>	 
									
										@if($user->birth_country == 'HT') 
									    	<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Birth State/Province/Commune</label>
												<span class="lbl_text"> {{$birth_commune->commune}} </span>
											</div>
										</div>	 
									 @else 
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Birth State/Province/Commune</label>
												<span class="lbl_text bfh-states" data-country="{{ isset($user->id)?$user->birth_country:'' }}" data-state="{{ isset($user->id)?$user->birth_state:'' }}">  </span>
											</div>
										</div>	 
									@endif	
										<!--birth country etc end-->
										
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
												<span class="lbl_text">@if($user->religion=="Other"){{ $user->otherreligion }}@else{{ $user->religion }}@endif</span>
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
												<span class="lbl_text bfh-countries" data-country="{{ isset($user->id)?$user->country:'' }}">  </span>
											</div>
										</div>
										@if($user->commune!=NULL && $user->department!=NULL  && $user->arrondissement!=NULL)
										
										<!--<div class="col-md-4">-->
										<!--	<div class="form-group">-->
										<!--		<label class="form-label" for="">Commune</label>-->
										<!--	<span class="lbl_text">{{ isset($user->id)?$user->commune:'' }}  </span>-->
										<!--	</div>-->
										<!--</div>-->
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Department</label>
											<span class="lbl_text">{{ isset($user->id)?showdepartmentName($user->department):'' }}  </span>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Arrondissement </label>
											<span class="lbl_text">{{ isset($user->id)?$user->arrondissement:'' }}  </span>
											</div>
										</div>
										@endif
											@if($user->country == 'HT') 
											<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province/Commune</label>
												<span class="lbl_text"> {{$commune->commune}} </span>
											</div>
										</div>	
										@else
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">State/Province/Commune</label>
											<span class="lbl_text bfh-states" data-country="{{ isset($user->id)?$user->birth_country:'' }}" data-state="{{ isset($user->id)?$user->birth_state:'' }}">  </span>
											</div>
										</div>
                                        @endif

											<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Business Category</label>
												<span class="lbl_text">
													@if($user->business_category==13){{ $user->otherbusiness }}
													@elseif($user->business_category==1) Tailor
													@elseif($user->business_category==2) Dentist
													@elseif($user->business_category==4) Carpenter
													@elseif($user->business_category==5) Professor
													@elseif($user->business_category==6) Doctor
													@elseif($user->business_category==7) Laboratory (Lab)
													@elseif($user->business_category==8) Pharmacy
													@elseif($user->business_category==9) Cardiology
													@elseif($user->business_category==10) Real Estate
													@elseif($user->business_category==11) Insurance
													@elseif($user->business_category==12) Healer
													@elseif($user->business_category==14) Naturopathie
													@else others
													@endif
													</span>
												  
												  
												</select>
											</div>
										</div>
										<!--biz-->
										<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Profession/Study</label>
												<span class="lbl_text">{{ isset($user->id)?$lead_category:'' }}  </span>
												  
												  
												</select>
											</div>
										</div>
											<div class="col-md-4">
											<div class="form-group">
												<label class="form-label" for="">Company Name</label>
											<span class="lbl_text">{{ isset($user->id)?$user->company:'' }}  </span>
											</div>
										</div>
									</div>
                            </div>

                                     <div class="clearfix"></div>	
									<!--<div class="divider">-->
									    <!-- divider -->
									    <!--</div>	-->
									<!--<div class="row gy-4" style="padding-bottom:20px;">-->
										
									<!--	<div class="col-md-12 text-center" style="margin-top:20px;">-->
									<!--		<h6>Billing Information</h6>-->
									<!--	</div>-->
									<!--	<div class="col-md-6">-->
									<!--		<div class="form-group">-->
									<!--			<label class="form-label" for="">Street Address</label>-->
												
									<!--			<span class="lbl_text">{{ isset($user->id)?$user->billing_address:'' }}  </span>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--	<div class="col-md-6">-->
									<!--		<div class="form-group">-->
									<!--			<label class="form-label" for="">Zip Code</label>-->
												
									<!--			<span class="lbl_text">{{ isset($user->id)?$user->billing_zip_code:'' }}  </span>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--	<div class="col-md-4">-->
									<!--		<div class="form-group">-->
									<!--			<label class="form-label" for=""> City </label>-->
												
									<!--			<span class="lbl_text">{{ isset($user->id)?$user->billing_city:'' }}  </span>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--	<div class="col-md-4">-->
									<!--		<div class="form-group">-->
									<!--			<label class="form-label" for="">Country</label>-->
												
									<!--			<span class="lbl_text">{{ isset($user->id)?$user->billing_country:'' }}  </span>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--	<div class="col-md-4">-->
									<!--		<div class="form-group">-->
									<!--			<label class="form-label" for="">State/Province</label>-->
											
									<!--			<span class="lbl_text">{{ isset($user->id)?$user->billing_state:'' }}  </span>-->
									<!--		</div>-->
									<!--	</div>-->
										
										
									<!--</div>-->

									 <div class="clearfix"></div>	
	 <div class="heading-title heading-dotted col-md-12 margin-bottom-20 margin-top-20 text-center">
                                <h4>Choose Package</h4>
      </div>

        <div class="row justify-content-center">
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
            	
            		
                <div class="pricingTable {{ $class }}" style="width: 30rem; height: 38rem; margin-top: 10px;">
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