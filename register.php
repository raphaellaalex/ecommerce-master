<?php

use PHPMailer\PHPMailer\PHPMailer;

include 'includes/session.php';

	if(isset($_POST['signup'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
        $company_name = $_POST['company_name'];
		$email = $_POST['email'];
		$type = $_POST['type'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['company_name'] = $company_name;
		$_SESSION['email'] = $email;

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup.php');
		}
		else {
            $conn = $pdo->open();

            $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
            $stmt->execute(['email' => $email]);
            $row = $stmt->fetch();
            if ($row['numrows'] > 0) {
                $_SESSION['error'] = 'Email already taken';
                header('location: signup.php');
            } else {
                $conn = $pdo->open();

                $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE company_name=:company_name");
                $stmt->execute(['company_name' => $company_name]);
                $row = $stmt->fetch();
                if ($row['numrows'] > 0) {
                    $_SESSION['error'] = 'Company Name already taken';
                    header('location: signup.php');
                } else {
                    $now = date('Y-m-d');
                    $password = password_hash($password, PASSWORD_DEFAULT);


                    try {
                        $stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, company_name, type, created_on) VALUES (:email, :password, :firstname, :lastname, :company_name, :type, :now)");
                        $stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'company_name' => $company_name, 'type' => $type, 'now' => $now]);
                        $userid = $conn->lastInsertId();


                    } catch (PDOException $e) {
                        $_SESSION['error'] = $e->getMessage();
                        header('location: register.php');
                    }
                    $message = "
					<h2>A new user has been registered</h2>
					<p>Please proceed to the platform to see the Registration</p>
				";

                    //Load phpmailer
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

                        $mail->setFrom('raphaella.alexandraki.thesis@gmail.com');

                        //Recipients
                        $mail->addAddress('raphaella.alexandraki.thesis@gmail.com');
                        $mail->addReplyTo('raphaella.alexandraki.thesis@gmail.com');

                        //Content
                        $mail->isHTML(true);
                        $mail->Subject = 'B2B E-Commerce new user';
                        $mail->Body    = $message;

                        $mail->send();

                        $_SESSION['success'] = 'Your registration is under process. Please check your email.';


                    $pdo->close();
                    header("Location: login.php");

                }

            }
        }

	}
	else{
		$_SESSION['error'] = 'Fill up signup form first';
		header('location: signup.php');
	}

?>