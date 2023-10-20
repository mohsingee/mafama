@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs -->
            <section>
                <div class="container">
                    <div class="row">
                        <!-- tabs content -->
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-12">
                                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                    <h4>Lab Tests</h4>
                                </div>
                            </div>
                            <div class="col-md-12 text-right margin-bottom-20">
                                <?php if($chat != "off"){ ?>
                                    <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                                <?php } ?>
                                <?php if($tools != "off"){ ?>
                                    <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                                <?php } ?>
                                <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                                <a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
                            </div>
                           <div class="col-md-12"  style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                                   <form action="{{ url('lab_test_upload_file') }}" class="" method="POST" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" style="border-radius: 10px; padding: 0px; padding-top: 10px; padding-bottom: 20px;">

                           
                             @if($lab->status==0)
                                <div class="col-md-12 text-center">
                                        <div class="form-group" style="font-size: 16px">
                                            <label class="form-label">{{$lab_name}} Do you want to do this test ? Yes <input type="radio" class="mark-as-progress" data-id="{{$lab->id}}"> 
                                                </label>
                                            
                                        </div>
                                </div> 
                             @else   
                                                                      
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Upload Tests Results</label>
                                            <input type="file" class="form-control" name="file"  required="" />
                                        </div>
                                       
                                        
                                    </div>
                                   
                                    <div class="col-md-6" style="margin-top: 25px;">
                                        <input id="id" type="hidden" name="id"value="{{ $lab->id }}">
                                         
                                        <button type="submit" class="btn btn-md btn-info" >Submit</button>
                                       
                                    </div>
                             @endif

                                </div>
                            </form>
                           </div>
                          
                        </div>
                    </div>
                </div>
            </section>
            
        </div>
    </div>
</section>



<script type="text/javascript">

$(document).on("click", ".mark-as-progress", function () {
     if(confirm('Are you sure to do this test?'))
     {
     var id=$(this).attr('data-id');    
     $.ajax({
            url: "{{ url('mark-as-progress') }}",
            data: {'id':id,'_token': '<?= csrf_token() ?>' },
            type: 'POST',
            success: function(result) {
                //console.log(result);
               window.location.href="{{ url('front_dashboard')}}";
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



</script>

@endsection