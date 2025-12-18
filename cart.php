<?php
session_start();
include 'includes/meta.php';
include 'includes/header.php';
?>

<section class="cart-section">
    <h2>Keranjang Belanja</h2>

    <div class="cart-box">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $total = 0;

            if (!empty($_SESSION['cart'])):
                foreach ($_SESSION['cart'] as $key => $item):
                    $id = isset($item['id']) ? $item['id'] : 0;
                    $name = isset($item['name']) ? $item['name'] : 'Produk';
                    $price = isset($item['price']) ? $item['price'] : 0;
                    $qty = isset($item['qty']) ? $item['qty'] : 0;
                    $image = isset($item['image']) ? $item['image'] : 'default.png';

                    $subtotal = $price * $qty;
                    $total += $subtotal;
            ?>
                <tr>
                    <td class="cart-produk">
                        <img src="uploads/products/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>">
                        <span><?php echo htmlspecialchars($name); ?></span>
                    </td>
                    <td>Rp <?php echo number_format($price); ?></td>
                    <td><?php echo $qty; ?></td>
                    <td>Rp <?php echo number_format($subtotal); ?></td>
                    <td>
                        <a href="remove_cart.php?id=<?php echo $id; ?>" class="hapus">Hapus</a>
                    </td>
                </tr>
            <?php
                endforeach;
            else:
            ?>
                <tr>
                    <td colspan="5">Keranjang masih kosong</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <div class="cart-total">
            <h3>Total: <span>Rp <?php echo number_format($total); ?></span></h3>
            <?php if(!empty($_SESSION['cart'])): ?>
            <a href="checkout.php" class="btn">Checkout</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Konfirmasi hapus -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelectorAll('.hapus');

    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if(!confirm("Yakin ingin menghapus pesanan ini?")) {
                e.preventDefault(); // batalkan hapus
            }
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>
