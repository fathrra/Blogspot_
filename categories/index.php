<?php 
require '../config/database.php';

// 1. LOGIKA PROSES DATA (PASTIKAN BERSIH & TIDAK DOUBLE)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    
    // Buat slug otomatis
    $slug = strtolower(str_replace(' ', '-', $name));
    
    // Query INSERT hanya sekali saja
    $stmt = $conn->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $slug);
    
    if ($stmt->execute()) {
        header("location: index.php");
        exit;
    }
}

// 2. AMBIL DATA DARI DATABASE
$result = $conn->query("SELECT * FROM categories ORDER BY id DESC");

// 3. BARU PANGGIL HEADER
include '../layout/header.php'; 
?>

<div class="page-hero" data-label="Cat" style="margin-left:-2.5rem; margin-right:-2.5rem; margin-top:0;">
    <div class="hero-tag">Manajemen</div>
    <h1>Kelola Kategori</h1>
    <p>Tambah dan hapus kategori untuk postinganmu.</p>
</div>

<div class="row g-4 align-items-start">

    <div class="col-md-4">
        <div class="section-label">Tambah Baru</div>
        <div class="form-card">
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Teknologi" required>
                </div>
                <button type="submit" name="submit" class="btn-submit w-100">Simpan Kategori</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="section-label">Daftar Kategori</div>
        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:60px;">ID</th>
                        <th>Nama Kategori</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td style="color:#A1A1AA; font-size:12px;"><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td>
                            <a href="delete.php?id=<?= $row['id']; ?>" class="btn-del" onclick="return confirm('Hapus kategori ini?')">&#10005; Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                    <?php if ($result->num_rows == 0): ?>
                    <tr class="empty-row">
                        <td colspan="3">Belum ada kategori.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include '../layout/footer.php'; ?>