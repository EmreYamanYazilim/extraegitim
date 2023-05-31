<?php
if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    }else{
        $GelenID = "";
    }

    if ($GelenID!=""){
        $SepetSilmeSorgusu   =   $VeritabaniBaglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? limit 1");
        $SepetSilmeSorgusu->execute([$GelenID, $KullaniciID]);
        $SepetSilmeSayisi    =  $SepetSilmeSorgusu->rowCount();

        if ($SepetSilmeSayisi>0){
            header("location:index.php?SK=94");
            exit();
        }else {
            header("location:index.php?SK=94");
            exit();
        }

    }else{
        header("location:index.php?SK=94");
        exit();
    }

}else{
    header("location:index.php");
    exit();
}



?>