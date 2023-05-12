<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    $baza->spojiDB();
    if(isset($_GET["nova"])){
        $sql = "INSERT INTO kategorija VALUES(DEFAULT, '".$_POST["naziv"]."', '".$_POST["opisKat"]."');";
        UnesiZapis('3', $sql);
        $baza->executeDB($sql);
    }
    
    if(isset($_GET["azuriraj"])){
        $sql = "UPDATE kategorija SET naziv='".$_POST["naziv"]."', opis='".$_POST["opisKat"]."' WHERE id='".$_POST["id"]."';";
        UnesiZapis('3', $sql);
        $baza->executeDB($sql);
    }
    
    if(isset($_GET["obrisi"])){
        $sql = "DELETE FROM kategorija WHERE id='".$_POST["id"]."';";
        UnesiZapis('3', $sql);
        $baza->executeDB($sql);
    }
    
    $baza->zatvoriDB();
    header("Location: ../upravljanjeKategorijama.php");
?>