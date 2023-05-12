<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "DELETE FROM moderator_kategorije WHERE korisnici_id='".$_POST["moderator"]."' AND kategorija_id='".$_POST["kategorija"]."';";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);

    $baza->zatvoriDB();
?>