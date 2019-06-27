<?php
session_start();
if(!$_SESSION['loggedin']){
    header('Location: login.php');
}else{
    
}
?>
<!doctype html>

<html>
<head>
    <meta charset='UTF-8'>
    
</head>
<body>

    <?php
        //select chat parter here
        if($db = new PDO('mysql:host=localhost;dbname=breedr;charset=utf8', 'root', '')){
            if($stmt = $db->prepare('SELECT d.name, i.path, d.dogID ' . /* select dog names matched with current dog  */ . '
            FROM swipe AS s 
               JOIN dog AS d ON s.dogID = d.dogID 
               JOIN user AS u ON d.userID = u.userID
               JOIN image_class AS ic ON d.userID = ic.userID
               JOIN image AS i ON ic.imageID = i.imageID
               JOIN breed AS b ON d.breedID = b.breedID
               JOIN `match` AS m ON s.swipeID = m.swipeID   ' . /*   */ . '
                WHERE s.dogSID = ? OR s.dogID = ?')){ 
                
                if($stmt -> execute(array($_SESSION['dogID'],$_SESSION['dogID']))){
                   $matched = $stmt->fetchAll();
                   $stmt = NULL;
                   $db = NULL;

                   foreach($matched as $m =>$val){
                       echo $matched[$m]['name'];
                       echo '<img src="' . $matched[$m]['path'] . '"/>'; 
                       echo "<form method='POST' action='<?php htmlentities(\$_SERVER['PHP_SELF']); ?>'>
                       <input type='hidden' value='" . $matched[$m]['dogID'] . "' name='otherdogID'>
                       <input type='submit' name='startchat' value='send'>
                        </form>";//some link to open chat with user 
                   }
                }else{echo'could not execute (partner)';}
            }else{echo'could not prepare (partner)';}
        }else{echo'could not connect to database (partner)';}

        if(isset($_POST['startchat'])){
            //load chat of person clicked

            if($db = new PDO('mysql:host=localhost;dbname=breedr;charset=utf8', 'root', '')){
                if($stmt = $db->prepare('SELECT `message`, messageID FROM messages WHERE dogID = ? AND dogSID = ? ORDER BY messageID')){//get other dudes messages
                   
                    if($stmt -> execute(array($_POST['otherdogID'] , $_SESSION['dogID']))){
                        $received = $stmt->fetchAll();
                        $stmt = NULL;
                        $db = NULL;
                        foreach($received as $r){
                            echo $received[$r][0];
                        }
                        

                        if($db = new PDO('mysql:host=localhost;dbname=breedr;charset=utf8', 'root', '')){
                            if($stmt = $db->prepare('SELECT `message`, messageID FROM messages WHERE dogID = ? AND dogSID = ? ORDER BY messageID')){//now get own messages
                                                   
                                if($stmt -> execute(array($_SESSION['dogID'], $_POST['otherdogID']))){
                                    $sent = $stmt->fetchAll();
                                    $stmt = NULL;
                                    $db = NULL;      
                                    
                                    foreach($sent as $s){
                                        echo $sent[$s][0];
                                    }
                                }else{echo'could not execute (sent)';}
                            }else{echo'could not prepare (sent)';}
                        }else{echo'could not connect to database (sent)';}

                    }else{echo'could not execute (receive)';}
                }else{echo'could not prepare (receive)';}
            }else{echo'could not connect to database (receive)';}


        }
        if(isset($_POST['sendMessage'])){                   //if send button is pressed
            if($db = new PDO('mysql:host=localhost;dbname=breedr;charset=utf8', 'root', '')){
                if($stmt = $db->prepare('INSERT INTO `messages`(`message`, dogID, dogSID) VALUES (?,?,?)')){ //puts new message in database
                                       
                    if($stmt -> execute(array($_POST['sendy_boi'], $_SESSION['dogID'], $_POST['otherdogID']))){
                       echo'message sent';
                       // TODO refresh messages after sending                     
                    }else{echo'could not execute (send)';}
                }else{echo'could not prepare (send)';}
            }else{echo'could not connect to database (send)';}
        }
       
    ?>
    <form method='POST' action='<?php htmlentities($_SERVER['PHP_SELF']); ?>'>
        message:<input type='text' name='sendy_boi'>
        <input type='submit' name='sendMessage' value='send'>
    </form>
</body>
</html>