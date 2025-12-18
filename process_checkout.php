<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['user_login'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$total   = 0;

// hitung total
foreach($_SESSION['cart'] as $item){
    $total += $item['price'] * $item['qty'];
}

// simpan ke orders
mysqli_query($koneksi, "
    INSERT INTO orders (user_id, total, status)
    VALUES ('$user_id', '$total', 'pending')
");

$order_id = mysqli_insert_id($koneksi);

// simpan ke order_items
foreach($_SESSION['cart'] as $item){
    $nama  = $item['name'];
    $qty   = $item['qty'];
    $price = $item['price'];

    mysqli_query($koneksi, "
        INSERT INTO order_items (order_id, nama_produk, qty, price)
        VALUES ('$order_id', '$nama', '$qty', '$price')
    ");
}

// kosongkan cart
unset($_SESSION['cart']);

header("Location: success.php");
exit;
