<?php
include 'includes/session.php';

if(isset($_POST['activatecat'])){
    $id = $_POST['id'];

    $conn = $pdo->open();

    try{
        $stmt = $conn->prepare("UPDATE category SET status=:status WHERE id=:id");
        $stmt->execute(['status'=>1, 'id'=>$id]);
        $_SESSION['success'] = 'Category activated successfully';

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }

    $pdo->close();

}


header('location: category.php');

if(isset($_POST['declinecat'])){
    $id = $_POST['id'];

    $conn = $pdo->open();

    try{
        $stmt = $conn->prepare("UPDATE category SET status=:status WHERE id=:id");
        $stmt->execute(['status'=>0, 'id'=>$id]);
        $_SESSION['success'] = 'Category declined';
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }

    $pdo->close();

}

header('location: category.php');