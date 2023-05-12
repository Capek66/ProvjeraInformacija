<?php
    require_once './baza.class.php';
    require_once './dohvatiVrijeme.php';
    $virtVrijeme = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")."+".$virtualniSati." hours"));
    
    $bazaDnevnik = new Baza();
    
    function UnesiZapis($tip, $opis){
        global $bazaDnevnik;
        global $virtVrijeme;
        
        $bazaDnevnik->spojiDB();
        if(isset($_SESSION["korisnik_id"])){
            if($tip == '3'){
            $query = explode(" ", $opis);
                $sql = "INSERT INTO dnevnik_rada VALUES(DEFAULT, ".$_SESSION["korisnik_id"].", '".$virtVrijeme."', ".$tip.", '".$query[0]."');";
            }else{
                $sql = "INSERT INTO dnevnik_rada VALUES(DEFAULT, ".$_SESSION["korisnik_id"].", '".$virtVrijeme."', ".$tip.", '".$opis."');";
            }
            $bazaDnevnik->executeDB($sql);
        }
        

        $bazaDnevnik->zatvoriDB();
    }
?>