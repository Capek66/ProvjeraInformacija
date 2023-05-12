<?php

    require_once './baza.class.php';
    
    $baza = new Baza();

    $korisnicko_ime = $_GET["korisnicko_ime"];
    $korisnik = "";
    
    PronadiKorisnika();
    
    if($korisnik != null){
        $korisnik_json["korisnicko_ime"] = $korisnik["kor_ime"];
        echo json_encode($korisnik_json);
    }else{
        $korisnik_json["korisnicko_ime"] = null;
        echo json_encode($korisnik_json);
    }

    function PronadiKorisnika(){
        global $baza;
        global $korisnicko_ime;
        global $korisnik;
        
        $baza->spojiDB();
        
        $sql = "SELECT * FROM korisnici WHERE kor_ime='".$korisnicko_ime."';";
        $r = $baza->selectDB($sql);
        $korisnik = mysqli_fetch_assoc($r);
        
        $baza->zatvoriDB();
    }
?>