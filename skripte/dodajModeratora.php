<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "SELECT * FROM korisnici WHERE kor_ime='".$_POST["moderator"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $korisnik = mysqli_fetch_assoc($r);
    
    $sql = "INSERT INTO moderator_kategorije VALUES ('".$korisnik["id"]."', '".$_POST["kategorija"]."');";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);
    
    if($korisnik["tip_korisnika_id"] != '1'){
        $sql = "UPDATE korisnici SET tip_korisnika_id='2' WHERE id='".$korisnik["id"]."';";
        UnesiZapis('3', $sql);
        $baza->executeDB($sql);
    }

    $baza->zatvoriDB();
?>