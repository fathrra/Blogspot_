<?php 
require '../config/database.php';
include '../layout/header.php'; // Panggil header agar ada navbar

// Logika Simpan Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    
    // Refresh halaman agar data terbaru muncul
    header("location: index.php");
    exit;
}

// Ambil Data untuk List
$result = $conn->query("SELECT * FROM categories ORDER BY id DESC");
?>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Tambah Kategori</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Teknologi" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <h3>Daftar Kategori</h3>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../layout/footer.php'; // Panggil footer ?>