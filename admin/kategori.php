<?php
include '../config/koneksi.php';
include 'includes/admin_header.php';

$data = mysqli_query($koneksi, "SELECT * FROM categories");
?>

<h1>Data Kategori</h1>

<a href="kategori_tambah.php" class="btn add">+ Tambah Kategori</a>
<br><br>
<table class="admin-table">
<tr>
    <th>Nama Kategori</th>
    <th>Aksi</th>
</tr>

<?php while($k = mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $k['name']; ?></td>
    <td>
        <a href="kategori_edit.php?id=<?= $k['id']; ?>" class="btn edit">Edit</a>
        <a href="kategori_hapus.php?id=<?= $k['id']; ?>" 
           class="btn delete"
           onclick="return confirm('Hapus kategori ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'includes/admin_footer.php'; ?>
