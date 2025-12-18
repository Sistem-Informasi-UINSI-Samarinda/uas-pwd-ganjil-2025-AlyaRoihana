<?php
session_start();
include 'config/koneksi.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($koneksi,
        "SELECT id FROM users WHERE username='$username'"
    );

    if(mysqli_num_rows($cek) > 0){
        $error = "Username sudah digunakan";
    } else {
        mysqli_query($koneksi,
            "INSERT INTO users (username,email,password,role)
             VALUES ('$username','$email','$password','customer')"
        );

        $_SESSION['user_login'] = true;
        $_SESSION['user_id']    = mysqli_insert_id($koneksi);
        $_SESSION['user_name']  = $username;

        header("Location: checkout.php");
        exit;
    }
}
?>

<?php include 'includes/meta.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="auth-section">
    <div class="auth-box">
        <h2>Register</h2>

        <?php if(isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>

        <form method="post">
            <input name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button name="register" class="btn">Daftar</button>
        </form>

        <p class="auth-link">
            Sudah punya akun? <a href="login.php">Login</a>
        </p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
