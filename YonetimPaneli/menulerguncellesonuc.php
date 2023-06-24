<?php
if (isset($_SESSION["Yonetici"])) {

    if (isset($_GET["ID"])) {
        $GelenID        =       Guvenlik($_GET["ID"]);
    }else{
        $GelenID        =       "";
    }

    if (isset($_POST["MenuAdi"])) {

        $GelenMeunAdi   =   Guvenlik($_POST["MenuAdi"]);
    }else{
        $GelenMeunAdi   =   "";
    }



    if (($GelenID!="") and ($GelenMeunAdi!="")) {


        $MenuGuncellemeSorgusu  =   $VeritabaniBaglantisi->prepare("UPDATE menuler SET MenuAdi = ? WHERE id = ? LIMIT 1 ");
        $MenuGuncellemeSorgusu->execute([$GelenMeunAdi,$GelenID]);
        $MenuGuncellemeSayisi   =   $MenuGuncellemeSorgusu->rowCount();


        if ($MenuGuncellemeSayisi>0) {
            header("Location:index.php?SKD=0&SKI=64");
            exit();
        }else{
            header("Location:index.php?SKD=0&SKI=65");
            exit();
        }

    }else{
        header("Location:index.php?SKD=0&SKI=65");
        exit();
    }

}else{
    header("Location:index.php?SKD=1");
    exit();
}

?>
