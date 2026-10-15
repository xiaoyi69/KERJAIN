<?php
session_start();
include "../koneksi.php";

$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $hasil = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($hasil) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh;">
<div class="card big" style="width: 350px;">
  <h3>Admin Login</h3>
  <?php if($error): ?><p style="color:#dc2626; font-size:0.8rem; margin-top:8px;"><?= $error ?></p><?php endif; ?>
  <form method="post" style="margin-top: 10px;">
    <label>USERNAME</label>
    <input type="text" name="username" required>
    <label>PASSWORD</label>
    <input type="password" name="password" required style="margin-bottom: 15px;">
    <button type="submit" name="login" class="btn primary full">Login</button>
  </form>
</div>
</body>
</html>