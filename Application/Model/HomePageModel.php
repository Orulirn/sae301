<?php

function isConn(){
    if ($_SESSION['user']->getlog()){
        return true;
    }else{
        return false;
    }
}
?>
