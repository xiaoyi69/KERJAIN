<?php 
session_start();
include "koneksi.php";

$pesanSapaan = "";
if (isset($_POST['kirim'])) {
    $nama_kontak = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email_kontak = mysqli_real_escape_string($koneksi, $_POST['email']);
    $pesan_kontak = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    if ($nama_kontak == "" || $email_kontak == "" || $pesan_kontak == "") {
        $pesanSapaan = "Mohon lengkapi seluruh field terlebih dahulu.";
    } else {
        $query_pesan = "INSERT INTO pesan_kontak (nama, email, pesan) VALUES ('$nama_kontak', '$email_kontak', '$pesan_kontak')";
        mysqli_query($koneksi, $query_pesan);
        $pesanSapaan = "Terima kasih, " . $nama_kontak . "! Pesan Anda telah tersimpan.";
    }
}

$nama = "Alifia Xiaoichi Zahirah";
$nim = "5324600000";
$prodi = "Teknologi Rekayasa Multimedia";
$email = "xiaoichi1@gmail.com";
$deskripsi = "A Founder, Multilingual Translator (Mandarin & English), Junior Developer, Musician, and Podcaster based in Surabaya.";
$status_mahasiswa = true;

// Mengambil data skill secara dinamis dari database (jika tabel skill sudah ada)
$skills = [];
$result_skill = mysqli_query($koneksi, "SELECT * FROM skill");
if ($result_skill) {
    while ($row = mysqli_fetch_assoc($result_skill)) {
        $skills[] = $row['nama_skill'];
    }
}
// Fallback jika tabel skill kosong
if (empty($skills)) {
    $skills = ["HTML/CSS", "JavaScript", "PHP", "Python", "C/C++", "Team Leadership", "Project Management"];
}

function greeting($namaPengguna) {
    return "Hello, I'm <br><span class=\"grad-dark\">" . $namaPengguna . "</span>";
}

