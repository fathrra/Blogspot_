<?php

require '../config/database.php'; // 1. Perbaikan typo: databse -> database

// 2. Perbaikan typo: $GET -> $_GET
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare(
    "DELETE FROM categories WHERE id = ?" // 'categories' biasanya huruf kecil sesuai nama tabelmu
);

// 3. Tambahkan koma antara "i" dan $id
$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: index.php");
exit;