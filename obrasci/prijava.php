<?php
    require_once '../vanjske_biblioteke/smarty/libs/Smarty.class.php';
    require_once '../skripte/baza.class.php';
    require_once './dnevnik.php';
    session_start();

    $smarty = new Smarty();
    $baza = new Baza();
    
    $putanja = "./prijava.php";
    $poruka = "";
    $korisnik = "";
    $korisnicko_ime = "";
    $zapamti_da = "";
    $zapamti_ne = "checked";
    
    if(!isset($_SERVER["HTTPS"])){
        $url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];
        header("Location: ".$url);
    }
    
    if(isset($_GET["logout"])){
        if(isset($_SESSION["korisnik_id"])){
            UnesiZapis('2', null);
        }
        session_unset();
        session_destroy();
    }
    
    if(isset($_COOKIE["zapamti_korisnika"])){
        $korisnicko_ime = $_COOKIE["zapamti_korisnika"];
        $zapamti_da = "checked";
        $zapamti_ne = "";
    }
    
    if(isset($_POST["korisnicko_ime"]) && isset($_POST["lozinka"])){
        if(($_POST["korisnicko_ime"] != "") && ($_POST["lozinka"] != "")){
            ProvjeriKorisnika();
            if($korisnik !== null){
                if($korisnik["status_racuna"] === "1"){
                    $_SESSION["korisnik_id"] = $korisnik["id"];
                    $_SESSION["korisnicko_ime"] = $korisnik["kor_ime"];
                    $_SESSION["tip_korisnika"] = $korisnik["tip_korisnika_id"];
                    UnesiZapis('1', null);
                    if(isset($_POST["zapamti"])){
                        if($_POST["zapamti"] === "da"){
                            if(!isset($_COOKIE["zapamti_korisnika"])){
                                setcookie("zapamti_korisnika", $korisnik["kor_ime"], time()+(3600*24*2));
                            }else{
                                if($_COOKIE["zapamti_korisnika"] != $korisnik["kor_ime"]){
                                    setcookie("zapamti_korisnika", $korisnik["kor_ime"], time()+(3600*24*2));
                                }
                            }
                        }else{
                            if(isset($_COOKIE["zapamti_korisnika"])){
                                setcookie("zapamti_korisnika", "", time()-3600);
                            }
                        }
                    }
                    $uvjeti = provjeriUvjete();
                    if($uvjeti == "da"){
                        setcookie("prijavljeni_korisnik", $korisnik["kor_ime"], time()+(3600*24*2), '/');
                    }
                    
                    if(isset($_COOKIE[$korisnik["kor_ime"]])){
                        header("Location: ".$_COOKIE[$korisnik["kor_ime"]]);
                    }else{
                        header("Location: ../index.php");
                    }
                }else{
                    header("Location: prijava.php?blocked");
                }
            }else{
                header("Location: prijava.php?unauthorized");
            }
        }
    }
    
    if(isset($_GET["blocked"])){
        $poruka .= "Račun nije aktiviran ili je blokiran!<br>";
    }
    
    if(isset($_GET["unauthorized"])){
        $poruka .= "Korisničko ime i/ili lozinka nisu ispravni!<br>Pokušatje ponovo.<br>";
    }

    $smarty->assign("korisnicko_ime",$korisnicko_ime);
    $smarty->assign("poruka", $poruka);
    $smarty->assign("putanja", $putanja);
    $smarty->assign("zapamti_ne", $zapamti_ne);
    $smarty->assign("zapamti_da", $zapamti_da);
    
    $smarty->display("prijava.tpl");
    
    function ProvjeriKorisnika(){
        global $baza;
        global $korisnik;

        $baza->spojiDB();
        
        $sql = "SELECT * FROM korisnici WHERE kor_ime='".$_POST["korisnicko_ime"]."';";
        
        $r = $baza->selectDB($sql);
        $temp = mysqli_fetch_assoc($r);
        
        if($temp === null){
            $korisnik = null;
        }else{
            $sol = md5($temp["kor_ime"].",".date("Y-m-d H:i:s", strtotime($temp["datum_kreiranja"])).":");
            $lozinka_hash = hash("sha256", $sol.$_POST["lozinka"]);
            
            $sql = "SELECT * FROM korisnici WHERE kor_ime='".$_POST["korisnicko_ime"]."' AND lozinka_hash='".$lozinka_hash."';";
            $r = $baza->selectDB($sql);
            $korisnik = mysqli_fetch_assoc($r);
            if($korisnik === null){
                $neuspjesne_prijave = $temp["broj_neuspjesnih_pokusaja"] + 1;
                if($neuspjesne_prijave < 3){
                    $sql = "UPDATE korisnici SET broj_neuspjesnih_pokusaja='".$neuspjesne_prijave."' WHERE id='".$temp["id"]."';";
                }else{
                    $sql = "UPDATE korisnici SET broj_neuspjesnih_pokusaja='".$neuspjesne_prijave."', status_racuna='3' WHERE id='".$temp["id"]."';";
                }   
            }else{
                if($korisnik["status_racuna"] === "1"){
                    $sql = "UPDATE korisnici SET broj_neuspjesnih_pokusaja='0' WHERE id='".$korisnik["id"]."';";
                }
            }
            $baza->executeDB($sql);
        }
        
        $baza->zatvoriDB();
    }
    
    function provjeriUvjete(){
        global $baza;
        global $korisnik;

        $baza->spojiDB();
        $uvjeti = "ne";
        $sql = "SELECT kolacic_id FROM korisnik_kolacic WHERE korisnik_id = '".$korisnik["id"]."';";
        $r = $baza->selectDB($sql);

        while($kolacic = mysqli_fetch_assoc($r)){
            if($kolacic["kolacic_id"] == '1'){
                $uvjeti = "da";
            }
        }
        $baza->zatvoriDB();
        
        return $uvjeti;
    }
?>