@extends('layouts.main') 
<style>
    html body .card-body .dates span.blocked_day {
        background: #da291c;
        color: white;
        border-radius: 50%;
        display: inline-block;
        height: 45px;
        width: 45px;
        line-height: 45px;
        cursor: pointer;
    }
    html body .card-body .dates span.prev_day {
        background: #da291c;
        color: white;
        border-radius: 50%;
        display: inline-block;
        height: 45px;
        width: 45px;
        line-height: 45px;
        cursor: pointer;
    }
    .table>tbody>tr>td:first-child {
         text-align: center !important; 
    }
    html body .card {
        border-radius: 15px;
        overflow: hidden;
    }

    html body .card-header {
        background: #5c3037;
        color: #fff;
    }

    html body .card-header .prevMonth {
        cursor: pointer;
    }

    html body .card-header .nextMonth {
        cursor: pointer;
    }

    html body .card-body {
        background: #f1acb7;
    }

    html body .card-body .days span {
        background: #e27586;
        color: #fff;
        border-radius: 50%;
        display: inline-block;
        height: 45px;
        width: 45px;
        line-height: 45px;
        cursor: pointer;
    }

    html body .card-body .days span:hover {
        background: #f7899a;
    }

    html body .card-body .dates span {
        background: #f4bdc6;
        color: #000;
        border-radius: 50%;
        display: inline-block;
        height: 45px;
        width: 45px;
        line-height: 45px;
        cursor: pointer;
    }

    html body .card-body .dates span.active,
    html body .card-body .dates span:hover {
        background: #ffeef0;
        color: #000;
    }

    html body .card-body .dates span.ntMonth {
        color: #938e8e;
        background: #ffd8de;
    }

    html body .card-body .dates span.ntMonth:hover {
        background: #ffeef0;
        color: #000;
    }

    html body .card#event .card-header .close {
        color: #fff;
        opacity: 1;
    }

    html body .card#event .card-body .events-today {
        height: 210px;
        overflow-x: hidden;
    }

    html body .card#event .card-body .events-input .data-invalid {
        border-color: red;
    }

    html body .card#event .card-body .events-input .error {
        font-size: 12px;
        color: red;
        position: absolute;
        top: 100%;
    }

    @media (max-width: 767px) {
        html body .card-body .days span {
            height: 38px;
            width: 38px;
            line-height: 38px;
            font-size: 0.8rem;
        }
        html body .card-body .dates span {
            height: 38px;
            width: 38px;
            line-height: 38px;
            font-size: 0.8rem;
        }
        html body .card#event .card-body .events-today {
            height: 188px;
        }
    }
    html body .card-body .days span {
        text-align: center;
    }
    html body .card-header {
        text-align: center;
        padding-top: 10px;
        padding-bottom: 10px;
        background: #5c3037;
        color: #fff;
    }
    html body .card-header span {
        font-size: 20px;
    }
    html body .card-header .prevMonth {
        cursor: pointer;
        margin-right: 30px;
    }
    html body .card-header .nextMonth {
        cursor: pointer;
        margin-left: 30px;
    }
    .days th {
        text-align: center;
    }
    html body .card-body {
        background: #e1f5fe;
    }
    .toast {
        display: none;
    }
    #app .col-sm-6.col-12.d-flex {
        margin-left: 25%;
    }
    .d-none {
        display: none;
    }
    .time-table {
        width: 100%;
        margin-bottom: 0px;
    }
    .time-table th label {
        font-size: 12px;
    }
    .time-table thead {
        background-color: #fae3e2;
        color: #000;
    }
    .bottom-body {
        background-color: #fae3e2 !important;
    }
    .time-table input[type="checkbox"],
    input[type="radio"] {
        margin: 0px 0 0;
        width: 30px;
        height: 30px;
    }
</style>
@section('abanner')
<?php if(count($bbbanner) > 0){ ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="appndbanner" style="margin-bottom: 20px; margin-top: 20px;">
                {!! $bbbanner[0]->preview !!}
            </div>
        </div>
    </div>
</div>
<?php } ?>
@endsection
@section("content")


