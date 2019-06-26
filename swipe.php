<?php
session_start();
/*if(!$_SESSION['loggedin']){
    header('Location: login.php');
}else{
    //echo '<a href="register.php">register</a>';
    //echo '<a href="messages.php"> more lööps</a>';
}*/

if (isset($_POST["submit"])){

}
//first show match requests
if($db = new PDO('mysql:host=localhost;dbname=breedr;charset=utf8', 'root', '')){
    if($stmt=$db->prepare(
        'SELECT s.dogID, d.name, d.age, d.sex, d.description, i.path, u.longi, u.lat
         FROM swipe AS s 
            JOIN dog AS d ON s.dogID = d.dogID 
            JOIN user AS u ON d.userID = u.userID
            JOIN image_class AS ic ON d.userID = ic.userID
            JOIN image AS i ON ic.imageID = i.imageID
            JOIN breed AS b ON d.breedID = b.breedID
         WHERE s.dogSID = ?')){
        if($stmt->execute(array("test"))){
            $requests = $stmt->fetchAll();
            $stmt = NULL;
            $db = NULL;
            var_dump($requests);
            foreach($requests as $req => $val){
                //print out one profile

                echo "<form method='POST' action='<?php htmlentities(\$_SERVER['PHP_SELF']); ?>'>
                        <input type='submit' name='like'>
                        <input type='submit' name='dislike'>
                        </form>
                        ";
                while(!isset($_POST['like']) && !isset($_POST['dislike'])){
                    //wait
                }
            }

            
        }else{echo'could not execute';}
    }else{echo'could not prepare';}
}else{echo'could not connect to database';}

//then show nearby users
if($db = new PDO('mysql:host=localhost;dbname=breedr;charset=utf8', 'root', '')){
    $maxlong = 0;
    $maxlat = 0;
    if($stmt=$db->prepare(
        'SELECT s.dogID, d.name, d.age, d.sex, d.description, i.path, u.longi, u.lat
         FROM swipe AS s 
            JOIN dog AS d ON s.dogID = d.dogID 
            JOIN user AS u ON d.userID = u.userID
            JOIN image_class AS ic ON d.userID = ic.userID
            JOIN image AS i ON ic.imageID = i.imageID
            JOIN breed AS b ON d.breedID = b.breedID
         WHERE s.dogSID = ?')){
        if($stmt->execute(array("test"))){
            $nearby = $stmt->fetchAll();
            $stmt = NULL;
            $db = NULL;
            //printy printy
        
            
        }else{echo'could not execute';}
    }else{echo'could not prepare';}
}else{echo'could not connect to database';}
?>
<!doctype html>

<html>
<head>
    <meta charset='UTF-8'>
    
</head>
<body>

    <form method='POST' action='<?php htmlentities($_SERVER['PHP_SELF']); ?>'>
        <input type='submit' name='like'>
        <input type='submit' name='dislike'>
    </form>
</body>
</html>