@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Fix Commission Setting</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('form-submit')}}" method="POST">	
									@csrf
									<div class="row gy-4">
										<div class="col-md-6 mr-5">
											<div class="form-group">
												<label class="form-label font-weight-bold">
													<b>When any free lead become a paid user</b>
												</label>
												<input type="text" class="form-control" placeholder="Amount" name="lead"  value="{{ $fixcomm->free_lead }}"  required>
											</div>
											<input type="hidden" name="customSwitch1" id="cs1" value="{{ $fixcomm->free_lead_status }}">
										</div>
										<div class="col-md-3 mt-5 ml-5">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input s1" id="customSwitch1"  @if($fixcomm->free_lead_status==1) {{  "checked" }}@else{{ "" }}@endif>
												<label class="custom-control-label" for="customSwitch1"></label>
											</div>
										</div>
										
									</div>
									<div class="row gy-4">
										<div class="col-md-6 mr-5">
											<div class="form-group">
												<label class="form-label font-weight-bold">
													<b>Other Amount</b>
												</label>
												<input type="text" class="form-control" placeholder="Amount" name="otheramount"  value="{{ $fixcomm->other_amount }}"  required>
											</div>
										</div>
										<div class="col-md-3 mt-5 ml-5">
											<input type="hidden" name="customSwitch2" id="cs2" value="{{ $fixcomm->other_amount_status }}">

											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="customSwitch2" @if($fixcomm->other_amount_status==1) {{  "checked" }}@else{{ "" }}@endif>
												<label class="custom-control-label" for="customSwitch2"></label>
											</div>
											
										</div>
										
									</div>
									
									<div class="row gy-4">	
										<div class="col-12">
											<input type="submit" class="btn btn-lg btn-primary" value="Save">
											
										</div>
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
<script>
	$(document).on("change","#customSwitch1",function(){
		if($('#customSwitch1').is(':checked')){
			$('#cs1').val(1);
			// alert("ok");
		}else{
			$('#cs1').val(0);
			
		}
	})

	$(document).on("change","#customSwitch2",function(){
		if($('#customSwitch2').is(':checked')){
			$('#cs2').val(1);
			// alert("ok");
		}else{
			$('#cs2').val(0);
			
		}
	})
</script>
@endsection