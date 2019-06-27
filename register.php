<?php
    //Starts session and includes database connection
    session_start();
    include("includes/config.php");

    //Checks whether submit button has been pressed.
    if (isset($_POST['register_user'])) {

        $username = $_POST["user"];
        $password = $_POST["pass"];
        $email = $_POST["email"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $dogName = $_POST["dogName"];
        $desc = $_POST["desc"];
        $age = $_POST["age"];
        $sex = $_POST["sex"];
        $target_dir = "images/uploads/";

        //Checks if fields are empty, if so displays error message.
        if (empty($_POST['user']) || empty($_POST['pass']) || empty($_POST['email']) || empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['dogName']) || empty($_POST['desc']) || empty($_POST['age']) || empty($_FILES['image']['name'])) {
            //echo "<p>You must fill all fields to register an account</p>";
            echo '<script>alert("You must fill all fields to register an account!")</script>';
        } else {
            //Prepares and executes SQL statement to input data into the user and dog table.
            $sql = $pdo->prepare('INSERT INTO user (username, password, email, firstName, lastName, longi, lat) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $sql->execute(array($username, password_hash($password, PASSWORD_BCRYPT), $email, $firstName, $lastName, 0, 0));

            //Executes SQL to select the userid you created above.
            $sql = $pdo->query("SELECT userID FROM user ORDER BY userID DESC LIMIT 1");
            $userid = $sql->fetchColumn();
            $userid_plusOne = $userid;


            //Prepares and executes SQL statement to insert the dog information into the dog table.
            $zero = 0;
            $sql = $pdo->prepare("INSERT INTO dog (userID, breedID, name, age, sex, description) VALUES(?, ?, ?, ?, ?, ?)");
            $sql->execute(array($userid_plusOne, $zero, $dogName, $age, $sex, $desc));


            //Image uploader, checks mimetype/filetype, size and whether the file is an image.
            $token = bin2hex(random_bytes(10));
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $target_file = $target_dir . $token . "." . $imageFileType;
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check !== false) {
                if ($_FILES["image"]["size"] <= 500000) {
                    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" ) {

                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            $sql = $pdo->prepare('INSERT INTO image (path) VALUES (?)');
                            $sql->execute(array($target_file));

                            $sql = $pdo->prepare('SELECT imageID FROM image WHERE path = ?');
                            $sql->execute(array($target_file));

                            $result = $sql->fetchAll(PDO::FETCH_COLUMN);


                            echo $userid_plusOne;
                            $sql = $pdo->prepare('INSERT INTO image_class (imageID, userID) VALUES (?, ?)');
                            $sql->execute(array($result[0], $userid_plusOne));

                            header("url=login.php");
                        } else {
                            $msg = '<i class="fas fa-exclamation-triangle"> Error while uploading.';
                        }
                    } else {
                        $msg = '<i class="fas fa-exclamation-triangle"></i> Please upload only JPG, JPEG, PNG & GIF extensions.';
                    }
                } else {
                    $msg = '<i class="fas fa-exclamation-triangle"></i> The file is too large.';
                }
            } else {
                $msg = '<i class="fas fa-exclamation-triangle"></i> The file is not an image.';
            }
        }
        header("url=login.php");
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
            <form class="form_signup" method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data">
                <p>Username:</p>
                <p><input type="text" name="user" class="text-input"/></p>

                <p>Password:</p>
                <p><input type="password" name="pass" class="pass-input"/></p>

                <p>Email:</p>
                <p><input type="email" name="email" class="email-input"/></p>

                <p>First Name:</p>
                <p><input type="text" name="firstName" class="text-input"/></p>

                <p>Last Name:</p>
                <p><input type="text" name="lastName" class="text-input"/></p>

                <p>Dog Name:</p>
                <p><input type="text" name="dogName" class="text-input"/></p>

                <p>Profile Description:</p>
                <textarea rows="5" cols="50" name="desc" class="textarea-input"></textarea>

                <p>Dog Age:</p>
                <p><input type="number" name="age" min="1" max="100" class ="number-input" value="1"></p>

                <p>Sex:</p>
                <p><select name="sex" class="dropdown-input">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select></p>

                <p>Profile Picture:</p>
                <p><input type="file" name="image" class="image-input"/></p>

                <p><input type="submit" value="Submit" name="register_user" class="submit-button"/></p>
            </form>
        </div>
    </div>
    </body>
</html>
