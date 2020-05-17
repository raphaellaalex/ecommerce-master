<?php
	include 'includes/session.php';

	$output = '';
    $where2 = '';
    if(isset($_GET['company_name'])) {
        $comid = $_GET['company_name'];
        $where2 = 'WHERE company_name =' . $comid;
    }
	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM products $where2");
	$stmt->execute();
	foreach($stmt as $row){
		$output .= "
			<option value='".$row['id']."' class='append_items'>".$row['name']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>