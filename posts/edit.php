<?php
require '../config/database.php';
include '../layout/header.php';

// 1. Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// 2. Ambil data postingan lama
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// Jika data tidak ditemukan
if (!$post) {
    echo "Postingan tidak ditemukan!";
    exit;
}

// 3. Ambil semua kategori untuk dropdown
$categories = $conn->query("SELECT * FROM categories");
?>

<h2>Edit Postingan</h2>
<hr>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?= $post['id']; ?>">

    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="title" class="form-control" value="<?= $post['title']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="category_id" class="form-select" required>
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['id']; ?>" <?= ($cat['id'] == $post['category_id']) ? 'selected' : ''; ?>>
                    <?= $cat['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Konten</label>
        <textarea name="content" class="form-control" rows="5" required><?= $post['content']; ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update Postingan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>

<?php include '../layout/footer.php'; ?>