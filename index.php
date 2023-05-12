<?php
    require_once './vanjske_biblioteke/smarty/libs/Smarty.class.php';
    require_once './skripte/baza.class.php';
    require_once './dnevnik.php';

    session_start();
    
    $smarty = new Smarty();
    $baza = new Baza();

    if(isset($_SESSION["korisnik_id"])){
        UnesiZapis('4', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
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
                    .'<a href="./pregledDnevnika.php"><li>Dnevnik</li></a>';
        }
    }else{
        $nav = "";
    }
    
    $uvjeti_koristenja = "";
    if(!isset($_COOKIE["uvjeti_koristenja"])){
        if(isset($_SESSION["korisnik_id"])){
            $provjeriKolacic = provjeriKolacic();
            if(!$provjeriKolacic){
                $uvjeti_koristenja = "<div id='uvjeti' style=''><h4 style='margin: 5px;'>Prihvaćate li uvjete korištenja?</h4><br><p style='margin: 5px;'>Prihvaćanjem dozvoljavate korištenje kolačića!</p><br><button class='gumb' id='prihvacam'>Prihvaćam</button><button class='gumb' id='ne_prihvacam'>Ne prihvaćam</button></div>";
            }else{
                setcookie("uvjeti_koristenja", "prihvaceni", time()+(2*24*3600), '/');
            }
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
    $smarty->assign("nav", $nav);
    $smarty->assign("uvjeti_koristenja", $uvjeti_koristenja);
    $smarty->display("index.tpl");
    
    function provjeriKolacic(){
        global $baza;
        
        $baza->spojiDB();
        
        $sql = "SELECT * FROM korisnik_kolacic WHERE korisnik_id='".$_SESSION["korisnik_id"]."' AND kolacic_id='1';";
        $r = $baza->selectDB($sql);
        $zapis = mysqli_fetch_assoc($r);
        if($zapis == null){
            return false;
        }
        else{
            return true;
        }
        
        $baza->zatvoriDB();
    }
?>