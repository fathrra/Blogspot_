<?php
require 'config/database.php';
include 'layout/header.php';

// Ambil 3 postingan terbaru untuk ditampilkan di beranda
$query = "SELECT posts.*, categories.name AS category_name 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          ORDER BY posts.id DESC LIMIT 3";
$result = $conn->query($query);
?>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Selamat Datang di Blog Saya</h1>
        <p class="col-md-8 fs-4">Tempat berbagi cerita, tutorial, dan pengalaman seputar dunia teknologi dan lainnya.</p>
        <a href="posts.php" class="btn btn-primary btn-lg">Lihat Semua Postingan</a>
    </div>
</div>

<h2 class="mb-4">Postingan Terbaru</h2>
<div class="row">
    <?php while($row = $result->fetch_assoc()): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <span class="badge bg-info text-dark mb-2"><?= $row['category_name'] ?? 'Uncategorized'; ?></span>
                <h5 class="card-title"><?= $row['title']; ?></h5>
                <p class="card-text"><?= substr($row['content'], 0, 100); ?>...</p>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php include 'layout/footer.php'; ?>