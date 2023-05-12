<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    session_start();
    
    $baza = new Baza();
    $json[] = null;
    $baza->spojiDB();
    $sql = "SELECT v.id, v.naslov, ko.kor_ime, ka.naziv FROM vijest v INNER JOIN korisnici ko ON v.autor = ko.id INNER JOIN kategorija ka ON v.kategorija_id=ka.id WHERE v.status_vijesti='3';";
    UnesiZapis('3', $sql);
    $v = $baza->selectDB($sql);
    while($vijest = mysqli_fetch_assoc($v)){
        $zapis["vijest_id"] = $vijest["id"];
        $zapis["naslov_vijesti"] = $vijest["naslov"];
        $zapis["autor"] = $vijest["kor_ime"];
        $zapis["kategorija"] = $vijest["naziv"];
        if($json[0] == null){
            $json[0] = $zapis;
        }else{
            $json[] = $zapis;
        }
    }
    $baza->zatvoriDB();
    echo json_encode($json);
?>