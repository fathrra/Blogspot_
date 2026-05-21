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
<div class="hero">
    <h1>My Blog</h1>
    <p>Tempat berbagi tutorial, pengalaman, dan pemikiran seputar teknologi.</p>
    <a href="posts.php" class="btn">Lihat Semua Postingan &rarr;</a>
</div>

<!-- POSTINGAN TERBARU -->
<p class="text-muted" style="margin-bottom:14px;">POSTINGAN TERBARU</p>

<?php if ($result->num_rows > 0): ?>
<div class="grid-3">
    <?php
    $i = 1;
    while ($row = $result->fetch_assoc()):
    ?>
    <a href="posts/read.php?id=<?= $row['id']; ?>" class="card">
        <div class="card-img"><?= $i; ?></div>
        <div class="card-body">
            <div class="badge"><?= htmlspecialchars($row['category_name'] ?? 'Umum'); ?></div>
            <h3><?= htmlspecialchars($row['title']); ?></h3>
            <p><?= htmlspecialchars(substr($row['content'], 0, 90)); ?>...</p>
        </div>
        <div class="card-foot">Baca Selengkapnya &rarr;</div>
    </a>
    <?php $i++; endwhile; ?>
</div>

<?php else: ?>
<p style="color:#aeaeb2; text-align:center; padding:40px;">
    Belum ada postingan. <a href="posts/create.php" style="color:#0071e3;">Tulis sekarang →</a>
</p>
<?php endif; ?>

<?php include 'layout/footer.php'; ?>