<?php
session_start();

if(!isset($_SESSION['admin_login'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/adminStyle.css">
</head>
<body>

<div class="admin-wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Admin</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="produk.php">Produk</a>
    <a href="order.php">Order</a>
    <a href="kategori.php">Kategori</a>


    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="admin-content">
