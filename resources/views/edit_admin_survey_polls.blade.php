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
                    <h3 class="nk-block-title page-title">Terms & Conditions</h3>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <form id="" action="{{ url('admin_survey_update') }}" method="POST" enctype="multipart/form-data">	
									@csrf
                                    <div class="row gy-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Business Category</label>
                                                <select name="category_id" class="form-control select2" required="">
                                                    @foreach($categories as $cate)
                                                     <option value="{{$cate->id}}"  {{ isset($survey->category_id) && $survey->category_id==$cate->id?'selected':''}}>{{$cate->category}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Question</label>
                                                <input type="text" class="form-control" name="question" value="{{ $survey->question }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding-top:0px;padding-bottom:0px">
                                            <a href="javascript:void(0)" class="btn btn-xs btn-info pull-right  add_option" >Add more option</a>
                                       </div>
                                       <div class="row" id="options_data">
                                         @php
                                             $j=0;
                                            @endphp
                                         @if(!empty($survey->options))
                                           
                                             @foreach(json_decode($survey->options,true) as $option)
                                              <div class="col-md-6 remove_div">
                                          
                                                <label class="form-label">Option {{$j++}}</label> 
                                                @if($j==2 || $j==3) @else <a href="javascript:void(0)" style="float:right" class="remove4"><i class="fa fa-minus text-danger "></i></a>  @endif
                                                
                                                

                                                <input type="text" class="form-control" name="option[]" value="{{ $option }}" required>
                                            
                                        </div>
                                             @endforeach
                                            @endif
                                             
                                        </div>
                                        <div class="col-12">
                                            <input type="hidden" name="id" value="{{ $survey->id }}">
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

<script type="text/javascript">
     var i="{{$j}}";
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