@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Show / Hide Links</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="">	
									<div class="row gy-4">
										<div class="col-md-2">
											<label>Link 1</label>
										</div>
										<div class="col-md-7">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" checked="" id="customSwitch1">
												<label class="custom-control-label" for="customSwitch1"></label>
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label>Link 2</label>
										</div>
										<div class="col-md-7">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" checked="" id="customSwitch2">
												<label class="custom-control-label" for="customSwitch2"></label>
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label>Link 3</label>
										</div>
										<div class="col-md-7">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" checked="" id="customSwitch3">
												<label class="custom-control-label" for="customSwitch3"></label>
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label>Link 4</label>
										</div>
										<div class="col-md-7">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" checked="" id="customSwitch4">
												<label class="custom-control-label" for="customSwitch4"></label>
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label>Link 5</label>
										</div>
										<div class="col-md-7">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" checked="" id="customSwitch5">
												<label class="custom-control-label" for="customSwitch5"></label>
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label>Affiliate Button</label>
										</div>
										<div class="col-md-7">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" checked="" id="customSwitch6">
												<label class="custom-control-label" for="customSwitch6"></label>
											</div>
										</div>
									</div>
									<div class="row gy-4">
										<div class="col-md-2">
											<label>Upload Pictures</label>
										</div>
										<div class="col-md-7">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" checked="" id="customSwitch7">
												<label class="custom-control-label" for="customSwitch7"></label>
											</div>
										</div>
									</div>
									<div class="row gy-4">	
										<div class="col-12">
											<a href="#" class="btn btn-lg btn-primary">Save</a>
											
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