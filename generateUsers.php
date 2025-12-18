<!-- INSERT INTO users (username, email, password, nama_lengkap, role) 
VALUES ('admin', 'admin@geraalmecca.com', '$2y$10$YourHashedPasswordHere', 'Admin Gerai', 'admin'); -->

<?php
include 'config/koneksi.php';

$username = "aymin";
$email = "aymin.com";
$password = password_hash("ayaadmin" ,PASSWORD_DEFAULT);
$nama_lengkap = "Admin Aya";
$role = "admin";

$query = "
            INSERT INTO users (username, email, password, role)
            VALUES ('$username', '$email', '$password', '$role')
        ";

if(mysqli_query($koneksi, $query)){
    echo "Akun admin telah tersedia";
} else {
    echo "Gagal membuat akun ". mysqli_error($koneksi);
}





?>