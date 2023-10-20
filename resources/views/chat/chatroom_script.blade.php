<script type="text/javascript">
	fetch_user();
	setInterval(function(){		
		//fetch_user();
		update_chat_history_data();
		var elem = document.getElementById('chat_history');
        elem.scrollTop = elem.scrollHeight;		
	}, 5000);


	$("div#videos").show();
    $("div#attachments").hide();
    $(".videos-btn").on("click", function(){
        $("div#videos").show();
        $("div#attachments").hide();
    });
    $(".attachments-btn").on("click", function(){
        $("div#attachments").show();
        $("div#videos").hide();
    });
$("#selectAll").click(function(){
        if(this.checked){
            $('.checkboxall').each(function(){
             $(".checkboxall").prop('checked', true);
             $("#user_checked").val(1);
            })
        }else{
            $('.checkboxall').each(function(){
                $(".checkboxall").prop('checked', false);
                 $("#user_checked").val('');
            })
        }
    });
	function fetch_user()
	{
	 var _token = $("meta[name='csrf-token']").attr("content"); 
		$.ajax({			
			method:"POST",
			url :"{{route('getAdminChatusers')}}" ,
           data :{_token:_token},
			success:function(data){
				$('.chat-list').html(data);
			}
		})
	}
function selectuser(to_user_id){
  $("#to_user_id").val(to_user_id);
  $(".chat-link").removeClass("chat-open current");
  $("#act"+to_user_id).addClass("chat-open current");
  $(".chat_history").attr("data-touserid",to_user_id);
  var _token = $("meta[name='csrf-token']").attr("content"); 
   $.ajax({
      type: "POST",
      url : "{{route('showchat')}}" ,
      data :  {
          to_user_id : to_user_id,                    
          _token : _token                    
           },
      success: function(resp){ 
        resp=jQuery.parseJSON(resp);
        console.log(resp);
        $(".nk-chat-head").html(resp.chat_header);
        $(".chat_history").html(resp.data);
        $("div#videos").html(resp.videos);
        $("div#attachments").html(resp.attachments);
      }
  });
}
function fetch_user_chat_history(to_user_id)
	{
		var _token = $("meta[name='csrf-token']").attr("content"); 
		$.ajax({
			type: "POST",
            url : "{{route('showchat')}}" ,
           data :  {
                   to_user_id : to_user_id,                    
                 _token : _token                    
            },
			success:function(data){
			resp=jQuery.parseJSON(data);
			 $(".nk-chat-head").html(resp.chat_header);
             $(".chat_history").html(resp.data);
             var elem = document.getElementById('chat_history');
              elem.scrollTop = elem.scrollHeight;
			}
		})
	}
function update_chat_history_data()
	{	
			var to_user_id = $("#to_user_id").val();
			//alert(to_user_id);
			if(to_user_id == '')
			{
				//alert('Select user ');
				return false;
			}			
			fetch_user_chat_history(to_user_id);
	}
