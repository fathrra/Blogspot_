<?php
require 'config/database.php';
include 'layout/header.php';

// Ambil semua postingan
$query = "SELECT posts.*, categories.name AS category_name 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          ORDER BY posts.id DESC";
$result = $conn->query($query);
?>

<div class="mb-5">
    <h1>Semua Postingan</h1>
    <p class="text-muted">Menampilkan semua artikel yang telah diterbitkan.</p>
    <hr>
</div>

<div class="row">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title"><?= $row['title']; ?></h3>
                        <span class="badge bg-secondary height-fit"><?= $row['category_name'] ?? 'General'; ?></span>
                    </div>
                    <p class="card-text mt-3">
                        <?= nl2br(substr($row['content'], 0, 200)); ?>...
                    </p>
                    <a href="#" class="btn btn-link p-0">Lanjutkan Membaca &rarr;</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12 text-center">
            <p>Belum ada postingan yang dipublikasikan.</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'layout/footer.php'; ?>