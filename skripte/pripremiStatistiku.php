<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    session_start();

    $baza = new Baza(); 

    $baza->spojiDB();

    $sql = "SELECT * FROM vijest WHERE autor='".$_SESSION["korisnik_id"]."' ORDER BY broj_pregleda ".$_POST["redoslijed"].";";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    while($vijest = mysqli_fetch_assoc($r)){
        $zapis["naslov"] = $vijest["naslov"];
        $zapis["pregledi"] = $vijest["broj_pregleda"];
        $json[] = $zapis;
    }
    $baza->zatvoriDB();
    echo json_encode($json);
?>