$year = date('Y'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= $nama ?> | Portfolio</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="nav"><div class="wrap nav-in">
  <a href="#home" class="logo">&lt;Xiaoichi 小一朱/&gt;</a>
  <ul class="links">
    <li><a href="#about">About</a></li><li><a href="#experience">Experience</a></li><li><a href="#skills">Skills</a></li>
    <li><a href="#projects">Projects</a></li><li><a href="#education">Education</a></li><li><a href="#contact">Contact</a></li>
  </ul>
  <div class="icons">
    <a href="https://github.com/" target="_blank" title="GitHub">GH</a>
    <a href="https://www.linkedin.com/in/xiaoichi" target="_blank" title="LinkedIn">in</a>
    <a href="mailto:<?= $email ?>" title="Email">✉</a>
    <a href="admin/login.php" title="Admin Login" style="font-size:0.7rem; font-weight:700; border:1px solid var(--bd); border-radius:8px; padding:2px 6px;">Admin</a>
    <button id="theme" title="Dark mode">☾</button>
  </div>
</div></nav>

<header id="home" class="hero">
  <div class="blob b1"></div><div class="blob b2"></div>
  <div class="pill">● Available for opportunities</div>
  
  <h1><?= greeting($nama) ?></h1>
  
  <h2>Multimedia Engineering Technology Student</h2>
  <p class="mut">Building impactful products with modern technologies</p>
  
  <div class="card" style="margin-top: 15px; padding: 12px 20px; max-width: 400px; width: 100%;">
    <form action="" method="GET" style="display: flex; gap: 8px; align-items: center;">
      <input type="text" name="visitor" placeholder="Masukkan nama Anda..." required style="margin-top:0; padding: 6px 10px; font-size:0.75rem;">
      <button class="btn primary" type="submit" style="padding: 6px 14px; font-size:0.75rem; margin-top:0;">Kirim</button>
    </form>
    <?php
    if (isset($_GET['visitor'])) {
        $visitorName = htmlspecialchars($_GET['visitor']);
        echo "<p class='small' style='margin-top:8px; color:var(--p);'>Halo, <b>{$visitorName}</b>! Selamat datang di portfolio saya.</p>";
    }
    ?>
  </div>

  <div class="btns">
    <a href="#projects" class="btn primary">View My Work</a>
    <a href="#contact" class="btn">Get In Touch</a>
    <a href="#" class="btn">⬇ Resume</a>
  </div>
  <div class="stats"><div><b data-n="7">0</b><span>Years Experience</span></div><div><b data-n="50">0</b><span>Projects Built</span></div><div><b data-n="20">0</b><span>Happy Clients</span></div></div>
  <div class="scroll">SCROLL<i></i></div>
</header>

<section id="about" class="wrap sec">
  <div class="head"><span class="tag">✦ ABOUT ME</span><h3>Crafting Digital <em>Experiences</em></h3><p class="mut">A little more about me and what drives my passion for development</p></div>
  <div class="about">
    <div>
      <div class="photo">
        <img src="assets/img/profile.png" alt="<?= $nama ?>" class="avatar-img" style="width:100%; height:100%; object-fit:cover; border-radius:16px;">
        <span class="avail">● Available</span>
      </div>
      <h4><?= $nama ?></h4>
      <p class="role"><?= $prodi ?></p>
      <p class="mut small">📍 Surabaya, Indonesia | NIM: <?= $nim ?></p>
      
      <p class="mut small" style="margin-top: 6px;">
        Status: <b>
        <?php 
        if ($status_mahasiswa) {
            echo "Mahasiswa Aktif";
        } else {
            echo "Bukan Mahasiswa Aktif";
        }
        ?>
        </b>
      </p>

      <p class="mut"><?= $deskripsi ?></p>
      <div class="icons sq"><a href="https://github.com/" target="_blank">GH</a><a href="https://www.linkedin.com/in/xiaoichi" target="_blank">in</a><a href="mailto:<?= $email ?>">✉</a></div>
    </div>
    <div>
      <div class="grid2">
        <div class="card"><h5>⚡ Fast &amp; Scalable</h5><p class="mut small">Building high-performance applications that handle millions of users</p></div>
        <div class="card"><h5>🖌 Clean Design</h5><p class="mut small">Creating intuitive interfaces with pixel-perfect attention to detail</p></div>
        <div class="card"><h5>◈ Modern Stack</h5><p class="mut small">Using cutting-edge technologies and best practices</p></div>
        <div class="card"><h5>🚀 Ship Fast</h5><p class="mut small">Delivering production-ready code with CI/CD pipelines</p></div>
      </div>
      <div class="band"><div><b data-n="7" data-s="+">0</b><span>Years Exp.</span></div><div><b data-n="50" data-s="+">0</b><span>Projects</span></div><div><b data-n="20" data-s="+">0</b><span>Clients</span></div></div>
    </div>
  </div>
</section>

<section id="experience" class="wrap sec">
  <div class="head"><span class="tag">✦ EXPERIENCE</span><h3>Professional <em>Journey</em></h3><p class="mut">With business and engineering — building impactful products</p></div>
  <div class="exp">
    <div class="tabs v" id="expTabs"></div>
    <div class="card big" id="expBody"></div>
  </div>
</section>

<section id="skills" class="wrap sec">
  <div class="head"><span class="tag">✦ SKILLS</span><h3>Technical <em>Arsenal</em></h3><p class="mut">Multidisciplinary skills and technologies I utilize across various professional fields.</p></div>
  
  <div class="card big" style="margin-bottom: 20px;">
    <h5 style="margin-bottom: 12px;">Daftar Keahlian (Dari Database MySQL)</h5>
    <ul class="chips">
      <?php foreach ($skills as $s): ?>
        <li class="chip"><?= htmlspecialchars($s) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="tabs h" id="skillTabs"></div>
  <div class="grid4" id="skillGrid"></div>
  <div class="band"><div><b data-n="41" data-s="+">0</b><span>Total Skills</span></div><div><b data-n="5" data-s="+">0</b><span>Core Disciplines</span></div><div><b data-n="50" data-s="+">0</b><span>Global Delegates</span></div></div>
</section>

<section id="projects" class="wrap sec">
  <div class="head"><span class="tag">✦ PROJECTS</span><h3>Featured <em>Work</em></h3><p class="mut">Projects that showcase my skills, creativity, and passion for building</p></div>
  <div class="grid2 proj">
    <article class="pcard"><div class="pimg g1"><span class="feat">★ Featured</span></div><div class="pbody"><h5>Visual Novel Interactive</h5><p class="mut small">A tale of power, destiny, and love unfolds in a vast ancient kingdom where legends are born...</p><div class="chips"><span>Ren'Py</span><span>Python</span><span>AI</span><span>+2</span></div></div></article>
    <article class="pcard"><div class="pimg g2"><span class="feat">★ Featured</span></div><div class="pbody"><h5>CareSync</h5><p class="mut small">Smart Healthcare App for Patient and Paramedics</p><div class="chips"><span>HTML</span><span>GUI</span><span>git</span><span>+1</span></div></div></article>
    <article class="pcard"><div class="pimg g3"></div><div class="pbody"><h5>Podcast</h5><p class="mut small">A Living Soul Tryna Vibin' Out with Podcast on Spotify</p><div class="chips"><span>Spotify</span><span>Podcast</span><span>Audacity</span><span>+1</span></div></div></article>
    <article class="pcard"><div class="pimg g4"><span class="feat">★ Featured</span></div><div class="pbody"><h5>Color Palette Manager CLI</h5><p class="mut small">Customized your own colors manager</p><div class="chips"><span>C/C++</span><span>git</span><span>GitHub</span><span>+1</span></div></div></article>
  </div>
  <p class="center"><a class="btn" href="https://github.com/" target="_blank">View More on GitHub</a></p>
</section>

<section id="education" class="wrap sec narrow">
  <div class="head"><span class="tag">✦ EDUCATION &amp; CERTS</span><h3>Academic <em>Background</em></h3><p class="mut">My educational journey and professional certifications</p></div>
  <h6>🎓 EDUCATION</h6>
  <div class="card big"><div class="row"><h5>Electronic Engineering Polytechnic Institute of Surabaya</h5><span class="chip-o">2025 - Present</span></div>
    <p class="role">Bachelor of Applied Computer Science</p><p class="mut small">Surabaya, Indonesia</p>
    <p class="mut small">Focus on the development of multimedia systems engineering, human-computer interaction (HCI), software programming, and interactive digital content production.</p><p class="mut small">✓ Active</p></div>
  <h6>🏅 CERTIFICATIONS</h6>
  <div class="grid2">
    <div class="card cert"><i>🏆</i><div><h5>ABRSM Violin Grade 2</h5><p class="mut small">The Associated Board of the Royal Schools of Music</p><span class="chip">2021</span></div></div>
    <div class="card cert"><i>🏆</i><div><h5>Piano Grade 1</h5><p class="mut small">Ronald Wilson Music School</p><span class="chip">2020</span></div></div>
  </div>
</section>

<section id="contact" class="wrap sec">
  <div class="head"><span class="tag">✦ CONTACT</span><h3>Let's <em>Connect</em></h3><p class="mut">Have a project in mind or want to chat? I'd love to hear from you.</p></div>
  <div class="grid2 contact">
    <div>
      <div class="card tint"><h5>Get In Touch</h5><p class="mut small">I'm always open to discussing new projects, creative ideas, or opportunities. Feel free to reach out through any channel below.</p>
        <ul class="info">
          <li>✉<div><small>Email</small><b><?= $email ?></b></div></li>
          <li>📞<div><small>Phone</small><b>+62 88991166296</b></div></li>
          <li>📍<div><small>Location</small><b>Surabaya, Indonesia</b></div></li>
          <li>💬<div><small>WeChat ID (微信ID)</small><b>siokci69</b></div></li>
        </ul></div>
      <div class="card"><small class="mut">FIND ME ONLINE</small><div class="icons sq"><a href="https://github.com/" target="_blank">GH</a><a href="https://www.linkedin.com/in/xiaoichi" target="_blank">in</a><a href="mailto:<?= $email ?>">✉</a></div></div>
    </div>
    <form class="card big" id="form" method="post">
      <h5>Send a Message</h5>
      <label>YOUR NAME<input name="name" placeholder="John Doe" required></label>
      <label>EMAIL ADDRESS<input name="email" type="email" placeholder="john@example.com" required></label>
      <label>MESSAGE<textarea name="message" rows="5" placeholder="Tell me about your project..." required></textarea></label>
      <button class="btn primary full" type="submit" name="kirim">Send Message</button>
      <p class="small" style="margin-top: 10px; color: var(--p);"><?= $pesanSapaan ?></p>
    </form>
  </div>
</section>

<footer><div class="wrap foot">
  <div><div class="logo">&lt;Xiaoichi 小一朱/&gt;</div><p class="mut small">Building impactful products with modern technologies</p></div>
  <div><small>NAVIGATION</small><a href="#about">About</a><a href="#experience">Experience</a><a href="#skills">Skills</a><a href="#projects">Projects</a><a href="#education">Education</a><a href="#contact">Contact</a></div>
  <div><small>CONTACT</small><a href="mailto:<?= $email ?>">✉ <?= $email ?></a><span class="mut small">Surabaya, Indonesia</span></div>
</div>
<div class="wrap copy"><span>© <?= $year ?> <?= $nama ?>. All rights reserved.</span><span>Built with HTML · CSS · JavaScript · PHP</span></div></footer>
<script src="assets/js/script.js"></script>
</body>
</html>