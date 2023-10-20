'use strict';

//Public Globals
const days = ['Sunday', 'Monday', 'Tuesday', 'Wedensday', 'Thursday', 'Friday', 'Saturday'];
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
									<div class="col-md-1" style="padding: 8px;">
										<label style="margin-top:45px;font-size:24px;">AM </label>
									</div>
									<div class="col-md-11">
										<table class="table-bordered time-table">
											<thead>
												<tr>
													<th><label for="slot1">12:00</lable></th>
													<th><label for="slot2">12:30</lable></th>
													<th><label for="slot3">01:00</lable></th>
													<th><label for="slot4">01:30</lable></th>
													<th><label for="slot5">02:00</lable></th>
													<th><label for="slot6">02:30</lable></th>
													<th><label for="slot7">03:00</lable></th>
													<th><label for="slot8">03:30</lable></th>
													<th><label for="slot9">04:00</lable></th>
													<th><label for="slot10">04:30</lable></th>
													<th><label for="slot11">05:00</lable></th>
													<th><label for="slot12">05:30</lable></th>
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="checkbox" id="slot1" name="slot1" value="12:00"></td>
													<td><input type="checkbox" id="slot2" name="slot2" value="12:30"></td>
													<td><input type="checkbox" id="slot3" name="slot3" value="01:00"></td>
													<td><input type="checkbox" id="slot4" name="slot4" value="01:30"></td>
													<td><input type="checkbox" id="slot5" name="slot5" value="02:00"></td>
													<td><input type="checkbox" id="slot6" name="slot6" value="02:30"></td>
													<td><input type="checkbox" id="slot7" name="slot7" value="03:00"></td>
													<td><input type="checkbox" id="slot8" name="slot8" value="03:30"></td>
													<td><input type="checkbox" id="slot9" name="slot9" value="04:00"></td>
													<td><input type="checkbox" id="slot10" name="slot10" value="04:30"></td>
													<td><input type="checkbox" id="slot11" name="slot11" value="05:00"></td>
													<td><input type="checkbox" id="slot12" name="slot12" value="05:30"></td>
												</tr>
											</tbody>
										</table>
										<table class="table-bordered time-table">
											<thead>
												<tr>
													<th><label for="slot13">06:00</lable></th>
													<th><label for="slot14">06:30</lable></th>
													<th><label for="slot15">07:00</lable></th>
													<th><label for="slot16">07:30</lable></th>
													<th><label for="slot17">08:00</lable></th>
													<th><label for="slot18">08:30</lable></th>
													<th><label for="slot19">09:00</lable></th>
													<th><label for="slot20">09:30</lable></th>
													<th><label for="slot21">10:00</lable></th>
													<th><label for="slot22">10:30</lable></th>
													<th><label for="slot23">11:00</lable></th>
													<th><label for="slot24">11:30</lable></th>
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="checkbox" id="slot13" name="slot13" value="06:00"></td>
													<td><input type="checkbox" id="slot14" name="slot14" value="06:30"></td>
													<td><input type="checkbox" id="slot15" name="slot15" value="07:00"></td>
													<td><input type="checkbox" id="slot16" name="slot16" value="07:30"></td>
													<td><input type="checkbox" id="slot17" name="slot17" value="08:00"></td>
													<td><input type="checkbox" id="slot18" name="slot18" value="08:30"></td>
													<td><input type="checkbox" id="slot19" name="slot19" value="09:00"></td>
													<td><input type="checkbox" id="slot20" name="slot20" value="09:30"></td>
													<td><input type="checkbox" id="slot21" name="slot21" value="10:00"></td>
													<td><input type="checkbox" id="slot22" name="slot22" value="10:30"></td>
													<td><input type="checkbox" id="slot23" name="slot23" value="11:00"></td>
													<td><input type="checkbox" id="slot24" name="slot24" value="11:30"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-1" style="padding: 8px;">
										<label style="margin-top:45px;font-size:24px;">PM </label>
									</div>
									<div class="col-md-11">
										<table class="table-bordered time-table">
											<thead>
												<tr>
													<th><label for="slot01">12:00</lable></th>
													<th><label for="slot02">12:30</lable></th>
													<th><label for="slot03">01:00</lable></th>
													<th><label for="slot04">01:30</lable></th>
													<th><label for="slot05">02:00</lable></th>
													<th><label for="slot06">02:30</lable></th>
													<th><label for="slot07">03:00</lable></th>
													<th><label for="slot08">03:30</lable></th>
													<th><label for="slot09">04:00</lable></th>
													<th><label for="slot010">04:30</lable></th>
													<th><label for="slot011">05:00</lable></th>
													<th><label for="slot012">05:30</lable></th>
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="checkbox" id="slot01" name="slot01" value="12:00"></td>
													<td><input type="checkbox" id="slot02" name="slot02" value="12:30"></td>
													<td><input type="checkbox" id="slot03" name="slot03" value="01:00"></td>
													<td><input type="checkbox" id="slot04" name="slot04" value="01:30"></td>
													<td><input type="checkbox" id="slot05" name="slot05" value="02:00"></td>
													<td><input type="checkbox" id="slot06" name="slot06" value="02:30"></td>
													<td><input type="checkbox" id="slot07" name="slot07" value="03:00"></td>
													<td><input type="checkbox" id="slot08" name="slot08" value="03:30"></td>
													<td><input type="checkbox" id="slot09" name="slot09" value="04:00"></td>
													<td><input type="checkbox" id="slot010" name="slot010" value="04:30"></td>
													<td><input type="checkbox" id="slot011" name="slot011" value="05:00"></td>
													<td><input type="checkbox" id="slot012" name="slot012" value="05:30"></td>
												</tr>
											</tbody>
										</table>
										<table class="table-bordered time-table">
											<thead>
												<tr>
													<th><label for="slot013">06:00</lable></th>
													<th><label for="slot014">06:30</lable></th>
													<th><label for="slot015">07:00</lable></th>
													<th><label for="slot016">07:30</lable></th>
													<th><label for="slot017">08:00</lable></th>
													<th><label for="slot018">08:30</lable></th>
													<th><label for="slot019">09:00</lable></th>
													<th><label for="slot020">09:30</lable></th>
													<th><label for="slot021">10:00</lable></th>
													<th><label for="slot022">10:30</lable></th>
													<th><label for="slot023">11:00</lable></th>
													<th><label for="slot024">11:30</lable></th>
													
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="checkbox" id="slot013" name="slot013" value="06:00"></td>
													<td><input type="checkbox" id="slot014" name="slot014" value="06:30"></td>
													<td><input type="checkbox" id="slot015" name="slot015" value="07:00"></td>
													<td><input type="checkbox" id="slot016" name="slot016" value="07:30"></td>
													<td><input type="checkbox" id="slot017" name="slot017" value="08:00"></td>
													<td><input type="checkbox" id="slot018" name="slot018" value="08:30"></td>
													<td><input type="checkbox" id="slot019" name="slot019" value="09:00"></td>
													<td><input type="checkbox" id="slot020" name="slot020" value="09:30"></td>
													<td><input type="checkbox" id="slot021" name="slot021" value="10:00"></td>
													<td><input type="checkbox" id="slot022" name="slot022" value="10:30"></td>
													<td><input type="checkbox" id="slot023" name="slot023" value="11:00"></td>
													<td><input type="checkbox" id="slot024" name="slot024" value="11:30"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
								
								<!--<input type="time" class="form-control" placeholder="Insert time" id="eventTxt">-->
                                
                            </div>
							<div class="clearfix"></div>
							<div class="col-12 mt-2 mb-10"  style="padding-left:20px;padding-right:15px;padding-bottom:10px;padding-top: 10px;">
                                <textarea class="form-control" placeholder="Enter reason for Appointment."></textarea>
                                
                            </div>
							<div class="col-12 mt-2"  style="padding-left:20px;padding-right:20px;text-align:center;padding-bottom:20px;">
                                <div class="input-group-append">
                                    <button class="btn btn-xs btn-info" type="button" id="createEvent">Save</button>
                                </div>
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
            $('.showEvent').removeClass('active');
            $('#event').removeClass('d-none');
            $(this).addClass('active');
            let todaysDate = $(this).text() +' '+ (months[month]) +' '+ year;
            let eventDay = days[new Date(year, month, $(this).text()).getDay()];
            let eventDate = $(this).text() + month + year;
            $('.event-date').html(todaysDate).data('eventdate', eventDate);
            $('.event-day').html(eventDay);
            showEvent(eventDate);
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

            
