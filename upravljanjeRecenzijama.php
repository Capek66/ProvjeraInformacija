<?php
    require_once './vanjske_biblioteke/smarty/libs/Smarty.class.php';
    require_once './skripte/baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    UnesiZapis('4', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

    $smarty = new Smarty();
    $baza = new Baza();
    
    if(!isset($_SESSION["korisnik_id"])){
        header("Location: ./obrasci/prijava.php");
    }else{
        if($_SESSION["tip_korisnika"] != '1'){
            header("Location: ./obrasci/prijava.php?logout");
        }
    }
    
    $navigacija = "";
    $navigacija_putanja = "";
    if(isset($_SESSION["korisnik_id"])){
        $navigacija = "<li id='odjavaZapamti'>Odjavi se</li>";
        $navigacija_putanja = "./obrasci/prijava.php?logout";
    }
    else{
        $navigacija = "<li>Prijavi se</li>";
        $navigacija_putanja = "./obrasci/prijava.php";
    }
    
    $smarty->assign("navigacija", $navigacija);
    $smarty->assign("navigacija_putanja", $navigacija_putanja);
    
    $smarty->display("upravljanjeRecenzijama.tpl");
?>