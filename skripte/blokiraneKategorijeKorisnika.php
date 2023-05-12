<?php
    require_once './baza.class.php';
    require_once './dohvatiVrijeme.php';
    require_once './dnevnik.php';
    $virtVrijeme = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")."+".$virtualniSati." hours"));
    session_start();

    $baza = new Baza();
    $json[] = null;
    $baza->spojiDB();
    
    $sql = "SELECT * FROM blokirani_korisnici bk INNER JOIN kategorija k ON bk.kategorija_id = k.id WHERE bk.korisnici_id='".$_SESSION["korisnik_id"]."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    while($zapis = mysqli_fetch_assoc($r)){
        if(date("Y-m-d H:i:s", strtotime($zapis["blokiran_do"])) < $virtVrijeme){
            $sql = "DELETE FROM blokirani_korisnici WHERE korisnici_id='".$zapis["korisnici_id"]."' AND kategorija_id='".$zapis["kategorija_id"]."';";
            UnesiZapis('3', $sql);
            $baza->executeDB($sql);
        }else{
            $blokKat["naziv"] = $zapis["naziv"];
            $blokKat["razlog"] = $zapis["razlog"];
            $blokKat["blokiran_do"] = date("d.m.Y. H:i:s", strtotime($zapis["blokiran_do"]));
            if($json[0] == null){
                $json[0] = $blokKat;
            }else{
                $json[] = $blokKat;
            }
        }
    }
    $baza->zatvoriDB();
    echo json_encode($json);
?>