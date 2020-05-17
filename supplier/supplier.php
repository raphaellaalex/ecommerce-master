<?php


include 'includes/session.php';

$output = '';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT id,company_name FROM users WHERE type = 2 AND id=$_SESSION[supplier]");
$stmt->execute();

foreach ($stmt as $row) {
    $output .= "
			<option value='" . $row['company_name'] . "' class='append_items'>" . $row['company_name'] . "</option>
		";
}

$pdo->close();
echo json_encode($output);

