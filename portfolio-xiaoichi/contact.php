<?php
// Handler form kontak (butuh server dengan mail() aktif, atau ganti dengan PHPMailer/SMTP)
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['ok'=>false,'msg'=>'Method not allowed']); exit; }
$name  = trim(strip_tags($_POST['name'] ?? ''));
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$msg   = trim(strip_tags($_POST['message'] ?? ''));
if (!$name || !$email || !$msg) { echo json_encode(['ok'=>false,'msg'=>'Mohon lengkapi semua kolom dengan benar.']); exit; }
$to = 'xiaoichi1@gmail.com';
$headers = "From: noreply@localhost\r\nReply-To: $email\r\nContent-Type: text/plain; charset=utf-8";
$body = "Nama: $name\nEmail: $email\n\nPesan:\n$msg";
$sent = @mail($to, "Pesan portfolio dari $name", $body, $headers);
// Cadangan: simpan ke file jika mail() tidak tersedia (mis. XAMPP lokal)
if (!$sent) { file_put_contents(__DIR__.'/messages.txt', date('c')."\n$body\n----\n", FILE_APPEND | LOCK_EX); }
echo json_encode(['ok'=>true,'msg'=>'Terima kasih! Pesanmu sudah terkirim.']);