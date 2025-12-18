<?php
session_start();
include "config/koneksi.php";

// Ambil ID produk dari URL
if(!isset($_GET['id'])){
    header("Location: produk.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM products WHERE id='$id'");
$produk = mysqli_fetch_assoc($query);

// Jika produk tidak ditemukan
if(!$produk){
    header("Location: produk.php");
    exit;
}

// Proses tambah ke keranjang
if(isset($_POST['add_to_cart'])){
    $id_produk = $produk['id'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    if(isset($_SESSION['cart'][$id_produk])){
        $_SESSION['cart'][$id_produk]['qty']++;
    } else {
        $_SESSION['cart'][$id_produk] = [
            'name' => $produk['name'],
            'price' => $produk['price'],
            'image' => $produk['image'],
            'qty' => 1
        ];
    }

    header("Location: cart.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $produk['name'] ?> - Gerai Al-Mecca</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="wrapper">

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">Gerai Al-Mecca</div>
    <nav>
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="produk.php" class="active">Produk</a></li>
            <li><a href="cart.php">🛒 Keranjang</a></li>
        </ul>
    </nav>
    <button class="menu-toggle" onclick="toggleMenu()">☰</button>
</header>

<!-- DETAIL PRODUK -->
<section class="detail-produk">
    <div class="detail-box">

        <div class="detail-img">
            <img src="uploads/products/<?= $produk['image'] ?>" alt="<?= $produk['name'] ?>">
        </div>

        <div class="detail-info">
            <h2><?= $produk['name'] ?></h2>
            <p class="harga">Rp <?= number_format($produk['price'], 0, ',', '.') ?></p>
            <p class="deskripsi"><?= nl2br($produk['description']) ?></p>

            <form method="POST">
                <button type="submit" name="add_to_cart" class="btn">
                    Tambah ke Keranjang
                </button>
            </form>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>© <?= date("Y") ?> Gerai Al-Mecca</p>
</footer>

</div>

<script>
function toggleMenu(){
    document.getElementById("menu").classList.toggle("show");
}
</script>

</body>
</html>
