@extends('layouts.main') 
@section("content")

<style>
 .rem{display: none;}
 .remove_div .fa-minus {
    display: none;
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
                                    <h4 class="margin-bottom-0">{{ $form ? $form->name:''}}</h4>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                <form id="form3"  method="POST" id="" enctype="multipart/form-data">  
                                    @csrf
                                @if(!empty($form->file_path))    
                                <div class="col-md-12  padding-0 margin-top-20 text-right">
                                     <a href="{{ url('download_pdf/'.$form->id)}}" class="btn btn-sm btn-success" > Download File</a>
                                </div>
                                @endif
                                <div class="col-md-12  padding-0 margin-top-10 client-form-data">
                                    @if(empty($old_form))
                                     {!! $form ? $form->form_data:'' !!}
                                    @else
                                     {!! $old_form !!}
                                    @endif 
                                </div>
                                <div class="clearfix"></div>
                                @if(!empty($form->form_data))
                                <div class="col-md-12" style="margin-top:40px; text-align:center;">
                                    <input type="hidden" name="form_id" value="{{$form->id}}">
                                    <input type="submit" class="btn btn-lg btn-primary btn4" value="{{ $form ? 'SAVE':'SAVE'}}">
                                    </div>
                                  @endif  
                                </form>
                                
                            </div>
                        </div>

                       
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
   
   $(document).on("keyup", ".client-form-data input,.client-form-data textarea", function () {
    $(this).attr("value", $(this).val());
});

$("#form3").submit(function(e)
{    e.preventDefault();    
      //var _token= $('input[name="_token"]').val();
    
        $elm=$(".btn4");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $form=$(this);
        var dynamic_form_data=$(".client-form-data").html();
        var formData = new FormData(this);
            formData.append('form_data',dynamic_form_data);
        $.ajax({
            method: 'POST',
            url: "{{ url('update_client_forms_library') }}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(resp) {
                alert('Inserted successfully')
               location.reload();
                $(".submit-loading").remove();
                $elm.show();
                return false;
            },
            error: function(data) {
            }
        });  
});


</script>


@endsection