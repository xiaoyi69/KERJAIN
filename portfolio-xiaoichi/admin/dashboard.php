<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
include "../koneksi.php";

// Proses Hapus Skill
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM skill WHERE id = $id");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 40px 20px;">
<div class="wrap">
  <div class="row" style="align-items: center; margin-bottom: 30px;">
    <h2>Dashboard Admin Portfolio</h2>
    <a href="logout.php" class="btn" style="background:#dc2626; color:#fff; border:0;">Logout</a>
  </div>

  <div class="card big" style="margin-bottom: 30px;">
    <div class="row" style="margin-bottom: 15px;">
      <h4>Manajemen Keahlian (Skills)</h4>
      <a href="tambah_skill.php" class="btn primary" style="padding: 6px 14px; font-size:0.75rem;">+ Tambah Skill</a>
    </div>
    <table style="width:100%; border-collapse: collapse; font-size: 0.85rem;">
      <thead>
        <tr style="border-bottom: 1px solid var(--bd); text-align: left;">
          <th style="padding: 8px;">No</th>
          <th style="padding: 8px;">Nama Skill</th>
          <th style="padding: 8px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        $data_skill = mysqli_query($koneksi, "SELECT * FROM skill");
        while($row = mysqli_fetch_assoc($data_skill)): 
        ?>
        <tr style="border-bottom: 1px solid var(--bd);">
          <td style="padding: 8px;"><?= $no++ ?></td>
          <td style="padding: 8px;"><?= htmlspecialchars($row['nama_skill']) ?></td>
          <td style="padding: 8px;">
            <a href="edit_skill.php?id=<?= $row['id'] ?>" style="color:#0ea5e9; margin-right:10px;">Edit</a>
            <a href="dashboard.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" style="color:#dc2626;">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <div class="card big">
    <h4 style="margin-bottom: 15px;">Daftar Pesan Masuk</h4>
    <?php
    $query_pesan = "SELECT * FROM pesan_kontak ORDER BY id DESC";
    $hasil_pesan = mysqli_query($koneksi, $query_pesan);
    while ($baris = mysqli_fetch_assoc($hasil_pesan)):
    ?>
    <p style="font-size: 0.85rem; margin-bottom: 8px;">
      <strong><?= htmlspecialchars($baris['nama']) ?></strong> (<?= htmlspecialchars($baris['email']) ?>) - <small class="mut"><?= $baris['tanggal'] ?></small><br>
      <?= htmlspecialchars($baris['pesan']) ?>
    </p>
    <hr style="border:0; border-top:1px solid var(--bd); margin: 10px 0;">
    <?php endwhile; ?>
  </div>
</div>
</body>
</html>