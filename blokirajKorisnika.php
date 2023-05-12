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
        if(($_SESSION["tip_korisnika"] != '2') && ($_SESSION["tip_korisnika"] != '1')){
            header("Location: ./obrasci/prijava.php?logout");
        }
        if($_SESSION["tip_korisnika"] == '2'){
            $nav = '<a href="./mojeVijesti.php"><li>Moje Vijesti</li></a>'
                    .'<a href="./mojeKategorije.php"><li class="aktivan">Moje Kategorije</li></a>';
        }
        if($_SESSION["tip_korisnika"] == '1'){
            $nav = '<a href="./mojeVijesti.php"><li>Moje Vijesti</li></a>'
                    .'<a href="./mojeKategorije.php"><li class="aktivan">Moje Kategorije</li></a>'
                    .'<a href="./upravljanjeKategorijama.php"><li>Upravljanje kategorijama</li></a>'
                    .'<a href="./upravljanjeRecenzijama.php"><li>Upravljanje recenzijama</li></a>'
                    .'<a href="./virtualnoVrijeme.php"><li>Promjena vremena</li></a>'
                    .'<a href="./pregledDnevnika.php"><li>Dnevnik</li></a>';
        }
        $smarty->assign("nav", $nav);
    }
    
    $kategorija_id = $_GET["kategorija"];
    $autor_id = $_GET["autor"];
    $poruka = "";
    $zapis = "";
    $razlog = "";
    $dodatuma = "";
    $putanja = "./skripte/unesiBlock.php";
    $gumbTekst = "Blokiraj";
    $deblokiraj = "style='display:none;'";
    $deblokirajLink = "";
    $natrag = "./odbijeneVijesti.php";
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
    
    if(isset($_GET["zabrane"])){
        $natrag = "./zabrane.php";
    }
    
    $blokiran = provjeriKorisnikaKategoriju();
    if($blokiran == true){
        $poruka = "Korisnik je već blokiran do ".date("d.m.Y. H:i:s", strtotime($zapis["blokiran_do"]))."!";
        $razlog = $zapis["razlog"];
        $dodatuma = $zapis["blokiran_do"];
        if(isset($_GET["zabrane"])){
            UnesiZapis('4', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?zabrane");
            $putanja = "./skripte/azurirajBlock.php?zabrane";
        }else{
            UnesiZapis('4', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
            $putanja = "./skripte/azurirajBlock.php";
        }
        $gumbTekst = "Ažuriraj";
        $deblokiraj = "";
        if(isset($_GET["zabrane"])){
            $deblokirajLink = "./blokirajKorisnika.php?zabrane&deblokiraj&kategorija=".$_GET["kategorija"]."&autor=".$_GET["autor"];
        }else{
            $deblokirajLink = "./blokirajKorisnika.php?deblokiraj&kategorija=".$_GET["kategorija"]."&autor=".$_GET["autor"];
        }
        
        if(isset($_GET["deblokiraj"])){
            deblokirajAutora();
        }
    }
    
    $smarty->assign("navigacija", $navigacija);
    $smarty->assign("navigacija_putanja", $navigacija_putanja);
    $smarty->assign("kategorija_id", $kategorija_id);
    $smarty->assign("autor_id", $autor_id);
    $smarty->assign("poruka", $poruka);
    $smarty->assign("razlog", $razlog);
    $smarty->assign("dodatuma", $dodatuma);
    $smarty->assign("putanja", $putanja);
    $smarty->assign("gumbTekst", $gumbTekst);
    $smarty->assign("deblokiraj", $deblokiraj);
    $smarty->assign("deblokirajLink", $deblokirajLink);
    $smarty->assign("natrag", $natrag);
    
    $smarty->display("blokirajKorisnika.tpl");
    
    function provjeriKorisnikaKategoriju(){
        global $baza;
        global $kategorija_id;
        global $autor_id;
        global $zapis;
        
        $baza->spojiDB();
        
        $sql = "SELECT * FROM blokirani_korisnici WHERE korisnici_id='".$autor_id."' AND kategorija_id='".$kategorija_id."';";
        $r = $baza->selectDB($sql);
        $zapis = mysqli_fetch_assoc($r);
        
        $baza->zatvoriDB();
        
        if($zapis == null){
            return false;
        }else{
            return true;
        }
    }
    
    function deblokirajAutora(){
        global $baza;
        global $kategorija_id;
        global $autor_id;
        
        $baza->spojiDB();
        
        $sql = "DELETE FROM blokirani_korisnici WHERE korisnici_id='".$autor_id."' AND kategorija_id='".$kategorija_id."';";
        $baza->executeDB($sql);
        
        $baza->zatvoriDB();
        if(isset($_GET["zabrane"])){
            header("Location: ./zabrane.php");
        }else{
            header("Location: ./odbijeneVijesti.php");
        } 
    }
?>