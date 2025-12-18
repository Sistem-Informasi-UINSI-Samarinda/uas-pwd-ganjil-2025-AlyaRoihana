<?php
include '../config/koneksi.php';

$id     = $_POST['id'];
$status = $_POST['status'];

mysqli_query(
    $koneksi,
    "UPDATE orders SET status='$status' WHERE id='$id'"
);

header("Location: order_detail.php?id=$id");
exit;
