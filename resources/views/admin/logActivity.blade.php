@extends('layouts.admin') 
@section('content')
<style type="text/css">
	tr, td {
    text-align: left;
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Notifications</h3>
					
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
						<form id="manageNotificationFilter"  method="POST"  >
						@csrf
						<div class="row" style="padding-left:21px" >
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label" style="margin-bottom:0px"> From Date</label>
							<input type="text" name="from_date" autocomplete="off" value="{{date('Y-m-d')}}" class="form-control date-picker1" id="from_date"  required=""  placeholder=" From Date">
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label" style="margin-bottom:0px"> To Date</label>
							<input type="text" name="to_date" autocomplete="off" value="{{date('Y-m-d')}}" class="form-control date-picker1" id="to_date"  required=""  placeholder=" To Date">
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<br>
							<input type="submit" class="btn btn-sm btn-success btn4" value="Search">
						  </div>
						</div>
						</div>
						</form>
							<div class="card-inner">

								<div class="table-responsive">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">No.</span></th>
											<th class="nk-tb-col"><span class="sub-text">User Name</span></th>
										<!--	<th class="nk-tb-col"><span class="sub-text">Action</span></th>-->
											<th class="nk-tb-col"><span class="sub-text">Description</span></th>
											<!--<th class="nk-tb-col"><span class="sub-text">URL</span></th>
											<th class="nk-tb-col"><span class="sub-text">Method</span></th>-->
											<th class="nk-tb-col"><span class="sub-text">IP</span></th>
											<!--<th class="nk-tb-col"><span class="sub-text">User Agent</span></th>-->
											<th class="nk-tb-col"><span class="sub-text">Datetime</span></th>
											
											<th class="nk-tb-col"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody class="notification_list_data">
                             @if($logs->count())
                             @php
                             $i=1;
                             @endphp
									@foreach($logs as $log)	
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>{{ $i++ }}.</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $log->username }}</span>
											</td>
										<!--	<td class="nk-tb-col">
												<span>{{ $log->action }}</span>
											</td>-->
											<td class="nk-tb-col">
												<span>{{ $log->notification }}</span>
											</td>
											<!----<td class="nk-tb-col">
												<span>{{ $log->url }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $log->method }}</span>
											</td>-->
											<td class="nk-tb-col">
												<span>{{ $log->ip }}</span>
											</td>
											<!--<td class="nk-tb-col">
												<span>{{ $log->agent }}</span>
											</td>-->
											<td class="nk-tb-col">
												<span>{{ $log->created_at }}</span>
											</td>
											
											
											
											<td class="nk-tb-col tb-col-md">
												<a href="javascript:voi(0)" data-id="{{$log->id}}" data-list="log_activities" class="btn btn-sm btn-success deleterow">Delete</a>
												
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