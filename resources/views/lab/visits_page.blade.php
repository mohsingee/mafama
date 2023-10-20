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
    .txt1{
        width: 130px!important;
        height:28px!important;margin-top: -4px;
    }
    .input_field{float: right;margin-top:-7px;font-size:12px;color:#404040}
    td label.form-label {
    text-align: left!important;
    padding-left: 15px;
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
                            <h4>Patient Management </h4>
                        </div>
                       
                        @include('lab.lab_tabs')
                        <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="tab-pane fade in active" id="tab1">
                            <form action="{{ url('vital_signs_add_edit_post') }}" class="" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">
                                    <div class="col-md-12">
                                        <table class="table margin-bottom-10" style="width: 100%;">
                                          <tbody>
                                              <tr>
                                                  
                                                  <td width="30%">
                                                    <label class="form-label">Weight in pounds (Lb):</label>
                                                    <span class="input_field">                 
                                                    <input type="text" class="form-control txt1" name="weight" value="{{$form ? $form->weight:''}}" placeholder="Weight" style="width: 130px;height:28px!important;margin-top: -20px;font-size: 10px" >
                                                    </span>
                                                   </td>
                                                   <td width="30%">
                                                    <label class="form-label">Height:</label>
                                                    <span class="input_field">                 
                                                    <input type="text" class="form-control txt1" name="height" value="{{$form ? $form->height:''}}" style="width: 130px;height:28px!important;margin-top: -20px;font-size: 10px" placeholder="Height">
                                                    </span>
                                                   </td> 
                                                  <td width="40%">
                                                    <label class="form-label">Blood Pressure:</label>
                                                    <span class="input_field">                 
                                                    <input type="text" class="form-control txt1" name="blood_pressure" value="{{$form ?$form->blood_pressure:''}}" style="width: 130px;height:28px!important;margin-top: -20px;font-size: 10px" placeholder="Blood Pressure">
                                                    </span>
                                                   </td>
                                              </tr>
                                              <tr>
                                                  
                                                  <td width="30%">
                                                    <label class="form-label">Temperatures:</label>
                                                    <span class="input_field">                 
                                                    <input type="text" class="form-control txt1" name="temperature" value="{{ $form ? $form->temperature:''}}" style="width: 130px;height:28px!important;margin-top: -20px;font-size: 10px" placeholder="Temperatures">
                                                    </span>
                                                   </td>
                                                   <td width="30%">
                                                    <label class="form-label">Heart Rate:</label>
                                                    <span class="input_field">                 
                                                    <input type="text" class="form-control txt1" name="heart_rate" value="{{ $form ? $form->heart_rate:'' }}" style="width: 130px;height:28px!important;margin-top: -20px;font-size: 10px" placeholder="Heart Rate">
                                                    </span>
                                                   </td> 
                                                  <td width="40%">
                                                    <label class="form-label">Raspiratory Rate:</label>
                                                    <span class="input_field">                 
                                                    <input type="text" class="form-control txt1" name="raspiratory" value="{{ $form ? $form->raspiratory:''}}" placeholder="Raspiratory Rate" style="width: 130px;height:28px!important;margin-top: -20px;font-size: 10px">
                                                    </span>
                                                   </td>
                                              </tr>
                                              <tr>
                                                  
                                                  <td width="30%">
                                                    <label class="form-label">SpO2:</label>
                                                    <span class="input_field">                 
                                                    <input type="text" class="form-control txt1" name="spo2" value="{{ $form ? $form->spo2:''}}" style="width: 130px;height:28px!important;margin-top: -20px;font-size: 10px" placeholder="SpO2">
                                                    </span>
                                                   </td>
                                                   <td width="30%">
                                                    
                                                   </td> 
                                                  <td width="40%">
                                                    
                                                   </td>
                                              </tr>
                                          </tbody>
                                        </table>
                                       
                                    </div>
                                    
                                   
                                    <div class="col-md-12 text-center" style="margin-top: 25px;">
                                        <input  type="hidden" name="id" value="">
                                         <input type="hidden" name="client_id"  value="{{ $client_id }}">
                                        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                                       
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12 padding-0 text-center margin-bottom-0" style="margin-bottom: 0px;padding-bottom: 0px">
                                        <h4 style="margin-bottom: 0px;">Vital Signs</h4>
                            </div>
                            <div class="clearfix"></div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>Date/Time</th>
                                            <th>Fulfilled By</th>
                                            <th>Weight in pounds (Lb)</th>
                                            <th>Height</th>
                                            <th>Blood Pressure</th>
                                            <th>Temperatures</th>
                                            <th>Heart Rate</th>
                                            <th>Raspiratory Rate</th>
                                            <th>SpO2</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if(count($records) >0 )

                                        @foreach($records as $lab)

                                        <tr>
                                            <td>{{date('M-d-Y :  h:i a',strtotime($lab->created_at))}}</td>
                                            <td>{{$lab->name}}</td>
                                            <td>{{$lab->weight}}</td>
                                            <td>{{$lab->height}}</td>
                                            <td>{{$lab->blood_pressure}}</td>
                                            <td>{{$lab->temperature}}</td>
                                            <td>{{$lab->heart_rate}}</td>
                                            <td>{{$lab->raspiratory}}</td>
                                            <td>{{$lab->spo2}}</td>
                                            
                                           
                                           <!--  <td>
                                            <a href="{{ url('lab/vital-signs/'.$lab->id) }}" class="btn btn-xs btn-success" style="padding-top: 5px">Edit</a>
                                                    
                                             <a href="javascript:void(0);" class="btn btn-xs btn-info deleterow" data-id="{{$lab->id }}" data-list="vital_signs"  >Delete</a>
                                                   
                                            </td> -->
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