@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:900px;">Prize Condition Table</h3>
					<!--<a href="add_access_roles.php" class="btn btn-sm btn-primary" style="float:right;">Add New</a>-->
				</div><!-- .nk-block-head-content -->
				
			
	<div class="nk-block">
				<!-- 	<div class="col-md-12" style="margin-bottom:20px;padding:0px;">
						<h4>Pool Prize Setting</h4>
						
					</div> -->
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							
							<div class="card-inner">
								
								<div class="">
								<form action="{{ url('update_pool_prize_value') }}" method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">	
										<div class="col-md-5">
											<div class="form-group">
												<label class="form-label">Pool Prize Price</label>
												<input type="text" class="form-control"  name="pool_prize"  value="{{ isset($pool_setting->id)?$pool_setting->pool_prize:''}}"  required>
												
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label class="form-label">Pool Price Collection</label>
												<input type="text" class="form-control"  name="bonus_prize"  value="{{ isset($pool->id)?number_format($pool->bonus_prize,2):''}}"  readonly="">
												
											</div>
										</div>
										<div class="col-md-2" style="margin-top:30px; text-align:center;">
											<input type="submit" class="btn btn-md btn-primary" value="Update">
										</div>
									</div>
									
								</form>
								</div>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
				<div class="nk-block">
					<div class="col-md-12" style="margin-bottom:20px;padding:0px;">
						<h4>Prizes Conditions Table</h4>
						
					</div>
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							
							<div class="card-inner">
								@if(permission_access('bonus_prizes_table_add')==1)
								<a class="btn btn-sm btn-success pull-right" href="{{url('admin/prize-conditions')}}">Add New Prize Condition</a>
								@endif
								<div class="">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead  class="thead-light">
										<tr  class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Level / Bonus</th>
											<th class="nk-tb-col"><span class="sub-text">Point Earned </th>
										  <th class="nk-tb-col"><span class="sub-text">Number of Times Log-in/Quarter</th>
											<th class="nk-tb-col"><span class="sub-text">Number of Direct Downline Affiliates</th>
											<th class="nk-tb-col"><span class="sub-text"># of active users</th>
											<th class="nk-tb-col"><span class="sub-text">Start Date </th>
											<th class="nk-tb-col"><span class="sub-text">End Date </th>
											<th class="nk-tb-col"><span class="sub-text">Actions</th>	
											
										</tr>
									</thead>
									<tbody>
										@if(!empty($prize_conditions))
										@foreach($prize_conditions as $bonus)
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>Level {{$bonus->level}}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{$bonus->point_earned }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{$bonus->active_days }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{$bonus->downline_affiliate}}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{$bonus->active_users}}</span>
											</td>
										  <td class="nk-tb-col">
												<span>{{ date('m-d-Y',strtotime($bonus->start_date))}}</span>
											</td>
											 <td class="nk-tb-col">
												<span>{{ date('m-d-Y',strtotime($bonus->end_date))}}</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('bonus_prizes_table_edit')==1)
												<a href="{{url('admin/prize-conditions/'.$bonus->id )}}" class="btn btn-sm btn-success">Edit</a>
												@endif
												<br>
												@if(permission_access('bonus_prizes_table_delete')==1)
												<a data-id="{{$bonus->id }}" data-list="prize_conditions" href="javascript:void(0)" class="btn btn-sm btn-success deleterow">Delete</a>
												@endif
												
											</td>
											
										</tr><!-- .nk-tb-item  -->
										 @endforeach
										@endif
										
										
									</tbody>
								</table>
								</div>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
				
			</div>
		</div>
	</div>
</div>
@endsection