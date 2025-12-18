<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<body>

<header class="navbar">
    <div class="logo">Gerai Al-Mecca</div>

    <nav>
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="contact.php">Kontak</a></li>
            <li><a href="cart.php">🛒 Keranjang</a></li>

            <?php if(isset($_SESSION['user_login'])): ?>
                <!-- JIKA SUDAH LOGIN -->
                <li><a href="pesanan_saya.php">📦 Pesanan Saya</a></li>
                <li class="nav-user">
                    Halo, <?= htmlspecialchars($_SESSION['user_name']); ?>
                </li>
                <li><a href="logout.php" class="btn-logout">Logout</a></li>

            <?php else: ?>
                <!-- JIKA BELUM LOGIN -->
                <li><a href="login.php" class="btn-login">Masuk</a></li>
                <li><a href="register.php" class="btn-register">Daftar</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <button class="menu-toggle" onclick="toggleMenu()">☰</button>
</header>
