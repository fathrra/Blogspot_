<?php
require '../config/database.php';

// Pastikan ada ID yang dikirim lewat URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Siapkan query hapus
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Berhasil hapus, balik ke index
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus postingan: " . $conn->error;
}
?>