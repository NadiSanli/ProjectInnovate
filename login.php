<?php
    //Starts session and includes database connection
    session_start();
    include("includes/config.php");

    //Checks whether submit button has been pressed.
    if (isset($_POST['login_user'])) {
        if (empty($_POST['user']) || empty($_POST['pass'])) {
            echo '<script>alert("You must enter a username and password!")</script>';
            //echo "<p>You must enter your username and password</p>";
            //echo "<p>You will be redirected to the login page in 5 seconds.</p>";
            //header("refresh:5;url=login.php");
        } else {
            //Prepares and executes SQL statement to pull all data from the user table to check values.
            $stmt = $pdo->prepare('SELECT * FROM `user` WHERE username = ?');
            $stmt->execute(array($_POST["user"]));
            $result = $stmt->fetchAll();

            //Checks whether username and password match data from user table in database.
            if (password_verify($_POST['pass'], $result[0][2])) {

                //Binds results to variables to be used later.
                $_SESSION['userid'] = $result[0][0];
                $_SESSION["username"] = $_POST["user"];
                header("Location: index.php");
            } else {
                echo '<script>alert("Username or password is wrong!")</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Breedr</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
    <div class="navbar">
        <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </div>
    <div class="content_wrapper">
        <div class="logo">
            <img src="images/logo.png">
        </div>
        <div class="addmessage">
            <form class="form_signup" method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"]) ?>">
                <p>Username:</p>
                <p><input type="text" name="user" class="main-button"/></p>

                <p>Password:</p>
                <p><input type="password" name="pass" class="main-button"/></p>

                <p><input type="submit" value="Submit" name="login_user" class="main-button"/></p>
            </form>
        </div>
    </div>
    </body>
</html>
