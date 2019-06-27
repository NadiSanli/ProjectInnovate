<?php
    //Starts session and includes database connection
    session_start();
    //Check if you're logged in.
    if ($_SESSION['loggedin'] === FALSE){
        header("location: login.php");
    }else {

        include("includes/config.php");


        $userid = $_SESSION['userid'];
        $sql = $pdo->prepare('SELECT description FROM dog WHERE userID = ?');
        $sql->execute(array($userid));
        $descCurrent = $sql->fetchAll();

        //Checks whether submit button has been pressed.
        if (isset($_POST["submit"])) {

            $dogName = $_POST["dogName"];
            $desc = $_POST["desc"];
            $age = $_POST["age"];
            //Prepares and executes statement to update your profile in the database.

            $target_dir = "images/uploads/";

            //Checks if you entered anything in the image uploader.
            if (!empty($_FILES["image"]["name"])) {
                //Prepares and executes SQL statement to input data into the user and dog table.

                $sql2 = $pdo->query("SELECT userID FROM user ORDER BY userID DESC LIMIT 1");
                $userid = $sql2->fetchColumn();
                $userid_plusOne = $userid;

                //Image uploader, checks mimetype/filetype, size and whether the file is an image.
                $token = bin2hex(random_bytes(10));
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $target_file = $target_dir . $token . "." . $imageFileType;
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check !== false) {
                    if ($_FILES["image"]["size"] <= 500000) {
                        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {

                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                $sql = $pdo->prepare('UPDATE image SET path = ?');
                                $sql->execute(array($target_file));

                                $sql = $pdo->prepare('SELECT imageID FROM image WHERE path = ?');
                                $sql->execute(array($target_file));

                                $result = $sql->fetchAll(PDO::FETCH_COLUMN);


                                echo $userid_plusOne;
                                $sql = $pdo->prepare('INSERT INTO image_class (imageID, userID) VALUES (?, ?)');
                                $sql->execute(array($result[0], $userid_plusOne));
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

            //Checks if you entered anything in the dogName box.
            if (!empty($_POST["dogName"])) {
                $sql = $pdo->prepare('UPDATE dog SET name = ? WHERE userid = ?');
                $sql->execute(array($dogName, $userid));
            }

            //Checks if you entered anything in the description box.
            if (!empty($_POST["desc"])) {
                $sql = $pdo->prepare('UPDATE dog SET description = ? WHERE userid = ?');
                $sql->execute(array($desc, $userid));
            }

            //Checks if you entered anything in the age box.
            if (!empty($_POST["age"])) {
                $sql = $pdo->prepare('UPDATE dog SET age = ? WHERE userid = ?');
                $sql->execute(array($age, $userid));
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
        <div class="profile_form">
            <form class="form_signup" method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data">
                <p>Dog Name:</p>
                <p><input type="text" name="dogName" class="text-input"/></p>

                <p>Profile Description:</p>
                <textarea rows="5" cols="50" name="desc" class="textarea-input"><?php echo $descCurrent[0][0] ?></textarea>

                <p>Dog Age:</p>
                <p><input type="number" name="age" min="1" max="100" class ="number-input" value="1"></p>

                <p>Profile Picture:</p>
                <p><input type="file" name="image" class="image-input"/></p>

                <p><input type="submit" value="Submit" name="submit" class="submit-button"/></p>
            </form>
        </div>
    </div>
    </body>
</html>