<?php

use PHPMailer\PHPMailer\PHPMailer;

include 'includes/session.php';

if(isset($_POST['activate'])) {
    $id = $_POST['id'];

    $conn = $pdo->open();

    try {
        $stmt = $conn->prepare("UPDATE users SET users.status=:status WHERE users.id=:id");
        $stmt->execute(['status' => 1, 'id' => $id]);

        $stmt2 = $conn->prepare("UPDATE users,products SET  products.status=:status WHERE users.id=:id AND users.company_name=products.supplier");
        $stmt2->execute(['status' => 1, 'id' => $id]);
        $_SESSION['success'] = 'User activated successfully';

    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    $conn = $pdo->open();

    $stmt1 = $conn->prepare("SELECT distinct email FROM users WHERE id=:id");
    $stmt1->execute(['id' => $id]);
    $row1 = $stmt1->fetch();

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
    $mail->addAddress($row1['email']);
    $mail->addReplyTo('raphaella.alexandraki.thesis@gmail.com');

//Content
    $mail->isHTML(true);
    $mail->Subject = 'B2B E-Commerce';
    $mail->Body = "
					<h2>Registration Approved</h2>
					
					<p>Your registration has been approved!</p> 
					<p>Please proceed to the login page.</p>";

    $mail->send();

    header('location: users.php');


    $pdo->close();

}


header('location: users.php');

if(isset($_POST['decline'])){
    $id = $_POST['id'];

    $conn = $pdo->open();

    try {
        $stmt = $conn->prepare("UPDATE users SET users.status=:status WHERE users.id=:id");
        $stmt->execute(['status' => 0, 'id' => $id]);

        $stmt2 = $conn->prepare("UPDATE users,products SET  products.status=:status WHERE users.id=:id AND users.company_name=products.supplier");
        $stmt2->execute(['status' => 0, 'id' => $id]);
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
/*        $stmt = $conn->prepare("UPDATE users,products SET users.status=:status, products.status=:status WHERE users.id=:id AND users.company_name=products.supplier");
