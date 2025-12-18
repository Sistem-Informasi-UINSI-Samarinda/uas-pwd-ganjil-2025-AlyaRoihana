<?php
include '../config/koneksi.php';
include 'includes/admin_header.php';

$id = $_GET['id'];

// ambil data order
$order = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM orders WHERE id='$id'")
);

// ambil item order
$items = mysqli_query($koneksi, "
    SELECT nama_produk, qty, price
    FROM order_items
    WHERE order_id='$id'
");
?>

<h1>Detail Order #<?= $id; ?></h1>

<div class="order-box">
    <p><strong>Nama:</strong> <?= $order['nama']; ?></p>
    <p><strong>Telepon:</strong> <?= $order['telepon']; ?></p>
    <p><strong>Alamat:</strong><br><?= nl2br($order['alamat']); ?></p>
    <p><strong>Status:</strong> <?= ucfirst($order['status']); ?></p>

<!-- FORM UPDATE STATUS -->
<form method="post" action="order_update.php" style="margin-bottom:20px">
    <input type="hidden" name="id" value="<?= $id; ?>">

    <label>Status Order</label><br>
    <select name="status" required>
        <option value="pending" <?= $order['status']=='pending'?'selected':''; ?>>Pending</option>
        <option value="processing" <?= $order['status']=='processing'?'selected':''; ?>>Processing</option>
        <option value="completed" <?= $order['status']=='completed'?'selected':''; ?>>Completed</option>
        <option value="cancelled" <?= $order['status']=='cancelled'?'selected':''; ?>>Cancelled</option>
    </select>

    <button type="submit" class="btn edit">Update Status</button>
</form>

<table class="admin-table">
<tr>
    <th>Produk</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Subtotal</th>
</tr>

<?php 
$total = 0;
while($i = mysqli_fetch_assoc($items)): 
    $subtotal = $i['qty'] * $i['price'];
    $total += $subtotal;
?>
<tr>
    <td><?= $i['nama_produk']; ?></td>
    <td><?= $i['qty']; ?></td>
    <td>Rp <?= number_format($i['price']); ?></td>
    <td>Rp <?= number_format($subtotal); ?></td>
</tr>
<?php endwhile; ?>

<tr>
    <th colspan="3">Total</th>
    <th>Rp <?= number_format($total); ?></th>
</tr>
</table>

<?php include 'includes/admin_footer.php'; ?>
