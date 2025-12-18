<?php
include '../config/koneksi.php';
include 'includes/admin_header.php';

$kategori = mysqli_query($koneksi, "SELECT * FROM categories");

if(isset($_POST['simpan'])){
    $category_id = $_POST['category_id'];
    $name        = $_POST['name'];
    $desc        = $_POST['description'];
    $price       = $_POST['price'];

    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/products/".$image);

    mysqli_query($koneksi, "
        INSERT INTO products (category_id, name, description, price, image)
        VALUES ('$category_id', '$name', '$desc', '$price', '$image')
    ");

    header("Location: produk.php");
}
?>

<h1>Tambah Produk</h1>

<form method="post" enctype="multipart/form-data" class="form-box">

    <label>Kategori</label>
    <select name="category_id" required>
        <option value="">-- Pilih Kategori --</option>
        <?php while($k = mysqli_fetch_assoc($kategori)): ?>
            <option value="<?= $k['id']; ?>"><?= $k['name']; ?></option>
        <?php endwhile; ?>
    </select>

    <label>Nama Produk</label>
    <input type="text" name="name" required>

    <label>Deskripsi</label>
    <textarea name="description" rows="4"></textarea>

    <label>Harga</label>
    <input type="text" name="price" placeholder="Contoh: 50000" required>

    <label>Gambar</label>
    <input type="file" name="image" required>

    <button name="simpan">Simpan Produk</button>
</form>

<?php include 'includes/admin_footer.php'; ?>
