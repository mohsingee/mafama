
<div style="padding:20px 10px;">
<div style="padding: 20px">
	{!! $user_banner !!}
</div>

{!! $body !!}<br>
<?php 
	if($image != ""){
?>
<img src="{{ $image }}" style="width: 50%">
<?php 
	}
?>
</div>