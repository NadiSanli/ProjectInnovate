<?php
    function getSlide ($count, $requests){
        if(true){
            for ($i=0;$i<8;$i++){
                echo '<p>';
                echo $requests[$count][$i];
                echo '</p>';
            }
            return true;
            
        }else{
            return false;
        }

    }
?>