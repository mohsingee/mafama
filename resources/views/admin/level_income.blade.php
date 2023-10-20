@extends('layouts.admin') 
@section('content')

<style>
  
.borderless tr td, .borderless tr th {
    
    text-align: left;
    
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Level Income</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('update_level_income') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										
										
										<div class="col-md-6">
											<div class="form-group">
											<label class="form-label">Plan </label>
												<select name="plan_id" id="sel_plan" class="form-control" required="">
													<option>Select Plan</option>
													@foreach($plans as $plan)
													<option value="{{ $plan->id }}"  {{ isset($level->id) && $level->plan_id==$plan->id?'selected':''}}>{{ $plan->name }}</option>
													@endforeach
												</select>
											</div>
									</div>

									
									<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Sponsor Affiliate Share</label>

												@foreach($plans as $plan)

												 @if($level->plan_id==$plan->id)
                                                 <input type="text" class="form-control"   id="sp_share" value="{{$plan->affiliate_share_price}}" readonly="">
                                                 <input type="hidden" class="form-control"   name="sp_share" id="share_{{$plan->id}}" value="{{$plan->affiliate_share_price}}"  >
												 @else
												<input type="hidden" class="form-control"   name="sp_share" id="share_{{$plan->id}}" value="{{$plan->affiliate_share_price}}"  >
												@endif
												@endforeach
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 2</label>
												<input type="text" class="form-control"   name="level_2" placeholder="Level 2" value="{{ isset($level->id)?$level->level_2:''}}" required readonly="">
											</div>
										</div>
											
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 3</label>
												<input type="text" class="form-control"   name="level_3" placeholder="Level 3" value="{{ isset($level->id)?$level->level_3:''}}" required readonly="">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 4</label>
												<input type="text" class="form-control"   name="level_4" placeholder="Level 4" value="{{ isset($level->id)?$level->level_4:''}}" required readonly="">
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 5</label>
												<input type="text" class="form-control"   name="level_5" placeholder="Level 5" value="{{ isset($level->id)?$level->level_5:''}}" required readonly="">
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 6</label>
												<input type="text" class="form-control"   name="level_6" placeholder="Level 1" value="{{ isset($level->id)?$level->level_6:''}}" required readonly="">
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 7</label>
												<input type="text" class="form-control"   name="level_7" placeholder="Level 7" value="{{ isset($level->id)?$level->level_7:''}}" required readonly="">
											</div>
										</div>
														
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 8</label>
												<input type="text" class="form-control"   name="level_8" placeholder="Level 1" value="{{ isset($level->id)?$level->level_8:''}}" required readonly="">
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 9</label>
												<input type="text" class="form-control"   name="level_9" placeholder="Level 1" value="{{ isset($level->id)?$level->level_9:''}}" required readonly="">
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 10</label>
												<input type="text" class="form-control"   name="level_10" placeholder="Level 10" value="{{ isset($level->id)?$level->level_10:''}}" required readonly="">
											</div>
										</div>
													
									 
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 11</label>
												<input type="text" class="form-control"   name="level_11" placeholder="Level 1" value="{{ isset($level->id)?$level->level_11:''}}" required readonly="">
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label">Level 12</label>
												<input type="text" class="form-control"   name="level_12" placeholder="Level 12" value="{{ isset($level->id)?$level->level_12:''}}" required readonly="">
											</div>
										</div>
												
										
									</div>
									<div class="clearfix"></div>	
									
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="hidden" name="id" value="{{ isset($level->id)?$level->id:''}}" >
										<input type="submit" class="btn btn-lg btn-primary" value="Update">
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on('change', '#sel_plan', function(e){
		var id=$(this).val();
		if(id !=='')
		{
		 var price=$("#share_"+id).val();
		 $("#sp_share").val(price);
		 var price=parseFloat(price);
		 $("input[name='level_2']").val((price/2).toFixed(2));
		 $("input[name='level_3']").val((price/3).toFixed(2));
		 $("input[name='level_4']").val((price/4).toFixed(2));
		 $("input[name='level_5']").val((price/5).toFixed(2));
		 $("input[name='level_6']").val((price/6).toFixed(2));
		 $("input[name='level_7']").val((price/7).toFixed(2));
		 $("input[name='level_8']").val((price/8).toFixed(2));
		 $("input[name='level_9']").val((price/9).toFixed(2));
		 $("input[name='level_10']").val((price/10).toFixed(2));
		 $("input[name='level_11']").val((price/11).toFixed(2));
		 $("input[name='level_12']").val((price/12).toFixed(2));

		}


	});
</script>
@endsection