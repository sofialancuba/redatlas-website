<?php

require('phpmailer/class.phpmailer.php');
require('phpmailer/class.smtp.php');

function write_log($cadena) {
    $arch = fopen('leads.txt','a+');
    // $cadena=iconv('UTF-8','ISO-8859-1//TRANSLIT',$cadena);
    fwrite($arch,$cadena);
    fclose($arch);
}

/* config start */

$emailAddressTo = 'rodrigo.vidal@atlas.red';
$fromName = "Website - Atlas";
$smtp = false;

/* NOTE: IF YOU RECIEVED THIS MESSAGE "Error Occured:Could not instantiate mail function." YOU SHOULD SET SMTP CONFIG
 * AND SET $SMTP VALUE TO TRUE */

/* config end */

$email = $_POST['email'];

$msg =
'Name:	'.$_POST['name'].'<br />
Company:	'.$_POST['company'].'<br />
Email:	'.$_POST['email'].'<br />
Phone number:	'.$_POST['phone'].'<br />

Message:<br /><br />

'.nl2br($_POST['message']).'

';

$mail = new PHPMailer(); // create a object to that class.

if ($smtp) {

    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = "ssl";
    $mail->Port       = 465;

    // optional
    // used only when SMTP requires authentication

    $mail->SMTPAuth = true;
    $mail->first_name = 'mail';
    $mail->Password = 'pass';
}

$mail->Timeout = 360;

$mail->Subject = "New contact | in atlas.red";
$from = $_POST['name'];
$mail->From = $email;
$mail->FromName = $_POST['name'];
$mail->AddReplyTo($email, $from);
$mail->AddAddress($emailAddressTo, '');
$mail->AddAddress('info@atlas.red', '');

$mail->MsgHTML($msg);

$mail->Body = $msg;

/* Guardo la consulta en un txt */

$fecha = new DateTime();

$msgTxt=
'Name: '.$_POST['name'].'
Company: '.$_POST['company'].'
Email: '.$_POST['email'].'
Phone: '.$_POST['phone'].'
Message:
'.nl2br($_POST['message']).'
';

write_log("--------- ".$fecha->format('d-m-Y H:i:s')." -------\n");
write_log($msgTxt . "\n");
write_log("\n");

if (!$mail->Send()) {
    mail($emailAddressTo, "New message from ".$_POST['name']." | in atlas.red", $msg);
}

header("Location: https://atlas.red#sent");
exit();

?>
