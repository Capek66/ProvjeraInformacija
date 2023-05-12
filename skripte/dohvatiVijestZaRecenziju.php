<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    
    $baza->spojiDB();
    
    $sql = "SELECT * FROM vijest WHERE id='".$_POST["id"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $vijest = mysqli_fetch_assoc($r);
    
    $sql = "SELECT * FROM korisnici WHERE id=".$vijest["autor"].";";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $autor = mysqli_fetch_assoc($r);
    
    $vijest_json["id"] = $vijest["id"];
    $vijest_json["autor"] = $autor["kor_ime"];
    $vijest_json["naslov"] = $vijest["naslov"];
    $vijest_json["clanak"] = $vijest["clanak"];
    $vijest_json["izvor"] = $vijest["url_izvora"];
    $vijest_json["datum_vrijeme"] = date("d.m.Y H:i:s", strtotime($vijest["datum_vrijeme"]));
    $vijest_json["slika"] = $vijest["slika"];
    $vijest_json["medij"] = $vijest["video/audio"];
    
    $baza->zatvoriDB();
    
    echo json_encode($vijest_json);
?>