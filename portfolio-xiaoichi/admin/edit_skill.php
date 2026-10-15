<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit(); }
include "../koneksi.php";

$id = intval($_GET['id']);
$data = mysqli_query($koneksi, "SELECT * FROM skill WHERE id = $id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama_baru = mysqli_real_escape_string($koneksi, $_POST['nama_skill']);
    mysqli_query($koneksi, "UPDATE skill SET nama_skill = '$nama_baru' WHERE id = $id");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><title>Edit Skill</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh;">
<div class="card big" style="width: 400px;">
  <h3>Edit Skill</h3>
  <form method="post" style="margin-top: 15px;">
    <label>NAMA SKILL</label>
    <input type="text" name="nama_skill" value="<?= htmlspecialchars($row['nama_skill']) ?>" required style="margin-bottom: 15px;">
    <button type="submit" name="update" class="btn primary full">Update</button>
  </form>
</div>
</body>
</html>