<?php
session_start();
include 'config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($query);

if(!$product){
    header("Location: produk.php");
    exit;
}

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]['qty'] += 1;
}else{
    $_SESSION['cart'][$id] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'qty' => 1,
        'image' => $product['image']
    ];
}

header("Location: cart.php");
exit;
