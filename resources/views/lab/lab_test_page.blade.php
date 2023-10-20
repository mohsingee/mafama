@extends('layouts.main') 
@section("content")
<style type="text/css">
    .btn-success {
        background: green !important;
        border: 1px solid green;
    }
    .btn-success, .btn-danger, .add_report_sec {
        height: 21px !important;
        line-height: 8px !important;
        font-size: 12px !important;
    }
    .tasks-divv {
        height: auto !important;
    }
    .tasks-divv table thead {
        background: none;
    }
    .tasks-divv table th {
        padding: 10px;

        margin: 0 10px;
    }
    .tasks-divv table td {
        padding: 0 10px;
    }
    .clientreport, .clientreport2 {
        border-bottom: 1px solid #d8d8d8;
    }
    .report_submit {
        float: right;
        right: 4px;
    }
    .confirmed {
        font-weight: bold;
        cursor: auto !important;
    }
     .profile-info td {
        text-align: left !important;
        /*font-size: 12px;*/
        padding: 0 2px;
        vertical-align: baseline;
    }
   .shadow-boxx {
    border: 1px solid #da291c73 !important;
    border-radius: 10px;
    padding-top: 20px;
    padding-bottom: 20px;
    box-shadow: 1px 4px 10px 3px #da291c57;
    height: 230px;
    color: #da291c;
}
.text-pink {
    color: #da291c;
    font-size: 16px;
}
.table1>tbody>tr>td {
    text-align: left !important;
    color: #da291c;
}
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="" style="padding-bottom: 40px;">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Client Management / Client Access</h4>
                        </div>
                       
                        @include('lab.lab_tabs')
                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="tab-pane fade in active" id="tab1">
                 
                        @if(empty($test_id) )    
                         
                         @if(!empty($client_id ))
                            <form action="{{ url('lab_test_add_edit_post') }}" class="" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Test Names</label>
                                            <textarea class="form-control" name="test_name" required="" placeholder="Test Names" ></textarea> 
                                        </div>
                                    </div> 
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Search Lab</label>
                                            <select name="lab_id"  class="form-control select2" >
                                             <option value=""> Select Lab</option>
                                                @if(count($lab_list) >0 )
                                                @foreach($lab_list as $list)
                                                <option value="{{ $list->lab_id }}">{{ $list->business_name }}</option>
                                                 @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>                                   
                                   
                                   
                                    <div class="col-md-12 text-center" style="margin-top: 25px;">
                                         <input type="hidden" name="client_id"  value="{{ $client_id }}">
                                        <button type="submit" class="btn btn-md btn-info" >Submit</button>
                                       
                                    </div>
                                </div>
                            </form>
                            @endif
                           
                        @else 

                          <form action="{{ url('lab_test_upload_file') }}" class="" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                           
                             @if($form->status==0)
                                <div class="col-md-12 text-center">
                                        <div class="form-group" style="font-size: 16px">
                                            <label class="form-label">{{$lab_name}}, Do you want to do this test ? Yes <input type="radio" class="mark-as-progress" data-cid="{{$id}}" data-id="{{$form->id}}"> 
                                                </label>
                                            
                                        </div>
                                </div> 
                             @else   
                                                                      
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Upload File</label>
                                            <input type="file" class="form-control" name="file"  required="" />
                                        </div>
                                       <!--  @if(!empty($form))
                                        <a href="{{ url('download_file/'.$form->id) }}" class="btn btn-xs btn-primary float-right"> Download</a>
                                        @endif
                                        <br>
                                         -->
                                        
                                    </div>
                                   
                                    <div class="col-md-6" style="margin-top: 25px;">
                                        <input id="id" type="hidden" name="id"value="{{ $test_id }}">
                                         <input type="hidden" name="client_id"  value="{{ $client_id }}">
                                         <input type="hidden" name="page_id"  value="{{ $id }}">
                                        <input  type="hidden" name="old_file" value="{{ $form ?$form->uploaded_file:''}}">
                                        <button type="submit" class="btn btn-md btn-info" >Submit</button>
                                       
                                    </div>
                             @endif

                                </div>
                            </form>


                        @endif 



                        <div class="col-md-12 lab-search-header" style="display: none">
                            <div class="col-md-4"> 
                                <h4 class="text-pink">Lab Test Results</h4>
                            </div>
                            <div class="col-md-4">
                                <h4 class="text-pink">Search Labs</h4>
                            </div>
                            <div class="col-md-4">  <a href="javascript:void(0)" class="btn btn-xs btn-info clearfilter" style="float: right">x</a></div>
                            <div class="clearfix"></div>
                        </div>     
                            <div class="col-sm-12">
                            <div class="col-md-5">
                            <div class="col-md-12 margin-bottom-20  text-center ordered_div_info" >
                                
                            </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                            <div class="col-md-12 margin-bottom-20  text-center completed_div_info" >
                                 
                            </div>
                            </div>
                            </div>
                       

                             <div class="col-md-12 padding-0 text-center margin-bottom-0" style="margin-bottom: 0px;padding-bottom: 0px">
                                        <h4 style="margin-bottom: 0px;">Lab Test</h4>
                            </div>
                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover table1" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>Date/Time</th>
                                            <th>Ordered By</th>
                                            <th>Completed By</th>
                                            <th>Test Names</th>
                                            <th>Upload</th>
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($lab_records) >0 )

                                        @foreach($lab_records as $lab)

                                        <tr>
                                         <td>{{date('M,d,Y :  h:i A',strtotime($lab->created_at))}}</td>
                                            <td><a class="get_ordered_info" data-email="{{$lab->email}}" data-id="{{$lab->id}}" style="color:red">{{$lab->name}}</a></td>
                                            <td>
                                              @if($lab->status==1)    
                                             @php 
                                             $user=\App\User::get_user_info($lab->completed_by);
                                             @endphp 
                                                <a class="get_completed_info" data-email="{{$user->email}}" data-id="{{$lab->id}}" style="color:red">{{$user->name}}</a>
                                              @else
                                               -
                                              @endif  
                                            </td>
                                            <td>{{$lab->test_name}}</td>
                                            <td>
                                                @if(!empty($lab->uploaded_file))
                                                <a href="{{ url('download_file/'.$lab->id) }}" class="btn btn-xs btn-primary float-right"> <i class="fa fa-download" aria-hidden="true"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($lab->status==0)
                                                <a href="javascript:void(0);" class="btn btn-xs btn-warning">pending</a>
                                                @elseif($lab->status==1)

                                                 <a href="javascript:void(0);" class="btn btn-xs btn-success"  style="padding-top: 5px" data-id="{{$lab->id }}" >Completed</a>

                                                @elseif($lab->status==2)
                                                  <a href="javascript:void(0);" class="btn btn-xs btn-primary">{{$lab->test_name}} in progress</a>
                                                @endif
                                            </td>
                                       
