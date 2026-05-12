<?php
require 'config/database.php';
include 'layout/header.php';

$query = "SELECT posts.*, categories.name AS category_name 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          ORDER BY posts.id DESC LIMIT 3";
$result = $conn->query($query);
?>

<!-- HERO -->
<div class="page-hero" style="margin-bottom:0; padding-bottom:4rem;">
    <div class="main-container" style="padding-bottom:0;">
        <div class="hero-tag">Blog System</div>
        <h1>Cerita, Ide,<br>dan Inspirasi.</h1>
        <p style="max-width:400px; margin-bottom:1.8rem;">
            Tempat berbagi tutorial, pengalaman, dan pemikiran seputar teknologi dan kehidupan.
        </p>
        <a href="posts.php" class="btn-dark">Lihat Semua Postingan &rarr;</a>
    </div>
</div>

<!-- POSTS TERBARU -->
<div style="margin-top:2.5rem;">
    <div class="section-label">Postingan Terbaru</div>

    <?php if ($result->num_rows > 0): ?>
    <div class="row g-3">
        <?php 
        $symbols = ['✦', '◈', '◇'];
        $i = 0;
        while ($row = $result->fetch_assoc()): 
        ?>
        <div class="col-md-4">
            <div class="blog-card">
                <div class="card-thumb">
                    <span><?= $symbols[$i % 3]; ?></span>
                </div>
               <div class="card-inner">
    <div class="cat-badge"><?= htmlspecialchars($row['category_name'] ?? 'Uncategorized'); ?></div>
    
    <!-- Tambahkan link di Judul juga agar lebih user-friendly -->
    <h5 style="font-size:14px; font-weight:500; line-height:1.4; margin-bottom:6px;">
        <a href="posts/read.php?id=<?= $row['id']; ?>" style="text-decoration:none; color:inherit;">
            <?= htmlspecialchars($row['title']); ?>
        </a>
    </h5>

    <p style="font-size:12.5px; color:#6b6b6b; line-height:1.6; margin:0;">
        <?= htmlspecialchars(substr($row['content'], 0, 100)); ?>...
    </p>
</div>

<div class="card-footer-strip">
    <!-- Link yang sudah diperbaiki -->
    <a href="posts/read.php?id=<?= $row['id']; ?>" class="read-link">Baca Selengkapnya &rarr;</a>
</div>
            </div>
        </div>
        <?php $i++; endwhile; ?>
    </div>

    <?php else: ?>
    <div style="text-align:center; padding:3rem; color:#6b6b6b; font-size:14px; background:#fff; border-radius:12px; border:0.5px solid rgba(0,0,0,0.07);">
        Belum ada postingan. <a href="posts/create.php" style="color:#185FA5;">Tulis yang pertama →</a>
    </div>
    <?php endif; ?>
</div>

<?php include 'layout/footer.php'; ?>