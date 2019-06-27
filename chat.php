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
            if($stmt = $db->prepare('SELECT ')){
                
                if($stmt -> execute(array(''))){
                    
                }else{echo'could not execute (partner)';}
            }else{echo'could not prepare (partner)';}
        }else{echo'could not connect to database (partner)';}










       //select chat partner
       //pull chat history
       //insert new message
    ?>
    <form method='POST' action='<?php htmlentities($_SERVER['PHP_SELF']); ?>'>
        message:<input type='text' name='name'>
        <input type='submit' name='submit' value='send'>
    </form>
</body>
</html>