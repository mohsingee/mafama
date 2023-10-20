
  <div class="col-md-12 text-right margin-bottom-20">
    <?php if($chat != "off"){ ?>
        <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
    <?php } ?>
    <?php if($tools != "off"){ ?>
        <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
    <?php } ?>
    <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
    <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
</div>
           <?php
                $curPageName = Request::path(); 
                ?>            
 <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-20">
    
    <li class="@php echo 'active',(request()->path() != 'tasks')?:'';@endphp
            "><a href="{{ url('tasks') }}">Task</a></li>
     @if($is_medical_user ==1)       
     <li class="@php echo 'active',(request()->path() != 'profile_info')?:'';@endphp
            "><a href="{{ url('profile_info') }}">Patient Profile</a></li>
    <li class="@php echo 'active',(request()->path() != 'lab/lab-test')?:'';@endphp
            "><a href="javascript:void(0)" >Lab Tests</a></li>
     <li class="@php echo 'active',(request()->path() != 'lab/lab-test')?:'';@endphp
            "><a href="javascript:void(0)" >Lab Test Comparison</a></li>        
    <li class="@php echo 'active',(request()->path() != 'lab/vital-signs/')?:'';@endphp
            "><a href="javascript:void(0)" >Vital Signs</a></li>
      <li  class="@php echo 'active',(request()->path() != 'lab/pharmacy')?:'';@endphp
            "><a href="javascript:void(0)" 
            >Pharmacy</a>  </li>       
   <!--  <li  class="@php echo 'active',(request()->path() != 'lab/referals')?:'';@endphp
            "><a href="{{ url('lab/referals') }}">Referral</a></li> -->
    <!-- <li  class="@php echo 'active',(request()->path() != 'lab/visits')?:'';@endphp
            "><a href="{{ url('lab/visits') }}">Visits</a></li> -->
   <!--  <li  class="@php echo 'active',(request()->path() != 'lab/care-reminders')?:'';@endphp
            "><a href="{{ url('lab/care-reminders') }}">Care Reminders</a></li>
    <br> -->
    <!-- <li  class="@php echo 'active',(request()->path() != 'lab/access-role')?:'';@endphp
            "><a href="">Access Role</a></li> -->
   
    
   <!--  <li  class="@php echo 'active',(request()->path() != 'lab/patient-grouping')?:'';@endphp
            "><a href="{{ url('lab/patient-grouping') }}">Patients Grouping</a></li>
    <li  class="@php echo 'active',(request()->path() != 'lab/resources')?:'';@endphp
            "><a href="{{ url('lab/resources') }}">Resources</a></li> -->
            <li  class="@php echo 'active',(request()->path() != 'forms_library')?:'';@endphp
            "><a href="{{ url('forms_library') }}">Forms Library</a></li>
     @endif   
         
</ul>






