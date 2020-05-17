
<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $name = $_POST['name'];

    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM category WHERE name=:name");
    $stmt->execute(['name'=>$name]);
    $row = $stmt->fetch();

    if($row['numrows'] > 0){
        $_SESSION['error'] = 'Category already exist';
    }
    else{
        try{
            $stmt = $conn->prepare("INSERT INTO category (name,cat_slug) VALUES (:name,:name)");
            $stmt->execute(['name'=>$name,'cat_slug'=>$name]);
            $_SESSION['success'] = 'Category submitted successfully, please wait for the approval';
        }
        catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }
    }

    $pdo->close();
}
else{
    $_SESSION['error'] = 'Fill up category form first';
}

header('location: category.php');

?>