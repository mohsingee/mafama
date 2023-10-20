<!-- <img src="{{ $img_path }}"> -->
<div <?php if ($bakg != "") { ?> style="padding:10px; background-color: {{ $bakg }}" <?php } ?>>
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
<?php 
	if($img_path != ""){
?>
<img src="{{ $img_path }}" style="width: 50%">
<?php 
	}
?>
</div>