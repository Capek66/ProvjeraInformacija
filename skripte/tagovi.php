<?php
    require_once './baza.class.php';
    require_once './dnevnik.php';
    
    session_start();
    
    $baza = new Baza();
    $baza->spojiDB();
    $tagovi = "";
    
    if(isset($_GET["dohvati"])){
        $sql = "SELECT * FROM tagovi WHERE vijest_id='".$_POST["id"]."';";
        UnesiZapis('3', $sql);
        $r = $baza->selectDB($sql);
        while($tag = mysqli_fetch_assoc($r)){
            $tagovi .= $tag["tag"].";";
        }
        echo json_encode($tagovi);
    }
    
    if(isset($_GET["unesi"])){
        $tagovi = explode(";", $_POST["tagovi"]);
        for($i=0; $i<count($tagovi);$i++){
            $sql = "SELECT * FROM tagovi WHERE vijest_id='".$_POST["id"]."' AND tag='".$tagovi[$i]."';";
            UnesiZapis('3', $sql);
            $r = $baza->selectDB($sql);
            $tag = mysqli_fetch_assoc($r);
            if($tag == null){
                $sql = "INSERT INTO tagovi VALUES('".$_POST["id"]."', '".$tagovi[$i]."');";
                UnesiZapis('3', $sql);
                $baza->executeDB($sql);
            }
        }
    }

    $baza->zatvoriDB();
?>