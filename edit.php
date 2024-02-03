<?php
include "connection.php";

$error_message = ""; 


if(isset($_GET['id'])){
    $id = $_GET['id'];

   
    $select_query = "SELECT * FROM `users` WHERE `id` = $id";
    $result = mysqli_query($conn, $select_query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['submit'])) {
    $newUsername = $_POST['newUsername'];
    $newEmail = $_POST['newEmail'];
    $newPassword = md5($_POST['newPassword']);
    $newUsertype = $_POST['newUsertype'];

    
    $checkUsernameQuery = "SELECT * FROM `users` WHERE `username` = '$newUsername' AND `id` != $id";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

    
    $checkEmailQuery = "SELECT * FROM `users` WHERE `email` = '$newEmail' AND `id` != $id";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkUsernameResult) > 0) {
        $error_message = "Username already exists. Choose a different username.";
    } elseif (mysqli_num_rows($checkEmailResult) > 0) {
        $error_message = "Email already exists. Choose a different email.";
    } else {
        $update_query = "UPDATE `users` SET `username`='$newUsername', `email`='$newEmail', `password`='$newPassword', `usertype`='$newUsertype' WHERE `id`=$id";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .card-container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card-header {
            background-color: #008000;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 15px; 
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px; 
        }

        .form-control {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            text-decoration: none;
            padding: 10px 20px;
            border: 1px solid #333;
            background-color: #fff;
            color: #333;
            border-radius: 5px;
            margin-right: 5px;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-info {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>

<nav>
    <h2>Admin Dashboard</h2>
    <a class="navbar-btn" href="dashboard.php">Back to Dashboard</a>
</nav>

<div class="card-container">
    <div class="card-header">
        <h1>Edit User</h1>
    </div>

    <?php
        if($error_message){
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>
    <form method="post" action="">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="newUsername" class="form-control" value="<?php echo $user['username']; ?>">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="newEmail" class="form-control" value="<?php echo $user['email']; ?>">
        </div>

        <div class="form-group">
            <label>New Password:</label>
            <input type="password" name="newPassword" class="form-control">
        </div>

        <div class="form-group">
            <label>Usertype:</label>
            <select name="newUsertype" class="form-control">
                <option value="admin" <?php echo ($user['usertype'] == 'admin') ? 'selected' : ''; ?>>admin</option>
                <option value="user" <?php echo ($user['usertype'] == 'user') ? 'selected' : ''; ?>>user</option>
            </select>
        </div>

        <button class="btn btn-success" type="submit" name="submit">Update User</button>
    </form>
</div>

</body>
</html>
