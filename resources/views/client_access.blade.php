@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">

            <!-- tabs -->
            
            @include('setting_header')
            
            <!-- tabs content -->
            <div class="col-md-9 col-sm-9">
                <!--<div class="col-md-12 margin-bottom-20">
                    <a href="add_client_access.php" class="btn btn-xs btn-info" style="float:right;">Add New</a>
                </div>-->
                <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                    <h4>Client Access</h4>
                </div>
                <div class="col-md-12 text-center">
                    <a href="{{ url('profile_info') }}" class="btn btn-md btn-info">Profile Info</a>
                    <a href="{{ url('tasks') }}" class="btn btn-md btn-info">Tasks</a>
                    <a href="{{ url('forms_library') }}" class="btn btn-md btn-info">Forms Library</a>
                    
                </div>
                
            </div>

        </div>
    </div>
</section>

@endsection