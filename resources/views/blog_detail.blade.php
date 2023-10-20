@extends('layouts.main') 
@section("content")
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>
<section>
   <div class="container">
    <div class="well">
        <h3>{{ $blog->title }}</h3>
        <img src="{{ asset('public/assets/images/blogs') }}/<?= $blog->image ?>" style="width: 100%; height: 500px;">
        <p style="margin-top: 5%">{!! $blog->description !!}</p>
    </div>
  </div>
</section>
         
@endsection