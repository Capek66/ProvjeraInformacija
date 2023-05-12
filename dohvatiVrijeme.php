<?php
    require_once './skripte/baza.class.php';
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    static $virtualniSati;
    
    $sql = "SELECT vrijeme FROM vrijeme WHERE id='1'";
    $r = $baza->selectDB($sql);
    $vrijemeBaza = mysqli_fetch_assoc($r);
    $virtualniSati = $vrijemeBaza["vrijeme"];

    $baza->zatvoriDB();
?>