<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "SELECT * FROM korisnici WHERE kor_ime='".$_POST["recenzent"]."';";
    UnesiZapis('3', $sql);
    $k = $baza->selectDB($sql);
    $recenzent = mysqli_fetch_assoc($k);
    
    $sql = "UPDATE recenzija SET recenzent='".$recenzent["id"]."' WHERE vijest_id='".$_POST["id"]."';";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);

    $baza->zatvoriDB();
    header("Location: ../upravljanjeRecenzijama.php");
?>