<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Futura:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Robusta&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">

    <title>Login System</title>
    <link rel="stylesheet" href="css/login_style.css">
    <script src="js/login_script.js"></script>
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION["id"])) {
            if($_SESSION["username"] == "admin"){
                header("Location: admin.php");
            }
            else{
                header("Location: client.php");
            }
        }
        if (isset($_SESSION["errorMessage"])) {
    ?>
        <p><?php  echo $_SESSION["errorMessage"]; ?></p>
    <?php
            unset($_SESSION["errorMessage"]);
        }
    ?>
    <nav>
        <div class="logo">
            <img src="Assets/Traffic management.jpeg" alt="Traffic Logo">
            <span class="navbar-heading">Smart Traffic Management Sytem</span>
        </div>
    </nav>

    <form id="loginForm" action="include/auth.php" method="POST" enctype="multipart/form-data">
        <label for="uname">Username</label>
        <input type="text" name="uname" required placeholder="Username">

        <label for="password">Password</label>
        <input type="password" name="password" required placeholder="Password">
        <button>Login</button>
    </form>
</body>
</html>
