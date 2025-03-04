<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully!";
        header("Location: list.php"); 
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
