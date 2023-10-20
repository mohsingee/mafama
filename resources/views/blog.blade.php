@extends('layouts.main') 
@section("content")
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('public/morris/morris.min.js') }}" type="text/javascript"></script>
<section>
   <div class="container">
    <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
        <thead style="display: none">
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach ($blogs as $blog) {
                ?>
                <tr class="nk-tb-item col-sm-6" style="border: 2px solid #da291c;margin-bottom: 2%">
                    <td class="nk-tb-col">
                        <a class="pull-left" href="{{ url('blog_detail') }}/<?= $blog->id ?>">
                            <img class="media-object" src="{{ asset('public/assets/images/blogs') }}/<?= $blog->image ?>" style="width: 150px;height: 150px;">
                        </a>
                    </td>
                    <td class="nk-tb-col">
                        <h4 class="media-heading"><a href="{{ url('blog_detail') }}/<?= $blog->id ?>" style="color: #da291c">{{ $blog->title }}</a></h4>
                        <p>{!! Str::limit($blog->description, 250) !!}</p>
                        <ul class="list-inline list-unstyled">
                            <li><span><i class="glyphicon glyphicon-calendar"></i>@php
                                $date = Carbon\Carbon::parse($blog->created_at);
                                $date1 = Carbon\Carbon::parse($blog->updated_at);
                                @endphp
                                @if($blog->created_at!=NULL && $blog->updated_at==NULL){{$date->diffForHumans(Carbon\Carbon::now())}}@else{{$date1->diffForHumans(Carbon\Carbon::now())}}@endif</span></li></span></li>
                        </ul>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    </div>
</section>
         
@endsection