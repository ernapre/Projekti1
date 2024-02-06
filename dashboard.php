<?php 
  session_start(); 

  
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: projekti.php");
    exit();
  }

  $inactive_timeout = 3000; 

  
  if (isset($_SESSION['username'])) {
    
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_timeout)) {
      session_unset();
      session_destroy();
      $_SESSION['timeout_msg'] = "Your session has timed out. Please log in again.";
      header('location: login.php');
      exit();
    }

    
    $_SESSION['last_activity'] = time();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>

  <nav>
    <h2>Dashboard</h2>
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

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Performuesi</th>
        <th>Data</th>
        <th>Koha</th>
        <th>Cmimi</th>
        <th>Vendi</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql_tickets = "SELECT * FROM tickets";
      $result_tickets = $conn->query($sql_tickets);
      if (!$result_tickets) {
        die("Invalid query!");
      }
      while ($row_tickets = $result_tickets->fetch_assoc()) {
        echo "
      <tr>
        <td>$row_tickets[ID]</td>
        <td>$row_tickets[Performuesi]</td>
        <td>$row_tickets[Data]</td>
        <td>$row_tickets[Koha]</td>
        <td>$row_tickets[Cmimi]</td>
        <td>$row_tickets[Vendi]</td>
        <td>
            <a class='btn btn-success' href='edit_ticket.php?ID=$row_tickets[ID]'>Edit</a>
        </td>
      </tr>";
      }
      ?>
    </tbody>
  </table>

  <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Admin Username</th>
            <th>Change Description</th>
            <th>Change Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $changes_query = "SELECT * FROM changes";
        $changes_result = mysqli_query($conn, $changes_query);

        while ($change = mysqli_fetch_assoc($changes_result)) {
            echo "
                <tr>
                    <td>{$change['id']}</td>
                    <td>{$change['admin_username']}</td>
                    <td>{$change['change_description']}</td>
                    <td>{$change['change_date']}</td>
                </tr>
            ";
        }
        ?>
    </tbody>
</table>

  <div id="content">
        <button id="menuButton" onclick="toggleMenu()">
            <img src="Btn.png" alt="Menu Button">
        </button>
    </div>

    <div class="menu-container">
        <div class="menu-content">

            <a href="Projekti.php" class="menu-item">Home</a>
            <a href="Historiku.php" class="menu-item">Historiku</a>
            <a href="Galeria.php" class="menu-item">Galeria</a>
            <?php
         if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
          echo '<a href="Projekti.php?logout=1" class="menu-item">Log Out</a>';
          echo '<a href="Tickets.php" class="menu-item">Tickets</a>';

            if ($_SESSION['is_admin']) {
                echo '<a href="dashboard.php" class="menu-item">Dashboard</a>';
            }
         } else {
            echo '<a href="login.php" class="menu-item">Log In</a>';
            echo '<a href="JoTicket.php" class="menu-item">Tickets</a>';
         }
         ?>
            

            <div class="cls-button">
                <a href="#" onclick="toggleMenu()" class="menu-item1">X</a>
            </div>
                <div class="content1">
                    
                    <?php if (isset($_SESSION['success'])) : ?>
                    <div class="error success" >
                        <h3>
                        <?php 
                            echo $_SESSION['success']; 
                            unset($_SESSION['success']);
                        ?>
                        </h3>
                    </div>
                    <?php endif ?>

                
                    <?php  if (isset($_SESSION['username'])) : ?>
                      <p style="font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 300;">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
                    <?php endif ?>

                    <?php if (isset($_SESSION['timeout_msg'])) : ?>
                            <div class="error">
                                <p><?php echo $_SESSION['timeout_msg']; unset($_SESSION['timeout_msg']); ?></p>
                            </div>
                        <?php endif ?>

                </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.querySelector('.menu-container');
            menu.style.right = menu.style.right === '0px' ? '-500px' : '0px';
        }
    </script>

    
<footer>
        <div class="footer-content">
            <h3>MUZIKA ROCK NE MITROVICE</h3>
            <img src="guitar.png" alt="" class="guitar">
            <p>Zhytuni ne boten e Muzikes Rock ne Kosove nepermjet webfaqes tone...</p>
            <p>Socials:</p>
            <ul class="socials">
                <li><a href="https://www.facebook.com/"><img src="facebook.png" alt="" class="socials-image"></a></li>
                <li><a href="https://twitter.com/"><img src="twitter.png" alt="" class="socials-image"></a></li>
                <li><a href="https://www.linkedin.com/"><img src="linkedin.png" alt="" class="socials-image"></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>Copyright &copy; 2023 designed by <span>Erna Prekazi, Ermal Sadiku</span></p>
        </div>
    </footer>

</body>
</html>