<!-- -->
<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Appointments / Steps to make appointment</h4>
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
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>
                <!--<ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                                    <li class="active"><a href="add_appointment_setting.php">Appointment</a></li>
                                    <li><a href="#">Client Management</a></li>
                                    <li><a href="#">Email Management</a></li>
                                    <li><a href="#">Financial Management</a></li>
                                    
                                </ul>-->
                <div class="col-md-12">
                    <div class="row process-wizard process-wizard-info">
                        <div class="col-xs-5th process-wizard-step complete">
                            <div class="text-center process-wizard-stepnum">Step 1</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Locate the Professional by Location or by Keyword.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step complete">
                            <!-- complete -->
                            <div class="text-center process-wizard-stepnum">Step 2</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Click Make an Appointment to go to next step.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step active">
                            <!-- complete -->
                            <div class="text-center process-wizard-stepnum">Step 3</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Click on any available date below to view available time for that date.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step disabled">
                            <!-- active -->
                            <div class="text-center process-wizard-stepnum">Step 4</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Enter reason for Appointment.</div>
                        </div>

                        <div class="col-xs-5th process-wizard-step disabled">
                            <!-- active -->
                            <div class="text-center process-wizard-stepnum">Step 5</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="process-wizard-dot"></a>
                            <div class="process-wizard-info text-center">Click on Set Appointment to Proceed.</div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                    <form action="{{ url('user_appointment_step4_details') }}" method="POST" enctype="multipart/form-data">   
                        @csrf
                        <div class="col-md-12 margin-bottom-40 margin-top-20">
                            <div class="col-md-12 text-center margin-bottom-20">
                                <h4>Click on any available date below to view available time for that date.</h4>
                            </div>

                            <div class="col-md-12 margin-bottom-20">
                                <div class="col-md-12 shadow-boxx">
                                    <div id="app"></div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center margin-top-20">
                                <input type="hidden" name="app_date" value="" id="app_date">
                                <input type="hidden" name="id" id="appn_id" value="<?= $id ?>">
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-info" style="margin-right: 10px; width: 200px; height: 34px">Back</a>
                                <button type="submit" class="btn btn-sm btn-info" style="margin-right: 10px; width: 200px; height: 34px">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    let c_date = new Date();
    let day = c_date.getDay();
    let month = c_date.getMonth();
    let year = c_date.getFullYear();

    (function App() {

        const calendar = `<div class="">
            
                <div class="row">
                    <div class="col-sm-6 col-12 d-flex" style="margin-bottom:20px;">
                        <div class="card border-0 mt-5 flex-fill">
                            <div class="card-header py-3 d-flex justify-content-between">
                                <span class="prevMonth">&#10096;</span>
                                <span><strong id="s_m"></strong></span>
                                <span class="nextMonth">&#10097;</span>
                            </div>
                            <div class="card-body px-1 py-3">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless">
                                        <thead class="days text-center">
                                            <tr>
                                                ${Object.keys(days).map(key => (
                                                    `<th><span>${days[key].substring(0,3)}</span></th>`
                                                )).join('')}                                            
                                            </tr>
                                        </thead>
                                        <tbody id="dates" class="dates text-center"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 d-flex">
                        <div class="card border-0 mt-5 flex-fill d-none" id="event">
                            <div class="card-header py-3 text-center">
                                <span class="event-date">06 June 2020 </span> , <span class="event-day">Monday</span>
                                <button type="button" class="close hide">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card-body bottom-body px-1 py-3">
                                
                                <div class="col-12 mb-20" style="padding-left:20px;padding-right:20px;padding-bottom:10px;padding-top:20px;">
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-12" style="border: 2px solid #ddd; border-radius: 4px;">
                                            <p class="avail_alert" style="disply:none"></p>
                                            
                                            <div class="timingsecc"></div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <!--<input type="time" class="form-control" placeholder="Insert time" id="eventTxt">-->
                                    
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-12 mt-2 mb-10"  style="padding-left:20px;padding-right:15px;padding-bottom:10px;padding-top: 10px;">
                                    <textarea class="form-control" name="reason" placeholder="Enter reason for Appointment." required></textarea>
                                    
                                </div>
                                
                                 
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
            `;
        document.getElementById('app').innerHTML = calendar;   
    })()

    function renderCalendar(m, y) {
        //Month's first weekday
        let firstDay = new Date(y, m, 1).getDay();  
        //Days in Month
        let d_m = new Date(y, m+1, 0).getDate();
        //Days in Previous Month
        let d_pm = new Date(y, m, 0).getDate();
        
        let table = document.getElementById('dates');
        table.innerHTML = '';
        let s_m = document.getElementById('s_m');
        s_m.innerHTML = months[m] + ' ' + y;
        let date = 1;
        //remaing dates of last month
        let r_pm = (d_pm-firstDay) +1;
        for (let i = 0; i < 6; i++) {
            let row = document.createElement('tr');
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay) {  
                    let cell = document.createElement('td');
                    let span = document.createElement('span');
                    let cellText = document.createTextNode(r_pm);
                    span.classList.add('ntMonth');
                    span.classList.add('prevMonth');                  
                    cell.appendChild(span).appendChild(cellText);
                    row.appendChild(cell);
                    r_pm++;
                }
                else if (date > d_m && j <7) {
                    if (j!==0) {
                        let i = 0; 
                        for (let k = j; k < 7; k++) {
                             i++                                             
                            let cell = document.createElement('td');
                            let span = document.createElement('span');
                            let cellText = document.createTextNode(i);
                            span.classList.add('ntMonth');                    
                            span.classList.add('nextMonth');                    
                            cell.appendChild(span).appendChild(cellText);
                            row.appendChild(cell);          
                        };                  
                    }                
                   break;
                }
                else {
                    let cell = document.createElement('td');
                    let span = document.createElement('span');
                    let cellText = document.createTextNode(date);
                    span.classList.add('showEvent');

                    let currmonth = new Date(y,m).getMonth();
                    let currentmonth = ("0" + (currmonth + 1)).slice(-2);
                    let currentyear = new Date(y,m).getFullYear();
                    let currentdate = ("0" + (date)).slice(-2);
                    let appn_id = $("#appn_id").val();
                    // console.log(currentmonth);
                    // let dayy = new Date(c_date.getFullYear()+"-"+(("0" + (c_date.getMonth() + 1)).slice(-2))+"-"+date);
                    // console.log(c_date);
                    // if(dayy < c_date){
                    //     span.classList.add("blocked_day");
                    // }
                    // let dayyy = (days[dayy.getDay()]).toLowerCase();
                    // let main_day = "";
                    var url = "<?php echo url('/'); ?>/user_appointmentstepdet";
                    $.ajax({
                          url: url,
                          data: 'date=' + currentdate + '&currentmonth=' + currentmonth + '&currentyear=' + currentyear + '&appn_id=' + appn_id + '&_token={{ csrf_token() }}',
                          type: "POST",
                        success: function (response) {
                            console.log(response);
                            span.classList.add(response);
                            // main_day = response;
                        }
                    });
                    if (date === c_date.getDate() && y === c_date.getFullYear() && m === c_date.getMonth()) {
                        span.classList.add('bg-danger');
                    } 
                    cell.appendChild(span).appendChild(cellText);
                    row.appendChild(cell);
                    date++;
                }
            }
            table.appendChild(row);
        }
    }
    renderCalendar(month, year)


        $(function(){
            function showEvent(eventDate){
                let storedEvents = JSON.parse(localStorage.getItem('events'));
                if (storedEvents == null){
                    $('.events-today').html('<h5 class="text-center">No events found</h5 class="text-center">');               
                }else{
                    let eventsToday = storedEvents.filter(eventsToday => eventsToday.eventDate === eventDate);
                    let eventsList = Object.keys(eventsToday).map(k => eventsToday[k]);
                    if(eventsList.length>0){
                        let eventsLi ='';
                        eventsList.forEach(event =>  $('.events-today').html(eventsLi +=`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${event.eventText}
                        <button type="button" class="close remove-event" data-event-id="${event.id}" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>`));
                    }else{
                        $('.events-today').html('<h5 class="text-center">No events found</h5 class="text-center">');
                    }               
                }
            }
            function removeEvent(id){
                let storedEvents = JSON.parse(localStorage.getItem('events'));
                if(storedEvents != null){
                    storedEvents = storedEvents.filter( ev => ev.id != id ); 
                    localStorage.setItem('events', JSON.stringify(storedEvents));
                    $('.toast-body').html('Your event have been removed');
                    $('.toast').toast('show');
                }
            }        
            $(document).on('click', '.remove-event', function(){
                let eventId = $(this).data('event-id');
                removeEvent(eventId);
            })

            $(document).on('click', '.prevMonth', function(){
                year = (month === 0) ? year - 1 : year;
                month = (month === 0) ? 11 : month - 1;
                renderCalendar(month, year);
            })
            $(document).on('click', '.nextMonth', function(){
                year = (month === 11) ? year + 1 : year;
                month = (month + 1) % 12;
                renderCalendar(month, year);
            })
        
            $(document).on('click', '.showEvent', function(){
                if($(this).hasClass("prev_day")){
                    alert("You can't choose a previous date.");
                    $('#event').addClass('d-none');
                }
                else if($(this).hasClass("blocked_day")) {
                    alert("The day has been blocked.");
                    $('#event').addClass('d-none');
                }
                else{
                    let appn_id = $("#appn_id").val();
                    let todaysDate = $(this).text() +' '+ (months[month]) +' '+ year;
                    let eventDay = days[new Date(year, month, $(this).text()).getDay()];
                    let eventDate = $(this).text() + month + year;
                    $('.showEvent').removeClass('active');
                    $('#event').removeClass('d-none');
                    $(this).addClass('active');
                    $('.event-date').html(todaysDate).data('eventdate', eventDate);
                    $('.event-day').html(eventDay);
                    $("#app_date").val(todaysDate);
                    showEvent(eventDate);
                    // console.log(todaysDate);
                    var url = "<?php echo url('/'); ?>/user_appointment_date_availabilityy";
                    $.ajax({
                          url: url,
                          beforeSend: function(){
                            $("#loading").show();
                            $("#wrapper").hide();
                          },
                          data: 'todaysDate=' + todaysDate + '&appn_id=' + appn_id + '&_token={{ csrf_token() }}',
                          type: "POST",
                        success: function (response) {
                            // alert(response);
                            if(response == "Slot is not available"){
                                $(".avail_alert").show();
                                $(".avail_alert").html(response);
                            }
                            else{
                                console.log(response);
                                // var arr1 = response[0];
                                // console.log(arr1);
                                // $.each(arr1 , function(index, val) { 
                                //     console.log(val);
                                //     $(".timingul").append(" "+val+" ");
                                // });
                                $(".timingsecc").html(response);
                                $(".avail_alert").hide();
                            }
                        },
                        complete: function(){
                            $("#loading").hide();
                            $("#wrapper").show();
                        }
                    });

                }
            })
            $(document).on('click', '.hide', function(){
                $('#event').addClass('d-none');
            })
            $(document).on('click', '#createEvent', function(){
                let events = localStorage.getItem('events');
                let obj = [];
                if (events) {
                    obj = JSON.parse(events);
                }
                let eventDate = $('.event-date').data('eventdate');
                let eventText = $('#eventTxt').val();
                let valid = false;
                $('#eventTxt').removeClass('data-invalid');
                $('.error').remove();
                if (eventText == ''){
                    $('.events-input').append(`<span class="error">Please enter event</span>`);
                    $('#eventTxt').addClass('data-invalid');
                    $('#eventTxt').trigger('focus');
                }else if(eventText.length < 3){
                    $('#eventTxt').addClass('data-invalid');
                    $('#eventTxt').trigger('focus');
                    $('.events-input').append(`<span class="error">please enter at least three characters</span>`);
                }else{
                    valid = true;
                }
                if (valid){
                    let id =1;
                    if (obj.length > 0) {
                        id = Math.max.apply('', obj.map(function (entry) { return parseFloat(entry.id); })) + 1;
                    }
                    else {
                        id = 1;
                    }
                    obj.push({
                        'id' : id,
                        'eventDate': eventDate,
                        'eventText': eventText
                    });           
                    localStorage.setItem('events', JSON.stringify(obj));
                    $('#eventTxt').val('');
                    $('.toast-body').html('Your event have been added');
                    $('.toast').toast('show');
                    showEvent(eventDate);
                }
            })
        })
        function myFunction(id){
            $(".slottime").prop("checked", false);
            $("#"+id).prop("checked", true);
        }
</script>
@endsection