<?php
require '../config/database.php';
include '../layout/header.php';

$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>

<!-- HERO -->
<div class="page-hero" style="margin-left:-2rem; margin-right:-2rem; margin-top:0;">
    <div class="hero-tag">Postingan</div>
    <h1>Tambah Postingan Baru</h1>
    <p>Isi form di bawah untuk menerbitkan artikel baru.</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="form-card">
            <form action="store.php" method="POST">

                <div class="mb-4">
                    <label class="form-label">Judul Postingan</label>
                    <input type="text" name="title" class="form-control" placeholder="Masukkan judul artikel..." required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">— Pilih Kategori —</option>
                        <?php while ($cat = $categories->fetch_assoc()): ?>
                            <option value="<?= $cat['id']; ?>"><?= htmlspecialchars($cat['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Isi Artikel</label>
                    <textarea name="content" class="form-control" rows="10" placeholder="Tuliskan isi artikel di sini..." required></textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="index.php" class="btn-dark-outline">← Kembali</a>
                    <button type="submit" class="btn-submit">Simpan Postingan</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>