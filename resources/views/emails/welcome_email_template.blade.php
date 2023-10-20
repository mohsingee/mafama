
@php

 
 $email_body=str_replace('{fullname}',$data['fullname'],$data['email_body']);
 $email_body=str_replace('{email}',$data['email'],$email_body);
 $email_body=str_replace('{password}',$data['password'],$email_body);
@endphp

{!! $email_body !!}