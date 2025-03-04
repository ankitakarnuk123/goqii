<?php
header("Content-Type: application/json");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id']) && !empty($data['name']) && !empty($data['email']) && !empty($data['dob'])) {
    $id = $data['id'];
    $name = $data['name'];
    $email = $data['email'];
    $dob = $data['dob'];

    if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT); 
        $sql = "UPDATE users SET name='$name', email='$email', password='$password', dob='$dob' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET name='$name', email='$email', dob='$dob' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "User updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
}

$conn->close();
?>
