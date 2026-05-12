<?php
require '../config/database.php';

// 1. CEK ID DULU SEBELUM ADA OUTPUT APAPUN
if (!isset($_GET['id'])) {
    header("Location: ../posts.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare(
    "SELECT posts.*, categories.name AS category_name 
     FROM posts 
     LEFT JOIN categories ON posts.category_id = categories.id 
     WHERE posts.id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// 2. JIKA POST TIDAK ADA, TAMPILKAN HEADER + ERROR
if (!$post) {
    include '../layout/header.php'; // Panggil di sini hanya jika error
    echo "<div style='text-align:center;padding:4rem;color:#aaa;'>Postingan tidak ditemukan.</div>";
    include '../layout/footer.php';
    exit;
}

// 3. JIKA SEMUA OK, BARU PANGGIL HEADER UTAMA
include '../layout/header.php';
?>

<!-- HERO -->
<div class="page-hero" style="margin-left:-2rem; margin-right:-2rem; margin-top:0;">
    <div class="hero-tag"><?= htmlspecialchars($post['category_name'] ?? 'Umum'); ?></div>
    <h1 style="max-width:640px;"><?= htmlspecialchars($post['title']); ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">

        <!-- ISI ARTIKEL -->
        <div class="form-card" style="padding:2rem 2.2rem; line-height:1.9; font-size:15px;">
            <!-- Menggunakan nl2br agar enter/paragraf di database tetap terbaca -->
            <?= nl2br(htmlspecialchars($post['content'])); ?>
        </div>

        <!-- TOMBOL KEMBALI -->
        <div style="margin-top:1.5rem;">
            <a href="../posts.php" class="btn-dark-outline">← Kembali ke Semua Postingan</a>
        </div>

    </div>
</div>

<?php include '../layout/footer.php'; ?>