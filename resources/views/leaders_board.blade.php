
 @extends('layouts.main')

 @section('content')

     <link rel="stylesheet" href="https://unpkg.com/huebee@2/dist/huebee.min.css" />
     <style type="text/css">

        .panel.price,
		.panel.price>.panel-heading{
			border-radius:0px;
			 -moz-transition: all .3s ease;
			-o-transition:  all .3s ease;
			-webkit-transition:  all .3s ease;
		}
		.panel.price:hover{
			box-shadow: 0px 0px 30px rgba(0,0,0, .2);
		}
		.panel.price:hover>.panel-heading{
			box-shadow: 0px 0px 30px rgba(0,0,0, .2) inset;
		}


		.panel.price>.panel-heading{
			box-shadow: 0px 5px 0px rgba(50,50,50, .2) inset;
			text-shadow:0px 3px 0px rgba(50,50,50, .6);
		}

		.price .list-group-item{
			border-bottom-:1px solid rgba(250,250,250, .5);
		}

		.panel.price .list-group-item:last-child {
			border-bottom-right-radius: 0px;
			border-bottom-left-radius: 0px;
		}
		.panel.price .list-group-item:first-child {
			border-top-right-radius: 0px;
			border-top-left-radius: 0px;
		}

		.price .panel-footer {
			color: #fff;
			border-bottom:0px;
			background-color:  rgba(0,0,0, .1);
			box-shadow: 0px 3px 0px rgba(0,0,0, .3);
		}


		.panel.price .btn{
			box-shadow: 0 -1px 0px rgba(50,50,50, .2) inset;
			border:0px;
		}

	/* green panel */


		.price.panel-green>.panel-heading {
			color: #fff;
			background-color: #57AC57;
			border-color: #71DF71;
			border-bottom: 1px solid #71DF71;
		}


		.price.panel-green>.panel-body {
			color: #fff;
			background-color: #65C965;
		}


		.price.panel-green>.panel-body .lead{
				text-shadow: 0px 3px 0px rgba(50,50,50, .3);
		}

		.price.panel-green .list-group-item {
			color: #333;
			background-color: rgba(50,50,50, .01);
			font-weight:600;
			text-shadow: 0px 1px 0px rgba(250,250,250, .75);
		}

		/* blue panel */


		.price.panel-blue>.panel-heading {
			color: #fff;
			background-color: #608BB4;
			border-color: #78AEE1;
			border-bottom: 1px solid #78AEE1;
		}


		.price.panel-blue>.panel-body {
			color: #fff;
			background-color: #73A3D4;
		}


		.price.panel-blue>.panel-body .lead{
				text-shadow: 0px 3px 0px rgba(50,50,50, .3);
		}

		.price.panel-blue .list-group-item {
			color: #333;
			background-color: rgba(50,50,50, .01);
			font-weight:600;
			text-shadow: 0px 1px 0px rgba(250,250,250, .75);
		}

		/* red price */


		.price.panel-red>.panel-heading {
			color: #fff;
			background-color: #D04E50;
			border-color: #FF6062;
			border-bottom: 1px solid #FF6062;
		}


		.price.panel-red>.panel-body {
			color: #fff;
			background-color: #EF5A5C;
		}




		.price.panel-red>.panel-body .lead{
				text-shadow: 0px 3px 0px rgba(50,50,50, .3);
		}

		.price.panel-red .list-group-item {
			color: #333;
			background-color: rgba(50,50,50, .01);
			font-weight:600;
			text-shadow: 0px 1px 0px rgba(250,250,250, .75);
		}

		/* grey price */


		.price.panel-grey>.panel-heading {
			color: #fff;
			background-color: #6D6D6D;
			border-color: #B7B7B7;
			border-bottom: 1px solid #B7B7B7;
		}


		.price.panel-grey>.panel-body {
			color: #fff;
			background-color: #808080;
		}



		.price.panel-grey>.panel-body .lead{
				text-shadow: 0px 3px 0px rgba(50,50,50, .3);
		}

		.price.panel-grey .list-group-item {
			color: #333;
			background-color: rgba(50,50,50, .01);
			font-weight:600;
			text-shadow: 0px 1px 0px rgba(250,250,250, .75);
		}

		/* white price */
		.flex-parent {
			display: flex;
		}

		.flex-item {
		padding: .5em;
		}

		.price.panel-white>.panel-heading {
			color: #333;
			background-color: #f9f9f9;
			border-color: #ccc;
			border-bottom: 1px solid #ccc;
			text-shadow: 0px 2px 0px rgba(250,250,250, .7);
			min-height: 135px;
		}

		.panel.panel-white.price:hover>.panel-heading{
			box-shadow: 0px 0px 30px rgba(0,0,0, .05) inset;
		}

		.price.panel-white>.panel-body {
			color: #fff;
			background-color: #dfdfdf;
		}

		.price.panel-white>.panel-body .lead{
				text-shadow: 0px 2px 0px rgba(250,250,250, .8);
				color:#666;
		}

		.price:hover.panel-white>.panel-body .lead{
				text-shadow: 0px 2px 0px rgba(250,250,250, .9);
				color:#333;
		}

		.price.panel-white .list-group-item {
			color: #333;
			background-color: rgba(50,50,50, .01);
			font-weight:600;
			text-shadow: 0px 1px 0px rgba(250,250,250, .75);
		}
		.price.panel-white .list-group-item input, .price.panel-white .list-group-item textarea{
			width: 100%;
			border: 1px solid #ddd;
			padding: 5px 10px;
		}
		.desc_li {
			min-height: 280px;
		}
     </style>
     <!-- -->
    <section>
        <div class="container">
            <div class="row">
                <!-- tabs -->
                <!-- tabs content -->
                <div class="col-md-12 col-sm-12">
                   <div class="row text-center">
                        @if(!empty($main))
                        <div class="col-md-12">
                            <h4 class="f-36">{{ $main->description }}</h4>
                        </div>
                        @endif

                        @if(!empty($sub))
                        <div class="col-md-12">
                            <h4 class="f-28">{{ $sub->description }}</h4>
                        </div>
                        <hr style="width:50%">
                        @endif
                        @if( isset($user_info->birth_commune) )
                        <div class="col-md-12">
                            <h4 class="f-28">{{ showcommuneName($user_info->birth_commune)}}</h4>
                        </div>
                        <hr style="width:50%">
                        
                        @elseif( isset($user_info->birth_state) )
                        <div class="col-md-12">
                            <h4 class="f-28"><span class="bfh-states" data-country="{{ $user_info->birth_country }}" data-state="{{ $user_info->birth_state }}">{{ $user_info->birth_state }}</span></h4>
                        </div>
                        <hr style="width:50%">
                        @endif
                   </div>
                </div>
            </div>
			<form method="post" action="{{ 'update_user_leader_board' }}" enctype="multipart/form-data">
				<div class="container">
					@csrf
						@if(!empty($user_board))
						<input type="hidden" name="actions" value="update">
						<input type="hidden" name="eid" value="{{ $user_board->id }}">
						@endif
					<div class="row">

						@foreach ($boards as $item)
						<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 text-center">
							<div class="f_blue form-group h4">
								@if(!empty($user_board->leader_board_id))
								<input id="admin" name="id" value="{{ $item->id }}" type="radio" {{ ($item->id==$user_board->leader_board_id)?'checked':'' }}> <b>{{ strip_tags($item->title) }}</b></label>
								@else
								<input id="admin" name="id" value="{{ $item->id }}" type="radio"> <b>{{ strip_tags($item->title) }}</b></label>
								@endif
							</div>
							<!-- PRICE ITEM -->
							<div class="panel price panel-white">
								<div class="panel-heading arrow_box text-center">
								<h3 class="margin-bottom-1">{!! $item->sub_title !!}</h3>
								</div>
								<!-- <div class="panel-body text-center">
									<p class="lead" style="font-size:40px"><strong>$0 / month</strong></p>
								</div> -->
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item desc_li text-left"> {!! $item->description !!} </li>

									<li class="list-group-item"><textarea name="other[{{ $item->id }}]" onkeydown="checkWordLen(this)" class="other" id="" style="width: 100%;"  placeholder="What You can do for your place of Birth (15 Words Maximum)"></textarea></li>
									<li class="list-group-item"><textarea name="description[{{ $item->id }}]" class="description" id="" style="width: 100%;"  placeholder="Write Your Experience/ Qualification (4 Words Maximum)"></textarea> </li>

								</ul>
							</div>
							<!-- /PRICE ITEM -->
							<input type="file" name="file_url[{{ $item->id }}]" value="" class="margin-bottom-10 imgInp" data-id="blah-{{ $item->id }}">
							{{-- <img src="images/logo1.jpg" class="blah-{{ $item->id }}" style="width:100%"> --}}
						</div>
						@endforeach
					</div>
                    @if(empty($user_board))
					<div class="row">
						<div class="col-lg-12 text-center margin-top-30">
							<button type="submit" name="submit" class="btn btn-lg btn-info clipboard width-250" style="">Submit</button>
						</div>
					</div>
                    @endif
					<div class="row">
						<div class="col-md-12">
                            @include('center_nav')
                        </div>
					</div>
				</div>
			</form>
        </div>
    </section>
     <script type="text/javascript">
         $(document).ready(function() {
             $(".group-checkable").change(function() {
                 if ($(this).prop('checked')) {
                     var boxes = $('.checkboxes:not(:checked)');
                     boxes.each(function() {
                         $(this).prop('checked', false);
                         $(this).trigger('click');
                     });
                 } else {
                     $('.checkboxes').prop('checked', true);

                     $('.checkboxes').trigger('click');
                 }
             });

         });
     </script>
    <script>
        $(document).ready(function() {
            $(".owl-prev").html('<i class="fa fa-chevron-left"></i>');
            $(".owl-next").html('<i class="fa fa-chevron-right"></i>');
        });
        function readURL(input) {
            let dataId = $(input).attr("data-id");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.'+dataId).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imgInp").change(function(){
            readURL(this);
        });

        var maxWords = 4;
        $('.description').on('input', function() {
            var words = $(this).val().split(/\b[\s,\.-:;]*/);
            if (words.length > maxWords) {
                words.splice(maxWords);
                $(this).val(words.join(" "));
                alert("You've reached the maximum allowed words. Extra words removed.");
            }
        });
        var maxWordsForOther = 15;
        $('.other').on('input', function() {
            var words = $(this).val().split(/\b[\s,\.-:;]*/);
            if (words.length > maxWordsForOther) {
                words.splice(maxWordsForOther);
                $(this).val(words.join(" "));
                alert("You've reached the maximum allowed words. Extra words removed.");
            }
        });


    </script>
@endsection
