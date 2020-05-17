<?php
include 'includes/session.php';

$conn = $pdo->open();

$output = array('error'=>false);

$id = $_POST['id'];
$quantity = $_POST['quantity'];

if(isset($_SESSION['user'])){
    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM wishlist WHERE user_id=:user_id AND product_id=:product_id");
    $stmt->execute(['user_id'=>$user['id'], 'product_id'=>$id]);
    $row = $stmt->fetch();
    if($row['numrows'] < 1){
        try{
            $stmt = $conn->prepare("INSERT INTO wishlist (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
            $stmt->execute(['user_id'=>$user['id'], 'product_id'=>$id, 'quantity'=>$quantity]);
            $output['message'] = 'Item added to ordering list';

        }
        catch(PDOException $e){
            $output['error'] = true;
            $output['message'] = $e->getMessage();
        }
    }
    else{
        $output['error'] = true;
        $output['message'] = 'Product already in ordering list';
    }
}
else{
    if(!isset($_SESSION['wishlist'])){
        $_SESSION['wishlist'] = array();
    }

    $exist = array();

    foreach($_SESSION['wishlist'] as $row){
        array_push($exist, $row['productid']);
    }

    if(in_array($id, $exist)){
        $output['error'] = true;
        $output['message'] = 'Product already in ordering list';
    }
    else{
        $data['productid'] = $id;
        $data['quantity'] = $quantity;

        if(array_push($_SESSION['wishlist'], $data)){
            $output['message'] = 'Item added to ordering list';
        }
        else{
            $output['error'] = true;
            $output['message'] = 'Cannot add item to ordering list';
        }
    }

}

$pdo->close();
echo json_encode($output);

?>