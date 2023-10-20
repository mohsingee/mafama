@extends('layouts.main') 
@section("content")
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>
<style type="text/css">
    text {
        display: none !important;
    }
    .table-scrollable {
        overflow-x: auto;
    }
    .morris-hover-point {
        display: none;
    }
    table a{
        color: #da291c;
    }
</style>
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
    .txt1{
        width: 130px!important;
        height:28px!important;margin-top: -4px;
    }
    .input_field{float: right;margin-top:-7px;font-size:12px;color:#404040}
    td label.form-label {
    text-align: left!important;
    padding-left: 3px;
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
                            <form action="{{ url('test_coparision_add_edit_post') }}" class="" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">
                                    <div class="col-md-12">
                                        <table class="table margin-bottom-10" style="width: 100%;">
                                          <tbody>
                                              <tr>
                                                  
                                         <td width="35%">
                                                    
                                            <label class="form-label">Component
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#CModel" style="float: right"><i class="fa fa-plus"></i></a>

                                            </label>
                                          
                                            <select name="component_id" id="component_list" class="form-control select22" >
                                              <option value=""> Select </option>
                                                @if(count($component_list1)>0)
                                                  @foreach($component_list1 as $co)

                                                  <option value="{{$co->id}}">{{$co->component}}</option>

                                                  @endforeach
                                                @endif 
                                                @if(count($component_list)>0)
                                                  @foreach($component_list as $co)

                                                  <option value="{{$co->id}}">{{$co->component}}</option>

                                                  @endforeach
                                                @endif
                                            </select>

                                          </td>
                                          <td width="30%">
                                                    
                                            <label class="form-label">Current Value</label>
                                            <input type="text" class="form-control" name="current_value" required="" placeholder="Current Value">
                                          </td>
                                          <td width="35%">
                                                    
                                            <label class="form-label">Standard Value</label>
                                            <input type="text" class="form-control" name="standard_value"  placeholder="Standard Value" readonly="">
                                          </td>
                                                  
                                              </tr>
                                              
                                          </tbody>
                                        </table>
                                       
                                    </div>
                                    
                                   
                                    <div class="col-md-12 text-center" style="margin-top: 25px;">
                                       
                                         <input type="hidden" name="client_id"  value="{{ $client_id }}">
                                        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                                       
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12 padding-0 text-center margin-bottom-0" style="margin-bottom: 0px;padding-bottom: 0px">
                                        <h4 style="margin-bottom: 0px;">Tests Comparision</h4>
                            </div>
                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>

                             <div class="col-md-12">
                        <div class="clearfix"></div>
                        </div>
                    </div>
                 
                    <ul class="nav nav-tabs nav-button-tabs nav-justified">
                            <li class="active"><a href="#all_test" data-toggle="tab">Test Comparision</a></li>
                            <li><a href="#daily" data-toggle="tab"> Test Comparision</a></li>
                           
                            <!-- <li><a href="#sms-tab" data-toggle="tab">Send SMS</a></li> -->
                    </ul>
                <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 20px;">
                        <div class="tab-pane fade in active" id="all_test">
                            
                         <div class="">
                           <div id="" class="table-scroll">
                             <div class="table-wrap">  
                                <table class="table table-striped table-bordered table-hover" id="sample_editable_13">
                                    <thead>
                                        <tr>
                                           <!--  <th>Date/Time</th>
                                            <th>Fulfilled By</th> -->
                                            <th>Component</th>
                                            <th>Current Value</th>
                                            <th>Standard value</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if(count($records) >0 )

                                        @foreach($records as $lab)

                                        <tr>
                                            <!-- <td>{{date('M-d-Y :  h:i a',strtotime($lab->created_at))}}</td>
                                            <td>{{$lab->name}}</td> -->
                                            <td>
                                              <b>{{strtoupper($lab->component)}}</b><br>
                                                {!!$lab->description!!}</td>
                                            <td><b>{{$lab->current_value}}</b> @if(!empty($lab->current_value)) mg/dL @endif</td>
                                            <td><b>{{$lab->standard_value}} </b> @if(!empty($lab->standard_value)) mg/dL @endif </td>
                                            
                                        </tr>

                                        @endforeach

                                        @endif
                                    </tbody>
                                </table>
                             </div>
                         </div>
                      </div>    
                    </div>
                    <div class="tab-pane fade in" id="daily">
                        
                         <div class="">
                                        <div id="" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table table-striped table-bordered table-hover main-table" id="">
                                                    <thead>
                                                        <tr class="top-tr">
                                                            <th class="fixed-side"></th>
                                                            <th>Standard Value</th>
                                                            @php
                                                            $todates_arr=array();
                                                            @endphp
                                                            @foreach($last_records as $rec)
                                                            @php
                                                             $todates_arr[]=$rec->created_at;
                                                            @endphp
                                                            <th>{{date('M d - Y',strtotime($rec->created_at))}} <br>Your Value</th>
                                                            @endforeach
                                                         
                                                            <th>Graph</th>
                                                        </tr>
                                                    </thead>
                                <tbody>

                                @if(count($last_records) >0) 
                                @foreach($components_reports as $co)  
                                <?php
                                 $tsum=0;
                                 foreach ($todates_arr as $date) {
                                 $tot = \App\TestComparision::get_test_coparision_by_month($co->id,$client_id, $date);
                                  $tsum += $tot;      
                                    }
                                 ?>
                                 @if($tsum !=0)
                                    <tr >
                                        <td class="fixed-side" style="text-align: left; color: #da291c;"><b> {{$co->component}} </b></td>
                                        <td><b>{{$co->standard_value}}</b>  </td>
                                        <?php                                        
                                         foreach ($todates_arr as $date) {
                                         $total = \App\TestComparision::get_test_coparision_by_month($co->id,$client_id, $date);
                                                echo '<td>'.$total.'</td>';
                                            }
                                          ?>                                        
                                        <td> <a href="{{ url('lab/lab-report-chart/'.$client_id.'/'.$co->id) }}"><i class="fa fa-bar-chart"></i></a></td>
                                                            
                                    </tr>
                                   @endif
                                @endforeach 

                                   @endif                               
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
        </div>
        </div>
    </div>
</section>




<div id="CModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title1" style="text-align-last: center">Add Component</h4>
            </div>
            <form id="form1" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Component Name</label>
                                <input type="text" class="form-control"   name="component" placeholder=""  required>
                            </div>
                        </div>
                       <div class="col-md-6">
                            <div class="form-group">
                               <label class="form-label"> Standard Value</label>
                                <input type="text" class="form-control"   name="standard_value" placeholder=""  required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label"> Component Description</label>
                                
                                <textarea name="bonus_message_day" class="form-control" ></textarea>
                            </div>
                         </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                   
                    <input type="hidden" name="client_id" value="{{ $client_id }}" >
                    <input type="submit" class="btn btn-sm btn-primary btn2" value="Save">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://unpkg.com/huebee@2/dist/huebee.pkgd.min.js"></script>
<script type="text/javascript">
     CKEDITOR.replace('bonus_message_day');
     
</script>
<script type="text/javascript">


$(document).on("change","#component_list",function(){
    var id=$(this).val();
    $('input[name="standard_value"]').val('');
      var _token = "{{ csrf_token() }}";      
     $.ajax({
            method:"POST",
            url:"{{ url('get_standard_value') }}",
            data:{id:id,_token:_token},
            success:function(data)
            {                
               $('input[name="standard_value"]').val(data);
            }
        });
});

$("#form1").submit(function(e)
{    e.preventDefault();    
      var component= $('input[name="component"]').val();
      if(component ==''){
        return false;
      }
      for (var i in CKEDITOR.instances) {
        CKEDITOR.instances[i].updateElement();
    }
     $("#component_list").html('');
        $elm=$(".btn2");
        $elm.hide();  
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: "{{ url('add_new_component_by_user') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
             $(".submit-loading").remove();
              $elm.show();

               $("#CModel").modal("hide");
               $('#form1')[0].reset();
               $('#component_list').removeClass('select2');

              resp=JSON.parse(resp);
              if(resp.valid==1){ 
              
               $("#component_list").html(resp.html);  
                $('input[name="standard_value"]').val(resp.standard_value);      
                //  $('#component_list').addClass('select2'); 
               }              
               
            },
            error: function(data) {
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

</script>

@endsection