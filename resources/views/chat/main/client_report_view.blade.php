@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Client / Library Form Report</h4>
                </div>
                <div class="col-md-12 text-right margin-bottom-20">
                    <?php if($chat != "off"){ ?>
                        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                    <?php } ?>
                    <?php if($tools != "off"){ ?> 
                        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                    <?php } ?>
                    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                </div>
                
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Date</th>
                               
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($report as $value){
                            ?>
                                <tr>
                                    <td><?= $value->first_name ?></td>
                                    <td><?= $value->last_name ?></td>
                                    <td><?= $value->email ?></td>
                                    <td >
                                               <span>{{date('m-d-Y h:i A',strtotime($value->created_at)) }}</span>
                                            </td>
                                            
                                  
                                    <td width="20%">
                                       
                                        <a href="javascript:void(0)" class="btn btn-xs btn-success view-survey-result" data-id="{{$value->uid}}" >View Report</a><br>
                                       
                                    </td>
                                </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--<div class="clearfix"></div>
                            </div>-->
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
  <div class="modal fade" id="survey_data_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">  
         <button type="button" class="close" data-dismiss="modal">&times;</button>       
          <h4 class="modal-title">Report</h4>
          
        </div>
        <div class="modal-body">
          <div id="survey_data">
             
                
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
    
$(document).on('click', '.view-survey-result', function(e)
{
     e.preventDefault();
        var token = $("meta[name='csrf-token']").attr("content");    
        var id=$(this).attr('data-id');       
          $elm=$(this);
          $elm.hide();
          $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');        
         
           $.ajax({
            method:"POST",
            url:"{{url('get_reports_result')}}",
            data:{id:id,_token:token},
            success:function(data)
            {
                
            $(".submit-loading").remove();
            $elm.show();
           // var data = jQuery.parseJSON(data);
            
                $("#survey_data_modal").modal('show')
               $("#survey_data").html(data);           
               
            
           
            }
        });
     
        
    
});
</script>
@endsection