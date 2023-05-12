<?php
    require_once './baza.class.php';
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "SELECT * FROM vijest WHERE id='".$_POST["id"]."';";
    $r = $baza->selectDB($sql);
    $vijest = mysqli_fetch_assoc($r);
    $broj_pregleda = $vijest["broj_pregleda"];
    $broj_pregleda++;
    $datumVrijeme = $vijest["datum_vrijeme"];
    
    $sql = "UPDATE vijest SET broj_pregleda='".$broj_pregleda."', datum_vrijeme='".$datumVrijeme."' WHERE id='".$_POST["id"]."';";
    $baza->executeDB($sql);

    $baza->zatvoriDB();
?>