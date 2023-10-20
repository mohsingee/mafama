@php

 $email_body=str_replace('{sponsor_link}',$data['sponsor_link'],$data['email_body']);
 $email_body=str_replace('{sponsor_name}',$data['sponsor_name'],$email_body);
 $email_body=str_replace('{profile_photo}',$data['sponsor_photo'],$email_body);
 $email_body=str_replace('{fullname}',$data['fullname'],$email_body);
 
@endphp

{!! $email_body !!}