<?php
require '../config/database.php';
include '../layout/header.php';

// Ambil semua kategori untuk pilihan di dropdown
$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Postingan Baru</h4>
            </div>
            <div class="card-body">
                <form action="store.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Judul Postingan</label>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan judul..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while($cat = $categories->fetch_assoc()): ?>
                                <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten / Isi Blog</label>
                        <textarea name="content" class="form-control" rows="8" placeholder="Tuliskan isi artikel di sini..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan Postingan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>