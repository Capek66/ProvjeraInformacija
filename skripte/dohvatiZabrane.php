<?php
    require_once './baza.class.php';
    require_once './dohvatiVrijeme.php';
    require_once './dnevnik.php';
    $virtVrijeme = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")."+".$virtualniSati." hours"));
    session_start();

    $baza = new Baza();
    $json[] = null;
    $baza->spojiDB();
    
    $sql = "SELECT * FROM moderator_kategorije WHERE korisnici_id='".$_SESSION["korisnik_id"]."';";
    UnesiZapis('3', $sql);
    $k = $baza->selectDB($sql);
    while($modKat = mysqli_fetch_assoc($k)){
        $sql = "SELECT bk.korisnici_id, bk.kategorija_id, ko.kor_ime, k.naziv, bk.razlog, bk.blokiran_do FROM blokirani_korisnici bk INNER JOIN kategorija k ON bk.kategorija_id = k.id INNER JOIN korisnici ko ON ko.id=bk.korisnici_id WHERE bk.kategorija_id='".$modKat["kategorija_id"]."';";
        UnesiZapis('3', $sql);
        $r = $baza->selectDB($sql);
        while($zapis = mysqli_fetch_assoc($r)){
            if(date("Y-m-d H:i:s", strtotime($zapis["blokiran_do"])) < $virtVrijeme){
                $sql = "DELETE FROM blokirani_korisnici WHERE korisnici_id='".$zapis["korisnici_id"]."' AND kategorija_id='".$zapis["kategorija_id"]."';";
                UnesiZapis('3', $sql);
                $baza->executeDB($sql);
            }else{
                $zabrana["autor_id"] = $zapis["korisnici_id"];
                $zabrana["kategorija_id"] = $zapis["kategorija_id"];
                $zabrana["autor"] = $zapis["kor_ime"];
                $zabrana["kategorija"] = $zapis["naziv"];
                $zabrana["razlog"] = $zapis["razlog"];
                $zabrana["blokiran_do"] = date("d.m.Y. H:i:s", strtotime($zapis["blokiran_do"]));
                if($json[0] == null){
                    $json[0] = $zabrana;
                }else{
                    $json[] = $zabrana;
                }
            }
        }
    }

    $baza->zatvoriDB();
    echo json_encode($json);
?>