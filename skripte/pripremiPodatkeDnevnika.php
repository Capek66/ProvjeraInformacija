<?php
    require_once './baza.class.php';
    
    $baza = new Baza();
    $json[] = null;
    $baza->spojiDB();
    
    if($_POST["korisnik"] == null && $_POST["tip"] == null && $_POST["zapisi_od"] == null && $_POST["zapisi_do"] == null)
    {
        $sql = "SELECT * FROM dnevnik_rada ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] != null && $_POST["tip"] == null && $_POST["zapisi_od"] == null && $_POST["zapisi_do"] == null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE korisnici_id='".$_POST["korisnik"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] == null && $_POST["tip"] != null && $_POST["zapisi_od"] == null && $_POST["zapisi_do"] == null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE tip_id='".$_POST["tip"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] != null && $_POST["tip"] != null && $_POST["zapisi_od"] == null && $_POST["zapisi_do"] == null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE korisnici_id='".$_POST["korisnik"]."' AND tip_id='".$_POST["tip"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] == null && $_POST["tip"] == null && $_POST["zapisi_od"] != null && $_POST["zapisi_do"] == null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE datum_vrijeme BETWEEN '".$_POST["zapisi_od"]."' AND '".date("Y-m-d H:i:s")."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] != null && $_POST["tip"] == null && $_POST["zapisi_od"] != null && $_POST["zapisi_do"] == null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE korisnici_id='".$_POST["korisnik"]."' AND datum_vrijeme BETWEEN '".$_POST["zapisi_od"]."' AND '".date("Y-m-d H:i:s")."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] == null && $_POST["tip"] != null && $_POST["zapisi_od"] != null && $_POST["zapisi_do"] == null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE tip_id='".$_POST["tip"]."' AND datum_vrijeme BETWEEN '".$_POST["zapisi_od"]."' AND '".date("Y-m-d H:i:s")."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] != null && $_POST["tip"] != null && $_POST["zapisi_od"] != null && $_POST["zapisi_do"] == null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE korisnici_id='".$_POST["korisnik"]."' AND tip_id='".$_POST["tip"]."' AND datum_vrijeme BETWEEN '".$_POST["zapisi_od"]."' AND '".date("Y-m-d H:i:s")."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] == null && $_POST["tip"] == null && $_POST["zapisi_od"] == null && $_POST["zapisi_do"] != null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE datum_vrijeme BETWEEN '".date("Y-m-d H:i:s", strtotime("1001-01-01 00:00:00"))."' AND '".$_POST["zapisi_do"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] != null && $_POST["tip"] == null && $_POST["zapisi_od"] == null && $_POST["zapisi_do"] != null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE korisnici_id='".$_POST["korisnik"]."' AND datum_vrijeme BETWEEN '".date("Y-m-d H:i:s", strtotime("1001-01-01 00:00:00"))."' AND '".$_POST["zapisi_do"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] == null && $_POST["tip"] != null && $_POST["zapisi_od"] == null && $_POST["zapisi_do"] != null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE tip_id='".$_POST["tip"]."' AND datum_vrijeme BETWEEN '".date("Y-m-d H:i:s", strtotime("1001-01-01 00:00:00"))."' AND '".$_POST["zapisi_do"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] != null && $_POST["tip"] != null && $_POST["zapisi_od"] == null && $_POST["zapisi_do"] != null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE korisnici_id='".$_POST["korisnik"]."' AND tip_id='".$_POST["tip"]."' AND datum_vrijeme BETWEEN '".date("Y-m-d H:i:s", strtotime("1001-01-01 00:00:00"))."' AND '".$_POST["zapisi_do"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] == null && $_POST["tip"] == null && $_POST["zapisi_od"] != null && $_POST["zapisi_do"] != null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE datum_vrijeme BETWEEN '".$_POST["zapisi_od"]."' AND '".$_POST["zapisi_do"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] != null && $_POST["tip"] == null && $_POST["zapisi_od"] != null && $_POST["zapisi_do"] != null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE korisnici_id='".$_POST["korisnik"]."' AND datum_vrijeme BETWEEN '".$_POST["zapisi_od"]."' AND '".$_POST["zapisi_do"]."' ORDER BY datum_vrijeme ASC;";
    }
    else if($_POST["korisnik"] == null && $_POST["tip"] != null && $_POST["zapisi_od"] != null && $_POST["zapisi_do"] != null)
    {
        $sql = "SELECT * FROM dnevnik_rada WHERE tip_id='".$_POST["tip"]."' AND datum_vrijeme BETWEEN '".$_POST["zapisi_od"]."' AND '".$_POST["zapisi_do"]."' ORDER BY datum_vrijeme ASC;";
    }
    else{
        $sql = "SELECT * FROM dnevnik_rada WHERE korisnici_id='".$_POST["korisnik"]."' AND tip_id='".$_POST["tip"]."' AND datum_vrijeme BETWEEN '".$_POST["zapisi_od"]."' AND '".$_POST["zapisi_do"]."' ORDER BY datum_vrijeme ASC;";
    }
    
    $r = $baza->selectDB($sql);
    while($zapis = mysqli_fetch_assoc($r)){
        $sql = "SELECT * FROM korisnici WHERE id='".$zapis["korisnici_id"]."';";
        $a = $baza->selectDB($sql);
        $korisnik = mysqli_fetch_assoc($a);

        $sql = "SELECT * FROM tip_radnje WHERE id='".$zapis["tip_id"]."';";
        $k = $baza->selectDB($sql);
        $tip = mysqli_fetch_assoc($k);

        $zapis_json["korisnik"] = $korisnik["kor_ime"];
        $zapis_json["tip"] = $tip["naziv"];
        $zapis_json["opis"] = $zapis["opis"];
        $zapis_json["datumVrijeme"] = date("Y-m-d H:i:s", strtotime($zapis["datum_vrijeme"]));
        if($json[0] == null){
            $json[0] = $zapis_json;
        }else{
            $json[] = $zapis_json;
        }  
    }
    $baza->zatvoriDB();
    
    echo json_encode($json);
?>