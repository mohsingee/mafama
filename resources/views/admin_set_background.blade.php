@extends('layouts.admin') 
@section('content')
<style type="text/css">
	input{
		margin: 0 5px;
	}
	.mt-20 {
		margin-top: 20px
	}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Set Background Color</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{ url('background_color_submit') }}" method="POST" enctype="multipart/form-data">
									<div class="row">
									@csrf	
										@foreach($colors as $value)
											<div class="col-md-3">
												<label class="form-label">{{ $value->color_name }}</label>
												<div class="bfh-colorpicker" data-name="color{{ $value->id }}"  data-color="{{ $value->color }}"></div>
											</div>
										@endforeach
										<div class="col-md-12 text-center mt-20">
											@if(permission_access('background_color_edit')==1)
											<button type="submit" class="btn btn-primary">Submit</button>
											@endif
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
@endsection