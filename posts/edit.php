<?php
require '../config/database.php';
include '../layout/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "<p style='color:red;'>Postingan tidak ditemukan!</p>";
    include '../layout/footer.php';
    exit;
}

$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>

<!-- JUDUL HALAMAN -->
<div class="page-title">
    <small>Postingan</small>
    <h1>Edit Postingan</h1>
</div>

<div style="max-width:640px; margin:0 auto;">
    <div class="form-wrap">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $post['id']; ?>">

            <div class="mb-4">
                <label>Judul Postingan</label>
                <input type="text" name="title" value="<?= htmlspecialchars($post['title']); ?>" required>
            </div>

            <div class="mb-4">
                <label>Kategori</label>
                <select name="category_id" required>
                    <option value="">— Pilih Kategori —</option>
                    <?php while ($cat = $categories->fetch_assoc()): ?>
                        <option value="<?= $cat['id']; ?>"
                            <?= ($cat['id'] == $post['category_id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-4">
                <label>Isi Artikel</label>
                <textarea name="content" required><?= htmlspecialchars($post['content']); ?></textarea>
            </div>

            <div class="d-flex justify-between align-center">
                <a href="index.php" class="btn btn-gray">← Batal</a>
                <button type="submit" class="btn">Update Postingan</button>
            </div>

        </form>
    </div>
</div>

<?php include '../layout/footer.php'; ?>