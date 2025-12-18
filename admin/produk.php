<?php
include '../config/koneksi.php';
include 'includes/admin_header.php';

$data = mysqli_query($koneksi, "
    SELECT products.*, categories.name AS kategori
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
");
?>

<h1>Data Produk</h1>

<a href="produk_tambah.php" class="btn add">+ Tambah Produk</a>

<br><br>

<table class="admin-table">
<tr>
    <th>Nama</th>
    <th>Kategori</th>
    <th>Harga</th>
    <th>Gambar</th>
    <th>Aksi</th>
</tr>

<?php while($p = mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $p['name']; ?></td>
    <td><?= $p['kategori']; ?></td>
    <td>Rp <?= number_format($p['price']); ?></td>
    <td>
        <?php if($p['image']): ?>
            <img src="../uploads/products/<?= $p['image']; ?>" width="60">
        <?php endif; ?>
    </td>
    <td>
        <a href="produk_edit.php?id=<?= $p['id']; ?>" class="btn edit">Edit</a>
        <a href="produk_hapus.php?id=<?= $p['id']; ?>" 
           class="btn delete"
           onclick="return confirm('Hapus produk?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'includes/admin_footer.php'; ?>
