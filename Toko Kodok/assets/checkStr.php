<?php
    function checkStr($str)
    {
        $str = trim($str); 
        $str = stripslashes($str); 
        $str = htmlspecialchars($str);        
        return $str;
    }
?>