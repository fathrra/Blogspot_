<?php
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];

    // Menyiapkan query insert
    $stmt = $conn->prepare(
        "INSERT INTO posts (title, category_id, content) VALUES (?, ?, ?)"
    );

    // "sis" artinya: s (string untuk title), i (integer untuk category_id), s (string untuk content)
    $stmt->bind_param("sis", $title, $category_id, $content);

    if ($stmt->execute()) {
        // Jika berhasil, balik ke halaman utama posts
        header("Location: index.php");
        exit;
    } else {
        echo "Wah, gagal simpan data nih: " . $conn->error;
    }
}
?>