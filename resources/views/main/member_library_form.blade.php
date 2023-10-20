@extends('layouts.main') 
@section("content")

<style>
    .heading-div {
        background-color: #da291c;
        border-radius: 5px;
    }
    .heading-div h4 {
        color: #fff;
        margin-top: 10px;
        margin-bottom: 10px;
        font-weight: 400;
    }
    .form-info td {
        text-align: left !important;
        font-size: 12px;
        vertical-align: top;
        border: 1px solid #da291c40;
        padding: 10px;
    }
 .grid-3 {
    text-align: left !important;
    font-size: 12px;
    vertical-align: top;
    border: 1px solid #da291c40;
    padding: 10px;
}
 </style>
<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                       <div class="col-md-12 margin-bottom-40">
                            <div class="col-md-12 shadow-boxx">
                                <div class="col-md-12 text-center">
                                    <h4 class="margin-bottom-0">General Forms</h4>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                <div class="col-md-12 text-center padding-0 margin-top-20">
                                    <table class="form-info margin-bottom-10" style="width: 100%;">
                                        <tbody class="general_form_body">

                                            @if(count($general_forms) > 0) 
                                            @php  
                                            $i=1;                                           
                                            @endphp                                             
                                            @foreach($general_forms  as $form)
                                          
                                            @if($i == 1) 
                                              <tr>
                                            @endif    
                                                <td>
                                                    <label class="checkbox get_general_form" data-id="{{$form->id}}" data-path="{{asset('public/files/'.$form->file_path)}}" data-name="{{$form->name}}" >
                                                    <input type="checkbox" id="general_form" value="{{$form->id}}"  checked disabled=""  />
                                                        <i></i> {{$form->name}}  
                                                    </label>
                                                </td>   
                                            @if($i == 4) 
                                             </tr>
                                            @endif   
                                            
                                              <?php
                                                   if($i==4)
                                                   {
                                                    $i=0;
                                                   }
                                                ?>   
                                            @php  
                                            $i++;   

                                            @endphp  

                                            @endforeach
                                            
                                          @endif
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                                
                            </div>
                        </div>

                        <div class="col-md-12 margin-bottom-40">
                            <div class="col-md-12 shadow-boxx">
                                <div class="col-md-12 text-center">
                                    <h4 class="margin-bottom-0">Medical Forms</h4>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                <div class="col-md-12 text-center padding-0 margin-top-20">
                                    <table class="form-info margin-bottom-10" style="width: 100%;">
                                        <tbody class="medical_form_body">
                                         @if(count($medical_forms) > 0) 
                                            @php  
                                            $i=1;                                           
                                            @endphp                                             
                                            @foreach($medical_forms  as $form)
                                            
                                            @if($i == 1) 
                                              <tr>
                                            @endif    
                                                <td>
                                                     <label class="checkbox get_general_form" data-id="{{$form->id}}" data-path="{{asset('public/files/'.$form->file_path)}}" data-name="{{$form->name}}" >
                                                        <input type="checkbox" id="medical_form" value="{{$form->id}}" checked="checked" disabled   />
                                                        <i></i> {{$form->name}} 
                                                    </label>
                                                </td>   
                                            @if($i == 4) 
                                             </tr>
                                          
                                            @endif  
                                              <?php
                                                   if($i==4)
                                                   {
                                                    $i=0;
                                                   }
                                                ?>   
                                            @php  
                                            $i++;                                           
                                            @endphp  

                                            @endforeach
                                            
                                          @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                               
                            </div>
                        </div>

                        <div class="col-md-12 margin-bottom-40">
                            <div class="col-md-12 shadow-boxx">
                                <div class="col-md-12 text-center">
                                    <h4 class="margin-bottom-0">Dentist Forms</h4>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                <div class="col-md-12 text-center padding-0 margin-top-20">
                                    <table class="form-info margin-bottom-10" style="width: 100%;">
                                         <tbody class="dentist_form_body">
                                              @if(count($dentist_forms) > 0) 
                                            @php  
                                            $i=1;                                           
                                            @endphp                                             
                                            @foreach($dentist_forms  as $form)
                                            
                                            @if($i == 1) 
                                              <tr>
                                            @endif    
                                                <td>
                                                  <label class="checkbox get_general_form" data-id="{{$form->id}}" data-path="{{asset('public/files/'.$form->file_path)}}" data-name="{{$form->name}}" >
                                                        <input type="checkbox" id="dentist_form" value="{{$form->id}}" checked disabled />
                                                        <i></i> {{$form->name}} 
                                                    </label>
                                                </td>   
                                            @if($i == 4) 
                                             </tr>
                                             
                                            @endif   
                                              <?php
                                                   if($i==4)
                                                   {
                                                    $i=0;
                                                   }
                                                ?>   
                                            @php  
                                            $i++;                                           
                                            @endphp  

                                            @endforeach
                                            
                                          @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                               
                            </div>
                        </div>

                        <div class="col-md-12 margin-bottom-40">
                            <div class="col-md-12 shadow-boxx">
                                <div class="col-md-12 text-center">
                                    <h4 class="margin-bottom-0">Pedriatric Forms</h4>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                <div class="col-md-12 text-center padding-0 margin-top-20">
                                    <table class="form-info margin-bottom-10" style="width: 100%;">
                                         <tbody class="pedriatric_form_body">
                                              @if(count($pedriatric_forms) > 0) 
                                            @php  
                                            $i=1;                                           
                                            @endphp                                             
                                            @foreach($pedriatric_forms  as $form)
                                            
                                             
                                            @if($i == 1) 
                                              <tr>
                                            @endif    
                                                <td>
                                                 <label class="checkbox get_general_form" data-id="{{$form->id}}" data-path="{{asset('public/files/'.$form->file_path)}}" data-name="{{$form->name}}" >
                                                        <input type="checkbox" id="pedriatric_form" value="{{$form->id}}" checked disabled/>
                                                        <i></i> {{$form->name}} 
                                                    </label>
                                                </td>   
                                            @if($i == 4) 
                                             </tr>
                                            @endif   
                                           
                                              <?php
                                                   if($i==4)
                                                   {
                                                    $i=0;
                                                   }
                                                ?>   
                                            @php  
                                            $i++;                                           
                                            @endphp  

                                            @endforeach
                                            
                                          @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                               
                            </div>
                        </div>
                      
                </div>
            </div>
        </div>
    </div>
</section>
<div id="LibraryFormModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center" ></h4>
            </div>
            <form action="{{ url('expense_new_account_submit') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-md-12" id="form_load" >
                        
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('click','.get_general_form',function(){
        $(".modal-title").text('');
      $("#form_load").html('');
      var id=$(this).attr('data-id');
      // var title=$(this).attr('data-name');
      // var file_path=$(this).attr('data-path');
      // $(".modal-title").text(title);
      // $("#form_load").html('<embed src="'+file_path+'" frameborder="0" width="100%" height="400px">');
      // $("#LibraryFormModal").modal('show');

      window.location.href="member-library-form/"+id;
    
    });
</script>


@endsection