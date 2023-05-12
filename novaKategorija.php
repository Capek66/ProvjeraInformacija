<?php
    require_once './vanjske_biblioteke/smarty/libs/Smarty.class.php';
    require_once './skripte/baza.class.php';
    require_once './dnevnik.php';
    
    session_start();

    $smarty = new Smarty();
    $baza = new Baza();
    
    if(!isset($_SESSION["korisnik_id"])){
        header("Location: ./obrasci/prijava.php");
    }else{
        if($_SESSION["tip_korisnika"] != '1'){
            header("Location: ./obrasci/prijava.php?logout");
        }
    }
    
    $naslov = "Dodavanje kategorije";
    $putanja = "./skripte/kategorije.php?nova";
    $naziv = "";
    $opis = "";
    $kategorija_id = "";
    $ukljucena = "disabled";
    $prikazujeSe = "style='display: none;'";
    $gumbTekst = "Dodaj kategoriju";
    
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
    
    if(isset($_GET["azuriraj"])){
        UnesiZapis('4', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?azuriraj");
        $kategorija = dohvatiKategoriju();
        $naslov = "Ažuriranje kategorije";
        $putanja = "./skripte/kategorije.php?azuriraj";
        $naziv = $kategorija["naziv"];
        $opis = $kategorija["opis"];
        $kategorija_id = $_GET["id"];
        $ukljucena = "";
        $prikazujeSe = "";
        $gumbTekst = "Ažuriraj kategoriju";
    }else{
        UnesiZapis('4', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
    }
    
    $smarty->assign("navigacija", $navigacija);
    $smarty->assign("navigacija_putanja", $navigacija_putanja);
    $smarty->assign("naslov", $naslov);
    $smarty->assign("putanja", $putanja);
    $smarty->assign("naziv", $naziv);
    $smarty->assign("opis", $opis);
    $smarty->assign("kategorija_id", $kategorija_id);
    $smarty->assign("ukljucena", $ukljucena);
    $smarty->assign("prikazujeSe", $prikazujeSe);
    $smarty->assign("gumbTekst", $gumbTekst);
    
    $smarty->display("novaKategorija.tpl");
    
    function dohvatiKategoriju(){
        global $baza;
        
        $baza->spojiDB();
        
        $sql = "SELECT * FROM kategorija WHERE id='".$_GET["id"]."';";
        $r = $baza->selectDB($sql);
        $kategorija = mysqli_fetch_assoc($r);

        $baza->zatvoriDB();
        return $kategorija;
    }
?>