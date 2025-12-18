<?php
session_start();
include 'config/koneksi.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($koneksi,
        "SELECT * FROM users 
         WHERE username='$username' AND role='customer' LIMIT 1"
    );

    if(mysqli_num_rows($q) === 1){
        $u = mysqli_fetch_assoc($q);

        if(password_verify($password, $u['password'])){
            $_SESSION['user_login'] = true;
            $_SESSION['user_id']    = $u['id'];
            $_SESSION['user_name']  = $u['username'];

            // kalau dipaksa login dari checkout
            if(isset($_SESSION['redirect_after_login'])){
                $to = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']);
                header("Location: $to");
            } else {
                header("Location: index.php");
            }
            exit;
        }
    }
    $error = "Username atau password salah";
}
?>

<?php include 'includes/meta.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="auth-section">
    <div class="auth-box">
        <h2>Login</h2>

        <?php if(isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>

        <form method="post">
            <input name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="login" class="btn">Login</button>
        </form>

        <p class="auth-link">
            Belum punya akun? <a href="register.php">Daftar</a>
        </p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