$(document).on('click', '.remove_chat', function(){
		var chat_message_id = $(this).attr('data-id');
		var to_user_id = $(this).attr('data-toid');
		var _token = $("meta[name='csrf-token']").attr("content"); 
		//if(confirm("Are you sure you want to remove this chat?"))
		//{ }
			$.ajax({
				url:"{{route('DeleteChat')}}",
				method:"POST",
				data:{chat_message_id:chat_message_id,to_user_id:to_user_id,_token:_token},
				success:function(resp)
				{
					//update_chat_history_data();
					resp=jQuery.parseJSON(resp);
			      // $('.write_msg').val('');
			        $(".chat_history").html(resp.data); 
			        var elem = document.getElementById('chat_history');
                    elem.scrollTop = elem.scrollHeight;				
                }
			});
});
$(document).on('click', '.edit_chat', function(){
		var chat_message_id = $(this).attr('data-id');	
		var to_user_id = $(this).attr('data-toid');	
		var _token = $("meta[name='csrf-token']").attr("content");		
			$.ajax({
				url:"{{route('UpdateChat')}}",
				method:"POST",
				data:{chat_message_id:chat_message_id,to_user_id:to_user_id,_token:_token},
				success:function(resp)
				{		
					resp=jQuery.parseJSON(resp);			    
			        $("#msg_id").val(resp.msg_id); 
			        $("#to_user_id").val(resp.to_user_id); 
			        $(".write_msg").html(resp.msg); 
                }
			});
});
$(document).on('click', '.remove_reply', function(){
   $("#reply-msg").html('');
   $("#reply_uid").val('');
});
$(document).on('click', '.reply_chat', function(){
		var chat_message_id = $(this).attr('data-id');	
		var to_user_id = $(this).attr('data-toid');	
		var msg_box = $("#msg-box"+chat_message_id).html();	
		 $("#reply_uid").val(chat_message_id);
		$("#reply-msg").html('<div class="chat-msg" ><span class="float-right remove_reply" style="float:right;cursor:pointer">x</span> You <br>'+msg_box+' </div> '); 
		// var _token = $("meta[name='csrf-token']").attr("content");		
		// 	$.ajax({
		// 		url:"{{route('UpdateChat')}}",
		// 		method:"POST",
		// 		data:{chat_message_id:chat_message_id,to_user_id:to_user_id,_token:_token},
		// 		success:function(resp)
		// 		{		
		// 			resp=jQuery.parseJSON(resp);			    
		// 	        $("#msg_id").val(resp.msg_id); 
		// 	        $("#to_user_id").val(resp.to_user_id); 
		// 	        $(".write_msg").val(resp.msg); 
  //               }
		// 	});
});

function search_user(text){
	var _token = $("meta[name='csrf-token']").attr("content"); 
  $.ajax({
     type: "POST",
     url : "{{route('search_user')}}",
     data :  {
         text  :  text,
         _token : _token },
     success: function(resp){ 
       resp=jQuery.parseJSON(resp);
       $(".chat-list").html(resp.data);   
      }
  });
 }
$(document).ready(function() {


$("#manageadminchatform").submit(function(e)
{
    e.preventDefault();
    
		var to_user_id = $("#to_user_id").val();
		var user_checked = $("#user_checked").val();
		var chat_message = $('.write_msg').html();
		var _token = $("meta[name='csrf-token']").attr("content");
		if(to_user_id == '' && user_checked =='' )
		{
			alert('Select atleast one user ');
			return false;
		}
		if(chat_message == '')
		{
			alert('Type something');
			return false;
		}
		else{
           var formData = new FormData(this);
            var reply_uid= $("#reply_uid").val();
            // if(reply_uid !='')
            // {
            //   var  reply_msg=$("#reply-msg").html();
            //   //alert(reply_msg);
            //   formData.append('chat_message', chat_message);
            // }else{
            // }
             formData.append('chat_message', chat_message);
			$.ajax({
				url : "{{route('msg_send_write_msg')}}" ,
				method:"POST",
				//data:formData,//{to_user_id:to_user_id,_token:_token, chat_message:chat_message},
				 data:formData,
                 cache:false,
                 contentType: false,
                 processData: false,
				success:function(resp)
				{
				   resp=jQuery.parseJSON(resp);
				   $("#manageadminchatform")[0].reset();
				   $(".remove" ).trigger( "click" );
			       $('.write_msg').html('');
			       $("#reply-msg").html('');
			        $(".chat_history").html(resp.data);
			        fetch_user();
			        var elem = document.getElementById('chat_history');
                    elem.scrollTop = elem.scrollHeight;
				}
			})
		}
	});







  if (window.File && window.FileList && window.FileReader) {
    $("#my_file").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">x</span>" +
            "</span>").insertAfter(".attach-sec");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          }); 
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
  if (window.File && window.FileList && window.FileReader) {
    $("#my_file1").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
          	"<video class=\"imageThumb\" title=\"" + file.name + "\"controls><source src=\"" + e.target.result + "\"  type=\"video/mp4\"></video>"+           
            "<br/><span class=\"remove\">x</span>" +
            "</span>").insertAfter(".attach-sec");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          }); 
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>