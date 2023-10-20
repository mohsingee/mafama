
<?php

 
 $email_body=str_replace('{fullname}',$data['fullname'],$data['email_body']);
 $email_body=str_replace('{email}',$data['email'],$email_body);
 $email_body=str_replace('{password}',$data['password'],$email_body);
?>

<?php echo $email_body; ?><?php /**PATH /home/mafamatest/public_html/resources/views/emails/welcome_email_template.blade.php ENDPATH**/ ?>