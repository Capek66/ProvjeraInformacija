<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "SELECT * FROM korisnici WHERE kor_ime='".$_POST["kor_ime"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $korisnik = mysqli_fetch_assoc($r);
    if($korisnik != null){
        if($korisnik["status_racuna"] == '1'){
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