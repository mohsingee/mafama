@extends('layouts.admin') 
@section('content')
<style type="text/css">
	.modal-body {
		margin-top: 20px;
		max-height: 500px;
		overflow-y: auto;
	}
	.ml-20{
		margin-left: 20px
	}
</style>
<div class="nk-content ">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head-content" style="margin-bottom:20px;">
					<h3 class="nk-block-title page-title">Popup Settings</h3>
					
				</div>
				<div class="nk-block">
					<div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
							<div class="card-inner card-inner-lg">
							  @if(permission_access('settings_popup_add')==1)	
								<form action="{{ url('popup_settings_submit') }}" method="POST" enctype="multipart/form-data">
								@csrf	
									<div class="row gy-4">
										<div class="col-md-6">
			                                <div class="form-group">
			                                    <label class="form-label">Send Email in popup</label>
			                                    <div>
				                                    <input type="radio" name="email_status" value="1" <?=isset($popups->id) && ($popups->email_status ==1) ?'checked':'checked';?>> On
				                                    <input type="radio" name="email_status" value="0" class="ml-20" <?=isset($popups->id) && ($popups->email_status ==0) ?'checked':'';?>> Off
				                                </div>
			                                </div>
			                            </div>
			                            <div class="col-md-6">
			                                <div class="form-group">
			                                    <label class="form-label">Choose Category</label>
			                                    <div>
				                                    <input type="radio" name="category" value="1" <?=isset($popups->id) && ($popups->category ==1) ?'checked':'checked';?>> Business Category1
				                                    <input type="radio" name="category" value="2" class="ml-20" <?=isset($popups->id) && ($popups->category == 2) ?'checked':'';?>> Business Category2
				                                </div>
			                                </div>
			                            </div>
			                            <div class="col-md-6 time-div" style="@if($popups != "") @if($popups->email_status == 0) display:none; @endif @else display:none; @endif">
			                                <div class="form-group">
			                                    <label class="form-label">Can't send popup within (hours)</label>
			                                    <input name="time_difference" class="form-control" type="number" value="<?=isset($popups->id) ?$popups->time_difference:'';?>" @if($popups != "") @if($popups->email_status == 1) required @endif @endif />
			                                </div>
			                            </div>
										
										<div class="col-12">
											<input type="submit" class="btn btn-sm btn-primary" value="Save">
										</div>
									</div>
								</form>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on("change", "input[name='email_status']", function() { 
        var val = "";
	    if($(this).val()==1){
	        $('.time-div').css('display','block');
	        $("input[name='time_difference']").attr('required', 'required');
	        val = 1;
	    }else{
	         $('.time-div').css('display','none');
	         $("input[name='time_difference']").val('');
	         $("input[name='time_difference']").removeAttr('required');
	    }
    });
</script>
@endsection