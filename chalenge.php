<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;

include 'db_con.php';

$email = $_POST['email'];
$money = $_POST['money'];
$query = "SELECT username FROM users WHERE id = '".$_SESSION['id_login']."'";
$go_query = mysqli_query($conected, $query);
$name = mysqli_fetch_assoc($go_query);
$name = $name['username'];

$mail = new PHPMailer();
$mail->isSMTP();

$mail->SMTPDebug = 3;
$mail->CharSet = 'utf-8';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true);
$mail->Username = 'misternet101@gmail.com';
$mail->Password = '227204153';

$mail->SetFrom('misternet101@gmail.com');
$mail->AddAddress( $email );

$mail->Subject = ' חברך '.$name.' רוצה לאתגר אותך:';

$body = '<div style="padding: 10px; text-align: center; border: solid 1px black; width: 50%; margin: auto;"><h2> חברך '.$name.' רוצה לאתגר אותך:</h2><h3> אני זכיתי ב - ' . $money . ' מיליון שקל</h3><h3>בא נראה בכמה מיליונים אתה זוכה במשחק</h3><a style="display: block; width: 100px; text-decoration: none; margin: auto; padding: 3px 10px; color: white; background-color: green; border-radius:20px;" href="http://pais.grupopardes.com">בא תרויח</a></div>';
echo $body;
$mail->Body = html_entity_decode($body);
$mail->IsHTML(true);
//בדיקה אם המייל נשלח
if($mail->send()){
    echo 'send';
} else {
    echo $mail->ErrorInfo;
};

