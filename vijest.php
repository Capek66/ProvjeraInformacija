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
        if($_SESSION["tip_korisnika"] == '3'){
            $nav = '<a href="./mojeVijesti.php"><li class="aktivan">Moje Vijesti</li></a>';
        }
        if($_SESSION["tip_korisnika"] == '2'){
            $nav = '<a href="./mojeVijesti.php"><li class="aktivan">Moje Vijesti</li></a>'
                    .'<a href="./mojeKategorije.php"><li>Moje Kategorije</li></a>';
        }
        if($_SESSION["tip_korisnika"] == '1'){
            $nav = '<a href="./mojeVijesti.php"><li class="aktivan">Moje Vijesti</li></a>'
                    .'<a href="./mojeKategorije.php"><li>Moje Kategorije</li></a>'
                    .'<a href="./upravljanjeKategorijama.php"><li>Upravljanje kategorijama</li></a>'
                    .'<a href="./upravljanjeRecenzijama.php"><li>Upravljanje recenzijama</li></a>'
                    .'<a href="./virtualnoVrijeme.php"><li>Promjena vremena</li></a>'
                    .'<a href="./pregledDnevnika.php"><li>Dnevnik</li></a>';
        }
        $smarty->assign("nav", $nav);
    }
    
    $kategorije = "";
    $greska = "";
    $putanja = "skripte/dodajVijest.php";
    $autor = $_SESSION["korisnicko_ime"];
    $izvor = "";
    $clanak = "";
    $naslov = "";
    $naslovStranice = "Nova vijest";
    $gumbTekst = "Dodaj vijest";
    $gumbID = "dodaj";
    
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
    
    if(isset($_GET["id"])){
        $putanja = "skripte/azurirajVijest.php?id=".$_GET["id"];
        $naslovStranice = "Ažuriranje vijesti";
        $gumbTekst = "Ažuriraj vijest";
        $gumbID = "azurirajVijest";
        $vijest = dohvatiVijest();
        $naslov = $vijest["naslov"];
        $clanak = $vijest["clanak"];
        $izvor = $vijest["url_izvora"];
    }
    
    $smarty->assign("navigacija", $navigacija);
    $smarty->assign("navigacija_putanja", $navigacija_putanja);
    $smarty->assign("kategorije", $kategorije);
    $smarty->assign("greska", $greska);
    $smarty->assign("putanja", $putanja);
    $smarty->assign("autor", $autor);
    $smarty->assign("naslov", $naslov);
    $smarty->assign("clanak", $clanak);
    $smarty->assign("izvor", $izvor);
    $smarty->assign("naslovStranice", $naslovStranice);
    $smarty->assign("gumbTekst", $gumbTekst);
    $smarty->assign("gumbID", $gumbID);
    
    $smarty->display("vijest.tpl");
    
    function dohvatiVijest(){
        global $baza;
        
        $baza->spojiDB();
        
        $sql = "SELECT * FROM vijest WHERE id='".$_GET["id"]."';";
        $r = $baza->selectDB($sql);
        $vijest = mysqli_fetch_assoc($r);
        
        $baza->zatvoriDB();
        return $vijest;
    }
?>