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
    
    $kategorija = dohvatiKategoriju();
    $kategorijaNaziv = $kategorija["naziv"];
    $prikazModeratora = dohvatiModeratore();
    $listaKorisnika = dohvatiKorisnike();
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
    $smarty->assign("kategorijaNaziv", $kategorijaNaziv);
    $smarty->assign("prikazModeratora", $prikazModeratora);
    $smarty->assign("listaKorisnika", $listaKorisnika);
    $smarty->assign("kategorijaID", $_GET["id"]);
    
    $smarty->display("moderatoriKategorije.tpl");
    
    function dohvatiKategoriju(){
        global $baza;
        
        $baza->spojiDB();
        
        $sql = "SELECT * FROM kategorija WHERE id='".$_GET["id"]."';";
        $r = $baza->selectDB($sql);
        $kategorija = mysqli_fetch_assoc($r);
        
        $baza->zatvoriDB();
        return $kategorija;
    }
    
    function dohvatiModeratore(){
        global $baza;
        $prikaz = "";
        $baza->spojiDB();
        
        $sql = "SELECT * FROM moderator_kategorije mk INNER JOIN korisnici k ON mk.korisnici_id=k.id WHERE mk.kategorija_id='".$_GET["id"]."';";
        $r = $baza->selectDB($sql);
        while($zapis = mysqli_fetch_assoc($r)){
            $prikaz .= "<tr moderator='".$zapis["id"]."' kategorija='".$_GET["id"]."'><td><b>".$zapis["kor_ime"]."</b></td><td>".$zapis["prezime"]." ".$zapis["ime"]."</td><td class='gumb'>Ukloni s liste</td></tr>";
        }
        if($prikaz == ""){
            $prikaz = "<tr><td colspan='3'><b>Ne postoje moderatori za ovu kategoriju!</b></td></tr>";
        }
        $baza->zatvoriDB();
        return $prikaz;
    }
    
    function dohvatiKorisnike(){
        global $baza;
        $prikaz = "";
        $baza->spojiDB();
        
        $sql = "SELECT * FROM korisnici WHERE status_racuna='1';";
        $r = $baza->selectDB($sql);
        while($zapis = mysqli_fetch_assoc($r)){
            $prikaz .= "<option value='".$zapis["kor_ime"]."'>";
        }
        $baza->zatvoriDB();
        return $prikaz;
    }
?>