<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "INSERT INTO blokirani_korisnici VALUES('".$_POST["autor_id"]."', '".$_POST["kategorija_id"]."', '".$_POST["razlog"]."', '".date("Y-m-d H:i:s", strtotime($_POST["blokiran_do"]))."');";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);

    $baza->zatvoriDB();
    header("Location: ../odbijeneVijesti.php");
?>