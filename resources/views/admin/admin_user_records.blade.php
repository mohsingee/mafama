@extends('layouts.admin') 
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head-content" style="margin-bottom: 20px;">
                    <h3 class="nk-block-title page-title">Survey Results</h3>
                </div>
                <!-- .nk-block-head-content -->
           
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="col-md-12"></div>
                            <div class="card-inner">
                                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col"><span class="sub-text">Id</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Survey Date</span></th>
                                           
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
                                                <span><?= $value->name ?></span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span><?= $value->email ?></span>
                                            </td>
                                            <td class="nk-tb-col">
                                               <span>{{date('m-d-Y h:i A',strtotime($value->created_at)) }}</span>
                                            </td>
                                           
                                            <td class="nk-tb-col tb-col-md">
                                                @if(permission_access('surveyques_edit')==1)
                                                <a href="javascript:void(0)" class="btn btn-sm btn-success view-survey-result" data-id="{{$value->id}}" >View Result</a><br>
                                                @endif
                                                @if(permission_access('surveyques_delete')==1)
                                                <a href="javascript:void(0)" class="btn btn-sm btn-success deleterow" data-id="{{$value->id}}" data-list="user_survey_records" >Delete</a>
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
<!-- Modal -->
  <div class="modal fade" id="survey_data_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">         
          <h4 class="modal-title">Survey Result</h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="survey_data">
           
                
          </div>
        </div>
        <div class="modal-footer">
         <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
      </div>
      
    </div>
  </div>
@endsection