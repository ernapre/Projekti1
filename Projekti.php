<?php 
  session_start(); 

  
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: Projekti.php");
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
    <title>Gjeneza e muzikes rock</title>
    <link rel="stylesheet" href="Projekti.css">
</head>

<body>
    <video id="video-background" autoplay muted loop>
        <source src="MuzikaRock_2.mp4" type="video/mp4">
    </video>

    <div id="music-button">
        <p class="song-name">Era - Gjurmet</p>
        <button class="music-button">
            <img src="play.png" id="icon">
        </button>
        <div class="volume-slider">
            <input type="range" id="volume" min="0" max="100" value="50">
            <div>
                <label class="switch">
                    <input type="checkbox" id="videoToggle">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>

    <audio id="mySong">
        <source src="Era.mp3" type="audio/mp3">
    </audio>

    <script>
        var mySong = document.getElementById("mySong");
        var icon = document.getElementById("icon");
        var volumeSlider = document.getElementById("volume");
        var videoToggle = document.getElementById("videoToggle");
        var video = document.getElementById("video-background");

        icon.onclick = function () {
            if (mySong.paused) {
                mySong.play();
                icon.src = "pauza.png";
            } else {
                mySong.pause();
                icon.src = "play.png";
            }
        }

        volumeSlider.addEventListener('input', function () {
            mySong.volume = volumeSlider.value / 100;
        });

        videoToggle.addEventListener('change', function () {
            if (videoToggle.checked) {
                video.pause();
            } else {
                video.play();
            }
        });
    </script>

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
        <div class="welcome">
        <p style="font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 300;">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    </div>
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

<script>
        // mos e le mu kthy prap te log-in masi ke login
        history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            history.pushState(null, null, window.location.href);
        };
    </script>

</body>

</html>