<?php

function sendemail($to, $from, $subject, $message) {
  $mail = new PHPMailer();
  $mail->IsSMTP(); 
  $mail->Host = 'purpletoaster.com';
  $mail->Port = 25;
  $mail->SMTPAuth = true;
  $mail->Username = 'info@iapps4.me';
  $mail->Password = 'sucssucs';
  $mail->SetFrom($from, 'iApps4me');
  $mail->AddAddress($to);
  $mail->Subject = $subject;
  $mail->Body = $message;
  if(!$mail->Send()) {
    die ('Mailer error: '. $mail->ErrorInfo);
  } else {
  }
}

function new_hash() {
    $keyset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $max = strlen($keyset)-1;
    $hash = "";
    for ($i=0; $i<32; $i++) {
        $hash .= substr($keyset, rand(0, $max), 1);
    }
    
    $sql = "SELECT hash FROM solutions WHERE hash='$hash'";
    $exists = mysql_num_rows( @mysql_query ($sql)) != 0;
    
    if(!$exists) {
        return $hash;
    }
    else {
        return new_hash();
    }
}
