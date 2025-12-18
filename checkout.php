<?php
session_start();

if(!isset($_SESSION['user_login'])){
    $_SESSION['redirect_after_login'] = 'checkout.php';
    header("Location: success.php");
    exit;
}
?>

<?php
session_start();
include 'includes/meta.php';
include 'includes/header.php';

$total = 0;
if(!empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $item){
        $total += $item['price'] * $item['qty'];
    }
}
?>

<section class="checkout-section">
    <h2 style="text-align:center; margin-bottom:30px;">Checkout</h2>

    <div class="checkout-wrapper">
        <!-- FORM PEMBAYARAN -->
        <div class="checkout-form">
            <h2>Data Pemesan</h2>
            <form action="process_checkout.php" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="tel" name="telepon" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>Metode Pembayaran</label>
                    <select name="pembayaran" required>
                        <option value="">-- Pilih --</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cod">COD</option>
                    </select>
                </div>

                <button type="submit" class="btn">Place Order</button>
            </form>
        </div>

        <!-- SUMMARY PESANAN -->
        <div class="checkout-summary">
            <h2>Ringkasan Pesanan</h2>
            <?php if(!empty($_SESSION['cart'])): ?>
                <?php foreach($_SESSION['cart'] as $item): ?>
                    <div class="summary-item">
                        <span><?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['qty']; ?></span>
                        <span>Rp <?php echo number_format($item['price'] * $item['qty']); ?></span>
                    </div>
                <?php endforeach; ?>
                <hr>
                <div class="summary-total">
                    <strong>Total:</strong>
                    <strong>Rp <?php echo number_format($total); ?></strong>
                </div>
            <?php else: ?>
                <p>Keranjang kosong.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
