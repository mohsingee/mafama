@extends('layouts.admin') 
@section('content')
<style type="text/css">
    input.form-control.mdw {
    min-width: 400px;
}
</style>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom: 20px;">
                    <h3 class="nk-block-title page-title">Survey/Polls </h3>
                </div>
                <!-- .nk-block-head-content -->
                @if(permission_access('surveypolls_add')==1)
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <form id="" action="{{ url('admin_survey_entry') }}" method="POST" enctype="multipart/form-data">	
									@csrf
                                    <div class="row gy-4">
                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Business Category</label>
                                                <select name="category_id" class="form-control select2" required="">
                                                    @foreach($categories as $cate)
                                                     <option value="{{$cate->id}}">{{$cate->category}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Question</label>
                                                <input type="text" class="form-control" name="question" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Option 1</label>
                                                <input type="text" class="form-control" name="option[]" placeholder="Value" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Option 2</label>
                                                <input type="text" class="form-control" name="option[]" placeholder="Value" required >
                                            </div>
                                        </div>
                                       <div class="col-md-12" style="padding-top:0px;padding-bottom:0px">
                                            <a href="javascript:void(0)" class="btn btn-xs btn-info pull-right  add_option" >Add more option</a>
                                       </div>
                                      <div class="row" id="options_data"></div>  
                                        <div class="col-12">
                                            <input type="submit" class="btn btn-sm btn-primary" value="Save">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="col-md-12"></div>
                            <div class="card-inner">
                                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col"><span class="sub-text">Id</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Category</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Question</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Options</span></th>
                                           
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
											$i = 1;
						                  	foreach ($survey as $value) {
						                ?>
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col">
                                                <span><?= $value->id ?></span>
                                            </td>
                                              <td class="nk-tb-col">
                                                <span><?= $value->category ?></span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span><?= $value->question ?></span>
                                            </td>
                                            <td class="nk-tb-col">
                                                 @php
                                             $j=1;
                                            @endphp
                                            @if(!empty($value->options))
                                           
                                             @foreach(json_decode($value->options,true) as $option)
                                             <span class="text-capitalize"><b style="color:red">{{$j++}}.</b>{{$option}}, </span>
                                             @endforeach
                                            @endif
                                             
                                            </td>
                                            
                                           
                                            <td class="nk-tb-col tb-col-md">
                                                @if(permission_access('surveypolls_edit')==1)
                                                <a href="<?php echo url('edit_admin_survey') ?>/<?= $value->id ?>" class="btn btn-sm btn-success">Edit</a>
                                                @endif
                                                @if(permission_access('surveypolls_delete')==1)
                                                <a href="<?php echo url('delete_admin_survey') ?>/<?= $value->id ?>" class="btn btn-sm btn-danger">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php 
											$i++;
											} 
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- .card -->
                </div>
                <!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     var i=2;
    $(document).on('click','.add_option',function(){
            i++;
        
        $("#options_data").append('<div class="col-md-6 clearfix remove_div">'
          //  +'<div class="form-group">'               
             +'<label class="form-label">Option '+i+'</label><a href="javascript:void(0)" style="float:right" class="remove4"><i class="fa fa-minus text-danger "></i></a>'              
              +'<input type="text" class="form-control mdw" required name="option[]" placeholder="Value">'         
        //      +'</div>'
       +' </div>');
    });
    
    $(document).on("click",".remove4", function(e){ 
        e.preventDefault();
        $(this).parent('.remove_div').remove(); 
    })
</script>
@endsection