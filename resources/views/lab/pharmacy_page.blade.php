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
    ul.ul_list {
    list-style: none;
}
ul.ul_list li input {
    float: right;
   
}
ul.ul_list li span {
    color: #666!important;
   
}
ul.ul_list li {
    margin-top: 5px;
}
.float-right {
    float: right;
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
                            @if($client_id !='')
                           <form  action="{{ url('pharmacy_form_submit') }}" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding: 0px; padding-top: 0px; padding-bottom: 20px;">
                                     <div class="padding-0 text-center margin-bottom-0" >
                                        <h4 >Pharmacy</h4>
                                     </div>

                                   <div class="col-md-12" style="margin-bottom:20px;border:1px solid red;padding: 10px;border-radius: 5px">
                                    <div class="col-md-4">
                                       
                                    <label class="form-label">Pharmacy:</label>   
                                    <p>I'm filling this medication:Yes <input type="radio" name="fill_medication1" class="p_confirm" value="Yes">
                                    No <input type="radio" name="fill_medication1" value="No"> 
                                    </p>
                                    <label class="form-label">Pharmacy 's Note:</label>
                                    <textarea class="form-control" name="pharma_note1"></textarea>
                                     
                                    </div>
                                    <div class="col-md-4">
                                      
                                    <label class="form-label">Pharmacy:</label>   
                                    <p>I'm filling this medication:Yes <input type="radio" name="fill_medication2" class="p_confirm" value="Yes">
                                    No <input type="radio" name="fill_medication2"  value="No"> 
                                    </p>
                                    <label class="form-label">Pharmacy 's Note:</label>
                                    <textarea class="form-control" name="pharma_note2"></textarea>
                                     
                                    </div>
                                    <div class="col-md-4">
                                       
                                    <label class="form-label">Pharmacy:</label>   
                                    <p>I'm filling this medication:Yes <input type="radio" name="fill_medication3" class="p_confirm" value="Yes">
                                    No <input type="radio" name="fill_medication3" value="No"> 
                                    </p>
                                    <label class="form-label">Pharmacy 's Note:</label>
                                    <textarea class="form-control" name="pharma_note3"></textarea>
                                    
                                    </div>
                                </div>
<hr>
                                    <div class="col-md-12">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Main complaint 1 
                                              <a href="javascript:void(0)" class="float-right add-complaint" data-id="1"><i class="fa fa-plus"></i></a></label>
                                           <select name="complaint1" class="form-control">
                                               @foreach($complaint1 as $value)

                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                               
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Main complaint 2
                                               <a href="javascript:void(0)" class="float-right add-complaint" data-id="2"><i class="fa fa-plus"></i></a>

                                            </label>
                                            <select name="complaint2" class="form-control">
                                                @foreach($complaint2 as $value)

                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Main complaint 3
                                               <a href="javascript:void(0)" class="float-right add-complaint" data-id="3"><i class="fa fa-plus"></i></a>

                                            </label>
                                            <select name="complaint3" class="form-control">
                                               @foreach($complaint3 as $value)

                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                           </select>
                                        </div>
                                    </div>
                                   </div>

                                    <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Medication 1
                                               <a href="javascript:void(0)" class="float-right add-medication" data-id="1"><i class="fa fa-plus"></i></a>

                                            </label>
                                           <select name="medician1" class="form-control">
                                               @foreach($medician1 as $value)
                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                               
                                           </select>
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Medication 2
                                                <a href="javascript:void(0)" class="float-right add-medication" data-id="2"><i class="fa fa-plus"></i></a>


                                            </label>
                                           <select name="medician2" class="form-control">
                                                @foreach($medician2 as $value)
                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                               
                                           </select>
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Medication 3
                                                <a href="javascript:void(0)" class="float-right add-medication" data-id="3"><i class="fa fa-plus"></i></a>


                                            </label>
                                           <select name="medician3" class="form-control">
                                              @foreach($medician3 as $value)
                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                               
                                           </select>
                                        </div>
                                    </div>
                                    
                                    
                                   </div>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label"> Recommentations
                                              <!--  <a href="javascript:void(0)" class="float-right add-recomm" data-id="1"><i class="fa fa-plus"></i></a> -->

                                             </label>
                                             <textarea  name="recomm1" class="form-control"></textarea>
                                           
                                            <!-- <select name="recomm1" class="form-control">
                                              @foreach($recomms as $value)
                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                               
                                           </select> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Recommentations
                                            <!--  <a href="javascript:void(0)" class="float-right add-recomm" data-id="2"><i class="fa fa-plus"></i></a> -->
                                            </label>
                                             <textarea  name="recomm2" class="form-control"></textarea>
                                            <!--  <select name="recomm2" class="form-control">
                                              @foreach($recomms as $value)
                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                               
                                           </select> -->
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Recommentations
                                              <!--  <a href="javascript:void(0)" class="float-right add-recomm" data-id="3"><i class="fa fa-plus"></i></a> -->

                                            </label>
                                             <textarea  name="recomm3" class="form-control"></textarea>
                                             <!-- <select name="recomm3" class="form-control">
                                              @foreach($recomms as $value)
                                               <option value="{{$value->report}}">{{$value->report}}</option>

                                               @endforeach
                                               
                                           </select> -->
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <label class="form-label">Physician's Instructions:</label><br>
                                        <label class="form-label">Dosage / day hr:</label>
                                        <p><input type="text" name="dosage_day1"  style="width: 25%">  time(s) per day</p>
                                        <p><input type="text" name="dosage_times1"  style="width: 25%" >time(s) every <input type="text" name="dosage_hours1"  style="width: 25%"> hours</p>
                                          <label class="form-label">Refill#<input type="text" name="refill1"  style="width: 25%"> time(s)</label>
                                       <p>Generic Substitution:Yes <input type="radio" name="generic1" value="Yes">
                                       No <input type="radio" name="generic1" value="No">
 
                                       </p>
                                     
                                      <hr>
                                    <label class="form-label">Special Note:</label>
                                     <textarea class="form-control" name="special_note1"></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Physician's Instructions:</label><br>
                                        <label class="form-label">Dosage / day hr:</label>
                                        <p><input type="text" name="dosage_day2"  style="width: 25%">  time(s) per day</p>
                                        <p><input type="text" name="dosage_times2"  style="width: 25%">  time(s) every <input type="text" name="dosage_hours2"  style="width: 25%"> hours</p>
                                          <label class="form-label">Refill#<input type="text" name="refill2"  style="width: 25%"> time(s)</label>
                                       <p>Generic Substitution:Yes <input type="radio" name="generic2" value="Yes">
                                       No <input type="radio" name="generic2" value="No">
 
                                       </p>
                                     
                                      <hr>
                                    <label class="form-label">Special Note:</label>
                                     <textarea class="form-control" name="special_note2"></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Physician's Instructions:</label><br>
                                        <label class="form-label">Dosage / day hr:</label>
                                        <p><input type="text" name="dosage_day3"  style="width: 25%">  time(s) per day</p>
                                        <p><input type="text" name="dosage_times3"  style="width: 25%" >time(s) every <input type="text" name="dosage_hours3"  style="width: 25%"> hours</p>
                                          <label class="form-label">Refill#<input type="text" name="refill3"  style="width: 25%"> time(s)</label>
                                       <p>Generic Substitution:Yes <input type="radio" name="generic3" value="Yes">
                                       No <input type="radio" name="generic3" value="No">
 
                                       </p>
                                      
                                      <hr>
                                    <label class="form-label">Special Note:</label>
                                     <textarea class="form-control" name="special_note3"></textarea>
                                    </div>
                                </div>

                                 <div class="col-md-12" style="margin-top:20px">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label"> Results/Observations </label>
                                           <ul class="ul_list">
                                               <li>
                                                <span>Satisfactory
                                                <input type="radio" name="result1" value="Satisfactory" selected>
                                                </span>
                                               </li>
                                               <li>
                                                <span>Need Improvement
                                                <input type="radio" name="result1" value="Need Improvement">
                                                </span>
                                               </li>
                                               <li>
                                                <span>Unsatisfactory
                                                <input type="radio" name="result1" value="Unsatisfactory">
                                                </span>
                                               </li>
                                               <li>
                                                <span>Excellent
                                                <input type="radio" name="result1" value="Excellent">
                                                </span>
                                               </li>
                                           </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Results/Observations</label>
                                              <ul class="ul_list">
                                               <li>
                                                <span>Satisfactory
                                                <input type="radio" name="result2" value="Satisfactory" selected>
                                                </span>
                                               </li>
                                               <li>
                                                <span>Need Improvement
                                                <input type="radio" name="result2" value="Need Improvement">
                                                </span>
                                               </li>
                                               <li>
                                                <span>Unsatisfactory
                                                <input type="radio" name="result2" value="Unsatisfactory">
                                                </span>
                                               </li>
                                               <li>
                                                <span>Excellent
                                                <input type="radio" name="result2" value="Excellent">
                                                </span>
                                               </li>
                                           </ul>
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Results/Observations</label>
                                              <ul class="ul_list">
                                               <li>
                                                <span>Satisfactory
                                                <input type="radio" name="result3" value="Satisfactory" selected>
                                                </span>
                                               </li>
                                               <li>
                                                <span>Need Improvement
                                                <input type="radio" name="result3" value="Need Improvement">
                                                </span>
                                               </li>
                                               <li>
                                                <span>Unsatisfactory
                                                <input type="radio" name="result3" value="Unsatisfactory">
                                                </span>
                                               </li>
                                               <li>
                                                <span>Excellent
                                                <input type="radio" name="result3" value="Excellent">
                                                </span>
                                               </li>
                                           </ul>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-12 text-center" style="margin-top: 25px;">
                                        <input id="id" type="hidden" name="id" value="">
                                        <input type="hidden" name="client_id"  value="{{ $client_id }}">
                                        <button type="submit" class="btn btn-md btn-info" >Submit</button>
                                       
                                    </div>
                                </div>
                            </form>
                            @endif
                            <div class="clearfix"></div>
                            <div class="padding-0 text-center margin-bottom-0" >
                                        <h4>Prescription List</h4>
                                     </div>
                            <div class="divider divider-center divider-short">
                                <!-- divider -->
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>Date/Time</th>
                                            <th>Ordered By</th>
                                            <th>Completed By</th>
                                            <th>Date Filled</th>
                                           <!--  <th>Main complaint 1</th>
                                            <th>Main complaint 2</th>
                                            <th>Main complaint 3</th> -->
                                             <th>Medication 1</th>
                                            <th>Medication 2</th>
                                            <th>Medication 3</th>
                                          <!--  <th>Recommentations 1</th>
                                            <th>Recommentations 2</th>
                                            <th>Recommentations 3</th>
                                            <th>Results/Observations 1</th>
                                            <th>Results/Observations 2</th>
                                            <th>Results/Observations 3</th> -->
                                           <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if(count($records) >0 )
                                        @foreach($records as $lab)

                                        <tr>
                                          <td>{{date('M-d-Y :  h:i a',strtotime($lab->created_at))}}</td>
                                            <td>{{$lab->name}}</td>
                                            <td>{{$lab->completed_by}}</td>
                                            <td>{{$lab->created_at}}</td>
                                          <!--   <td>{{$lab->complaint1}}</td>
                                            <td>{{$lab->complaint2}}</td>
                                            <td>{{$lab->complaint3}}</td> -->
                                             <td>{{$lab->medication1}}</td>
                                            <td>{{$lab->medication2}}</td>
                                            <td>{{$lab->medication3}}</td>
                                            <!--<td>{{$lab->recomm1}}</td>
                                            <td>{{$lab->recomm2}}</td>
                                            <td>{{$lab->recomm3}}</td>
                                            <td>{{$lab->result1}}</td>
                                            <td>{{$lab->result2}}</td>
                                            <td>{{$lab->result3}}</td> -->
                                            
                                            <td> <a href="javascript:void(0);" class="btn btn-xs btn-info " data-id="{{$lab->id }}" >view refill</a></td>

                                        @endforeach

                                        @endif
                                    </tbody>
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


<div id="ComplaintModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title1" style="text-align-last: center">Add Complaint</h4>
            </div>
            <form id="form1" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Complaint Name</label>
                                <input type="text" name="complaint" id="complaint1"  class="form-control" required="">
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" id="type1" >
                    <input type="hidden" name="client_id" value="{{ $client_id }}" >
                    <input type="submit" class="btn btn-sm btn-primary btn2" value="Save">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="MedicalModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title2" style="text-align-last: center">Add Medication</h4>
            </div>
            <form id="form2" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Medication Name</label>
                                <input type="text" name="medication"  class="form-control" required="">
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" id="type2" >
                    <input type="hidden" name="client_id"  value="{{ $client_id }}">
                    <input type="submit" class="btn btn-sm btn-primary btn3" value="Save">

                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="RecModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title2" style="text-align-last: center">Add Recommendation</h4>
            </div>
            <form id="form3" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Recommendation Name</label>
                                <input type="text" name="report"  class="form-control" required="">
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" id="type3" >
                    <input type="hidden" name="client_id"  value="{{ $client_id }}">
                    <input type="submit" class="btn btn-sm btn-primary btn4" value="Save">

                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).on("click", ".p_confirm", function () {
     if(confirm('Are for filling this medication?'))
     {
     // var id=$(this).attr('data-id');
     // var cid=$(this).attr('data-cid');
     // $.ajax({
     //        url: "{{ url('mark-as-progress444') }}",
     //        data: {'id':id,'cid':cid,'_token': '<?= csrf_token() ?>' },
     //        type: 'POST',
     //        success: function(result) {
     //            //console.log(result);
     //           window.location.href="{{ url('lab/lab-test')}}/"+cid;
     //        }
     //    });
     }else{
        $(this).prop('checked',false);
     }
     
});

  $(document).on("click",'.add-complaint',function(){
     $("#type1").val('');
    var id=$(this).attr("data-id");
    $("#type1").val(id);
    $(".title1").text('Add Complaint');
    $("#ComplaintModel").modal("show");


  });

   $(document).on("click",'.add-recomm',function(){
     $("#type3").val('');
    var id=$(this).attr("data-id");
    $("#type3").val(id);
    $(".title3").text('Add Recommendation');
    $("#RecModel").modal("show");


  });

   $(document).on("click",'.add-medication',function(){
    $("#type2").val('');
    var id=$(this).attr("data-id");
    $("#type2").val(id);
    $(".title2").text('Add Medication ');
    $("#MedicalModel").modal("show");


  });


