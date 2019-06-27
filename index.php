<?php
//Starts session and includes database connection
session_start();
include ("includes/config.php");

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
        <li><a href="index.php">Swipe</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="settings.php">Preferences</a></li>
    </ul>
</div>
<div class="content_wrapper">
    <div class="logo">
        <img src="images/logo.png">
    </div>
    <div class="addmessage">
        <form class="form_signup" method="POST" action="login.php">
            <p>Distance:</p>
            <p><input type="number" name="distance" min="1" max="100" class ="main-button" value="1"></p>

            <p>Age:</p>
            <p><input type="number" name="age" min="1" max="100" class ="main-button" value="1"></p>

            <p>Breed:</p>
            <p><select name ="breed" class="main-button">
                    <option value="dog1">Volvo</option>
                    <option value="dog2">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select></p>

            <p>Sex:</p>
            <p><select name="sex" class="main-button">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select></p>


            <p><input type="submit" value="Submit" name="submit" class="main-button"/></p>
        </form>
    </div>
</div>
</body>
</html>