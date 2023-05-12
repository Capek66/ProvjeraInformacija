<?php
    require_once '../vanjske_biblioteke/smarty/libs/Smarty.class.php';
    require_once '../skripte/baza.class.php';
    require_once './dnevnik.php';
    require_once './dohvatiVrijeme.php';
    $virtVrijeme = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")."+".$virtualniSati." hours"));
    session_start();

    $smarty = new Smarty();
    $baza = new Baza();
    
    if(isset($_SESSION["korisnik_id"])){
        if($_SESSION["tip_korisnika"] == '3'){
            $nav = '<a href="../mojeVijesti.php"><li>Moje Vijesti</li></a>';
        }
        if($_SESSION["tip_korisnika"] == '2'){
            $nav = '<a href="../mojeVijesti.php"><li>Moje Vijesti</li></a>'
                    .'<a href="../mojeKategorije.php"><li>Moje Kategorije</li></a>';
        }
        if($_SESSION["tip_korisnika"] == '1'){
            $nav = '<a href="../mojeVijesti.php"><li>Moje Vijesti</li></a>'
                    .'<a href="../mojeKategorije.php"><li>Moje Kategorije</li></a>'
                    .'<a href="../upravljanjeKategorijama.php"><li>Upravljanje kategorijama</li></a>'
                    .'<a href="../upravljanjeRecenzijama.php"><li>Upravljanje recenzijama</li></a>'
                    .'<a href="../pregledDnevnika.php"><li>Dnevnik</li></a>';
        }
        $smarty->assign("nav", $nav);
    }else{
        $nav = "";
        $smarty->assign("nav", $nav);
    }
    
    $putanja = "./registracija.php?uspjesno";
    $ime = "";
    $prezime = "";
    $korisnicko_ime = "";
    $email = "";
    $lozinka = "";
    $potvrda_lozinke = "";
    $prikaz = "";
    $poruka = "";
    $naslov = "REGISTRACIJA";
    
    $navigacija = "";
    $navigacija_putanja = "";
    if(isset($_SESSION["korisnik_id"])){
        UnesiZapis('4', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
        $navigacija = "<li id='odjavaZapamti'>Odjavi se</li>";
        $navigacija_putanja = "./prijava.php?logout";
    }
    else{
        $navigacija = "<li>Prijavi se</li>";
        $navigacija_putanja = "./prijava.php";
    }
    $smarty->assign("navigacija", $navigacija);
    $smarty->assign("navigacija_putanja", $navigacija_putanja);
    
    if(isset($_GET["uspjesno"])){
        if($_POST["g-recaptcha-response"] != ""){
            $secretKey = "6LcPszwgAAAAAKNcP1r_4cWbSQUp4n_jSjpVm-E0";
            $provjeriCaptchu = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$_POST["g-recaptcha-response"]);
            $data = json_decode($provjeriCaptchu);
            if($data->success){
                if(ProvjeraPodataka()){
                    RegistrirajKorisnika();
                }
            }else{
                $poruka .= "reCAPTCHA pogrešna!";
            }
        }else{
            $poruka .= "reCAPTCHA nije potvrđena!";
        }
        
    }
    
    if(isset($_GET["aktivacijski_kod"])){
        $naslov = "AKTIVACIJA RAČUNA";
        AktivirajRacun();
    }
    
    $smarty->assign("naslov", $naslov);
    $smarty->assign("poruka", $poruka);
    $smarty->assign("prikaz", $prikaz);
    $smarty->assign("putanja", $putanja);
    $smarty->assign("ime", $ime);
    $smarty->assign("prezime", $prezime);
    $smarty->assign("korisnicko_ime", $korisnicko_ime);
    $smarty->assign("email", $email);
    $smarty->assign("lozinka", $lozinka);
    $smarty->assign("potvrda_lozinke", $potvrda_lozinke);
    $smarty->display("registracija.tpl");
    
    function RegistrirajKorisnika(){
        global $baza;
        global $prikaz;
        global $poruka;
        
        $danas = date("Y-m-d H:i:s");
        $sol = md5($_POST["korisnicko_ime"].",".$danas.":");
        $lozinka_hash = hash("sha256", $sol.$_POST["lozinka"]);
        $aktivacijski_kod = GenerirajKod();
        
        $baza->spojiDB();
        
        $sql = "INSERT INTO korisnici VALUES(DEFAULT, '".$_POST["ime"].
                "', '".$_POST["prezime"].
                "', '".$_POST["korisnicko_ime"].
                "', '".$_POST["lozinka"].
                "', '".$lozinka_hash.
                "', '".$danas.
                "', '".$_POST["email_adresa"].
                "', '3', '".$aktivacijski_kod.
                "', '0', '2');";
        $unesen = $baza->executeDB($sql);
        
        $baza->zatvoriDB();
        PosaljiMail($_POST["email_adresa"], $aktivacijski_kod);
        if(!$unesen) {
            $poruka = "Došlo je do pogreške prilikom unosa podataka u bazu!<br>Pokušajte ponovo!";
        }else{
            $poruka = $_POST["ime"]." ".$_POST["prezime"]." uspješno registriran!<br>Da bi aktivirali račun, otvorite poveznicu koja Vam je poslana na E-Mail adresu! Poveznica vrijedi 7 sati!";
            $prikaz = 'style="display: none;"';
        }
    }
    
    function GenerirajKod(){
        $kod = "";
        do{
            $kod = "";
            for($i=0;$i<6;$i++){
                $kod .= chr(rand(65,90));
            }
        }while(ProvjeriKod($kod));
        return $kod;
    }
    
    function ProvjeriKod($kod){
        global $baza;
        
        $baza->spojiDB();
        
        $sql = "select * from korisnici where aktivacijski_kod='".$kod."';";
        $r = $baza->selectDB($sql);
        $korisnik = mysqli_fetch_assoc($r);
        $baza->zatvoriDB();
        if(is_null($korisnik)){
            return false;
        
        }else{
            return true;
        }
    }
    
    function PosaljiMail($email, $kod){
        $poveznica = "https://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"]."?aktivacijski_kod=".$kod;
        
        $header = "From: dcapek@foi.hr \r\n";
        mail($email,"Aktivacija računa za web aplikaciju Provjera informacija",
                "Uspješno ste se registrirali na web aplikaciju Provjera informacija!"
                . "\r\nKako bi aktivirali svoj račun otvorite poveznicu u nastavku:"
                . "\r\n".$poveznica,$header);
    }
    
    function AktivirajRacun(){
        global $baza;
        global $prikaz;
        global $poruka;
        global $virtVrijeme;
        
        $prikaz = 'style="display: none;"';
        $trenutno_vrijeme = $virtVrijeme;
        
        $baza->spojiDB();
        
        $sql = "select * from korisnici where aktivacijski_kod='".$_GET["aktivacijski_kod"]."';";
        
        $r = $baza->selectDB($sql);
        $korisnik = mysqli_fetch_assoc($r);
        if(!is_null($korisnik)){
            if($korisnik["status_racuna"] === "2"){
                $datum_kreiranja = date("Y-m-d H:i:s", strtotime($korisnik["datum_kreiranja"]));
                $razlika = date_diff(new DateTime($datum_kreiranja), new DateTime($trenutno_vrijeme));
                if($razlika->h < 7){
                    $sql = "update korisnici set status_racuna='1' where id='".$korisnik["id"]."';";
                    $baza->executeDB($sql);
                    $poruka = "Račun s korisničkim imenom ".$korisnik["kor_ime"]." je uspješno aktiviran!";
                }else{
                    $sql = "DELETE FROM korisnici WHERE id='".$korisnik["id"]."';";
                    $baza->executeDB($sql);
                    $poruka = "Vrijeme za aktivaciju računa je isteklo!<br>Registrirajte se ponovo!";
                }
            }else{
                $poruka = "Korisnikov račun je već aktivan ili je blokiran!";
            }
        }else{
            $poruka = "Ne postoji takav račun!";
        }
        $baza->zatvoriDB();
    }
    
    function ProvjeraPodataka(){
        if(($_POST["ime"] != "") && ($_POST["prezime"] != "") && ($_POST["korisnicko_ime"] != "") && ($_POST["email_adresa"] != "") && ($_POST["lozinka"] != "") && ($_POST["potvrda_lozinke"] != "")){
            if($_POST["lozinka"] === $_POST["potvrda_lozinke"]){
                return true;
            }else{
                return false;
            }
        }
        else{
            return false;
        }
    }
?>