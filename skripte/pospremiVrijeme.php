<?php
    require_once './baza.class.php';
    
    $baza = new Baza();
    
    $baza->spojiDB();

        $virtualniSati = $_POST["sati"];
        $sql = "UPDATE vrijeme SET vrijeme='".$_POST["sati"]."' WHERE id='1'";
        $baza->executeDB($sql);

    $baza->zatvoriDB();
?>