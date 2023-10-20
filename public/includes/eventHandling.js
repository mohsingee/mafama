 var timeoutID;
 

var base_url = window.location.origin+'/';



 

function setup() {
    this.addEventListener("mousemove", resetTimer, false);
    this.addEventListener("mousedown", resetTimer, false);
    this.addEventListener("keypress", resetTimer, false);
    this.addEventListener("DOMMouseScroll", resetTimer, false);
    this.addEventListener("mousewheel", resetTimer, false);
    this.addEventListener("touchmove", resetTimer, false);
    this.addEventListener("MSPointerMove", resetTimer, false);
 
    startTimer();
}
setup();
 
function startTimer() {
    // wait 5 seconds before calling goInactive
    timeoutID = window.setTimeout(goInactive, 5000);
}
 
function resetTimer(e) {
    window.clearTimeout(timeoutID);
 
    goActive();
}
 
function goInactive() {
    // do something
     update_loginuser_idletime();
     //console.log('idle mode'); 
}
 
function goActive() {
    // do something
   
    update_loginuser_stroketime();
    // console.log('stroke mode');   
    startTimer();
}
  
// update idle time

function update_loginuser_idletime() {
 
        var token = $("meta[name='csrf-token']").attr("content");           
           $.ajax({
            method:"POST",
            url:base_url+'update-idle-time',
            data:{_token:token},
            success:function(data)
            {
              console.log(data);
            }
        });
}


function update_loginuser_stroketime() {
 
        var token = $("meta[name='csrf-token']").attr("content");           
           $.ajax({
            method:"POST",
            url:base_url+'update-stroke-time',
            data:{_token:token},
            success:function(data)
            {
              console.log(data);
            }
        });
}





//let timer, currSeconds = 0; 
     //   function resetTimer() { 
            /* Hide the timer text */ 
           // document.querySelector(".timertext") 
            //        .style.display = 'none'; 
            /* Clear the previous interval */ 
           // clearInterval(timer); 
            /* Reset the seconds of the timer */ 
          //  currSeconds = 0; 
            /* Set a new interval */ 
          //  timer = 
            //    setInterval(startIdleTimer, 1000); 
      //  } 

        // Define the events that 
        // would reset the timer 
      //  window.onload = resetTimer; 
   //     window.onmousemove = resetTimer; 
      //  window.onmousemove = setInterval(update_loginuser_stroketime, 1000); ; 
      //  window.onmousedown = resetTimer; 
       // window.ontouchstart = resetTimer; 
       // window.onclick = resetTimer; 
     //   window.onkeypress = resetTimer; 
       // function startIdleTimer() {             
            /* Increment the 
                timer seconds */ 
        //    currSeconds++; 
         
   //    update_loginuser_idletime();
         // console.log('idle mode');  

        

    //    } 
        
        
        
// document.getElementById("body_listener").addEventListener("mousemove", function(event) {

//     setInterval(update_loginuser_stroketime(),1000);
//       console.log('stroke mode'); 
// });        