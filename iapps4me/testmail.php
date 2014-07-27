<?php

include_once('class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP(); 
$mail->Host = 'purpletoaster.com';
$mail->Port = 25;
$mail->SMTPAuth = true;
$mail->Username = 'info@iapps4.me';
$mail->Password = 'sucssucs';
$mail->SetFrom('info@iapps4.me', 'iApps4me');
$mail->AddAddress('admin@nisch.org');
$mail->Subject = 'Test Message';
$mail->Body = 'This is the body';
if(!$mail->Send()) {
  echo 'Mailer error: '.$mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}

?>
