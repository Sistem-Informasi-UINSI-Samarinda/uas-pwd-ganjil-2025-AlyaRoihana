<?php
session_start();
include '../config/koneksi.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND role='admin'
            LIMIT 1";

    $query = mysqli_query($koneksi, $sql);

    if(!$query){
        die("Query error: " . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) === 1){
        $admin = mysqli_fetch_assoc($query);

        if(password_verify($password, $admin['password'])){
            $_SESSION['admin_login'] = true;
            $_SESSION['admin_id']    = $admin['id'];
            $_SESSION['admin_name']  = $admin['nama_lengkap'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Akun admin tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="../assets/css/adminStyle.css">
</head>
<body class="login-body">

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if(isset($error)): ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>
</div>

</body>
</html>
