<?php 
  session_start(); 

  
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
    exit();
  }

  $inactive_timeout = 30; // 30 seconds

  
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
    <title>Image Slider</title>
    <link rel="stylesheet" href="Galeria.css">
</head>

<body>
    <script>
        var i = 0;
        var imgArray = [
            { src: "Lindja.png", hoverText: "Lindja" },
            { src: "Gjurmet.png", hoverText: "Gjurmet" },
            { src: "Minatori.jpg", hoverText: "Minatori" },
            { src: "Mak.png", hoverText: "Mak" },
            { src: "Tnt.png", hoverText: "Tnt" }
        ];

        function ndrroImg(direction) {
            if (direction === 'prev') {
                i = (i - 1 + imgArray.length) % imgArray.length;
            } else {
                i = (i + 1) % imgArray.length;
            }
            document.getElementById('slideshow').src = imgArray[i].src;
            document.getElementById('image-overlay').innerText = imgArray[i].hoverText;
        }

        document.addEventListener('DOMContentLoaded', function () {
            ndrroImg();
        });
    </script>

    <div id="kontenti">
        <header>
            <img name="mySlide" id="slideshow" />
            <div id="image-overlay"></div>
        </header>
        <div class="navigation">
            <button class="prev" onclick="ndrroImg('prev')">←</button>
            <button class="next" onclick="ndrroImg('next')">→</button>
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
            <a href="Tickets.php" class="menu-item">Tickets</a>
            <a href="login.php" class="menu-item">Log In</a>

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
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p> <a href="Projekti.php?logout='1'" style="color: red;">logout</a> </p>
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