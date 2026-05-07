<?php

require '../config/databse.php';

if (!isset($GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare(
    "DELETE FROM CATEGORIES WHERE id = ?"
);

$stmt->bind_param("i" $id);

$stmt->execute();

header("Location: index.php");
exit;
