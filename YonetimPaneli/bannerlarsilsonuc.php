<?php
if (isset($_SESSION["Yonetici"])) {
    if (isset($_GET["ID"])) {
        $GelenID    =   Guvenlik($_GET["ID"]);
    }else{
        $GelenID    =   "";
    }

    if ($GelenID!=""){

        $BannerSorgusu          =   $VeritabaniBaglantisi->prepare("SELECT * FROM bannerlar WHERE id = ?");
        $BannerSorgusu->execute([$GelenID]);
        $BannerSayisi           =    $BannerSorgusu->rowCount();
        $BannerKaydi            =    $BannerSorgusu->fetch(PDO::FETCH_ASSOC);

        $SilinecekDosyaYolu     =   "../Resimler/".$BannerKaydi["BannerResmi"];
        unlink($SilinecekDosyaYolu);

        $BannerSilmeSorgusu     =   $VeritabaniBaglantisi->prepare("DELETE  FROM bannerlar WHERE id = ? LIMIT 1");
        $BannerSilmeSorgusu->execute([$GelenID]);
        $BannerSilmeSayisi      =   $BannerSilmeSorgusu->rowCount();

        if ($BannerSilmeSayisi > 0) {
            header("Location:index.php?SKD=0&SKI=43");
            exit();
        }else{
            header("Location:index.php?SKD=0&SKI=44");
            exit();
        }

    }else{
        header("Location:index.php?SKD=1&SKI=44");
        exit();
    }










}else{
    header("Location:index.php?SKD=1");
    exit();
}






?>