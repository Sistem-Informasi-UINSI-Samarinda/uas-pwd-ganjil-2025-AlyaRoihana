<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['user_login'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ambil semua pesanan user
$orders = mysqli_query($koneksi, "
    SELECT * FROM orders 
    WHERE user_id='$user_id' 
    ORDER BY id DESC
");
?>

<?php include 'includes/meta.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="order-section">
    <h2>Pesanan Saya</h2>

    <?php if(mysqli_num_rows($orders) == 0): ?>
        <p style="text-align:center">Belum ada pesanan</p>
    <?php else: ?>

        <?php $no = 1; ?>
        <?php while($o = mysqli_fetch_assoc($orders)): ?>

        <div class="order-card">
            <h3>Pesanan ke-<?= $no++; ?></h3>

            <p>
                <strong>Status:</strong> 
                <span class="status <?= $o['status']; ?>">
                    <?= ucfirst($o['status']); ?>
                </span>
            </p>

            <table class="order-item-table">
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>

                <?php
                $items = mysqli_query($koneksi, "
                    SELECT * FROM order_items 
                    WHERE order_id='{$o['id']}'
                ");

                while($i = mysqli_fetch_assoc($items)):
                ?>
                <tr>
                    <td><?= $i['nama_produk']; ?></td>
                    <td><?= $i['qty']; ?></td>
                    <td>Rp <?= number_format($i['price']); ?></td>
                    <td>Rp <?= number_format($i['qty'] * $i['price']); ?></td>
                </tr>
                <?php endwhile; ?>
            </table>

            <p class="order-total">
                <strong>Total:</strong> Rp <?= number_format($o['total']); ?>
            </p>
        </div>

        <?php endwhile; ?>

    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
