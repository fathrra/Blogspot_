<?php
require '../config/database.php';
include '../layout/header.php';

if (!isset($_GET['id'])) {
    header("Location: ../posts.php");
    exit;
}

$id = (int) $_GET['id'];
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

if (!$post) {
    echo '<div style="text-align:center; padding:3rem; color:#A1A1AA; font-size:13px;">Postingan tidak ditemukan. <a href="../posts.php" style="color:#1D5FA6;">Kembali →</a></div>';
    include '../layout/footer.php';
    exit;
}
?>

<!-- HERO -->
<div class="page-hero" data-label="Read" style="margin-left:-2.5rem; margin-right:-2.5rem; margin-top:0;">
    <div class="hero-tag"><?= htmlspecialchars($post['category_name'] ?? 'Artikel'); ?></div>
    <h1 style="max-width:620px;"><?= htmlspecialchars($post['title']); ?></h1>
</div>

<!-- ISI ARTIKEL -->
<div style="margin-top: 2.2rem;">
    <div class="article-body">
        <?php
        $paragraphs = explode("\n", trim($post['content']));
        foreach ($paragraphs as $para) {
            $para = trim($para);
            if ($para !== '') {
                echo '<p>' . htmlspecialchars($para) . '</p>';
            }
        }
        ?>
    </div>

    <!-- AKSI BAWAH -->
    <div style="max-width:680px; margin: 1.5rem auto 0; display:flex; justify-content:space-between; align-items:center;">
        <a href="../posts.php" class="btn-dark-outline">← Semua Postingan</a>
        <a href="edit.php?id=<?= $post['id']; ?>" class="btn-edit">&#9998; Edit Artikel</a>
    </div>
</div>

<?php include '../layout/footer.php'; ?>