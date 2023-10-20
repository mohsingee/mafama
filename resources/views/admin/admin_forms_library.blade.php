@extends('layouts.admin') 
@section('content')
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
						<h3 class="nk-block-title page-title"   style="width:935px;">Form Library</h3>
						<a href="{{ url('admin') }}" class="btn btn-sm btn-primary" style="float:right;">Back</a>
					</div><!-- .nk-block-head-content -->
					@if(permission_access('forms_library_add')==1) 
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="form2"  method="POST" id="" enctype="multipart/form-data">	
									@csrf
									
									<div class="row gy-4" style="padding-bottom:20px;">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label"> Library Form Name</label>
												<input type="text" class="form-control"   name="form_name" placeholder="" value="{{ $form ? $form->name:''}}" required>
											</div>
										</div>
										<div class="col-md-6">
										    
											<div class="form-group">
												<label class="form-label"> Form Category</label>
												<select class="form-control" name="form_cat_id" required="">
													<!-- <option value="">Select</option> -->
													@foreach($form_cats as $cat)
                                                     <option value="{{ $cat->id }}" {{ !empty($form) && ($form->form_cat_id == $cat->id)?'selected':'' }}>{{ $cat->cat_name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-6">
										    
											<div class="form-group">
												<label class="form-label"> Business Category</label>
												<select class="form-control" name="business_cat_id" required="">
													<!-- <option value="">Select</option> -->
													@foreach($buniness_categories as $cat)
                                                     <option value="{{ $cat->id }}" {{ !empty($form) && ($form->business_cat_id == $cat->id)?'selected':'' }}>{{ $cat->category }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-6">
										    
											<div class="form-group">
												<label class="form-label"> Upload File</label>
												<input type="file" class="form-control" name="file_path"   >
											</div>
											<input type="hidden" name="id" value="{{ $form ? $form->id:''}}">
											<input type="hidden" name="file_path1" value="{{ $form ? $form->file_path:''}}">
											@if(!empty($form->file_path))
                                              <br>
                                              <br>
											<a href="{{ asset('public/files/'.$form->file_path)}}"  target="_blank"> View File</a>
											@endif
										</div>
										
										<div class="col-md-6">
											<button type="button" data-toggle="modal" data-target="#DynamicFormModal" class="btn btn-xs btn-success">
												Create dynamic form fields
											</button>
										</div>
									</div>
									<div class="clearfix"></div>	
									<div class="row" id="dynamic_form_data">
										{!! $form ? $form->form_data:''!!}
									</div>
									
									<div class="col-md-12" style="margin-top:40px; text-align:center;">
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
						<h4>Library Forms</h4>
						
					</div>
					<div class="card card-bordered card-stretch">
						<div class="card-inner-group">
							
							<div class="card-inner">
								
								<div class="">
								<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
									<thead  class="thead-light">
										<tr  class="nk-tb-item nk-tb-head">
											<th class="nk-tb-col"><span class="sub-text">Form Name</th>
											<th class="nk-tb-col"><span class="sub-text">Business Category</th>
											<th class="nk-tb-col"><span class="sub-text">Form Category</th>
												<th class="nk-tb-col"><span class="sub-text">File</th>
												<th class="nk-tb-col"><span class="sub-text">Created At</th>
											<th class="nk-tb-col"><span class="sub-text">Actions</th>	
											
										</tr>
									</thead>
									<tbody>
										@if(!empty($forms))
										@foreach($forms as $form)
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span> {{$form->name}}</span>
											</td>
											<td class="nk-tb-col">
												<span> {{$form->business_cat}}</span>
											</td>
											<td class="nk-tb-col">
												<span> {{$form->cat_name}}</span>
											</td>
											<td class="nk-tb-col">
											<span> 
											@if(!empty($form->file_path))
											<a href="{{ asset('public/files/'.$form->file_path)}}"  target="_blank"> View File</a>
											@endif
										    </span>
											</td>
											
											 <td class="nk-tb-col">
												<span>{{ date('m-d-Y',strtotime($form->created_at))}}</span>
											</td>
											<td class="nk-tb-col tb-col-md">
												@if(permission_access('forms_library_edit')==1) 
												<a href="{{url('admin/forms_library/'.$form->id )}}" class="btn btn-sm btn-success">Edit</a>
												@endif
												<br>
												@if(permission_access('forms_library_delete')==1) 
												<a data-id="{{$form->id }}" data-list="library_forms" href="javascript:void(0)" class="btn btn-sm btn-success deleterow">Delete</a>
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
<div id="DynamicFormModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" style="text-align-last: center" > Create Dynamic Form fields</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" id="form1">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                    <div class="col-md-12">
						
							<label class="form-label"> Field Label Name</label>
							<input type="text" class="form-control" id="label_name" placeholder="Label Name"  required>
						
					</div>
					<div class="col-md-12">
						
							<label class="form-label"> Field  Name (<i>please do not make space between name</i>)</label>
							<input type="text" class="form-control" id="field_name" placeholder="Field Name"  required>
						
					</div>				
					<div class="col-md-12">
                        
							<label class="form-label"> Field Placeholder </label>
							<input type="text" class="form-control" id="placeholder" placeholder="Placeholder"  >
						
                    </div>
                     <div class="col-md-12">
					
							<label class="form-label"> Field Type </label>
							<select id="field_type"  required="" class="form-control">
								<option value="text">Input Text</option>
							<!-- 	<option value="file">Input File</option> -->
								<option value="email">Input Email</option>
								<option value="number">Input Number</option>
								<option value="date">Input Date</option>
								<option value="checkbox">Input Checkbox</option>
								<option value="radio">Input Radio</option>
								<option value="textarea">Input Textarea</option>
								
							</select>
							<div class="add_option1" style="display: none">
							<a href="javascript:void(0)" class="btn btn-xs btn-info add_option" >Add option</a>
							</div>
							
							<div id="options_data"></div>
							
					
					</div>
                    <!-- <div class="col-md-12">
					
							<label class="form-label">Is Field Required </label>
							<select id="is_required" required="" class="form-control">
								
								<option value="no">Not Required</option>
								<option value="yes">Required</option>
							</select>
					
					</div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-info add_new_field" >Add</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#form2").submit(function(e)
{    e.preventDefault();    
      //var _token= $('input[name="_token"]').val();
    
        $elm=$(".btn4");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var dynamic_form_data=$("#dynamic_form_data").html();
        var formData = new FormData(this);
            formData.append('form_data',dynamic_form_data);
        $.ajax({
            method: 'POST',
            url: "{{ url('update_admin_forms_library') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
               location.reload();
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
            error: function(data) {
            }
        });  
});
    $(document).on('change','#field_type',function(){
         $("#options_data").html('');
    	var field_type=$(this).val();
    	if(field_type=='checkbox' || field_type == 'radio'){
           $(".add_option1").css('display','block');
    	}else{
    		$(".add_option1").css('display','none');
    		$("#options_data").html('');
    	}
    });
    var i=0;
    $(document).on('click','.add_option',function(){
    	    i++;
    	  var name=$("#field_name").val();
          var type=$("#field_type").val();
    	$("#options_data").append('<span style="margin-right:6px;margin-bottom:10px"> <label   class="form-label"><input type="'+type+'" name="'+name+'" > <span contenteditable>   Option name </span>  </label><a  href="javascript:void(0)" class="remove1"><i class="fa fa-minus text-danger rem"></i></a></span>');
    });
    
    $("#options_data").on("click",".remove1", function(e){ 
		e.preventDefault(); $(this).parent('span').remove(); i--;
	});
    $(document).on('click','.add_new_field',function(){
      
      var label=$("#label_name").val();
      var name=$("#field_name").val();
      var type=$("#field_type").val();
      var required='';//$("#is_required").val();
      var placeholder=$("#placeholder").val();
      
     if(type=='checkbox' || type == 'radio'){
     	var options_data=$("#options_data").html();
     	options_data.replace("contenteditable", "");
     	$("#dynamic_form_data").append(
      	'<div class="col-md-6 remove_div">'                        
		+'<label class="form-label">'+label+'</label><a href="javascript:void(0)" style="float:right" class="remove2"><i class="fa fa-minus text-danger rem"></i></a><br>'
		+options_data+''						
        +'</div>');
        $("#options_data").html('');
     }else if(type =='textarea'){
        $("#dynamic_form_data").append(
      	'<div class="col-md-6 remove_div">'                        
		+'<label class="form-label">'+label+'</label><a href="javascript:void(0)" style="float:right" class="remove2"><i class="fa fa-minus text-danger "></i></a>'
		+'<textarea type="'+type+'" rows="3" class="form-control" name="'+name+'" placeholder="'+placeholder+'" '+ required +'></textarea>'						
        +'</div>');
     } else{ 
      $("#dynamic_form_data").append(
      	'<div class="col-md-6 remove_div">'                        
		+'<label class="form-label">'+label+'</label><a href="javascript:void(0)" style="float:right" class="remove2"><i class="fa fa-minus text-danger "></i></a>'
		+'<input type="'+type+'" class="form-control" name="'+name+'" placeholder="'+placeholder+'" '+ required +' value="">'						
        +'</div>');
        }
      $("#DynamicFormModal").modal('hide');
      $("#form1")[0].reset();
    
    });
    $("#dynamic_form_data").on("click",".remove2", function(e){ 
		e.preventDefault(); $(this).parent('.remove_div').remove(); 
	})
</script>
@endsection