<?php
include 'includes/session.php';

if(isset($_POST['confirm'])){
$user_id = $_GET['user_id'];
$supplier= $_GET['supplier'];
$company_name = $_GET['company_name'];
$product_id= $_GET['product_id'];
$quantity = $_GET['quantity'];
$total = $_GET['total_price'];
$pay_id= $_GET['pay_id'];
$sales_date = $_GET['sales_date'];


$conn = $pdo->open();

try{
$stmt = $conn->prepare("INSERT INTO sales (user_id, supplier, company_name, product_id, quantity, total_price, pay_id, sales_date) VALUES (:user_id, :supplier, :company_name, :product_id, :quantity, :total_price, :pay_id, :sales_date)");
$stmt->execute(['user_id'=>$user_id, 'supplier'=>$supplier, 'company_name'=>$company_name, 'product_id'=>$product_id, 'quantity'=>$quantity, 'total_price'=>$total, 'pay_id'=>$pay_id, 'sales_date'=>$sales_date]);
$userid = $conn->lastInsertId();


}
catch(PDOException $e){
$_SESSION['error'] = $e->getMessage();
header('location: register.php');
}

$pdo->close();


}
else{
$_SESSION['error'] = 'Fill up signup form first';
header('location: cart_view.php');
}

?>