$("#form1").submit(function(e)
{    e.preventDefault();    
      var complain= $('input[name="complaint"]').val();
      if(complain ==''){
        return false;
      }
     
        $elm=$(".btn2");
        $elm.hide();  
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: "{{ url('add_new_complaint') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
             $(".submit-loading").remove();
              $elm.show();
               $("#ComplaintModel").modal("hide");
               $('input[name="complaint"]').val('');
              resp=JSON.parse(resp);
              if(resp.valid==1){ 
             
               $("select[name=complaint"+resp.type+"]").html(resp.html1);        
              // $("select[name='complaint2']").html(resp.html2);        
              // $("select[name='complaint3']").html(resp.html3);        
               }              
               
            },
            error: function(data) {
            }
        });  
});


$("#form2").submit(function(e)
{    e.preventDefault();    
      var complain= $('input[name="medication"]').val();
      if(complain ==''){
        return false;
      }
     
        $elm=$(".btn3");
        $elm.hide();  
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: "{{ url('add_new_medication') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
             $(".submit-loading").remove();
              $elm.show();
               $("#MedicalModel").modal("hide");
               $('input[name="medication"]').val('');
              resp=JSON.parse(resp);
              if(resp.valid==1){ 
                
              
               $("select[name=medician"+resp.type+"]").html(resp.html1);        
               //$("select[name='medician2']").html(resp.html2);        
              // $("select[name='medician3']").html(resp.html3);        
               }              
               
            },
            error: function(data) {
            }
        });  
});


$("#form3").submit(function(e)
{    e.preventDefault();    
      var complain= $('input[name="report"]').val();
      if(complain ==''){
        return false;
      }
     
        $elm=$(".btn4");
        $elm.hide();  
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: "{{ url('add_new_recommendations') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
             $(".submit-loading").remove();
              $elm.show();
               $("#RecModel").modal("hide");
               $('input[name="report"]').val('');
              resp=JSON.parse(resp);
              if(resp.valid==1){ 
                
              
               $("select[name=recomm"+resp.type+"]").html(resp.html1);        
               //$("select[name='medician2']").html(resp.html2);        
              // $("select[name='medician3']").html(resp.html3);        
               }              
               
            },
            error: function(data) {
            }
        });  
});
</script>
@endsection