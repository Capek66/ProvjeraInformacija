<?php
    require_once './skripte/baza.class.php';
    require_once './dohvatiVrijeme.php';
    $virtVrijeme = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")."+".$virtualniSati." hours"));

    $baza = new Baza();
    
    function UnesiZapis($tip, $opis){
        global $baza;
        global $virtVrijeme;
        
        $baza->spojiDB();
        if(isset($_SESSION["korisnik_id"])){
            $sql = "INSERT INTO dnevnik_rada VALUES(DEFAULT, ".$_SESSION["korisnik_id"].", '".$virtVrijeme."', ".$tip.", '".$opis."');";
            $baza->executeDB($sql);
        }
        $baza->zatvoriDB();
    }
?>