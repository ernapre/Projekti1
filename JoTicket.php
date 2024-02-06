<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
<style>
        
        #login:hover {
            color: #FF00A8;
            text-decoration: none;
        }

        #register:hover {
            color: #52d800;
            text-decoration: none;
        }

        body{
            background-color: black;
        }

        #login, #register {
            text-decoration: none;
            color:white;
            
        }

        h1{
            font-size: 50px;
            color: white;
            font-family:'Montserrat', sans-serif;
            font-weight: 700;
            text-align: center;
        }

        p{
            color:white;
            font-family:'Montserrat', sans-serif;
            text-align: center;
        }

        .Text{
            margin-top: 25%;
            margin-bottom: 25%;
        }

        button {
  position: fixed;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  top: 50%;
  right: 0;
  transform: translateY(-50%);
  padding: 10px;
  padding-right: 40px;
  background-color: #ffffff00;
  border: none;
  cursor: pointer;
  justify-content: flex-end;
  align-items: center;
  align-content: center;
  z-index: 10;
}

#content {
  position: relative;
  z-index: 1;
  color: black;
  padding-left: 10px;
}

button img {
  width: 30px;
  height: 20px;
  margin-right: 5px;
  cursor: pointer;
}

.menu-container {
  position: fixed;
  top: 0;
  right: -500px; 
  width: 500px;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  transition: right 1.5s ease;
  z-index: 1;
  overflow-x: hidden;
  padding-top: 60px;
} 

.menu-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  color: white;
}

.menu-item {
  padding: 20px;
  text-decoration: none;
  color: white;
  font-size: 20px;
  transition: color 1.5s ease;
  font-family:'Montserrat', sans-serif;
  font-weight: 300;
 }

.menu-item:hover {
  color: #7a7a7a; 
}

.menu-button {
  position: fixed;
  top: 20px;
  left: 20px;
  cursor: pointer;
  z-index: 13;
  color: white;
}

.cls-button {
  padding-top: 57px;
  padding-right: 450px;
  font-weight:900;
  font-size: 50px;
  font-family:'Montserrat', sans-serif;
}

.menu-item1 {
  padding: 20px;
  text-decoration: none;
  color: white;
  font-size: 20px;
  transition: color 1.5s ease;
  font-weight:400;
  font-size: 25px;
}

.menu-item1:hover {
  color: #7a7a7a; 
}

footer{
  background-color: #111111;
  color: white; 
  text-align: center;
  padding: 10px;
  position: sticky;
  bottom: 0;
  width: 100%;
  margin-top: auto;
  top: 100%;
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
.footer-content{
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
}
.footer-content h3{
  font-size: 1.8rem;
  font-weight: 400;
  text-transform: capitalize;
  line-height: 3rem;
}
.footer-content p{
  max-width: 500px;
  margin: 10px auto;
  line-height: 28px;
  font-size: 14px;
}
.socials{
  list-style: none;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 1rem 0 3rem 0;
  margin-left: -40px;
  margin-top: -10px;
}
.socials li{
  margin: 0 10px;
}
.socials a{
  text-decoration: none;
  color: #fff;
}
.socials a i{
  font-size: 1.1rem;
  transition: color .4s ease;

}
.socials a:hover i{
  color: rgb(0, 255, 13);
}

.footer-bottom{
  background: #0c0c0c;
  width: 100vw;
  padding: 20px 0;
  text-align: center;
  margin-top: -50px;
  margin-bottom: -10px;
}
.footer-bottom p{
  font-size: 14px;
  word-spacing: 2px;
  text-transform: capitalize;
}
.footer-bottom span{
  text-transform: uppercase;
  opacity: .4;
  font-weight: 200;
}

.socials-image{
  width: 45px;
  height: 45px;
}

.guitar{
  margin-top: -30px;
  margin-bottom: 30px;
  width: 60px;
  height: 60px;
}

    </style>

</head>
<body>

        <div class="Text">
    <p>Oops! An account is required to perform this action.</p>
<h1>
        <a id="login" href="login.php">Log in</a>
        or
        <a id="register" href="register.php">Register</a>
        to continue!
</h1>
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