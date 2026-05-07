<?php 

require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];

    $stmt = $conn->prepare(
         "INSERT INTO categories (name) VALUES (?)"
    
    );  

    $stmt->bind_param("s", $name);

    $stmt->execute();

    header("location: index.php");
    exit;
}


$result = $conn->query(
    "SELECT * FROM categories ORDER BY id DESC"
);

?>