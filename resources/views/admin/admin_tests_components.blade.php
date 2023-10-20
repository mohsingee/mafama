 @extends('layouts.admin') 
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
<style>  
.borderless tr td, .borderless tr th {    
    text-align: left;
}
div#dynamic_form_data .remove1 {
    display: none;
}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				
				<div class="nk-block-head-content" style="margin-bottom:20px;display:flex;">
						<h3 class="nk-block-title page-title"   style="width:935px;">Tests Components</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
					@if(permission_access('test_components_add')==1)
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form action="{{url('update_admin_tests_components')}}"  method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label"> Component Name</label>
												<input type="text" class="form-control"   name="component" placeholder="" value="{{ $form ? $form->component:''}}" required>
											</div>
										</div>
                                      <div class="col-md-6">
											<div class="form-group">
												<label class="form-label"> Standard Value</label>
												<input type="text" class="form-control"   name="standard_value" placeholder="" value="{{ $form ? $form->standard_value:''}}" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label"> Component Description</label>
												
												<textarea name="bonus_message_day" class="editor1" rows="10">{{ $form ?$form->description:''}}</textarea>
											</div>
										</div>
										
									</div>
									<div class="clearfix"></div>	
									
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
										<input type="hidden" name="id" value="{{ $form ?$form->id:''}}" >
										<input type="submit" class="btn btn-lg btn-primary btn4" value="{{ $form ? 'Update':'Submit'}}">
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
				@endif
					<div class="nk-block">
					<div class="col-md-12" style="margin-bottom:20px;padding:0px;">
						<h4>Components List</h4>
						
					</div>
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							
							<div class="card-inner">
								
								<div class="">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead  class="thead-light">
										<tr  class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Component Name</th>
											<th class="nk-tb-col"><span class="sub-text">Description</th>
												<th class="nk-tb-col"><span class="sub-text">Standard Value</th>
											
											<th class="nk-tb-col"><span class="sub-text">Created At</th>
											<th class="nk-tb-col"><span class="sub-text">Actions</th>	
											
										</tr>
									</thead>
									<tbody>
										@if(!empty($forms))
										@foreach($forms as $form)
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span> {{$form->component}}</span>
											</td>
											<td class="nk-tb-col">
												<span> {!!$form->description!!}</span>
											</td>
											<td class="nk-tb-col">
												<span> {{$form->standard_value}}</span>
											</td>
											 <td class="nk-tb-col">
												<span>{{ date('m-d-Y',strtotime($form->created_at))}}</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if($form->status==0)
                                                <a data-id="{{$form->id }}" data-list="test_components" href="javascript:void(0)" class="btn btn-sm btn-info approve_coponent">Approve</a>  
												@endif
												@if(permission_access('test_components_edit')==1)
												<a href="{{url('admin/tests_components/'.$form->id )}}" class="btn btn-sm btn-success">Edit</a>
												<br>
												@endif
												@if(permission_access('test_components_delete')==1)
												<a data-id="{{$form->id }}" data-list="test_components" href="javascript:void(0)" class="btn btn-sm btn-success deleterow">Delete</a>
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
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
	 CKEDITOR.replace('bonus_message_day');
	 
</script>
@endsection