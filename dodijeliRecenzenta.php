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
    
    $vijest = infoVijesti();
    $opcije = moguciRecenzenti();
    $vijest_id = $_GET["id"];
    $navigacija = "";
    $navigacija_putanja = "";
    $kategorija_id = dohvatiKategoriju();
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
    $smarty->assign("vijest", $vijest);
    $smarty->assign("opcije", $opcije);
    $smarty->assign("vijest_id", $vijest_id);
    $smarty->assign("kategorija_id", $kategorija_id);
    
    $smarty->display("dodijeliRecenzenta.tpl");
    
    function infoVijesti(){
        global $baza;
        $prikaz = "<div id='galerija_vijesti' style='text-align: center; width: 50%;'>";
        $baza->spojiDB();
        
        $sql = "SELECT v.naslov, ko.kor_ime, r.recenzent, ka.naziv FROM vijest v INNER JOIN korisnici ko ON v.autor=ko.id "
                . "INNER JOIN kategorija ka ON v.kategorija_id=ka.id "
                . "INNER JOIN recenzija r ON v.id=r.vijest_id WHERE v.id='".$_GET["id"]."';";
        
        $r = $baza->selectDB($sql);
        $vijest = mysqli_fetch_assoc($r);
        
        $sql = "SELECT * FROM korisnici WHERE id='".$vijest["recenzent"]."';";
        $k = $baza->selectDB($sql);
        $recenzent = mysqli_fetch_assoc($k);
        $prikaz .= "<b>Autor</b><br><p>".$vijest["kor_ime"]."</p><br>";
        $prikaz .= "<b>Naslov vijesti</b><br><p>".$vijest["naslov"]."</p><br>";
        $prikaz .= "<b>Kategorija</b><br><p>".$vijest["naziv"]."</p><br>";
        $prikaz .= "<b>Recenzent</b><br><p>".$recenzent["prezime"]." ".$recenzent["ime"]." - ".$recenzent["kor_ime"]."</p>";
        $prikaz .= "</div>";
        $baza->zatvoriDB();
        return $prikaz;
    }
    
    function moguciRecenzenti(){
        global $baza;
        
        $prikaz = "";
        $baza->spojiDB();
        
        $sql = "SELECT * FROM vijest WHERE id='".$_GET["id"]."';";
        $r = $baza->selectDB($sql);
        $vijest = mysqli_fetch_assoc($r);
        
        $sql = "SELECT ko.kor_ime FROM moderator_kategorije mk INNER JOIN korisnici ko ON ko.id=mk.korisnici_id WHERE mk.kategorija_id='".$vijest["kategorija_id"]."';";
        $m = $baza->selectDB($sql);
        while($moderator = mysqli_fetch_assoc($m)){
            $prikaz .= "<option value='".$moderator["kor_ime"]."'>";
        }
        $baza->zatvoriDB();
        return $prikaz;
    }
    
    function dohvatiKategoriju(){
        global $baza;

        $baza->spojiDB();
        
        $sql = "SELECT * FROM vijest WHERE id='".$_GET["id"]."';";
        $r = $baza->selectDB($sql);
        $vijest = mysqli_fetch_assoc($r);
        $baza->zatvoriDB();
        return $vijest["kategorija_id"];
    }
?>