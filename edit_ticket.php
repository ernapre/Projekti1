<?php
include "connection.php";
include "server.php";

$error_message = "";

if(isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    $select_query = "SELECT * FROM `tickets` WHERE `ID` = $ID";
    $result = mysqli_query($conn, $select_query);

    if ($result) {
        $ticket = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['submit'])) {
    $newPerformuesi = $_POST['newPerformuesi'];
    $newData = $_POST['newData'];
    $newKoha = $_POST['newKoha'];
    $newCmimi = $_POST['newCmimi'];
    $newVendi = $_POST['newVendi'];

    $update_query = "UPDATE `tickets` SET `Performuesi`='$newPerformuesi', `Data`='$newData', `Koha`='$newKoha', `Cmimi`='$newCmimi', `Vendi`='$newVendi' WHERE `ID`=$ID";
    $update_result = mysqli_query($conn, $update_query);

    
    $admin_username = $_SESSION['username'];
    $change_description = "Admin changed ticket with ID $ID";
    $log_change_query = "INSERT INTO changes (admin_username, change_description) VALUES ('$admin_username', '$change_description')";
    mysqli_query($conn, $log_change_query);



    if ($update_result) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
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
            font-family: 'Montserrat', sans-serif; 
            margin: 0;
            padding: 0;
            background-color: #000000;
        }

        nav {
            background-color: black;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .navbar-btn{
            text-decoration: none;
            padding: 5px 10px;
            color: #fff;
            border: 1px solid;
            border-radius: 5px;
        }

        .card-container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            outline: 1px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: black;
        }

        .card-header {
            background-color: black;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 15px; 
            font-family: 'Montserrat', sans-serif;

        }

        .form-group {
            color: white;
            margin-bottom: 20px;
        }

        label {
            display: block;
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
            border: 1px solid #FF00A8;
            background-color: #fff;
            color: #333;
            border-radius: 5px;
            margin-right: 5px;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-success {
            background-color: black;
            color: #FF00A8;
        }

        .btn-info {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>

<nav>
    <h2>Dashboard</h2>
    <a class="navbar-btn" href="dashboard.php">Back to Dashboard</a>
</nav>

<div class="card-container">
    <div class="card-header">
        <h1>Edit Ticket</h1>
    </div>

    <?php
    if($error_message) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>
    <form method="post" action="">
        <div class="form-group">
            <label>Performuesi:</label>
            <input type="text" name="newPerformuesi" class="form-control" value="<?php echo $ticket['Performuesi']; ?>">
        </div>

        <div class="form-group">
            <label>Data:</label>
            <input type="text" name="newData" class="form-control" value="<?php echo $ticket['Data']; ?>">
        </div>

        <div class="form-group">
            <label>Koha:</label>
            <input type="text" name="newKoha" class="form-control" value="<?php echo $ticket['Koha']; ?>">
        </div>

        <div class="form-group">
            <label>Cmimi:</label>
            <input type="text" name="newCmimi" class="form-control" value="<?php echo $ticket['Cmimi']; ?>">
        </div>

        <div class="form-group">
            <label>Vendi:</label>
            <input type="text" name="newVendi" class="form-control" value="<?php echo $ticket['Vendi']; ?>">
        </div>

        <button class="btn btn-success" type="submit" name="submit">Update Ticket</button>
    </form>
</div>

</body>
</html>
