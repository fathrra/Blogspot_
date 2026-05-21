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
    echo "<p style='color:#aeaeb2; text-align:center; padding:40px;'>Postingan tidak ditemukan.</p>";
    include '../layout/footer.php';
    exit;
}
?>

<!-- JUDUL ARTIKEL -->
<div class="page-title">
    <small><?= htmlspecialchars($post['category_name'] ?? 'Artikel'); ?></small>
    <h1 style="font-size:28px;"><?= htmlspecialchars($post['title']); ?></h1>
</div>

<!-- ISI ARTIKEL -->
<div class="article">
    <?php
    foreach (explode("\n", trim($post['content'])) as $para) {
        $para = trim($para);
        if ($para) echo '<p>' . htmlspecialchars($para) . '</p>';
    }
    ?>
</div>

<!-- TOMBOL BAWAH -->
<div class="d-flex justify-between align-center mt-4" style="max-width:660px; margin-left:auto; margin-right:auto;">
    <a href="../posts.php" class="btn btn-gray">← Semua Postingan</a>
    <a href="edit.php?id=<?= $post['id']; ?>" class="btn">Edit Artikel</a>
</div>

<?php include '../layout/footer.php'; ?>