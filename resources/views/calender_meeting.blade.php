@extends('layouts.main') 
@section("content")
<style type="text/css">
	p, pre, ul, ol, dl, dd, blockquote, address, table, fieldset, form{
		margin-bottom: 0;
	}
	.fc-content-skeleton thead {
		background: transparent;
		color: red;
	}
	span, a {
	    color: #fae3e2;
	}
	.fc-event-time{
	   display : none;
	}
	.fc-time{
	   display : none;
	}
</style>
<section>
    <div class="container">
    	<div id="calendar"></div>
    </div>
</section>

<div id="calendarModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: aliceblue;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            </div>
            <form method="POST" action="<?php echo url('addevents') ?>">
              @csrf
              <div id="modalBody" class="modal-body" style=""> 
                  
                  <div class="" style="margin-bottom: 0px;">
                    <div class="">
                      <div class="form-group">
                        <label for="">Event Name</label>
                        <input type="text" class="form-control" name="title" required placeholder="Enter Name">
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                      </div>

                      <input type="hidden" name="start" id="starttime">
                      <input type="hidden" name="end" id="endtime">
                    </div>
                </div>
                  
              </div>
              <div class="modal-footer" style="background-color: aliceblue;">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
            
        </div>
    </div>
</div>
<div id="calendarUpdateModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: aliceblue;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            </div>
            <form method="POST" action="<?php echo url('addevents') ?>">
              @csrf
              <div id="modalBody" class="modal-body" style=""> 
                  
                  <div class="" style="margin-bottom: 0px;">
                    <div class="">
                      <div class="form-group">
                        <label for="">Event Name</label>
                        <input type="text" id="event_name" class="form-control" name="title" required placeholder="Enter Name">
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <textarea id="event_description" class="form-control" name="description" required></textarea>
                      </div>

                      <input type="hidden" name="start" id="starttime">
                      <input type="hidden" name="end" id="endtime">
                    </div>
                </div>
                  
              </div>
              <div class="modal-footer" style="background-color: aliceblue;">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
            
        </div>
    </div>
</div>
<script type="text/javascript">
      $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
	    var url = "<?php echo url('/'); ?>/calendarcheck";
	    var url2 = "<?php echo url('/'); ?>/addevents";
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });

          });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
        	displayEventTime : false,
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
          },
          buttonText: {
            today: 'today',
            month: 'month',
          },
          //Random default events
          events: 
            {
              url: url,
  	          type: 'GET', // Send post data
  	          data: {
  	              
  	          },
  	          error: function() {
  	              alert('There was an error while fetching events.');
  	          },
  	          success: function(data) {
  	            
  	          },
            },
      		
  	      selectable:true,
  	      selectHelper:true,
          
            select: function(start, end, jsEvent, view) {
      	        // var abc = prompt('Enter title');
      	        // var description = prompt("Enter Description");
      	        var newEvent = new Object();
      	        // if(abc == "No") {
      	          // newEvent.title = abc;
      	          newEvent.start = moment(start).format();
      	          newEvent.end = moment(end).format();
                  var endt = moment(end).format("YYYY-MM-DD HH:mm");
      	          newEvent.allDay = false;
                  var dates = new Date();
                  var datess = new Date(endt);
                  var date1 = Date.parse(dates);
                  var date2 = Date.parse(datess);
                  var flag = 0;
                  if (date1>date2) {
                      alert("Please select an appropriate date slot other than the past slot!");
                      flag = 1;
                  }
                  else {
                      $('#modalBody #starttime').val(moment(event.start).format("YYYY-MM-DD HH:mm"));
                      $('#modalBody #endtime').val(moment(event.end).format("YYYY-MM-DD HH:mm"));
                      $('#calendarModal').modal();
                  }
      			      // alert(newEvent.start);
      	        // if (abc) {
      	        //   $.ajax({
      	        //             url: url2,
      	        //             data: 'title=' + newEvent.title + '&description=' + description + '&start=' + newEvent.start + '&end=' + newEvent.end + '&_token={{ csrf_token() }}',
      	        //             type: "POST",
      	        //             success: function (data) {
      	        //               $("#calendar").fullCalendar('refetchEvents');
      	        //                 alert("Slot Successfully Blocked!!!");
      	        //                 // alert(data);
      	        //             }
      	        //         });
      	        //     // $('#calendar').fullCalendar('renderEvent', newEvent, true);
      	        // }
              $('#calendar').fullCalendar('unselect');
    	        $('#calendar').fullCalendar('unselect');

    	      },
            eventClick: function(calEvent, jsEvent, view) {
              alert(calEvent.description);
                $('#calendarUpdateModal #starttime').val(moment(calEvent.start).format("YYYY-MM-DD HH:mm"));
                $('#calendarUpdateModal #endtime').val(moment(calEvent.end).format("YYYY-MM-DD HH:mm"));
                $('#calendarUpdateModal #event_name').val(calEvent.title);

                $('#calendarUpdateModal').modal();
            }
        });

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          //Save color
          currColor = $(this).css("color");
          //Add color effect to button
          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
          e.preventDefault();
          //Get value and make sure it is not null
          var val = $("#new-event").val();
          if (val.length == 0) {
            return;
          }

          //Create events
          var event = $("<div />");
          event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
          event.html(val);
          $('#external-events').prepend(event);

          //Add draggable funtionality
          ini_events(event);

          //Remove event from text input
          $("#new-event").val("");
        });
      });
    </script>
@endsection