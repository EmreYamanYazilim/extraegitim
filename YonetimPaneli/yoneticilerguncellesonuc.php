<?php
if (isset($_SESSION["Yonetici"])) {
    if (isset($_GET["ID"])) {
        $GelenID                        =       Guvenlik($_GET["ID"]);
    }else{
        $GelenID                        =       "";
    }
    if (isset($_POST["Sifre"])) {
        $GelenSifre                     =       Guvenlik($_POST["Sifre"]);
    }else{
        $GelenSifre                     =       "";
    }
    if (isset($_POST["IsimSoyisim"])) {
        $GelenIsimSoyisim               =       Guvenlik($_POST["IsimSoyisim"]);
    }else{
        $GelenIsimSoyisim               =       "";
    }
    if (isset($_POST["EmailAdresi"])) {
        $GelenEmailAdresi               =       Guvenlik($_POST["EmailAdresi"]);
    }else{
        $GelenEmailAdresi               =       "";
    }
    if (isset($_POST["TelefonNumarasi"])) {
        $GelenTelefonNumarasi           =       Guvenlik($_POST["TelefonNumarasi"]);
    }else{
        $GelenTelefonNumarasi           =       "";
    }


    if (($GelenID!="") and ($GelenIsimSoyisim!="") and ($GelenEmailAdresi!="") and ($GelenTelefonNumarasi!="")) {

        $YoneticininMevcutSifreSorgusu  =       $VeritabaniBaglantisi->prepare("SELECT * FROM yoneticiler WHERE id = ? LIMIT 1");
        $YoneticininMevcutSifreSorgusu->execute([$GelenID]);
        $YoneticininMevcutSifreSayisi   =       $YoneticininMevcutSifreSorgusu->rowCount();
        $YoneticininMevcutSifrekontrolu =       $YoneticininMevcutSifreSorgusu->fetch(PDO::FETCH_ASSOC);

        if ($YoneticininMevcutSifreSayisi > 0) {
            $YoneticininMevcutSifresi   =       $YoneticininMevcutSifrekontrolu["Sifre"];
            // herhangi bir şifre yazılmıyorsa kaydedilicek şifre
            if ($GelenSifre == "") {
                $YoneticiIcinKaydedilecekSifre   =   $YoneticininMevcutSifresi;
            }else{
                $YoneticiIcinKaydedilecekSifre   = md5($GelenSifre);
            }

            $YoneticiGuncellemeSorgusu      =       $VeritabaniBaglantisi->prepare("UPDATE yoneticiler SET IsimSoyisim = ?, Sifre = ?, EmailAdresi = ?, TelefonNumarasi = ? WHERE id = ? LIMIT 1");
            $YoneticiGuncellemeSorgusu->execute([$GelenIsimSoyisim, $YoneticiIcinKaydedilecekSifre, $GelenEmailAdresi, $GelenTelefonNumarasi, $GelenID]);
            $YoneticiGuncellemeSayisi       =       $YoneticiGuncellemeSorgusu->rowCount();

            if ($YoneticiGuncellemeSayisi > 0) {
                header("Location:index.php?SKD=0&SKI=77");
                exit();

            }else{
                header("Location:index.php?SKD=0&SKI=78");
                exit();
            }

        }else{
            header("Location:index.php?SKD=0&SKI=78");
            exit();
        }
    }else{
        header("Location:index.php?SKD=0&SKI=78");
        exit();
    }

}else{
    header("Location:index.php?SKD=1");
    exit();
}








?>