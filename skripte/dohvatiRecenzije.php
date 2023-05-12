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
        $sql = "SELECT v.id, v.naslov, k.kor_ime, v.verzija FROM vijest v INNER JOIN korisnici k ON v.autor = k.id WHERE v.kategorija_id='".$kategorija["kategorija_id"]."' AND status_vijesti='3';";
        UnesiZapis('3', $sql);
        $v = $baza->selectDB($sql);
        while($vijest = mysqli_fetch_assoc($v)){
            $sql = "SELECT * FROM recenzija WHERE vijest_id='".$vijest["id"]."';";
            $r = $baza->selectDB($sql);
            $recenzija = mysqli_fetch_assoc($r);
            if($recenzija["recenzent"] == $_SESSION["korisnik_id"]){
                $zapis["vijest_id"] = $vijest["id"];
                $zapis["naslov_vijesti"] = $vijest["naslov"];
                $zapis["autor"] = $vijest["kor_ime"];
                $zapis["verzija"] = $vijest["verzija"];
                $zapis["kategorija"] = $kategorija["naziv"];
                if($json[0] == null){
                    $json[0] = $zapis;
                }else{
                    $json[] = $zapis;
                }
            }
        }
    }
    $baza->zatvoriDB();
    echo json_encode($json);
?>