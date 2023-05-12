<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "UPDATE blokirani_korisnici SET razlog='".$_POST["razlog"]."', blokiran_do='".date("Y-m-d H:i:s", strtotime($_POST["blokiran_do"]))."' WHERE korisnici_id='".$_POST["autor_id"]."' AND kategorija_id='".$_POST["kategorija_id"]."';";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);

    $baza->zatvoriDB();
    if(isset($_GET["zabrane"])){
        header("Location: ../zabrane.php");
    }else{
        header("Location: ../odbijeneVijesti.php");
    }
?>