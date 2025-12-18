<?php
include '../config/koneksi.php';
include 'includes/admin_header.php';

$data = mysqli_query($koneksi, "SELECT * FROM orders ORDER BY id DESC");
?>

<h1>Data Pesanan</h1>

<table class="admin-table">
<tr>
    <th>ID</th>
    <th>Pesanan</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php while($o = mysqli_fetch_assoc($data)): ?>
<tr>
    <td>#<?= $o['id']; ?></td>
    <td><?= $o['nama']; ?></td>
    <td>Rp <?= number_format($o['total']); ?></td>
    <td><?= ucfirst($o['status']); ?></td>
    <td>
        <a href="order_detail.php?id=<?= $o['id']; ?>" class="btn edit">
            Detail
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'includes/admin_footer.php'; ?>
