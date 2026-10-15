<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit(); }
include "../koneksi.php";

if (isset($_POST['tambah'])) {
    $nama_skill = mysqli_real_escape_string($koneksi, $_POST['nama_skill']);
    mysqli_query($koneksi, "INSERT INTO skill (nama_skill) VALUES ('$nama_skill')");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><title>Tambah Skill</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh;">
<div class="card big" style="width: 400px;">
  <h3>Tambah Skill Baru</h3>
  <form method="post" style="margin-top: 15px;">
    <label>NAMA SKILL</label>
    <input type="text" name="nama_skill" required style="margin-bottom: 15px;">
    <button type="submit" name="tambah" class="btn primary full">Simpan</button>
  </form>
</div>
</body>
</html>