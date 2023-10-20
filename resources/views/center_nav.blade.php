<div class="col-md-12 text-left margin-bottom-20 padding-0">
    <div class="margin-top-10">
        @if(userAccess('enable_state')==true)
        <a href="{{ url('birthplace') }}"
            class="btn btn-md btn-info {{ Request::is('birthplace') ? 'bg_green' : 'bg_blue' }}">City Project</a>
        @endif
        @if(userAccess('enable_diaspo_connection')==true)
        <a href="{{ url('birthplace_list') }}"
            class="btn btn-md btn-info {{ Request::is('birthplace_list') ? 'bg_green' : 'bg_blue' }}">Diaspo-Connection</a>
        @endif

        @if(userAccess('enable_gallery_of_leaders')==true)
        <a href="{{ url('leaders_board_details') }}"
            class="btn btn-md btn-info {{ Request::is('leaders_board_details') ? 'bg_green' : 'bg_blue' }}">Leaders
            Board</a>
        @endif

        @if(userAccess('enable_arts_culture')==true)
        <a href="{{ url('art-and-culture') }}"
            class="btn btn-md btn-info {{ Request::is('art-and-culture') ? 'bg_green' : 'bg_blue' }}">Art and
            Culture</a>
        @endif

        @if(userAccess('enable_shopping')==true)
        <a href="#" class="btn btn-md btn-info bg_blue">Shopping</a>
        @endif

        @if(userAccess('enable_top_city_news')==true)
        <a href="{{ url('top_city_news') }}"
            class="btn btn-md btn-info {{ Request::is('top_city_news') ? 'bg_green' : 'bg_blue' }}">Top City News</a>
        @endif
        @if(userAccess('enable_faith')==true)
        <a href="{{ url('my_faith') }}"
            class="btn btn-md btn-info {{ Request::is('my_faith') ? 'bg_green' : 'bg_blue' }}">My Faith</a>
        @endif
        @if(userAccess('enable_city_guide')==true)
        <a href="#" class="btn btn-md btn-info bg_blue">City Guide</a>
        @endif
        @if(userAccess('enable_city_management')==true)
        <a href="#" class="btn btn-md btn-info bg_blue">City Management</a>
        @endif
    </div>
</div>
<div class="col-md-12 text-right margin-bottom-20 padding-0">
    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
</div>