<?php

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['contact'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $body=$_POST['body'];

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);
//Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'raphaella.alexandraki.thesis@gmail.com';
    $mail->Password = 'Rafa1910!';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($email);

//Recipients
    $mail->addAddress('raphaella.alexandraki.thesis@gmail.com');
    $mail->addReplyTo($email);
//
////Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = " <p>Name: ".$name." </p> 
                    <p>".$body." </p> ";


    if($mail->send()) {
        echo "<script>
                alert('Email has been sent successfully.');
            </script>";
    }
    else
    {
        echo "<script>
                alert('Submission failed.');
            </script>";
    }
    header('Location: contact.php');
}