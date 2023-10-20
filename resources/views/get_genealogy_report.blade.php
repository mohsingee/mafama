@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="">
					<h3 class="nk-block-title page-title"   style="width:900px;">Genealogy Report</h3>
				</div>
					<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div>
							<form action="" method="get">
								{{-- @csrf --}} 
								<div class="d-flex" style="margin: 0px auto;gap: 10px;display: flex;justify-content: center;">
								    <div class="" style="width: 15%;">
										<select name="country" id="country_report" class="form-control custom-form-control ">
											<option value="">Select Country</option>
											
											@foreach($users as $user)
											<option value="{{ @$user['country'] }}" {{ (Request::get('country') == @$user['country'] ) ? 'selected' : '' }}>{{ @$user['country'] }}</option>
											@endforeach
										</select>
									</div>
									
									<div class="" style="width: 25%;">
										<select name="state" id="state_report" class="form-control custom-form-control ">
											<option value="">Select State/Commune/Province</option>
											@foreach($users as $user)
											<option value="{{ @$user['state'] }}" {{ (Request::get('state') == @$user['state'] ) ? 'selected' : '' }}>{{ @$user['state'] }}</option>
											@endforeach
										</select>
									</div>
									
									<div class="" style="width: 25%;">
										<select name="year" id="year_report" class="form-control custom-form-control ">
											<option value="">Select Year</option>
											<option value="2021" {{ (Request::get('year') == '2021' ) ? 'selected' : '' }}>2021</option>
											<option value="2022" {{ (Request::get('year') == '2022' ) ? 'selected' : '' }}>2022</option>
											<option value="2023" {{ (Request::get('year') == '2023' ) ? 'selected' : '' }}>2023</option>
										</select>
									</div>
									<div class="" style="width: 25%;">
										<select name="month" id="month_report" class="form-control custom-form-control">
											<option value="">Select Month</option>
											<option value="01" {{ (Request::get('month') == '01' ) ? 'selected' : '' }}>January</option>
											<option value="02" {{ (Request::get('month') == '02' ) ? 'selected' : '' }}>February</option>
											<option value="03" {{ (Request::get('month') == '03' ) ? 'selected' : '' }}>March</option>
											<option value="04" {{ (Request::get('month') == '04' ) ? 'selected' : '' }}>April</option>
											<option value="05" {{ (Request::get('month') == '05' ) ? 'selected' : '' }}>May</option>
											<option value="06" {{ (Request::get('month') == '06' ) ? 'selected' : '' }}>June</option>
											<option value="07" {{ (Request::get('month') == '07' ) ? 'selected' : '' }}>July</option>
											<option value="08" {{ (Request::get('month') == '08' ) ? 'selected' : '' }}>August</option>
											<option value="09" {{ (Request::get('month') == '09' ) ? 'selected' : '' }}>September</option>
											<option value="10" {{ (Request::get('month') == '10' ) ? 'selected' : '' }}>October</option>
											<option value="11" {{ (Request::get('month') == '11' ) ? 'selected' : '' }}>November</option>
											<option value="12" {{ (Request::get('month') == '12' ) ? 'selected' : '' }}>December</option>
										</select>
									</div>
									<div class="" style="width: 10%">
										<button type="submit" class="btn btn-primary submit_filter">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<div class="card-aside-wrap">
							<div class="">
								<table class="datatable-init nk-tb-list nk-tb-ulist" id="datatable_sample">
            						<thead>
            							<tr>
            								<th>Name</th>
            								<th>Upline</th>
            								<th>Downlines</th>
            								<th>Joining Date</th>
            								<th>Joining Time</th>
            								<th>Email</th>
            								<th>Telephone</th>
            								<th>Country of Birth</th>
            								<th>Country of Residence</th>
            								<th>state</th>
            							</tr>
            						</thead>
            						<tbody>
            							@foreach($users as $user)
            							{{-- @dd($users[0]) --}}
            							@php($new_user = \App\User::where('email', $user['email'])->get()->first())
            							@if(@$new_user)
            							@php($new_user = $new_user->toArray())
            							@endif
            							
            							<tr>
            								<td style="text-align: left;">{{ @$new_user['name'] }}</td>
            								<td>
            								    @if(@$new_user['total_uplines'] > 0)
            								    <a href="javascript:void(0)" class="hmd_uplines_ajax" user-id="{{ @$new_user['id'] }}">
            								    {{ @$new_user['total_uplines'] }}
            								    </a>
            								    @else
            								        {{ @$new_user['total_uplines'] }}
            								    @endif
            								</td>
            								<td>
            								    
            								     @if(@$new_user['total_uplines'] > 0)
            								    <a href="javascript:void(0)" class="hmd_downlines_ajax" user-id="{{ @$new_user['id'] }}">
                								    {{ @$new_user['direct_members'] }}
            								    </a>
            								    @else
            								        {{ @$new_user['direct_members'] }}
            								    @endif
            								    
            								</td>
            								<td>{{ date_format(date_create(@$user['joining_date']),"Y/m/d") }}</td>
            								<td>{{ date_format(date_create(@$user['joining_date']),"H:i:s") }}</td>
            								<td style="text-align: left;">{{ @$user['email'] }}</td>
            								<td>{{ @$user['cellphone'] }}</td>
            								<td>{{ @$user['birth_country'] }}</td>
            								<td>{{ @$user['country'] }}</td>
            								<td>{{ @$user['state'] }}</td>
            							</tr>
            							@endforeach
            						</tbody>
            					</table>
							</div>
						</div>
						
						<div class="card-aside-wrap">
						    <div class="">
                    			<table class="datatable-init nk-tb-list nk-tb-ulist" id="genealogy_user_detials_datatable">
                    				<thead>
                    					<tr>
                    						<th>Name</th>
                    						<th>Upline</th>
                    						<th>Downlines</th>
                    						<th>Joining Date</th>
                    						<th>Joining Time</th>
                    						<th>Email</th>
                    						<th>Telephone</th>
                    						<th>Country of Birth</th>
                    						<th>Country of Residence</th>
                    						<th>state/Commune/Province</th>
                    					</tr>
                    				</thead>
                    				<tbody id="append_genealogy_report">
                    				
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

@endsection


