<?php
include 'includes/session.php';

if(isset($_POST['activate'])){
    $id = $_POST['id'];

    $conn = $pdo->open();

    try{
        $stmt = $conn->prepare("UPDATE products SET status=:status WHERE id=:id");
        $stmt->execute(['status'=>1, 'id'=>$id]);
        $_SESSION['success'] = 'Product activated successfully';

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }

    $pdo->close();

}


header('location: products.php');

if(isset($_POST['disable'])){
    $id = $_POST['id'];

    $conn = $pdo->open();

    try{
        $stmt = $conn->prepare("UPDATE products SET status=:status WHERE id=:id");
        $stmt->execute(['status'=>0, 'id'=>$id]);
        $_SESSION['success'] = 'Product disabled';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }

    $pdo->close();

}

header('location: products.php');
