<?php
include 'includes/meta.php';
include 'includes/header.php';
include 'config/koneksi.php';

// ambil 4 produk terbaru
$query = mysqli_query($koneksi, "SELECT * FROM products ORDER BY id DESC LIMIT 4");
?>

<!-- HERO / ABOUT INTRO -->
<section class="hero-about">
    <div class="hero-about-box">
        <h1>Gerai Al-Mecca</h1>
        <p>
            Brand muslimah yang menghadirkan <strong>home dress & hijab produksi sendiri</strong>
            dengan desain <strong>elegan, syar’i, dan nyaman</strong> untuk aktivitas sehari-hari.
        </p>
        <p>
            Mengutamakan <strong>bahan premium</strong> dengan harga yang
            <strong>terjangkau untuk semua muslimah</strong>.
        </p>
        <a href="produk.php" class="btn">Lihat Koleksi</a>
    </div>
</section>


<!-- ABOUT (PINDAHAN DARI about.php) -->

        <div class="about-highlight">
            <div class="about-card">
                <h3>Produksi Sendiri</h3>
                <p>Kontrol kualitas langsung dari proses produksi.</p>
            </div>

            <div class="about-card">
                <h3>Bahan Premium</h3>
                <p>Nyaman dipakai seharian dan jatuh indah.</p>
            </div>

            <div class="about-card">
                <h3>Harga Terjangkau</h3>
                <p>Kualitas terbaik dengan harga bersahabat.</p>
            </div>
        </div>
    </div>
</section>

<!-- PRODUK PREVIEW -->
<section class="produk-preview">
    <h2>Produk Terbaru</h2>

    <div class="produk-grid">
        <?php if(mysqli_num_rows($query) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($query)): ?>
                <div class="produk-card">
                    <img src="uploads/products/<?= $row['image']; ?>"
                        alt="<?= htmlspecialchars($row['name']); ?>">


                    <h3><?= htmlspecialchars($row['name']); ?></h3>
                    <p>Rp <?= number_format($row['price']); ?></p>

                    <a href="detail.php?id=<?= $row['id']; ?>" class="btn small">
                        Detail
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center;width:100%;">Belum ada produk</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
