<?php
    require_once '../vanjske_biblioteke/smarty/libs/Smarty.class.php';
    require_once '../skripte/baza.class.php';
    session_start();

    $smarty = new Smarty();
    $baza = new Baza();
    
    $poruka = "";
    $korisnik = "";
    $prikaz = 'style="display: none;"';
    $putanja = "reset_pass.php";
    
    if(isset($_GET["reset"])){
        PronadiKorisnika();
        if($korisnik == null){
            $poruka = "Korisnik s korisničkim imenom ".$_GET["korisnicko_ime"]." ne postoji!";
        }
        else{
            $poruka = "Na email korisnika ".$_GET["korisnicko_ime"]." poslana je poveznica za oporavak lozinke!";
            PosaljiMail();
        }
    }
    
    if(isset($_GET["id"]) && isset($_GET["aktivacijski_kod"])){
        $poruka = "";
        $prikaz = "";
        $putanja = "./reset_pass.php?promijeni&id=".$_GET["id"]."&aktivacijski_kod=".$_GET["aktivacijski_kod"];
    }
    
    if(isset($_GET["promijeni"])){
        PromijeniLozinku();
        $poruka = "Lozinka uspješno promijenjena!";
    }
    
    $smarty->assign("putanja", $putanja);
    $smarty->assign("prikaz", $prikaz);
    $smarty->assign("poruka", $poruka);
    $smarty->display("reset_pass.tpl");
    
    function PosaljiMail(){
        global $korisnik;
        
        $poveznica = "https://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"]."?id=".$korisnik["id"]."&aktivacijski_kod=".$korisnik["aktivacijski_kod"];
        
        $header = "From: dcapek@foi.hr \r\n";
        mail($korisnik["email"],"Oporavak lozinke",
                "Kliknite na poveznicu ispod kako bi kreirali novu lozinku."
                . "\r\n".$poveznica,$header);
    }
    
    function PronadiKorisnika(){
        global $baza;
        global $korisnik;

        $baza->spojiDB();
        
        $sql = "SELECT * FROM korisnici WHERE kor_ime='".$_GET["korisnicko_ime"]."';";
        
        $r = $baza->selectDB($sql);
        $korisnik = mysqli_fetch_assoc($r);
        
        $baza->zatvoriDB();
    }
    
    function PromijeniLozinku(){
        global $baza;
        
        if($_POST["lozinka"] !== $_POST["ponovljena_lozinka"]){
            $poruka = "Lozinke nisu iste!";
        }else{
            $baza->spojiDB();
            
            $sql = "SELECT * FROM korisnici WHERE id='".$_GET["id"]."' AND aktivacijski_kod='".$_GET["aktivacijski_kod"]."';";
        
            $r = $baza->selectDB($sql);
            $korisnik = mysqli_fetch_assoc($r);
            
            $sol = md5($korisnik["kor_ime"].",".date("Y-m-d H:i:s", strtotime($korisnik["datum_kreiranja"])).":");
            $lozinka_hash = hash("sha256", $sol.$_POST["lozinka"]);
            
            $sql = "UPDATE korisnici SET lozinka='".$_POST["lozinka"]."', lozinka_hash='".$lozinka_hash."' WHERE id='".$_GET["id"]."' AND aktivacijski_kod='".$_GET["aktivacijski_kod"]."';";
            
            $baza->executeDB($sql);
            $baza->zatvoriDB();
        }
        
        $baza->spojiDB();
    }
?>