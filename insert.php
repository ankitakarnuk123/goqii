<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h4 class="text-center mb-4">Add New User</h4>
                <form id="addUserForm">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" id="dob" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#addUserForm").submit(function(e){
        e.preventDefault();

        let userData = {
            name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            dob: $("#dob").val()
        };

        $.ajax({
            url: "api_add_user.php",
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
                alert("Failed to add user.");
            }
        });
    });
});
</script>

</body>
</html>
