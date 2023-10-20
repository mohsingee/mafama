@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:900px;">Move Leads to Basket3</h3>
					<!--<a href="add_access_roles.php" class="btn btn-sm btn-primary" style="float:right;">Add New</a>-->
				</div><!-- .nk-block-head-content -->
				
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
							    	<!--<a class="btn btn-sm btn-success pull-right" href="{{ route('basket-condition',['basket'=>3,'id'=>''])}}">Add New </a>-->
								<div class="">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead  class="thead-light">
										<tr  class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">X # of Active Affiliates </th>
											<th class="nk-tb-col"><span class="sub-text">Plus X # of Users </th>
											<th class="nk-tb-col"><span class="sub-text">From Date </th>
											<th class="nk-tb-col"><span class="sub-text">To Date </th>
											<th class="nk-tb-col"><span class="sub-text">System will take X # of contacts Closest location</th>
											<th class="nk-tb-col"><span class="sub-text">From Categories all</th>
											<th class="nk-tb-col"><span class="sub-text">Place contacts in the basket of affiliate</th>
											<th class="nk-tb-col"><span class="sub-text">Actions </th>
											
										</tr>
									</thead>
									<tbody>
								    @if(!empty($baskets))	
								      @foreach($baskets as $basket)	
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>{{$basket->active_affiliates }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{$basket->plus_users }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ date('m-d-Y',strtotime($basket->from_date)) }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{ date('m-d-Y',strtotime($basket->to_date)) }}</span>
											</td>
											<td class="nk-tb-col">
												<span>{{$basket->closest_contacts }}</span>
											</td>
											<td class="nk-tb-col">
													<span>{{$basket->place_basket }}</span>
											</td>
											<td class="nk-tb-col">
											<span>{{ \App\BasketCondition::get_categories_list($basket->categories)}}</span>
											</td>
											<td class="nk-tb-col">
												@if(permission_access('move_leads_basketthree_edit')==1)
												<a href="
												{{ route('basket-condition',['basket'=>3,'id'=>$basket->id])}}" class="btn btn-xs btn-success">Edit</a>
												@endif
											</td>
											
										</tr>
										@endforeach
									@endif	
										<!-- .nk-tb-item  -->
										<!-- 
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>1728</span>
											</td>
											<td class="nk-tb-col">
												<span>1728</span>
											</td>
											<td class="nk-tb-col">
												<span>02/03/2020</span>
											</td>
											<td class="nk-tb-col">
												<span>02/10/2020</span>
											</td>
											<td class="nk-tb-col">
												<span>10</span>
											</td>
											<td class="nk-tb-col">
												<span>A, B, C, (All)</span>
											</td>
											<td class="nk-tb-col">
												<span>4</span>
											</td>
											<td class="nk-tb-col">
												<span>Notifications / Pic / Slide Show</span>
											</td>
											
										</tr> -->
										
										
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