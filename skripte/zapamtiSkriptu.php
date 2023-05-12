<?php
    session_start();
    
    setcookie($_SESSION["korisnicko_ime"], $_POST["skripta"], time()+(3600*24*2));
?>