<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    session_start();
    
    $baza = new Baza();
    $json[] = null;
    $baza->spojiDB();
    $sql = "SELECT * FROM moderator_kategorije mk INNER JOIN kategorija k ON mk.kategorija_id = k.id WHERE mk.korisnici_id='".$_SESSION["korisnik_id"]."';";
    UnesiZapis('3', $sql);
    $k = $baza->selectDB($sql);
    while($kategorija = mysqli_fetch_assoc($k)){
        $sql = "SELECT v.id as vijest_id, k.id as korisnik_id, v.naslov, k.kor_ime FROM vijest v INNER JOIN korisnici k ON v.autor = k.id WHERE v.kategorija_id='".$kategorija["kategorija_id"]."' AND status_vijesti='2';";
        UnesiZapis('3', $sql);
        $v = $baza->selectDB($sql);
        while($vijest = mysqli_fetch_assoc($v)){
            $zapis["kategorija_id"] = $kategorija["id"];
            $zapis["autor_id"] = $vijest["korisnik_id"];
            $zapis["naslov_vijesti"] = $vijest["naslov"];
            $zapis["autor"] = $vijest["kor_ime"];
            $zapis["kategorija"] = $kategorija["naziv"];
            if($json[0] == null){
                $json[0] = $zapis;
            }else{
                $json[] = $zapis;
            }
        }
    }
    $baza->zatvoriDB();
    echo json_encode($json);
?>