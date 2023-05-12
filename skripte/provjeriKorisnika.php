<?php
    require_once './baza.class.php';
    require_once './dohvatiVrijeme.php';
    require_once './dnevnik.php';
    $virtVrijeme = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")."+".$virtualniSati." hours"));
    session_start();

    $baza = new Baza();

    $baza->spojiDB();
    
    $sql = "SELECT * FROM blokirani_korisnici WHERE korisnici_id='".$_SESSION["korisnik_id"]."' AND kategorija_id='".$_POST["id"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $block = mysqli_fetch_assoc($r);
    if($block == null){
        $json["id"] = 0;
    }else{
        if(date("Y-m-d H:i:s", strtotime($block["blokiran_do"])) < $virtVrijeme){
            $sql = "DELETE FROM blokirani_korisnici WHERE korisnici_id='".$block["korisnici_id"]."' AND kategorija_id='".$block["kategorija_id"]."';";
            UnesiZapis('3', $sql);
            $baza->executeDB($sql);
            $json["id"] = 0;
        }else{
            $json["id"] = $block["kategorija_id"];
        }
    }
    $baza->zatvoriDB();
    echo json_encode($json);
?>