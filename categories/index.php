<?php 
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $slug = strtolower(str_replace(' ', '-', $name));
    $stmt = $conn->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $slug);
    if ($stmt->execute()) {
        header("location: index.php");
        exit;
    }
}

$result = $conn->query("SELECT * FROM categories ORDER BY id DESC");
include '../layout/header.php'; 
?>

<!-- JUDUL HALAMAN -->
<div class="page-title">
    <small>Manajemen</small>
    <h1>Kelola Kategori</h1>
</div>

<div class="row" style="align-items:start;">

    <!-- FORM -->
    <div class="col-4">
        <p class="text-muted mb-3">TAMBAH BARU</p>
        <div class="form-wrap">
            <form action="" method="POST">
                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" placeholder="Contoh: Teknologi" required>
                </div>
                <button type="submit" name="submit" class="btn" style="width:100%;">Simpan</button>
            </form>
        </div>
    </div>

    <!-- LIST -->
    <div class="col-8">
        <p class="text-muted mb-3">DAFTAR KATEGORI</p>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px;">ID</th>
                        <th>Nama</th>
                        <th style="width:80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="text-muted"><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td>
                            <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-red btn-sm"
                               onclick="return confirm('Hapus kategori ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                    <?php if ($result->num_rows == 0): ?>
                    <tr>
                        <td colspan="3" style="text-align:center; padding:28px; color:#aeaeb2;">
                            Belum ada kategori.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include '../layout/footer.php'; ?>