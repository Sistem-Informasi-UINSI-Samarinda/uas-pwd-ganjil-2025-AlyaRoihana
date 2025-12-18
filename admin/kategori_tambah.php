<?php
include '../config/koneksi.php';
include 'includes/admin_header.php';

if(isset($_POST['simpan'])){
    $name = htmlspecialchars($_POST['name']);
    mysqli_query($koneksi, "INSERT INTO categories (name) VALUES ('$name')");
    header("Location: kategori.php");
}
?>

<h1>Tambah Kategori</h1>

<form method="post" class="form-box">
    <label>Nama Kategori</label>
    <input type="text" name="name" required>
    <button name="simpan">Simpan</button>
</form>

<?php include 'includes/admin_footer.php'; ?>
