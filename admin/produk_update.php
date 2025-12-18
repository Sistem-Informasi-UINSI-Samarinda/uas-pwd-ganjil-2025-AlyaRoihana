<?php
include '../config/koneksi.php';

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $gambar_lama = $_POST['gambar_lama'];

    if($_FILES['image']['name'] != ''){
        $gambar = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/products/".$gambar);
    } else {
        $gambar = $gambar_lama;
    }

    mysqli_query($koneksi, "
        UPDATE products SET
        name='$name',
        price='$price',
        description='$description',
        image='$gambar'
        WHERE id='$id'
    ");

    header("Location: produk.php");
}
