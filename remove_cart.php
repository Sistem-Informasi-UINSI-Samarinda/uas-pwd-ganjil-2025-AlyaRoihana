<?php
session_start();

if(isset($_GET['id'])){
    $id = (int)$_GET['id']; // Pastikan integer

    if(!empty($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key => $item){
            if($item['id'] == $id){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex
                break;
            }
        }
    }
}

header("Location: cart.php");
exit;
