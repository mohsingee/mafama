@extends('layouts.admin') 
@section('content')
@php
 $months=array(
               '01'=>'Jan',
               '02'=>'Feb',
               '03'=>'Mar',
               '04'=>'Apr',
               '05'=>'May',
               '06'=>'Jun',
               '07'=>'Jul',
               '08'=>'Aug',
               '09'=>'Sep',
               '10'=>'Oct',
               '11'=>'Nov',
               '12'=>'Dec',
               );
             
@endphp
<div class="nk-content ">
<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head-content" style="margin-bottom:20px;">
				<h3 class="nk-block-title page-title">Access Monitoring</h3>
				
			</div><!-- .nk-block-head-content -->
			<div class="nk-block">
				<div class="card card-bordered card-stretch">
					<div class="card-aside-wrap">
						<div class="card-inner card-inner-lg">
							<div class="row" style="margin-bottom:20px;">
								<div class="col-md-6"></div>
								<div class="col-md-2">
									<div class="form-group">
										<input type="text" class="form-control date-picker" id="monitoring_date" onchange="loadAccessMonitoringData()" value="{{ $date}}"  placeholder="Select Date">
									</div>
								</div>
								<div class="col-md-2">
									<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" id="monitoring_month" onchange="loadAccessMonitoringData()"  aria-hidden="true" data-select2-id="3">
										<option>-- Month --</option>
										@foreach($months as $key=>$value)
                                         <option value="{{$key}}" {{ isset($value) && ($key==$month)?'selected':''}}>{{$value}}</option>
										@endforeach
										
									</select>
								</div>
								<div class="col-md-2">
									<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" id="monitoring_year" onchange="loadAccessMonitoringData()"  aria-hidden="true" data-select2-id="5">
										<option>-- Year --</option>
										@php
                                         $year=date('Y');
                                         $limit=$year-10;
										@endphp
										@for($i=$year;$i>=$limit;$i--)
										<option value="{{ $i }}" {{ isset($i) && ($i==$year)?'selected':''}}>{{ $i }}</option>
										@endfor
										
									</select>
								</div>
								<!--<div class="col-md-2">
									<a href="#" class="btn btn-md btn-primary">Search</a>
								</div>-->
							</div>
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tabItem1">Daily</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabItem2">Weekly</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabItem3">Monthly</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabItem4">Quarterly</a>
								</li>
								
							</ul>
							<div class="tab-content" id="access-monitoring-data-filter">
								<div class="tab-pane active" id="tabItem1">
									
									<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
										<thead>
											<tr class="nk-tb-item nk-tb-head">
												<th class="nk-tb-col"><span class="sub-text">User</span></th>
												<th class="nk-tb-col"><span class="sub-text">Times log-in</span></th>
												<th class="nk-tb-col"><span class="sub-text">Time Spent</span></th>
												<th class="nk-tb-col"><span class="sub-text">Idle time</span></th>
												<th class="nk-tb-col"><span class="sub-text">Points Earned</span></th>
												
												
											</tr>
										</thead>
										<tbody id="daily-filter-data">
										@if($daily->count()>0)
										 @foreach($daily as $dail)	
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>{{$dail->name}}</span>
												</th>
												<td class="nk-tb-col">
													<span>{{$dail->total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{$dail->stroke_time}} Hr</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{$dail->idle_time}} Hr</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{$dail->earned_points}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											@endforeach
										@endif	
											
											
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tabItem2">
									<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
										<thead>
											<tr class="nk-tb-item nk-tb-head">
												<th class="nk-tb-col"><span class="sub-text">Level/Week</span></th>
												<th class="nk-tb-col"><span class="sub-text">1st week</span></th>
												<th class="nk-tb-col"><span class="sub-text">2st week</span></th>
												<th class="nk-tb-col"><span class="sub-text">3rd week</span></th>
												<th class="nk-tb-col"><span class="sub-text">4th week</span></th>
												
												
											</tr>
										</thead>
										<tbody>
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>No. Of Users</span>
													
												</th>
												<td class="nk-tb-col">
													<span>{{ $first_week_no_users }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $second_week_no_users }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $third_week_no_users }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_week_no_users }}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Times log-in</span>
													
												</th>
												<td class="nk-tb-col">
													<span>{{ $first_week_total_logins }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $second_week_total_logins }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $third_week_total_logins }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_week_total_logins }}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Time spent</span>
													
												</th>
												<td class="nk-tb-col">
													<span>{{ $first_week_total_spend_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $second_week_total_spend_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $third_week_total_spend_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_week_total_spend_time }}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Idle time</span>
													
												</th>
												<td class="nk-tb-col">
													<span>{{ $first_week_idle_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $second_week_idle_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $third_week_idle_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_week_idle_time }}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Points</span>
													
												</th>
												<td class="nk-tb-col">
													<span>{{ $first_week_point }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $second_week_point }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $third_week_point }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_week_point }}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											
											
											
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tabItem3">
									<div class="table-responsive">
									<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
										<thead>
											<tr class="nk-tb-item nk-tb-head">
												<th class="nk-tb-col"><span class="sub-text">Level/Monthly</span></th>
												<th class="nk-tb-col"><span class="sub-text">Jan</span></th>
												<th class="nk-tb-col"><span class="sub-text">Feb</span></th>
												<th class="nk-tb-col"><span class="sub-text">Mar</span></th>
												<th class="nk-tb-col"><span class="sub-text">Apr</span></th>
												<th class="nk-tb-col"><span class="sub-text">May</span></th>
												<th class="nk-tb-col"><span class="sub-text">Jun</span></th>
												<th class="nk-tb-col"><span class="sub-text">Jul</span></th>
												<th class="nk-tb-col"><span class="sub-text">Aug</span></th>
												<th class="nk-tb-col"><span class="sub-text">Sep</span></th>
												<th class="nk-tb-col"><span class="sub-text">Oct</span></th>
												<th class="nk-tb-col"><span class="sub-text">Nov</span></th>
												<th class="nk-tb-col"><span class="sub-text">Dec</span></th>
												
											</tr>
										</thead>
										<tbody>
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>No. Of Users</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jan_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $feb_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $mar_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $apr_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $may_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $jun_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $jul_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $aug_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $sep_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $oct_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $nov_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $dec_no_users}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Times log-in</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
														<span>{{ $jan_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $feb_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $mar_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $apr_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $may_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jun_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jul_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $aug_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $sep_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $oct_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $nov_total_login}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $dec_total_login}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Time spent</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jan_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $feb_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $mar_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $apr_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $may_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jun_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jul_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $aug_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $sep_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $oct_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $nov_time_spend}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $dec_time_spend}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Idle time</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jan_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $feb_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $mar_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $apr_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $may_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jun_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jul_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $aug_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $sep_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $oct_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $nov_idle_time}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $dec_idle_time}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Points</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jan_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $feb_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $mar_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $apr_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $may_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jun_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $jul_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $aug_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $sep_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $oct_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $nov_points}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $dec_points}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											
											
											
										</tbody>
									</table>
									</div>
								</div>
								<div class="tab-pane" id="tabItem4">
									<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
										<thead>
											<tr class="nk-tb-item nk-tb-head">
												<th class="nk-tb-col"><span class="sub-text">Level/Quarterly</span></th>
												<th class="nk-tb-col"><span class="sub-text">Jan-Mar</span></th>
												<th class="nk-tb-col"><span class="sub-text">Apr-Jun</span></th>
												<th class="nk-tb-col"><span class="sub-text">Jul-Sep</span></th>
												<th class="nk-tb-col"><span class="sub-text">Oct-Dec</span></th>
												
												
											</tr>
										</thead>
										<tbody>
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>No. Of Users</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{$first_quater_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{$second_quater_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $third_quater_no_users}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{$four_quater_no_users}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Times log-in</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $first_quater_total_logins}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $second_quater_total_logins}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $third_quater_total_logins}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_quater_total_logins}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Time spent</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $first_quater_total_spend_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $second_quater_total_spend_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $third_quater_total_spend_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_quater_total_spend_time }}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Idle time</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $first_quater_idle_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $second_quater_idle_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span></span><span>{{ $third_quater_idle_time }}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_quater_idle_time }}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											<tr class="nk-tb-item">
												<th class="nk-tb-col">
													<span>Points</span>
													
												</th>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $first_quater_point}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
												<span>{{ $second_quater_point}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $third_quater_point}}</span>
												</td>
												<td class="nk-tb-col tb-col-md">
													<span>{{ $four_quater_point}}</span>
												</td>
												
											</tr><!-- .nk-tb-item  -->
											
											
											
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
            
        </div>
    </div>
</div>
</div>


@endsection