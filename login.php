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

    <div id="content">
        <button id="menuButton" onclick="toggleMenu()">
            <img src="Btn.png" alt="Menu Button">
        </button>
    </div>
    </div>

    <div class="menu-container">
        <div class="menu-content">
            <a href="Projekti.php" class="menu-item">Home</a>
            <a href="Historiku.html" class="menu-item">Historiku</a>
            <a href="Galeria.html" class="menu-item">Galeria</a>
            <a href="Tickets.html" class="menu-item">Tickets</a>
            <a href="login.html" class="menu-item">Log In</a>
            <a href="dashboard.php" class="menu-item">Dashboard</a>
            
            <div class="cls-button">
                <a href="#" onclick="toggleMenu()" class="menu-item1">X</a>
            </div>
        </div>
    </div>

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