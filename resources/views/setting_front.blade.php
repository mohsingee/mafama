@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Settings</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="">	
									<div class="row gy-4">
										
										<div class="col-md-12">
											<table class="table">
												
												<tbody>
													<tr>
													    <th style="border:0px!important"><input type="text" class="form-control" value="Profile"></th>
													    <th style="border:0px!important"><input type="text" class="form-control" value="Banner"></th>
														<th  style="border:0px!important"><input type="text" class="form-control" value="Import Contact"></th>
																												
													</tr>
													<tr>
													    <th style="border:0px!important"><input type="text" class="form-control" value="User Access Right"></th>
													    <th style="border:0px!important"><input type="text" class="form-control" value="Appointment Setting"></th>
														<th  style="border:0px!important"><input type="text" class="form-control" value="Manage Date Settings"></th>
																												
													</tr>
													<tr>
													    <th style="border:0px!important"><input type="text" class="form-control" value="Create Revenue Account"></th>
													    <th style="border:0px!important"><input type="text" class="form-control" value="Create Expense Account"></th>
														<th  style="border:0px!important"><input type="text" class="form-control" value="Chart of Accounts"></th>
																												
													</tr>
													<tr>
													    <th style="border:0px!important"><input type="text" class="form-control" value="Templates"></th>
													    <th style="border:0px!important"><input type="text" class="form-control" value="Tutorial"></th>
																												
													</tr>
													
													
												</tbody>
											</table>
										</div>
										
									</div>	
									<div class="row gy-4">
										<div class="col-md-12 text-center" style="margin-top:30px;">
											<a href="#" class="btn btn-sm btn-primary">Update</a>
											
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