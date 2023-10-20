@extends('layouts.admin') 
@section('content')

<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Financial Management</h3>
					
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
													<tr style="border:0px!important">
													    <th style="border:0px!important"><input type="text" class="form-control" value="Record Revenues"></th>
													    <th style="border:0px!important"><input type="text" class="form-control" value="Record Expenses"></th>
														<th  style="border:0px!important"><input type="text" class="form-control" value="Group Recordings"></th>
																												
													</tr>
													
													<tr style="border:0px!important">
														<th style="border:0px!important"><input type="text" class="form-control" value="Create Budget"></th>
														<th  style="border:0px!important"><input type="text" class="form-control" value="Create Invoice"></th>
														<th  style="border:0px!important"><input type="text" class="form-control" value="Manage Assets"></th>
														
													</tr>
													
													<tr style="border:0px!important">
														<th style="border:0px!important"><input type="text" class="form-control" value="Profit / Loss Statement"></th>
														<th  style="border:0px!important"><input type="text" class="form-control" value="Revenue Report"></th>
														<th style="border:0px!important"><input type="text" class="form-control" value="Expense Report"></th>
														
													</tr>
													
													<tr style="border:0px!important">
														<th style="border:0px!important"><input type="text" class="form-control" value="Performance Report"></th>
														<th style="border:0px!important"><input type="text" class="form-control" value="Comparison Mode"></th>
														<th style="border:0px!important"><input type="text" class="form-control" value="Payment / Balance"></th>
														
													</tr>
													
													<tr style="border:0px!important">
														<th style="border:0px!important"><input type="text" class="form-control" value="Upload files"></th>
														<th style="border:0px!important"><input type="text" class="form-control" value="Tutorial"></th>
														<td style="border:0px!important"></td>
														
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