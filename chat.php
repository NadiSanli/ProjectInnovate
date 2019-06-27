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
    <form method='POST' action='<?php htmlentities($_SERVER['PHP_SELF']); ?>'>
        message:<input type='text' name='name'>
        <input type='submit' name='submit' value='send'>
    </form>
    <?php
       //select chat partner
       //pull chat history
       //insert new message
    ?>
</body>
</html>