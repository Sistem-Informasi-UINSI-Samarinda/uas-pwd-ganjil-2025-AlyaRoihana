<?php session_start();

include 'config/koneksi.php';
include 'includes/meta.php'; 
include 'includes/header.php'; 

// Ambil kategori (untuk filter)
$kategori_query = mysqli_query($koneksi, "SELECT * FROM categories");

// Jika filter kategori dipilih
$where = "";
if(isset($_GET['kategori'])){
    $kategori_id = $_GET['kategori'];
    $where = "WHERE category_id = '$kategori_id'";
}

// Ambil produk
$produk_query = mysqli_query($koneksi, "SELECT * FROM products $where ORDER BY id DESC");

?>

<!-- KONTEN -->
<section class="produk-preview">
    <h2>Koleksi Produk</h2>

    <!-- FILTER -->
    <div class="filter-box">
        <form method="GET">
            <select name="kategori" class="filter-select">
                <option value="">Semua Kategori</option>
                <?php while($kat = mysqli_fetch_assoc($kategori_query)){ ?>
                <option value="<?= $kat['id'] ?>" <?= (isset($_GET['kategori']) && $_GET['kategori'] == $kat['id']) ? 'selected' : '' ?>>
                    <?= $kat['name'] ?>
                </option>
                <?php } ?>
            </select>
            <button type="submit" class="btn small">Filter</button>
        </form>
    </div>

    <!-- PRODUK LIST -->
    <div class="produk-grid">
        <?php while($produk = mysqli_fetch_assoc($produk_query)) { ?>
        <div class="produk-card">
            <img src="uploads/products/<?= $produk['image'] ?>" alt="<?= $produk['name'] ?>">
            <h3><?= $produk['name'] ?></h3>
            <p>Rp <?= number_format($produk['price'], 0, ',', '.') ?></p>
            <a href="detail.php?id=<?= $produk['id'] ?>" class="btn small">Detail</a>
        </div>
        <?php } ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>