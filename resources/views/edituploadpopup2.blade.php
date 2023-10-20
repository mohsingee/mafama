@extends('layouts.admin') 
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Upload Business Category2 Popup</h3>
					
				</div><!-- .nk-block-head-content -->
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
								<form id="register" method="POST" enctype="multipart/form-data">
								@csrf	
									<input type="hidden" name="id" value="<?= $popups->id ?>">
									<div class="row gy-4">
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Upload Image</label>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="imgInp" name="img_path">
													<label class="custom-file-label" for="imgInp">Choose file</label>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="form-label" for="">Lead Category</label>
												<input class="form-control" type="text" name="category" value="{{ $category->category }}" readonly>
											</div>
										</div>
										<div class="col-md-6">
			                                <div class="form-group">
			                                    <label class="form-label">Background color</label>
			                                    <input
			                                        class="form-control demo-input"
			                                        data-huebee='{"hues": 24,
			                                                "staticOpen": true }'
			                                        value="{{ $popups->background }}"
			                                        style="background-color: {{ $popups->background }}; color: white;"
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
			                                        value="{{ $popups->fontcolor }}"
			                                        style="background-color: {{ $popups->fontcolor }}; color: white;"
			                                    />
			                                </div>
			                            </div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="form-label" for="">Category Description</label>
												<textarea name="editor1" class="editor1">{{ $popups->description }}</textarea>
											</div>
										</div>
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="appndbanner" style="display: none;">
	<div class="user_banner"><div style="text-align: center;"><img class="popimg" src="" style="width: auto; height: 200px; max-width: 100%"></div><div class="description"></div></div>
</div>
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
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
            url: "<?php echo url('/'); ?>/image_update_banner2",
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
            var upid = $("input[name='id']").val(); 
            $.ajax({
                url: '<?php echo url('/'); ?>/uploadpopup2_update',
                data: 'preview=' + preview + '&background=' + bgcolor + '&message=' + message + '&fontcolor=' + fncolor + '&img=' + img + '&category=' + category + '&id=' + upid +'&_token={{ csrf_token() }}',
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