<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    session_start();

    $baza = new Baza();
    
    $baza->spojiDB();
     if(isset($_POST["cinjenicne"])){
         $cinjenicne = 1;
     }else{
         $cinjenicne = 0;
     }
     
     if(isset($_POST["gramaticke"])){
         $gramaticke = 1;
     }else{
         $gramaticke = 0;
     }
     
     if(isset($_POST["nedostatak_mat"])){
         $nedostatak_mat = 1;
     }else{
         $nedostatak_mat = 0;
     }
     
     if(isset($_POST["nedostatak_izv"])){
         $nedostatak_izv = 1;
     }else{
         $nedostatak_izv = 0;
     }
    
    
    $sql = "UPDATE recenzija SET status_id='".$_POST["statusVijesti"]."', recenzija='".$_POST["recenzija"]."', "
            . "cinjenicne_pogreske='".$cinjenicne."', "
            . "gramaticke_pogreske='".$gramaticke."', "
            . "nedostatak_materijala='".$nedostatak_mat."', "
            . "nedostatak_izvora='".$nedostatak_izv."' WHERE vijest_id='".$_POST["vijest_id"]."';";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);
    $sql = "UPDATE vijest SET status_vijesti='".$_POST["statusVijesti"]."' WHERE id='".$_POST["vijest_id"]."';";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);
    
    $baza->zatvoriDB();
    header("Location: ../mojeKategorije.php");
?>