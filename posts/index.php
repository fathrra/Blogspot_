<?php
require '../config/database.php';
include '../layout/header.php';

$query = "SELECT posts.*, categories.name AS category_name 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          ORDER BY posts.id DESC";
$result = $conn->query($query);
?>

<!-- HERO -->
<div class="page-hero" style="margin-left:-2rem; margin-right:-2rem; margin-top:0;">
    <div class="hero-tag">Admin</div>
    <h1>Daftar Postingan</h1>
    <p>Kelola semua artikel yang telah dibuat.</p>
</div>

<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="create.php" class="btn-dark">+ Tambah Post Baru</a>
</div>

<div class="data-table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width:48px;">#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th style="width:160px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = $result->fetch_assoc()): 
            ?>
            <tr>
                <td style="color:#aaa; font-size:12px;"><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td>
                    <span class="cat-badge"><?= htmlspecialchars($row['category_name'] ?? 'Tanpa Kategori'); ?></span>
                </td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">&#9998; Edit</a>
                    <a href="delete.php?id=<?= $row['id']; ?>" class="btn-del" onclick="return confirm('Yakin ingin menghapus postingan ini?')">&#10005; Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>

            <?php if ($result->num_rows == 0): ?>
            <tr>
                <td colspan="4" style="text-align:center; padding:2.5rem; color:#aaa; font-size:13px;">
                    Belum ada postingan. <a href="create.php" style="color:#185FA5;">Buat sekarang →</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../layout/footer.php'; ?>