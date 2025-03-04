<?php
include 'db.php';

if (isset($_GET['id'])) {
    $enid = $_GET['id'];
     $id=base64_decode($enid );
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
     <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h4 class="text-center mb-4">Edit User</h4>
                <form id="editUserForm">
                    <input type="hidden" id="id" value="<?php echo $id; ?>">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" value="<?php echo $user['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" id="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DOB</label>
                        <input type="date" id="dob" class="form-control" value="<?php echo $user['dob']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#editUserForm").submit(function(e){
        e.preventDefault();
        let userData = {
            id: $("#id").val(),
            name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            dob: $("#dob").val()
        };

        $.ajax({
            url: "api_update_user.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(userData),
            success: function(response){
                alert(response.message);
                if (response.status === "success") {
                    window.location.href = "list.php"; 
                }
            },
            error: function(){
                alert("Failed to update user.");
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
