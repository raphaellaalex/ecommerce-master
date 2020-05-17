<?php
	include 'includes/session.php';

	if(isset($_GET['pay'])){
		$payid = $_GET['pay'];
		$total = $_GET['total'];
		$date = date('Y-m-d');


		$conn = $pdo->open();

		try{
            $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date) VALUES (:user_id, :pay_id, :sales_date)");
            $stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date]);
            $salesid = $conn->lastInsertId();


            try{
            $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id LEFT JOIN users ON cart.user_id=users.id WHERE user_id=:user_id");
            $stmt->execute(['user_id'=>$user['id']]);

            foreach($stmt as $row1) {

                $stmt = $conn->prepare("INSERT INTO details (user_id, sales_date, sales_id,supplier, product_id,quantity, company_name) VALUES (:user_id, :sales_date, :sales_id, :supplier, :product_id, :quantity, :company_name)");
                $stmt->execute(['user_id' => $user['id'], 'sales_date' => $date, 'sales_id'=>$salesid,'supplier' => $row1['supplier'], 'product_id'=>$row1['product_id'], 'quantity'=>$row1['quantity'], 'company_name' => $row1['company_name']]);
            }

				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				$_SESSION['success'] = 'Transaction successful. Thank you.';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	
	header('location: profile.php');
	
?>