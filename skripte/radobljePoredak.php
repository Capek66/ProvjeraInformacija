<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    $json[] = null;
    $baza->spojiDB();
    
    if($_POST["od_datum"] == null){
        $od = date("Y-m-d H:i:s", strtotime("1001-01-01 00:00:00"));
    }else{
        $od = date("Y-m-d H:i:s", strtotime($_POST["od_datum"]));
    }
    
    if($_POST["do_datum"] == null){
        $do = date("Y-m-d H:i:s");
    }else{
        $do = date("Y-m-d H:i:s", strtotime($_POST["do_datum"]));
    }
    
    $sql = "SELECT * FROM vijest WHERE status_vijesti='1' AND datum_vrijeme BETWEEN '".$od."' AND '".$do."' ORDER BY broj_pregleda DESC;";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    while($vijest = mysqli_fetch_assoc($r)){
        $sql = "SELECT * FROM korisnici WHERE id = ".$vijest["autor"].";";
        UnesiZapis('3', $sql);
        $a = $baza->selectDB($sql);
        $autor = mysqli_fetch_assoc($a);

        $sql = "SELECT * FROM kategorija WHERE id='".$vijest["kategorija_id"]."';";
        UnesiZapis('3', $sql);
        $k = $baza->selectDB($sql);
        $kategorija = mysqli_fetch_assoc($k);

        $vijest_json["id"] = $vijest["id"];
        $vijest_json["autor"] = $autor["kor_ime"];
        $vijest_json["naslov"] = $vijest["naslov"];
        $vijest_json["clanak"] = $vijest["clanak"];
        $vijest_json["izvor"] = $vijest["url_izvora"];
        $vijest_json["datum_vrijeme"] = date("d.m.Y H:i:s", strtotime($vijest["datum_vrijeme"]));
        $vijest_json["slika"] = $vijest["slika"];
        $vijest_json["medij"] = $vijest["video/audio"];
        $vijest_json["broj_pregleda"] = $vijest["broj_pregleda"];
        $vijest_json["kategorija"] = $kategorija["naziv"];
        if($json[0] == null){
            $json[0] = $vijest_json;
        }else{
            $json[] = $vijest_json;
        }
    }
    $baza->zatvoriDB();
    
    echo json_encode($json);
?>