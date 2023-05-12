<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    session_start();

    $baza = new Baza(); 
    $baza->spojiDB();
    $json[] = null;
    $sql_ko = "SELECT * FROM korisnici;";
    UnesiZapis('3', $sql_ko);
    $ko = $baza->selectDB($sql_ko);
    while($korisnik = mysqli_fetch_assoc($ko)){
        $prihvacene = 0;
        $odbijene = 0;
        $sql_kat = "SELECT * FROM moderator_kategorije WHERE korisnici_id='".$_SESSION["korisnik_id"]."';";
        UnesiZapis('3', $sql_kat);
        $kat = $baza->selectDB($sql_kat);
        while($kategorija = mysqli_fetch_assoc($kat)){
            $sql_vj = "SELECT * FROM vijest WHERE autor='".$korisnik["id"]."' AND kategorija_id='".$kategorija["kategorija_id"]."';";
            UnesiZapis('3', $sql_vj);
            $vj = $baza->selectDB($sql_vj);
            while($vijest = mysqli_fetch_assoc($vj)){
                if($vijest["status_vijesti"] == '1'){
                    $prihvacene++;
                }
                if($vijest["status_vijesti"] == '2'){
                    $odbijene++;
                }
            }
        }
        
        if($prihvacene != 0 || $odbijene != 0){
            $korStat["autor"] = $korisnik["kor_ime"];
            $korStat["prihvacene"] = $prihvacene;
            $korStat["odbijene"] = $odbijene;
            if($json[0] == null){
                $json[0] = $korStat;
            }else{
                $json[] = $korStat;
            }
        }
    }
    $baza->zatvoriDB();
    echo json_encode($json);
?>
