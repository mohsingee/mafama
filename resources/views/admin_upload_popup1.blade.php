@extends('layouts.admin') 
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
<style type="text/css">
	.modal-body {
		margin-top: 20px;
		max-height: 500px;
		overflow-y: auto;
	}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Upload Business Category1 Popup</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<!-- <form id="" action="{{ url('uploadbusiness_entry') }}" method="POST" enctype="multipart/form-data">	 -->
							 @if(permission_access('uploadsone_popup_add')==1)		
								<form id="register" method="POST" enctype="multipart/form-data">
								@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
			                                <div class="form-group">
			                                    <label class="form-label">Background color</label>
			                                    <input
			                                        class="form-control demo-input"
			                                        data-huebee='{"hues": 24,
			                                                "staticOpen": true }'
			                                        value="#7E8"
			                                        style="background-color: rgb(204, 34, 85); color: white;"
			                                    />
			                                </div>
			                            </div>
			                            <div class="col-md-6">
			                                <div class="form-group">
			                                    <label class="form-label">Font Text color</label>
			                                    <input
			                                        class="form-control demo-input1"
			                                        data-huebee='{"hues": 24,
			                                                "staticOpen": true }'
			                                        value="#7E8"
			                                        style="background-color: rgb(204, 34, 85); color: white;"
			                                    />
			                                </div>
			                            </div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Upload Image</label>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="imgInp" name="img_path" required>
													<label class="custom-file-label" for="imgInp">Choose file</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Category Business</label>
												<select class="form-control form-select select2-hidden-accessible" data-search="on" tabindex="-1" aria-hidden="true" data-select2-id="1" name="category" id="category" required>
													<?php 
													foreach ($category as $value) {
													?>
													  	<option value="<?= $value->id ?>"><?= $value->category ?></option>
													<?php
													}
													?>
												</select>
												@if($errors->any())
													<p style="color: red">{{$errors->first()}}</p>
												@endif
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label" for="">Category Description</label>
												<!-- <textarea class="form-control summernote" style="height: 70px;"></textarea> -->
												<textarea name="editor1" class="editor1"></textarea>
											</div>
										</div>
										
										<div class="col-12">
											<a class="btn btn-sm btn-danger prvbtn">Preview</a>
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
								@endif
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
											<th class="nk-tb-col"><span class="sub-text">Id</span></th>
											<th class="nk-tb-col"><span class="sub-text">Category Business</span></th>
											<th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 1;
						                  	foreach ($popups as $popup) {
						                ?>
										<tr class="nk-tb-item">
											<td class="nk-tb-col">
												<span><?= $i ?></span>
											</td>
											<td class="nk-tb-col">
												<span><?= $popup->category ?></span>
											</td>
											
											<td class="nk-tb-col tb-col-md">
												 @if(permission_access('uploadsone_popup_edit')==1)
												<a href="<?php echo url('edituploadpopup1') ?>/<?= $popup->aid ?>" class="btn btn-sm btn-primary">Edit</a>
												@endif
												 @if(permission_access('uploadsone_popup_delete')==1)
												<a href="<?php echo url('deleteuploadpopup1') ?>/<?= $popup->aid ?>" class="btn btn-sm btn-danger">Delete</a>
												@endif
												 @if(permission_access('uploadsone_popup_view')==1)
												<a href="#" data-toggle="modal" data-target="#modall{{ $popup->aid }}" class="btn btn-sm btn-danger">View</a>
												@endif
												<div id="modall{{ $popup->aid }}" class="modal fade" role='dialog'>
												    <div class="modal-dialog">
												        <div class="modal-content" style="background: white">
												            <div class="modal-body">
												                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												                <div>
												                	{!! $popup->preview !!}
												                </div>
												            </div>
												        </div>
												    </div>
												</div>
											</td>
										</tr>
										<?php 
											$i++;
											} 
										?>
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
<div class="appndbanner" style="display: none;">
	<div class="user_banner"><div style="text-align: center;"><img class="popimg" src="" style="width: auto; height: 200px; max-width: 100%"></div><div class="description"></div></div>
</div>
<div id="modall" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content" style="background: white">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div  id= "modal-body"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script>
    CKEDITOR.replace( 'editor1' );
    $(".prvbtn").click(function(){
    	// alert(CKEDITOR.instances['editor1'].getData());
        var background      = $(".demo-input").css("background-color");
        var message         = CKEDITOR.instances['editor1'].getData();
        var fontcolor       = $(".demo-input1").css("background-color");
        $(".user_banner").css("background-color", background);
        $(".user_banner").css("color", fontcolor);
        $(".user_banner").css("padding", "15px");
        $(".description").html(message);
        // $(".description").css("border","1px solid "+fontcolor);
        // $(".description").css("border-radius","4px");
        $(".description").css("padding","10px");
        var preview = $(".appndbanner").html();
        $("#modall #modal-body").html(preview);   
        $('#modall').modal('show');
    });
    $("#register").submit(function(e) {
            //---------------^---------------
        e.preventDefault();
        var formData = new FormData(this);
        var img = "";
        $.ajax({
            type: "POST",
            beforeSend: function(){
                $("#loading").show();
                $("#wrapper").hide();
            },
            url: "image_up_banner",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (response) {
                // alert(response);
                img = response;
            },
            complete: function(){
                $("#loading").hide();
                $("#wrapper").show();
            }
        })
        .then( function( data ) {
            var base_url = {!! json_encode(url('/')) !!};
            // alert(base_url);
            if(img != ""){
                $(".popimg").attr('src', base_url+"/public/videos/"+img);
                // $("#blah").html('<img src="'+base_url+'/public/videos/'+img+'>');
            }
            var testt = CKEDITOR.instances['editor1'].getData();
            // alert(testt);
            var background      = $(".demo-input").css("background-color");
            var message         = testt;
            var fontcolor       = $(".demo-input1").css("background-color");
            var bgcolor = $(".demo-input").val();
            var fncolor = $(".demo-input1").val();
            var category = $("#category").val();
            $(".user_banner").css("background-color", background);
            $(".user_banner").css("color", fontcolor);
            $(".user_banner").css("padding", "15px");
            $(".description").html(message);
            // $(".description").css("border","1px solid "+fontcolor);
            // $(".description").css("border-radius","4px");
            $(".description").css("padding","10px");
            var preview = $(".appndbanner").html();
            $.ajax({
                url: 'uploadpopup1_entry',
                data: 'preview=' + preview + '&background=' + bgcolor + '&message=' + message + '&fontcolor=' + fncolor + '&img=' + img + '&category=' + category +'&_token={{ csrf_token() }}',
                type: "POST",
                success: function (response) {
                	location.reload();
                    alert("Saved Succesfully.");
                    // $("#imgInp").val("");
                    // $("input[type=file]").val("");
                    // $('#business_name').val("");
                    // $('#address').val("");
                    // $('#phone_no').val("");
                    // $('#web_address').val("");
                    // $('.address-chk').prop('checked', false);
                }
            }) 
        }); 
    });
    function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $('.popimg').attr('src', e.target.result);
	      // $("#blah").html('<img src="'+e.target.result+'>');
	    }
	    
	    reader.readAsDataURL(input.files[0]); // convert to base64 string
	  }
	}
	$("#imgInp").change(function() {
	  readURL(this);
	});
</script>
@endsection