<?php
include 'db.php';
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">User List</h2>
    <a href='insert.php' class='btn btn-sm btn-primary'>Insert</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { 
                $enid = base64_encode($row['id']); // Encode before passing
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td>
                        <a href='update.php?id=<?php echo $enid; ?>' class='btn btn-sm btn-primary'>Edit</a>   
                        <button class='btn btn-danger delete-btn' data-id='<?php echo $row['id']; ?>'>Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $(".delete-btn").click(function() {
        let userId = $(this).data("id");
        
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: "api_delete_user.php",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({ id: userId }),
                success: function(response) {
                    alert(response.message);
                    if (response.status === "success") {
                        location.reload(); // Reload the list after deletion
                    }
                },
                error: function() {
                    alert("Failed to delete user.");
                }
            });
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
