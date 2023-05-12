<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    session_start();

    $baza = new Baza();
    
    $baza->spojiDB();
    
    $slika = $_FILES["slika"]["tmp_name"];
    if($slika != ""){
        $slika_ime = $_FILES["slika"]["name"];
        //$putanjaSlika = "/WebDiP_Projekt/datoteke/".$_FILES["slika"]["name"];
        $putanjaSlika = "https://".$_SERVER["SERVER_NAME"]."/WebDiP/2021_projekti/WebDiP2021x017/datoteke/".$_FILES["slika"]["name"];
        $lokacija = '../datoteke/'.$slika_ime;
        move_uploaded_file($slika, $lokacija);
        
        $sql = "SELECT * FROM vijest WHERE id='".$_GET["id"]."';";
        UnesiZapis('3', $sql);
        $r = $baza->selectDB($sql);
        $vijest = mysqli_fetch_assoc($r);
        $staraSlika = array_pop(explode('/', $vijest["slika"]));
        unlink("../datoteke/".$staraSlika);
        
        $sql = "UPDATE vijest SET slika='".$putanjaSlika."' WHERE id='".$_GET["id"]."';";
        UnesiZapis('3', $sql);
        $baza->executeDB($sql);
    }
    
    $medij = $_FILES["medij"]["tmp_name"];
    if($medij != ""){
        $medij_ime = $_FILES["medij"]["name"];
        //$putanjaMedij = "/WebDiP_Projekt/datoteke/".$_FILES["medij"]["name"];
        $putanjaMedij = "https://".$_SERVER["SERVER_NAME"]."/WebDiP/2021_projekti/WebDiP2021x017/datoteke/".$_FILES["medij"]["name"];
        $lokacija = '../datoteke/'.$medij_ime;
        move_uploaded_file($medij, $lokacija);
        
        $sql = "SELECT * FROM vijest WHERE id='".$_GET["id"]."';";
        UnesiZapis('3', $sql);
        $r = $baza->selectDB($sql);
        $vijest = mysqli_fetch_assoc($r);
        $stariMedij = array_pop(explode('/', $vijest["video/audio"]));
        unlink("../datoteke/".$stariMedij);
        
        $sql = "UPDATE vijest SET video/audio='".$putanjaMedij."' WHERE id='".$_GET["id"]."';";
        UnesiZapis('3', $sql);
        $baza->executeDB($sql);
    }

    $izvor = "";
    if($_POST["izvor"] == ""){
        $izvor = null;
    }else{
        $izvor = $_POST["izvor"];
    }
    
    $sql = "UPDATE vijest SET kategorija_id='".$_POST["kategorija"]."', naslov='".$_POST["naslov"]."', clanak='".$_POST["clanak"]."', url_izvora='".$izvor."', verzija=verzija+1, status_vijesti='3' WHERE id='".$_GET["id"]."';";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);
    
    $sql = "UPDATE recenzija SET status_id='3' WHERE vijest_id='".$_GET["id"]."';";
    UnesiZapis('3', $sql);
    $baza->executeDB($sql);
    
    $baza->zatvoriDB();
    header("Location: ../mojeVijesti.php");
?>