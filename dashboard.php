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

    .navbar-btn {
      text-decoration: none;
      padding: 5px 10px;
      border: 1px solid #fff;
      background-color: #28a745;
      color: #fff;
      border-radius: 5px;
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
    }

    .btn-danger {
      background-color: #dc3545;
      color: #fff;
    }
  </style>
</head>
<body>

  <nav>
    <h2>AdminDashboard</h2>
    <a class="navbar-btn" href="create.php">Add New Member</a>
  </nav>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php
        include "connection.php";
        $sql = "select * from users";
        $result = $conn->query($sql);
        if(!$result){
            die("Invalid query!");
        }
        while($row=$result->fetch_assoc()){
            echo "
      <tr>
        <td>$row[id]</td>
        <td>$row[username]</td>
        <td>$row[email]</td>
        <td>
            <a class='btn btn-success' href='edit.php?id=$row[id]'>Edit</a>
            <a class='btn btn-danger' href='delete.php?id=$row[id]'>Delete</a>
        </td>
      </tr>
    
        ";}
        ?>
    </tbody>
  </table>

</body>
</html>
