<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		$conn = $pdo->open();


		$sql = $conn ->query( "SELECT * FROM products JOIN category WHERE products.category_id = category.id AND category.id='".$id."'");
		if ($sql->rowCount() > 0)
        {
            $_SESSION['error'] = 'This category contains Products';
        }
        else{
            $stmt = $conn->prepare("DELETE FROM category  WHERE id=:id");
            $stmt->execute(['id'=>$id]);

            $_SESSION['success'] = 'Category deleted successfully';
        }


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select category to delete first';
	}

	header('location: category.php');
	
?>