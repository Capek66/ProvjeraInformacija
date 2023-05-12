<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    session_start();

    $baza = new Baza();
    
    $baza->spojiDB();
    
    $slika = $_FILES["slika"]["tmp_name"];
    $slika_ime = $_FILES["slika"]["name"];
    //$putanjaSlika = "/WebDiP_Projekt/datoteke/".$_FILES["slika"]["name"];
    $putanjaSlika = "https://".$_SERVER["SERVER_NAME"]."/WebDiP/2021_projekti/WebDiP2021x017/datoteke/".$_FILES["slika"]["name"];
    $lokacija = '../datoteke/'.$slika_ime;
    move_uploaded_file($slika, $lokacija);
    
    $medij = $_FILES["medij"]["tmp_name"];
    if($medij == ""){
        $putanjaMedij = null;
    }else{
        $medij_ime = $_FILES["medij"]["name"];
        //$putanjaMedij = "/WebDiP_Projekt/datoteke/".$_FILES["medij"]["name"];
        $putanjaMedij = "https://".$_SERVER["SERVER_NAME"]."/WebDiP/2021_projekti/WebDiP2021x017/datoteke/".$_FILES["medij"]["name"];
        $lokacija = '../datoteke/'.$medij_ime;
        move_uploaded_file($medij, $lokacija);
    }
    $izvor = "";
    if($_POST["izvor"] == ""){
        $izvor = null;
    }else{
        $izvor = $_POST["izvor"];
    }
    
    $datum  = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO vijest VALUES (DEFAULT, '".$_SESSION["korisnik_id"]."', '".$_POST["kategorija"]."', '".$_POST["naslov"]."', '".$_POST["clanak"]."', '".$izvor."', '".$datum."', '".$putanjaSlika."', '".$putanjaMedij."', '1', '0', '3')";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);
    
    $sql = "SELECT * FROM vijest WHERE autor='".$_SESSION["korisnik_id"]."' AND naslov='".$_POST["naslov"]."' AND datum_vrijeme='".$datum."';";
    UnesiZapis('3', $sql);
    $r = $baza->selectDB($sql);
    $vijest = mysqli_fetch_assoc($r);
    
    $sql = "INSERT INTO recenzija VALUES(DEFAULT, '3', '".$vijest["id"]."', '18', 'Recenzija još nije obavljena!', null, null, null, null);";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);
    
    $baza->zatvoriDB();
    header("Location: ../mojeVijesti.php");
?>