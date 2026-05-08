<?php
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];

    // Query untuk mengupdate data berdasarkan ID
    $stmt = $conn->prepare(
        "UPDATE posts SET title = ?, category_id = ?, content = ? WHERE id = ?"
    );

    // "sisi" -> s (string), i (int), s (string), i (int)
    $stmt->bind_param("sisi", $title, $category_id, $content, $id);

    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke daftar postingan
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . $conn->error;
    }
} else {
    // Jika diakses tanpa metode POST, kembalikan ke index
    header("Location: index.php");
    exit;
}
?>