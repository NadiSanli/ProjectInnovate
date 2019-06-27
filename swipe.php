<?php
include ('includes.php');
session_start();
/* if(!$_SESSION['loggedin']){
    header('Location: login.php');
} */

//first show match requests
if($db = new PDO('mysql:host=localhost;dbname=breedr;charset=utf8', 'root', '')){
    if($stmt=$db->prepare(
        'SELECT s.dogID, d.name, d.age, d.sex, d.description, i.path, u.longi, u.lat, s.swipeID' . /* make a row of data for each swiper  */ . '
        FROM swipe AS s 
           JOIN dog AS d ON s.dogID = d.dogID 
           JOIN user AS u ON d.userID = u.userID
           JOIN image_class AS ic ON d.userID = ic.userID
           JOIN image AS i ON ic.imageID = i.imageID
           JOIN breed AS b ON d.breedID = b.breedID
        WHERE s.dogSID = ? AND NOT EXISTS(              ' . /* where swipee is current user  */ . '
            
            SELECT m.swipeID
        FROM swipe AS s 
           JOIN dog AS d ON s.dogID = d.dogID 
           JOIN user AS u ON d.userID = u.userID
           JOIN image_class AS ic ON d.userID = ic.userID
           JOIN image AS i ON ic.imageID = i.imageID
           JOIN breed AS b ON d.breedID = b.breedID
           JOIN `match` AS m ON s.swipeID = m.swipeID   ' . /* and swiper and swipee are not already matched  */ . '
            WHERE s.dogSID = ? 
        )')){
        if($stmt->execute(array("2","2"))){
            $requests = $stmt->fetchAll();
            $stmt = NULL;       //close DB connection for security
            $db = NULL;
            //var_dump($requests);
            //echo $requests[0][8];

            $maxcount = count($requests);
            //echo $maxcount;
            $count = 0;
            getSlide($count, $requests);

            if((isset($_POST['like']) || isset($_POST['dislike'])) && $count < $maxcount ){
                
                if(isset($_POST['like'])){
                    if($db = new PDO('mysql:host=localhost;dbname=breedr;charset=utf8', 'root', '')){
                        if($stmt = $db->prepare('INSERT INTO `match`(`swipeID`) VALUES (?)')){
                            //echo $requests[$count][8];
                            if($stmt -> execute(array($requests[$count][8]))){//insert swipeID from current Slide into new match
                                echo 'you matched with' . $requests[$count]['name'] . '!';
                            }else{echo'could not execute (match)';}
                        }else{echo'could not prepare (match)';}
                    }else{echo'could not connect to database (match)';}
                }
                

                $count++;
                if($count < $maxcount){
                    getSlide($count, $requests);
                    echo $count;
                }else{
                    echo 'bruh';
                    header('Location: swipeNearby.php');
                }
            }elseif((isset($_POST['like']) || isset($_POST['dislike'])) && $count >= $maxcount ){
                echo 'cant reach this';
            } 
            
        }else{echo'could not execute';}
    }else{echo'could not prepare';}
}else{echo'could not connect to database';}


//then show nearby users
/*
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
         WHERE u.longi < ? AND u.lat < ?')){
        if($stmt->execute(array("test" , "test"))){
            $nearby = $stmt->fetchAll();
            $stmt = NULL;
            $db = NULL;
            //printy printy

            $maxcount = count($nearby);
            //echo $maxcount;
            $count = 0;
            getSlide($count, $nearby);

            if((isset($_POST['like']) || isset($_POST['dislike'])) && $count < $maxcount ){
                $count++;
                if($count < $maxcount){
                    getSlide($count, $nearby);
                    echo $count;
                }else{
                    echo 'bruh';
                }
            }elseif((isset($_POST['like']) || isset($_POST['dislike'])) && $count >= $maxcount ){
                echo 'cant reach this';
            }




        }else{echo'could not execute';}
    }else{echo'could not prepare';}
}else{echo'could not connect to database';} 

*/
?>
<form method='POST' action='<?php htmlentities($_SERVER['PHP_SELF']); ?>'>
    <input type='submit' name='like' value='like'>
    <input type='submit' name='dislike' value='dislike'>
</form>

<!doctype html>

<html>
<head>
    <meta charset='UTF-8'>
    
</head>
<body>

    
</body>
</html>