<?php
include '../config/koneksi.php';
include 'includes/admin_header.php';

$id = $_GET['id'];
$p = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM products WHERE id='$id'"));

if(isset($_POST['update'])){
    $name  = $_POST['name'];
    $price = $_POST['price'];
    $desc  = $_POST['description'];

    if($_FILES['image']['name'] != ''){
        $image = $_FILES['image']['name'];
        $tmp   = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp,"../uploads/products/".$image);

        mysqli_query($koneksi,"
            UPDATE products SET
            name='$name',
            description='$desc',
            price='$price',
            image='$image'
            WHERE id='$id'
        ");
    } else {
        mysqli_query($koneksi,"
            UPDATE products SET
            name='$name',
            description='$desc',
            price='$price'
            WHERE id='$id'
        ");
    }

    header("Location: produk.php");
}
?>

<h1>Edit Produk</h1>

<form method="post" enctype="multipart/form-data" class="form-box">
    <label>Nama Produk</label>
    <input type="text" name="name" value="<?= $p['name']; ?>" required>

    <label>Harga</label>
    <input type="number" name="price" value="<?= $p['price']; ?>" required>
    
    <label>Deskripsi</label>
    <textarea name="description"><?= $p['description']; ?></textarea>
    
    <label>Gambar</label>
    <input type="file" name="image">
    <img src="../uploads/products/<?= $p['image']; ?>" width="120">

    <button name="update">Update</button>
</form>

<?php include 'includes/admin_footer.php'; ?>
