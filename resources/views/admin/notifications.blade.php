@extends('layouts.admin') 
@section('content')
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
					<h3 class="nk-block-title page-title"   style="width:880px;">Notification CMS</h3>

				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{url('add_edit_notification_cms')}}"  method="POST"  enctype="multipart/form-data">
									@csrf

									<div class="row gy-4" style="padding-bottom:20px;">

										<div class="col-md-6">

											<div class="form-group">
												<label class="form-label"> Actions</label>
												<select class="form-control select2" name="action_id" required="">
													<option value="">Select</option>
													@foreach($action_list as $key=>$list)
                                                     <option value="{{$key}}"  {{ !empty($form) && ($form->action_id == $key)?'selected':'' }}>{{$list}}</option>
                                                     @endforeach

												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label"> Message</label>

												<textarea name="message" class="form-control" required="">{{ $form ? $form->message:''}}</textarea>
											</div>
										</div>

									</div>
									<div class="clearfix"></div>


									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="hidden" name="id" value="{{ $form ? $form->id:''}}">
										<input type="submit" class="btn btn-lg btn-primary btn4" value="{{ $form ? 'Update':'Submit'}}">
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							<div class="col-md-12">
								
							</div>
							<div class="card-inner">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead>
										<tr class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">#ID</span></th>
											<th class="nk-tb-col"><span class="sub-text">Action</span></th>
											<th class="nk-tb-col"><span class="sub-text">Message</span></th>

											<th class="nk-tb-col"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										@if($notifications->count() >0)
										 @foreach($notifications as $value)
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span>{{$i++}}.</span>
											</td>
											<td class="nk-tb-col">
												<span>{{getAllActionList()[$value->action_id]}}</span>
											</td>

											<td class="nk-tb-col">
												<span>{{$value->message}}</span>
											</td>
											
											<td class="nk-tb-col">
												<a href="{{ url('admin/notification-cms/'.$value->id) }}" class="btn btn-xs btn-primary">Edit</a>
												<!--<a data-id="{{$value->id }}"   data-list="cms_notifications" href="javascript:void(0)" class="btn btn-xs btn-success deleterow">Delete</a>-->
											</td>
											
										</tr><!-- .nk-tb-item  -->
										@endforeach
										@endif
										
									</tbody>
								</table>
							</div>
						</div><!-- .card-inner-group -->
					</div><!-- .card -->
				</div><!-- .nk-block -->
				
				
				
			</div>
		</div>
	</div>
</div>
@endsection