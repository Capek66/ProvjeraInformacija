<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    $json[] = null;
    $baza->spojiDB();
    
    $sql = "SELECT * FROM kategorija;";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    while($kategorija = mysqli_fetch_assoc($r)){
        $kategorija_json["id"] = $kategorija["id"];
        $kategorija_json["naziv"] = $kategorija["naziv"];
        $kategorija_json["opis"] = $kategorija["opis"];
        if($json[0] == null){
            $json[0] = $kategorija_json;
        }else{
            $json[] = $kategorija_json;
        }
    }
    
    $baza->zatvoriDB();
    
    echo json_encode($json);
?>