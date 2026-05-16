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

<!-- HERO -->
<div class="page-hero" data-label="Edit" style="margin-left:-2.5rem; margin-right:-2.5rem; margin-top:0;">
    <div class="hero-tag">Postingan</div>
    <h1>Edit Postingan</h1>
    <p>Perbarui judul, kategori, atau isi artikel.</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="form-card">
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?= $post['id']; ?>">

                <div class="mb-4">
                    <label class="form-label">Judul Postingan</label>
                    <input type="text" name="title" class="form-control"
                           value="<?= htmlspecialchars($post['title']); ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
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
                    <label class="form-label">Isi Artikel</label>
                    <textarea name="content" class="form-control" rows="10" required><?= htmlspecialchars($post['content']); ?></textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="index.php" class="btn-dark-outline">← Batal</a>
                    <button type="submit" class="btn-submit">Update Postingan</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>