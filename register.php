<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="container">
    <div class="register-container">
        <form method="post" action="register.php" onsubmit="return validateForm()">
            <?php include('errors.php'); ?>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" placeholder="Username" required value="<?php echo $username; ?>">

          <label for="password">Password:</label>
          <input type="password" id="password_1" name="password_1" placeholder="Password" required>

          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="password_2" name="password_2" placeholder="Confirm Password" required>

          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" placeholder="Email Address" required value ="<?php echo $email; ?>">
       
          <a href="login.php" class="log-in-link">Already have an account? Log in here!</a>
   
        </div>
        <div class="register-button-container">
         <button type="submit" class="register-button" name="reg_user">Register</button>
         </div>
        </form>
    </div>
</div>

<div id="content">
    <button id="menuButton" onclick="toggleMenu()">
        <img src="Btn.png" alt="Menu Button">
    </button>
</div>

<div class="menu-container">
    <div class="menu-content">
        <a href="Projekti.html" class="menu-item">Home</a>
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
      var confirmPassword = document.getElementById('confirmPassword').value;
      var email = document.getElementById('email').value;

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

      if (password !== confirmPassword) {
          alert('Password and Confirm Password do not match.');
          return false;
      }

      var emailRegex = /^\S+@\S+\.\S+$/;
      if (!emailRegex.test(email)) {
          alert('Invalid email address.');
          return false;
      }
      return true;
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