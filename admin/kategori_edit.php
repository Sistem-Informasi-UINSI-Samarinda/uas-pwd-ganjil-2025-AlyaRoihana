<?php
include '../config/koneksi.php';
include 'includes/admin_header.php';

$id = $_GET['id'];
$kategori = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM categories WHERE id='$id'")
);

if(isset($_POST['update'])){
    $name = htmlspecialchars($_POST['name']);
    mysqli_query($koneksi, "UPDATE categories SET name='$name' WHERE id='$id'");
    header("Location: kategori.php");
}
?>

<h1>Edit Kategori</h1>

<form method="post" class="form-box">
    <label>Nama Kategori</label>
    <input type="text" name="name" value="<?= $kategori['name']; ?>" required>
    <button name="update">Update</button>
</form>

<?php include 'includes/admin_footer.php'; ?>
