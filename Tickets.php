<?php 
  session_start(); 

  
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
                <div class="EmriBandes">MAK</div>
                <div class="Data">07.27.2024</div>
                <div class="Koha">21:00</div>
                <div class="Cmimi">€5</div>
                <div class="Adresa">Sheshi Zahir Pajaziti</div>
            </div>

            <div class="tiketa">
                <img src="Ticket.png" alt="Ticket" height="auto">
                <div class="EmriBandes">MAK</div>
                <div class="Data">07.27.2024</div>
                <div class="Koha">21:00</div>
                <div class="Cmimi">€5</div>
                <div class="Adresa">Sheshi Zahir Pajaziti</div>
            </div>

            <div class="tiketa">
                <img src="Ticket.png" alt="Ticket" height="auto">
                <div class="EmriBandes">MAK</div>
                <div class="Data">07.27.2024</div>
                <div class="Koha">21:00</div>
                <div class="Cmimi">€5</div>
                <div class="Adresa">Sheshi Zahir Pajaziti</div>
            </div>

            <div class="tiketa">
                <img src="Ticket.png" alt="Ticket" height="auto">
                <div class="EmriBandes">MAK</div>
                <div class="Data">07.27.2024</div>
                <div class="Koha">21:00</div>
                <div class="Cmimi">€5</div>
                <div class="Adresa">Sheshi Zahir Pajaziti</div>
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