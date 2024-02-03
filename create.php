<?php
include "connection.php";

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check_query = "SELECT * FROM `users` WHERE `email` = '$email' OR `username` = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $error_message = "Error: Email or username already exists. Please use different credentials.";
    } else {
        
        $insert_query = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
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
            width: 25%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }


        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .navbar-btn {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #fff;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
        }

        .btn {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #333;
            background-color: #fff;
            color: #333;
            border-radius: 5px;
            margin-right: 5px;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
            margin-top: 15px;
            margin-bottom: 15px;
            width: 70px;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            width: 70px;
        }

        .error-message {
            background-color: #ffdddd;
            color: #ff0000;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .form-control{
            margin-top: 10px;
        }

    </style>
</head>
<body>

<nav>
    <h2>Admin Dashboard</h2>
    <a class="navbar-btn" href="create.php">Add New Member</a>
</nav>

<div class="card-container">
<?php
    if (!empty($error_message)) {
        echo '<div class="error-message">' . $error_message . '</div>';
    }
    ?>
<div class="card-header bg-primary">
    <h1 class="text-white text-center">Create New Member</h1>
</div><br>

<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username" class="form-control"> <br>

    <label>Email:</label>
    <input type="text" name="email" class="form-control"> <br>

    <label>Password:</label>
    <input type="password" name="password" class="form-control"> <br>

    <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
    <a class="btn btn-info" href="dashboard.php">Cancel</a><br>
</form>

</div>



</body>
</html>
