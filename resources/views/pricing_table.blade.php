@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Pricing Table</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<div class="">
								<form  method="POST" id="" enctype="multipart/form-data">
									@csrf
								<table class="datatable-init nk-tb-list nk-tb-ulist pricing-table" data-auto-responsive="false">
									<thead  class="thead-light">
										<tr  class="nk-tb-item nk-tb-head img-tr">
											<th class="nk-tb-col" style="background-image:url(../images/red-art-blue.jpg); background-size:cover;"><span class="sub-text">Plans </span></th>
											<th class="nk-tb-col text-center"  style="background-image:url(../images/bg3.jpg); background-size:cover;"><span class="sub-text"><a href="{{url('plan/3')}}" style="color:#fff">{{$gold_plan}}</a></span></th>
											<th class="nk-tb-col text-center"  style="background-image:url(../images/blue-bg.jpg); background-size:cover;"><span class="sub-text" ><a href="{{url('plan/4')}}" style="color:#fff">{{$silver_plan}}</a></span> </th>
											<th class="nk-tb-col text-center"  style="background-image:url(../images/blue-bg.jpg); background-size:cover;"><span class="sub-text"><a href="{{url('plan/2')}}" style="color:#fff">{{$enterprise_plan}}</a></span> </th>
											
										</tr>
										<tr  class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col text-left"><span class="sub-text">Features </th>
											<th class="nk-tb-col text-center"><span class="sub-text">Gold Package </th>
											<th class="nk-tb-col text-center"><span class="sub-text">Silver Package </th>
											<th class="nk-tb-col text-center"><span class="sub-text">Enterprises </th>
											
										</tr>
									</thead>
									<tbody>
										<tr class="nk-tb-item" style="background-color: #b71a0f24;">
											<th class="nk-tb-col" colspan="4">
												<span class="sub-text" style="color: #da291c;font-size:20px;text-align:left;">Appointment</span>
											</th>

										</tr><!-- .nk-tb-item  -->

									@foreach($appointments as $app)
										<tr class="nk-tb-item">
											<td class="nk-tb-col text-left">
												<span>{{$app->menu}}</span>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="gold_check_{{$app->id}}" class="custom-control-input active_menu" data-type="gold_access" data-id="{{$app->id}}" id="customCheck1{{$app->id}}" <?= isset($app->gold_access) && ($app->gold_access==1)?'checked':'';?> >
													<label class="custom-control-label" for="customCheck1{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="silver_check_{{$app->id}}"  class="custom-control-input active_menu" data-type="silver_access"  data-id="{{$app->id}}"  id="customCheck2{{$app->id}}" {{ isset($app->silver_access) && ($app->silver_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck2{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="enterprize_check_{{$app->id}}" class="custom-control-input active_menu" data-type="enterprise_access"  data-id="{{$app->id}}" id="customCheck3{{$app->id}}" {{ isset($app->enterprise_access) && ($app->enterprise_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck3{{$app->id}}"></label>
												</div>
											</td>
											
										</tr><!-- .nk-tb-item  -->
									@endforeach
									<!--
										<tr class="nk-tb-item hidden-tr1 d-none  text-left">
											<td class="nk-tb-col text-left">
												<span>Manage Appointment</span>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customChec13">
													<label class="custom-control-label" for="customCheck13"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck14">
													<label class="custom-control-label" for="customCheck14"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck15">
													<label class="custom-control-label" for="customCheck15"></label>
												</div>
											</td>
											
										</tr>
										<tr class="nk-tb-item hidden-tr1 d-none  text-left">
											<td class="nk-tb-col text-left">
												<span>Tutorial</span>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck10">
													<label class="custom-control-label" for="customCheck10"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck11">
													<label class="custom-control-label" for="customCheck11"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck12">
													<label class="custom-control-label" for="customCheck12"></label>
												</div>
											</td>
											
										</tr>
										<tr>
											<td  class="nk-tb-col  text-left show-less1 d-none" colspan="4"><span class="text-center" style="padding-left:10px;color: #da291c;text-align:left;"><b>... Show Less</b></span></td>
											<td  class="nk-tb-col  text-left show-more1" colspan="4"><span class="text-center" style="padding-left:10px;color: #da291c;text-align:left;"><b>... Show More</b></span></td>
											
										</tr>
										-->
										
										<tr class="nk-tb-item" style="background-color: #b71a0f24;">
											<th class="nk-tb-col" colspan="4">
												<span class="sub-text" style="color: #da291c;font-size:20px;text-align:left;">Client Management</span>
											</th>
											
										</tr><!-- .nk-tb-item  -->
											@foreach($client_menus as $app)
										<tr class="nk-tb-item">
											<td class="nk-tb-col text-left">
												<span>{{$app->menu}}</span>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="gold_check_{{$app->id}}" class="custom-control-input active_menu" data-type="gold_access" data-id="{{$app->id}}" id="customCheck1{{$app->id}}" {{ isset($app->gold_access) && ($app->gold_access==1)?'checked':''}} >
													<label class="custom-control-label" for="customCheck1{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="silver_check_{{$app->id}}"  class="custom-control-input active_menu" data-type="silver_access"  data-id="{{$app->id}}" id="customCheck2{{$app->id}}" {{ isset($app->silver_access) && ($app->silver_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck2{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="enterprize_check_{{$app->id}}" class="custom-control-input active_menu" data-type="enterprise_access"  data-id="{{$app->id}}" id="customCheck3{{$app->id}}" {{ isset($app->enterprise_access) && ($app->enterprise_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck3{{$app->id}}"></label>
												</div>
											</td>
										</tr><!-- .nk-tb-item  -->
									@endforeach
										<!----- feature 2 --->
										
										<tr class="nk-tb-item" style="background-color: #b71a0f24;">
											<th class="nk-tb-col" colspan="4">
												<span class="sub-text" style="color: #da291c;font-size:20px;text-align:left;">Email Management</span>
											</th>
											
										</tr><!-- .nk-tb-item  -->
									@foreach($email_menus as $app)
										<tr class="nk-tb-item">
											<td class="nk-tb-col text-left">
												<span>{{$app->menu}}</span>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="gold_check_{{$app->id}}" class="custom-control-input active_menu" data-type="gold_access" data-id="{{$app->id}}" id="customCheck1{{$app->id}}" {{ isset($app->gold_access) && ($app->gold_access==1)?'checked':''}} >
													<label class="custom-control-label" for="customCheck1{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="silver_check_{{$app->id}}"  class="custom-control-input active_menu" data-type="silver_access"  data-id="{{$app->id}}" id="customCheck2{{$app->id}}" {{ isset($app->silver_access) && ($app->silver_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck2{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="enterprize_check_{{$app->id}}" class="custom-control-input active_menu" data-type="enterprise_access"  data-id="{{$app->id}}" id="customCheck3{{$app->id}}" {{ isset($app->enterprise_access) && ($app->enterprise_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck3{{$app->id}}"></label>
												</div>
											</td>

										</tr><!-- .nk-tb-item  -->
									@endforeach
										
										<!----- feature 3 --->
										
										<tr class="nk-tb-item" style="background-color: #b71a0f24;">
											<th class="nk-tb-col" colspan="4">
												<span class="sub-text" style="color: #da291c;font-size:20px;text-align:left;">Financial Management</span>
											</th>
											
										</tr><!-- .nk-tb-item  -->
									@foreach($finance_menus as $app)
										<tr class="nk-tb-item">
											<td class="nk-tb-col text-left">
												<span>{{$app->menu}}</span>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="gold_check_{{$app->id}}" class="custom-control-input active_menu" data-type="gold_access" data-id="{{$app->id}}" id="customCheck1{{$app->id}}" {{ isset($app->gold_access) && ($app->gold_access==1)?'checked':''}} >
													<label class="custom-control-label" for="customCheck1{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="silver_check_{{$app->id}}"  class="custom-control-input active_menu" data-type="silver_access"  data-id="{{$app->id}}" id="customCheck2{{$app->id}}" {{ isset($app->silver_access) && ($app->silver_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck2{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="enterprize_check_{{$app->id}}" class="custom-control-input active_menu" data-type="enterprise_access"  data-id="{{$app->id}}" id="customCheck3{{$app->id}}" {{ isset($app->enterprise_access) && ($app->enterprise_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck3{{$app->id}}"></label>
												</div>
											</td>

										</tr><!-- .nk-tb-item  -->
									@endforeach


										
										<!----- feature 2 --->
										
										<tr class="nk-tb-item" style="background-color: #b71a0f24;">
											<th class="nk-tb-col" colspan="4">
												<span class="sub-text" style="color: #da291c;font-size:20px;text-align:left;">Archives</span>
											</th>
											
										</tr><!-- .nk-tb-item  -->
										@foreach($archive_menus as $app)
										<tr class="nk-tb-item">
											<td class="nk-tb-col text-left">
												<span>{{$app->menu}}</span>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="gold_check_{{$app->id}}" class="custom-control-input active_menu" data-type="gold_access" data-id="{{$app->id}}" id="customCheck1{{$app->id}}" {{ isset($app->gold_access) && ($app->gold_access==1)?'checked':''}} >
													<label class="custom-control-label" for="customCheck1{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="silver_check_{{$app->id}}"  class="custom-control-input active_menu" data-type="silver_access"  data-id="{{$app->id}}" id="customCheck2{{$app->id}}" {{ isset($app->silver_access) && ($app->silver_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck2{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="enterprize_check_{{$app->id}}" class="custom-control-input active_menu" data-type="enterprise_access"  data-id="{{$app->id}}" id="customCheck3{{$app->id}}" {{ isset($app->enterprise_access) && ($app->enterprise_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck3{{$app->id}}"></label>
												</div>
											</td>

										</tr><!-- .nk-tb-item  -->
									@endforeach

										<tr class="nk-tb-item" style="background-color: #b71a0f24;">
											<th class="nk-tb-col" colspan="4">
												<span class="sub-text" style="color: #da291c;font-size:20px;text-align:left;">Setting</span>
											</th>

										</tr><!-- .nk-tb-item  -->
										@foreach($setting_menus as $app)
										<tr class="nk-tb-item">
											<td class="nk-tb-col text-left">
												<span>{{$app->menu}}</span>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="gold_check_{{$app->id}}" class="custom-control-input active_menu" data-type="gold_access" data-id="{{$app->id}}" id="customCheck1{{$app->id}}" {{ isset($app->gold_access) && ($app->gold_access==1)?'checked':''}} >
													<label class="custom-control-label" for="customCheck1{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center  fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="silver_check_{{$app->id}}"  class="custom-control-input active_menu" data-type="silver_access"  data-id="{{$app->id}}" id="customCheck2{{$app->id}}" {{ isset($app->silver_access) && ($app->silver_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck2{{$app->id}}"></label>
												</div>
											</td>
											<td class="nk-tb-col text-center fsize-20">
												<div class="custom-control custom-control-sm custom-checkbox">
													<input type="checkbox" name="enterprize_check_{{$app->id}}" class="custom-control-input active_menu" data-type="enterprise_access"  data-id="{{$app->id}}" id="customCheck3{{$app->id}}" {{ isset($app->enterprise_access) && ($app->enterprise_access==1)?'checked':''}}>
													<label class="custom-control-label" for="customCheck3{{$app->id}}"></label>
												</div>
											</td>

										</tr><!-- .nk-tb-item  -->
									@endforeach
								<tr class="nk-tb-item">
											<td class="nk-tb-col text-center" ></td>

											<td class="nk-tb-col " >

