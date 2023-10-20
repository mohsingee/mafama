
<div <?php if ($bakg != "") { ?> style="padding:20px 10px; background-color: {{ $bakg }}" <?php } ?>>
<div style="padding: 5px">
	{!! $user_banner !!}
</div>
<?php 
	if($greetings != ""){
?>
<p style="margin-bottom: 0px; color: {{ $forecolorr }}">
	{{ $greetings }} {{ $username }},
</p>
<?php 
	}
?>
{!! $body !!}<br>
<img src="http://i.countdownmail.com/zkt9h.gif?end_date_time=2021-04-08T09:46:33+00:00" border="0" alt="countdownmail.com"/>
</div>