
var base_url = window.location.origin+'/mafama/';

$(document).ready(function() {
   //$('#treeview-pan').panner({control: $('#pan-5-control')});
    var $section = $('.pan-container').first();
   //$section.find('#treeview-pan').panzoom();
  /*  $('li.subx').on('click',function(){
                    var id = $(this).attr('data-id');
					alert(id);
                   $(this).removeClass('subx');
					
					 $(this).attr('onclick', 'return get_child1('+id+')');
					
                    $("<p class='loadingtext'>Loading Data.. Please wait...</p>").insertAfter("[data-id="+id+"] a");
                    var msg = "";
                     $.ajax({
                     type: "POST",
                     url: "getchildtree",
                     data: "id="+id,
                     cache: false,
                     beforeSend: function(){ $("#loading").show();},
                     success: function(msg)
                        {
                            $('p.loadingtext').remove();
							
						//	$('#genealogy_id').empty().append(msg);
							
							$(msg).insertAfter("[data-id="+id+"] a");
                        }
                
                    });
                   
                });  */
    $("#tree-loading").hide();
    $(".pan-container").show();
});


function get_child(id,sponsor_id)
{
//	alert(111);
//	alert(id);
   var _token = $("meta[name='csrf-token']").attr("content");   
//	$("<p class='loadingtext'>Loading Data.. Please wait...</p>").insertAfter("[data-id="+id+"] a");
	var msg = "";
	$.ajax({
		method: "POST",
		url:base_url+"getchildtree",
		data:{id:id,sponsor_id:sponsor_id,_token:_token},
		cache: false,
		beforeSend: function(){ $("#loading").show();},
		success: function(msg)
		{
		//	$('p.loadingtext').remove();
			$('#genealogy_id').empty().append(msg);
			return false;
			
		}
	});
	return false;
}



$('#SearchID').on('click', function(e)
{
	var sid = $('#sponserid').val();
	if(sid != '')
	{
	    var _token = $("meta[name='csrf-token']").attr("content");   
        $elm=$(".bbn");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
        $.ajax({
            method: "POST",
            url: base_url+"CheckSponser",
            data:{id:sid,_token:_token},
            cache: false,
            success: function(resp)
            {
                 $(".submit-loading").remove();
                $elm.show();
                resp=JSON.parse(resp);
                if(resp.valid)
                {
                    var _token = $("meta[name='csrf-token']").attr("content"); 
                    $.ajax({
                        method: "POST",
		                url:base_url+"getchildtree",
		                data:{id:resp.uid,sponsor_id:resp.sid,_token:_token},
                        cache: false,
                        success: function(msg)
                        {
                            $('#genealogy_id').empty().append(msg);
                            $('.back-to-home').show();
                            return false;
                        }

                    });
                }
                else{
                   
                    toastr.error(resp.message); 
					return false;
                }
               

            },
            error: function(data) {
            }

        });
	}
	else
	{
        _toastr("Enter Sponser ID","bottom-right","info",false);
	}


});



$(document).on('click','.return-btn',function(){
     $('.back-to-home').hide();
})