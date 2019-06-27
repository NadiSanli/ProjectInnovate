<?php

    //Closes session (Logout)
    session_start();
    //Checks whether the session has been ended, if so redirects you to login page.
    if(session_destroy()){
        header("location: login.php");
    }
?>
