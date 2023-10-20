@extends('layouts.admin') 
@section('content')
<style type="text/css">
	.modal-body {
		margin-top: 20px;
		max-height: 500px;
		overflow-y: auto;
	}
	.ml-20{
		margin-left: 20px
	}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Plan expire Message</h3>
					
				</div>
				<div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
									<form action="{{ url('add-plan-expire-popup-message') }}" method="POST" enctype="multipart/form-data">	
									@csrf
									<input type="hidden" name="id" value="{{ $auth_id }}">
									<div class="row gy-12">
										<div class="col-md-12">
										
												<label class="form-label">Message</label>
										
										</div>
										<div class="col-md-8">
											<div class="form-group">
												
												<textarea  class="form-control w-100" name="user_message" required>{{$message }}</textarea>
											</div>
										</div>
									</div><br>
									
										<div class="col-12">

											<button type="submit" class="btn btn btn-primary">Update message</button>
										</div>
									</div>
								</form>
							</div>
			</div>
		</div>
	</div>
</div>

@endsection