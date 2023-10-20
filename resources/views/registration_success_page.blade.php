@extends('layouts.main') 
@section('content')

<style>
  
.borderless tr td, .borderless tr th {
    border: none !important;
    text-align: left;
    
}
</style>
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                   
                        <div class="" style="padding-bottom: 20px;">
                            <div class="col-md-12 text-right">
                                <a href="{{ url('/') }}" class="btn btn-md btn-info">Back</a>
                            </div>
                            <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                                <h4>Registration Success</h4>
                            </div>
                        <div class="row gy-4">
                            <div class="col-md-12 text-center">
                                @if ($message = Session::get('success_msg'))
                                <div class="custom-alerts alert alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    {!! $message !!}
                                </div>
                              
                                @endif

                                @if ($message = Session::get('error'))
                                <div class="custom-alerts alert alert-danger fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    {!! $message !!}
                                </div>
                                <?php Session::forget('error');?>
                                @endif
                            </div>
                        </div>  
                            @if ($message = Session::get('success_msg')) 
                          <?php Session::forget('success_msg');?>
                         @endif
                        <div class="clearfix"></div>  
                          
<div class="col-md-12" style="margin-top:40px; text-align:center;">

<a href="{{ url('/')}}" class="btn btn-lg btn-primary">Back to home</a>

</div>               
                        </div>


 
                </div>
            </div>
        </div>
    </div>
</section>
@endsection