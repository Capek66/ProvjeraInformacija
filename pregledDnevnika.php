<?php
    require_once './vanjske_biblioteke/smarty/libs/Smarty.class.php';
    require_once './skripte/baza.class.php';
    require_once './dnevnik.php';

    session_start();
    
    UnesiZapis('4', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
    
    $smarty = new Smarty();
    $baza = new Baza();

    if(isset($_SESSION["korisnik_id"])){
        if($_SESSION["tip_korisnika"] == '3'){
            $nav = '<a href="./mojeVijesti.php"><li>Moje Vijesti</li></a>';
        }
        if($_SESSION["tip_korisnika"] == '2'){
            $nav = '<a href="./mojeVijesti.php"><li>Moje Vijesti</li></a>'
                    .'<a href="./mojeKategorije.php"><li>Moje Kategorije</li></a>';
        }
        if($_SESSION["tip_korisnika"] == '1'){
            $nav = '<a href="./mojeVijesti.php"><li>Moje Vijesti</li></a>'
                    .'<a href="./mojeKategorije.php"><li>Moje Kategorije</li></a>'
                    .'<a href="./upravljanjeKategorijama.php"><li>Upravljanje kategorijama</li></a>'
                    .'<a href="./upravljanjeRecenzijama.php"><li>Upravljanje recenzijama</li></a>'
                    .'<a href="./virtualnoVrijeme.php"><li>Promjena vremena</li></a>'
                    .'<a href="./pregledDnevnika.php"><li class="aktivan">Dnevnik</li></a>';
        }
        $smarty->assign("nav", $nav);
    }
    
    $tipFilter = dohvatiTipove();
    $korisniciFilter = dohvatiKorisnike();
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
    $smarty->assign("tipFilter", $tipFilter);
    $smarty->assign("korisniciFilter", $korisniciFilter);
    
    $smarty->display("pregledDnevnika.tpl");
    
    function dohvatiTipove(){
        global $baza;
        
        
        $baza->spojiDB();
        $prikaz = "";
        $sql = "SELECT * FROM tip_radnje ORDER BY id ASC;";
        $r = $baza->selectDB($sql);
        while($tip = mysqli_fetch_assoc($r)){
            $prikaz .= "<option value='".$tip["id"]."'>".$tip["naziv"]."</option>";
        }
        $baza->zatvoriDB();
        return $prikaz; 
    }
    
    function dohvatiKorisnike(){
        global $baza;
        
        
        $baza->spojiDB();
        $prikaz = "";
        $sql = "SELECT * FROM korisnici ORDER BY id ASC;";
        $r = $baza->selectDB($sql);
        while($korisnik = mysqli_fetch_assoc($r)){
            $prikaz .= "<option value='".$korisnik["id"]."'>".$korisnik["kor_ime"]."</option>";
        }
        $baza->zatvoriDB();
        return $prikaz;
    }
?>