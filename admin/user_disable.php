<?php

use PHPMailer\PHPMailer\PHPMailer;

include 'includes/session.php';

if (isset($_POST['disable'])) {
    $id = $_POST['id'];

    $conn = $pdo->open();

    try {
        $stmt = $conn->prepare("UPDATE users SET status=:status WHERE id=:id");
        $stmt->execute(['status' => 0, 'id' => $id]);
        $_SESSION['success'] = 'User disabled successfully';

    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    $stmt2 = $conn->prepare("SELECT distinct email FROM users WHERE id=:id");
    $stmt2->execute(['id'=>$id]);
    $row2 = $stmt2->fetch();

    require '../vendor/autoload.php';

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

    $mail->setFrom('raphaella.alexandraki.thesis@gmail.com');

//Recipients
    $mail->addAddress($row2['email']);
    $mail->addReplyTo('raphaella.alexandraki.thesis@gmail.com');
//
////Content
    $mail->isHTML(true);
    $mail->Subject = 'B2B E-Commerce';
    $mail->Body = "
					<h2>Your account has been disabled</h2>
					
					<p>You are no longer allowed to login into the system</p> 
					<p>For further information send us an email.</p>";

    $mail->send();
    header('location: users.php');


    $pdo->close();

}
header('location: users.php');
