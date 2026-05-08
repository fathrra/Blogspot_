<?php
require '../config/database.php';
include '../layout/header.php';

// Query untuk mengambil data postingan dan join dengan tabel categories
$query = "SELECT posts.*, categories.name AS category_name 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          ORDER BY posts.id DESC";
$result = $conn->query($query);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Postingan</h2>
    <a href="create.php" class="btn btn-primary">Tambah Post Baru</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        while($row = $result->fetch_assoc()): 
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['category_name'] ?? '<span class="text-muted">Tanpa Kategori</span>'; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus postingan ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        
        <?php if ($result->num_rows == 0): ?>
        <tr>
            <td colspan="4" class="text-center">Belum ada postingan.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../layout/footer.php'; ?>