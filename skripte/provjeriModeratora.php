<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "SELECT * FROM korisnici WHERE kor_ime='".$_POST["kor_ime"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $korisnik = mysqli_fetch_assoc($r);
    if($korisnik != null){
        $sql = "SELECT * FROM moderator_kategorije WHERE korisnici_id='".$korisnik["id"]."' AND kategorija_id='".$_POST["kategorija"]."';";
        UnesiZapis('3', $sql);
        $z = $baza->selectDB($sql);
        $zapis = mysqli_fetch_assoc($z);
        if($zapis != null){
            $json["postoji"] = "da";
        }else{
            $json["postoji"] = "ne";
        }
    }else{
        $json["postoji"] = "ne";
    }


    $baza->zatvoriDB();
    echo json_encode($json);
?>