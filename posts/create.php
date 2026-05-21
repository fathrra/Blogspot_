<?php
require '../config/database.php';
include '../layout/header.php';

$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>

<!-- JUDUL HALAMAN -->
<div class="page-title">
    <small>Postingan</small>
    <h1>Tambah Postingan Baru</h1>
</div>

<div style="max-width:640px; margin:0 auto;">
    <div class="form-wrap">
        <form action="store.php" method="POST">

            <div class="mb-4">
                <label>Judul Postingan</label>
                <input type="text" name="title" placeholder="Masukkan judul..." required>
            </div>

            <div class="mb-4">
                <label>Kategori</label>
                <select name="category_id" required>
                    <option value="">— Pilih Kategori —</option>
                    <?php while ($cat = $categories->fetch_assoc()): ?>
                        <option value="<?= $cat['id']; ?>"><?= htmlspecialchars($cat['name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-4">
                <label>Isi Artikel</label>
                <textarea name="content" placeholder="Tuliskan isi artikel..." required></textarea>
            </div>

            <div class="d-flex justify-between align-center">
                <a href="index.php" class="btn btn-gray">← Kembali</a>
                <button type="submit" class="btn">Simpan Postingan</button>
            </div>

        </form>
    </div>
</div>

<?php include '../layout/footer.php'; ?>