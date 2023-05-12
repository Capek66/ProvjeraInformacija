<?php
    require_once './baza.class.php';
    session_start();
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "INSERT INTO korisnik_kolacic VALUES('".$_SESSION["korisnik_id"]."', '".$_POST["kolacic_id"]."');";
    $baza->executeDB($sql);

    $baza->zatvoriDB();
?>