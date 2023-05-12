<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    $baza = new Baza();
    session_start();
    
    $baza->spojiDB();
    
    $sql = "SELECT * FROM vijest WHERE id ".$_POST["znak"]." '".$_POST["id"]."' AND autor='".$_SESSION["korisnik_id"]."' ORDER BY id ".$_POST["order"]." LIMIT 1;";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $vijest = mysqli_fetch_assoc($r);
    
    if($vijest == null){
        if($_POST["znak"] === ">"){
            $sql = "SELECT * FROM vijest WHERE autor='".$_SESSION["korisnik_id"]."' ORDER BY id ASC LIMIT 1;";
        }else{
            $sql = "SELECT * FROM vijest WHERE autor='".$_SESSION["korisnik_id"]."' ORDER BY id DESC LIMIT 1;";
        }
        UnesiZapis('3', $sql);
        $r = $baza->selectDB($sql);
        $vijest = mysqli_fetch_assoc($r);
    }
    if($vijest == null) return null;
    
    $sql = "SELECT * FROM korisnici WHERE id = ".$_SESSION["korisnik_id"].";";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $autor = mysqli_fetch_assoc($r);
    
    $sql = "SELECT * FROM status WHERE id = '".$vijest["status_vijesti"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $status = mysqli_fetch_assoc($r);
    
    $sql = "SELECT * FROM recenzija WHERE vijest_id = '".$vijest["id"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $recenzija = mysqli_fetch_assoc($r);
    
    $sql = "SELECT * FROM korisnici WHERE id = ".$recenzija["recenzent"].";";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $recenzent = mysqli_fetch_assoc($r);
    
    $sql = "SELECT * FROM kategorija WHERE id='".$vijest["kategorija_id"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $kategorija = mysqli_fetch_assoc($r);
    
    $vijest_json["id"] = $vijest["id"];
    $vijest_json["autor"] = $autor["kor_ime"];
    $vijest_json["naslov"] = $vijest["naslov"];
    $vijest_json["clanak"] = $vijest["clanak"];
    $vijest_json["izvor"] = $vijest["url_izvora"];
    $vijest_json["datum_vrijeme"] = date("d.m.Y H:i:s", strtotime($vijest["datum_vrijeme"]));
    $vijest_json["slika"] = $vijest["slika"];
    $vijest_json["medij"] = $vijest["video/audio"];
    $vijest_json["status"] = $status["naziv"];
    $vijest_json["recenzent"] = $recenzent["kor_ime"];
    $vijest_json["recenzija"] = $recenzija["recenzija"];
    $vijest_json["broj_pregleda"] = $vijest["broj_pregleda"];
    $vijest_json["kategorija"] = $kategorija["naziv"];
    if($recenzija["cinjenicne_pogreske"] == 1){
        $vijest_json["cinj_pogr"] = "Da";
    }else{
        $vijest_json["cinj_pogr"] = "Ne";
    }
    
    if($recenzija["gramaticke_pogreske"] == 1){
        $vijest_json["gram_pogr"] = "Da";
    }else{
        $vijest_json["gram_pogr"] = "Ne";
    }
    
    if($recenzija["nedostatak_materijala"] == 1){
        $vijest_json["ned_mat"] = "Da";
    }else{
        $vijest_json["ned_mat"] = "Ne";
    }
    
    if($recenzija["nedostatak_izvora"] == 1){
        $vijest_json["ned_izv"] = "Da";
    }else{
        $vijest_json["ned_izv"] = "Ne";
    }
    
    $baza->zatvoriDB();
    
    echo json_encode($vijest_json);
?>