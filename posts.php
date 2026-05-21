<?php
require 'config/database.php';
include 'layout/header.php';

$query = "SELECT posts.*, categories.name AS category_name 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          ORDER BY posts.id DESC";
$result = $conn->query($query);
?>

<!-- JUDUL HALAMAN -->
<div class="page-title">
    <small>Artikel</small>
    <h1>Semua Postingan</h1>
</div>

<!-- TOOLBAR -->
<div class="d-flex justify-between align-center mb-3">
    <span class="text-muted"><?= $result->num_rows; ?> artikel</span>
    <a href="posts/create.php" class="btn">+ Tambah Post</a>
</div>

<!-- TABEL -->
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th style="width:40px;">#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th style="width:130px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td class="text-muted"><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><span class="badge"><?= htmlspecialchars($row['category_name'] ?? 'Umum'); ?></span></td>
                <td>
                    <a href="posts/edit.php?id=<?= $row['id']; ?>" class="btn btn-gray btn-sm">Edit</a>
                    <a href="posts/delete.php?id=<?= $row['id']; ?>" class="btn btn-red btn-sm"
                       onclick="return confirm('Hapus postingan ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>

            <?php if ($result->num_rows == 0): ?>
            <tr>
                <td colspan="4" style="text-align:center; padding:32px; color:#aeaeb2;">
                    Belum ada postingan. <a href="posts/create.php" style="color:#0071e3;">Buat sekarang →</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php'; ?>