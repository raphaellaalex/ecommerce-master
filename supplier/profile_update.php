<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
		
	}
	else{
		$return = 'home.php';
	}

if(isset($_POST['save'])){
    $curr_password = $_POST['curr_password'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $company_name = $_POST['company_name'];
    $city = $_POST['city'];
    $contact_info = $_POST['contact_info'];
    $address = $_POST['address'];
    $photo = $_FILES['photo']['name'];
    if(password_verify($curr_password, $supplier['password'])){
        if(!empty($photo)){
            move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photo);
            $filename = $photo;
        }
        else{
            $filename = $admin['photo'];
        }

        if($password == $supplier['password']){
            $password = $supplier['password'];
        }
        else{
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $conn = $pdo->open();

        try {
            $stmt = $conn->prepare("UPDATE users SET email=:email, password=:password, firstname=:firstname, lastname=:lastname, company_name=:company_name, city=:city, contact_info=:contact_info, address=:address, photo=:photo WHERE id=:id");
            $stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'company_name' => $company_name, 'city' => $city, 'contact_info' => $contact_info, 'address' => $address, 'photo' => $filename, 'id' => $supplier['id']]);

            $_SESSION['success'] = 'Account updated successfully';
        }
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

			$pdo->close();
			
		}
		else{
			$_SESSION['error'] = 'Incorrect password';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up required details first';
	}

	header('location:'.$return);

?>