<div id="CommentModel{{$lab->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Comment</h4>
            </div>
            <form action="{{ url('update_lab_test_comment') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Comment</label>
                                <textarea class="form-control" rows="3" required="" name="comment">{{$lab->comment}}</textarea>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{$lab->id}}">
                    <input type="submit" class="btn btn-sm btn-primary" value="Save">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
                                        </tr>

                                        @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="clearfix"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
$(document).on('click','.clearfilter',function(){
 $(".lab-search-header").css('display','none');
 $(".completed_div_info").css('display','none');
 $(".ordered_div_info").css('display','none');
});
$(document).on("click", ".mark-as-progress", function () {
     if(confirm('Are you sure to do this test?'))
     {
     var id=$(this).attr('data-id');
     var cid=$(this).attr('data-cid');
     $.ajax({
            url: "{{ url('mark-as-progress') }}",
            data: {'id':id,'cid':cid,'_token': '<?= csrf_token() ?>' },
            type: 'POST',
            success: function(result) {
                //console.log(result);
               window.location.href="{{ url('lab/lab-test')}}/"+cid;
            }
        });
     }else{
        $(this).prop('checked',false);
     }
     
});

$(document).on('click','.get_ordered_info',function(){
    $(".lab-search-header").css('display','block');
    $(".ordered_div_info").css('display','block');
   
        $(".ordered_div_info").html("");
        if($(this).html() != 0){
            var id = $(this).attr("data-id");
            var email = $(this).attr("data-email");
            var url = "<?php echo url('/'); ?>/get_ordered_test_info";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'id=' + id + '&email=' + email + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {                   
                    $(".ordered_div_info").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        }
    

});

$(document).on('click','.get_completed_info',function(){
$(".lab-search-header").css('display','block');
$(".completed_div_info").css('display','block');
$(".completed_div_info").html("");
        if($(this).html() != 0){
            var id = $(this).attr("data-id");
            var email = $(this).attr("data-email");
            var url = "<?php echo url('/'); ?>/get_completed_test_info";

            $.ajax({
                  url: url,
                  beforeSend: function(){
                        $("#loading").show();
                        $("#wrapper").hide();
                      },
                  data: 'id=' + id + '&email=' + email + '&_token={{ csrf_token() }}',
                  type: "POST",
                success: function (response) {                   
                    $(".completed_div_info").html(response);
                },
                    complete: function(){
                        $("#loading").hide();
                        $("#wrapper").show();
                    }
            });
        }
});


$(document).on('click','.release',function(){
       var id = $(this).attr("data-id");
        var status = $(this).attr("data-status");
        var _token = "{{ csrf_token() }}";           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:"{{ url('update_test_status') }}",
            data:{id:id,status:status,_token:_token},
            success:function(data)
            {                
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                 alert(data.msg) ; 
                if(data.valid == 1)
                { 
                 window.location.reload();             
                }
                else
                {
                 window.location.reload();                    
                }
            }
        });
});

$(document).on('click', '.deleterow', function(e)
{
     e.preventDefault();
     
     if(confirm('Are you sure you want to delete this item?'))
     {      
        var id = $(this).attr("data-id");
        var list = $(this).attr("data-list");
        var _token = "{{ csrf_token() }}";           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:"{{ url('deleteRecord') }}",
            data:{id:id,list:list,_token:_token},
            success:function(data)
            {                
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                if(data.valid == 1)
                {                            
                 window.location.reload();             
                }
                else
                {
                 window.location.reload();                    
                }
            }
        });
     
    }    
});



$(document).on('click','.mark-complete',function(){
        var id = $(this).attr("data-id");       
        var _token = "{{ csrf_token() }}";           
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
           $.ajax({
            method:"POST",
            url:"{{ url('mark-as-complete-test') }}",
            data:{id:id,_token:_token},
            success:function(data)
            {                
                $(".submit-loading").remove();
                $elm.show();
                var data = jQuery.parseJSON(data);
                 alert(data.msg) ; 
                if(data.valid == 1)
                { 
                 window.location.reload();             
                }
                else
                {
                 window.location.reload();                    
                }
            }
        });
});

</script>

@endsection