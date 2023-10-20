@extends('layouts.admin') 
@section('content')

<style>
    tr, td {
    text-align: left!important;
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Level Income Report </h3>
					
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<div class="table-responsive1">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Sr. No.</span></th>
											<th class="nk-tb-col"><span class="sub-text">User Name</span></th>
											
											<th class="nk-tb-col"><span class="sub-text">Amount</span></th>
											<th class="nk-tb-col"><span class="sub-text">Description</span></th>
											<th class="nk-tb-col"><span class="sub-text">Created At</span></th>
											
											
										</tr>
									</thead>
									<tbody>
										@php
										  $i=1;
										@endphp
									@foreach($bonus as $bo)	
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>{{ $i++ }}.</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ $bo->username }}</span>
											</td>
										
											<td class="nk-tb-col">
												<span><b>$</b>{{ $bo->amount }}</span>
											</td>
												<td class="nk-tb-col">
												<span>{!! $bo->description !!}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{date('m-d-Y h:i A',strtotime($bo->created_at)) }}</span>
											</td>
											
											
										</tr><!-- .nk-tb-item  -->
									@endforeach
										
										
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