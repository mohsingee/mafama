@extends('layouts.main') 
@section("content")

<style type="text/css">
    .panel-body:not(.two-col) { padding:0px }
    .glyphicon { margin-right:5px; }
    .glyphicon-new-window { margin-left:5px; }
    .panel-body .radio,.panel-body .checkbox {margin-top: 0px;margin-bottom: 0px;}
    .panel-body .list-group {margin-bottom: 0;}
    .margin-bottom-none { margin-bottom: 0; }
    .panel-body .radio label,.panel-body .checkbox label { display:block; }
    input[type=checkbox]{
        margin-right: 10px;
    }
    .panel {
        margin-bottom: 10px;
    }
    .panel-title i {
        font-style: normal;
    }
</style> 
<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12" style="padding-bottom: 20px;">
                        <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                            <h4>Survey/Polls</h4>
                        </div>
                       <form action="{{ url('submit_form_servey_data') }}" method="POST">
                           @csrf
                        <div class="col-md-12">
                            <div>

                               
                                @foreach($survey as $value)
                                    <div class="panel panel-primary" data-id="{{ $value->id }}">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <i class="fas fa-arrow-circle-right"></i> {{ $value->question }}</h3>
                                                <input type="hidden" name="question[{{$value->id}}]" value="{{$value->question}}"> 
                                        </div>
                                        <div class="panel-body two-col">
                                            <div class="row">
                                              @if(!empty($value->options))  
                                                @foreach(json_decode($value->options,true) as $option)
                                                <div class="col-md-6">
                                                    <div class="well well-sm">
                                                        <div class="">
                                                            <label class="text-capitalize">
                                                                <input type="radio" name="option[{{$value->id}}]"  value="{{$option}}" >
                                                                {{ $option }} 
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                              @endif 
                                            </div>
                                           


                                            
                                       
                                        </div>
                                    </div>
                                @endforeach

                        <div class="col-md-12">
                            <div class="form-group">
                                    <label class="form-label">Feedback Message</label>
                            <textarea name="feedback_msg" rows="3" class="form-control" placeholder="Type your feedback here"></textarea>
                        </div>
                            <div>
                                @if(count($survey)>0)
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success subbtn">Save</button>
                                </div>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                        </div>
                       </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).on("click", ".subbtn", function(){
        var sub_arr = [];
        $(".panel").each(function(){
            var question = $(this).find("input[name='question']").val();
            var option = $(this).find("input[name='option']").val();
            var sub_arr2 = {};
            sub_arr2['question'] =  question;
            sub_arr2['option'] =  option;
            sub_arr.push(sub_arr2);
        });
        console.log(sub_arr);
    });
</script>

@endsection