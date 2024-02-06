<?php 
  session_start(); 

  include('connection.php');

  $ticketId1 = isset($_GET['ticket_id_1']) ? $_GET['ticket_id_1'] : 1;
  $ticketId2 = isset($_GET['ticket_id_2']) ? $_GET['ticket_id_2'] : 2;
  $ticketId3 = isset($_GET['ticket_id_3']) ? $_GET['ticket_id_3'] : 3;

  // i merr infot per tiket t par
  $query1 = "SELECT * FROM tickets WHERE ID = $ticketId1";
  $result1 = mysqli_query($conn, $query1);

  $performuesi1 = $data1 = $koha1 = $cmimi1 = $vendi1 = '';

  if ($result1 && mysqli_num_rows($result1) > 0) {
    $row1 = mysqli_fetch_assoc($result1);
    $performuesi1 = $row1['Performuesi'];
    $data1 = $row1['Data'];
    $koha1 = $row1['Koha'];
    $cmimi1 = $row1['Cmimi'];
    $vendi1 = $row1['Vendi'];
  }

  // i merr infot per tiket t dyt
  $query2 = "SELECT * FROM tickets WHERE ID = $ticketId2";
  $result2 = mysqli_query($conn, $query2);

  $performuesi2 = $data2 = $koha2 = $cmimi2 = $vendi2 = '';

  if ($result2 && mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_assoc($result2);
    $performuesi2 = $row2['Performuesi'];
    $data2 = $row2['Data'];
    $koha2 = $row2['Koha'];
    $cmimi2 = $row2['Cmimi'];
    $vendi2 = $row2['Vendi'];
  }
  
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: projekti.php");
    exit();
  }

  // i merr infot per tiket t tret
  $query3 = "SELECT * FROM tickets WHERE ID = $ticketId3";
  $result3 = mysqli_query($conn, $query3);

$performuesi3 = $data3 = $koha3 = $cmimi3 = $vendi3 = '';

if ($result3 && mysqli_num_rows($result3) > 0) {
  $row3 = mysqli_fetch_assoc($result3);
  $performuesi3 = $row3['Performuesi'];
  $data3 = $row3['Data'];
  $koha3 = $row3['Koha'];
  $cmimi3 = $row3['Cmimi'];
  $vendi3 = $row3['Vendi'];
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: projekti.php");
  exit();
}

  $inactive_timeout = 300; 

  
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
    <link rel="stylesheet" href="Tickets.css">
    <title>Tickets</title>
</head>

<body>

    <div class="container">

        <div class="Description">

            <h1>Buy
                Tickets
            </h1>

            <p> Discover your gateway to unforgettable experiences! This section is your ticket to the hottest events in
                town. Browse, click, and secure your spot for memorable moments. Don't miss out – start your adventure
                now!</p>

        </div>

        <div class="ticket">    
        <div class="tiketa">
                <img src="Ticket.png" alt="Ticket" height="auto">
                <div class="EmriBandes"><?php echo $performuesi1; ?></div>
                <div class="Data"><?php echo $data1; ?></div>
                <div class="Koha"><?php echo $koha1; ?></div>
                <div class="Cmimi">€<?php echo $cmimi1; ?></div>
                <div class="Adresa"><?php echo $vendi1; ?></div>
            </div>

            <div class="tiketa">
                <img src="Ticket.png" alt="Ticket" height="auto">
                <div class="EmriBandes"><?php echo $performuesi2; ?></div>
                <div class="Data"><?php echo $data2; ?></div>
                <div class="Koha"><?php echo $koha2; ?></div>
                <div class="Cmimi">€<?php echo $cmimi2; ?></div>
                <div class="Adresa"><?php echo $vendi2; ?></div>
            </div>

            <div class="tiketa">
                <img src="Ticket.png" alt="Ticket" height="auto">
                <div class="EmriBandes"><?php echo $performuesi3; ?></div>
                <div class="Data"><?php echo $data3; ?></div>
                <div class="Koha"><?php echo $koha3; ?></div>
                <div class="Cmimi">€<?php echo $cmimi3; ?></div>
                <div class="Adresa"><?php echo $vendi3; ?></div>
            </div>
        </div>

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
                <div class="content">
                    
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

</body>