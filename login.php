<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

 <div class="container">
        <div class="login-container">
            <form method="post" action="login.php" onsubmit="return validateForm()">
            <?php include('errors.php'); ?>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>

                <a href="register.php" class="register-link">Don't have an account? Register here!</a>

        </div>
        <form onsubmit="return validateForm()">

            <div class="login-button-container">
                <button type="submit" class="login-button" name="login_user">Login</button>
            </div>
        </form>
        </form>
    </div>

    <<div id="content">
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
                        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
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
        function validateForm() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            var usernameRegex = /^[a-zA-Z0-9]{8,15}$/;
            if (!usernameRegex.test(username)) {
                alert('Username should be between 8-15 letters.');
                return false;
            }

            var passwordRegex = /^[A-Z].*\d{3}$/;
            if (!passwordRegex.test(password)) {
                alert('Password requires an uppercase first letter and three numbers at the end.');
                return false;
            }
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