<td class="nk-tb-col text-center" ><!--<input type="submit" class="btn btn-sm btn-success" value="Update">--></td>
<td class="nk-tb-col text-center" ></td>


							    </tr>
									</tbody>
								</table>
							</form>
								</div>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
				
			</div>
		</div>
	</div>
</div>

<script>
$(".show-more1").click(function(){
$(".hidden-tr1").removeClass("d-none");
$(".show-less1").removeClass("d-none");
$(".show-more1").addClass("d-none");
});
$(".show-less1").click(function(){
$(".hidden-tr1").addClass("d-none");
$(".show-less1").addClass("d-none");
$(".show-more1").removeClass("d-none");
});

$(".show-more2").click(function(){
$(".hidden-tr2").removeClass("d-none");
$(".show-less2").removeClass("d-none");
$(".show-more2").addClass("d-none");
});
$(".show-less2").click(function(){
$(".hidden-tr2").addClass("d-none");
$(".show-less2").addClass("d-none");
$(".show-more2").removeClass("d-none");
});

$(".show-more3").click(function(){
$(".hidden-tr3").removeClass("d-none");
$(".show-less3").removeClass("d-none");
$(".show-more3").addClass("d-none");
});
$(".show-less3").click(function(){
$(".hidden-tr3").addClass("d-none");
$(".show-less3").addClass("d-none");
$(".show-more3").removeClass("d-none");
});


$(".show-more4").click(function(){
$(".hidden-tr4").removeClass("d-none");
$(".show-less4").removeClass("d-none");
$(".show-more4").addClass("d-none");
});
$(".show-less4").click(function(){
$(".hidden-tr4").addClass("d-none");
$(".show-less4").addClass("d-none");
$(".show-more4").removeClass("d-none");
});

$(".show-more5").click(function(){
$(".hidden-tr5").removeClass("d-none");
$(".show-less5").removeClass("d-none");
$(".show-more5").addClass("d-none");
});
$(".show-less5").click(function(){
$(".hidden-tr5").addClass("d-none");
$(".show-less5").addClass("d-none");
$(".show-more5").removeClass("d-none");
});
</script>


@endsection