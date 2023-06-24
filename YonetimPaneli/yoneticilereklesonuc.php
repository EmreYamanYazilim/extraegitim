<?php
if (isset($_SESSION["Yonetici"])) {

    if (isset($_POST["KullaniciAdi"])) {
        $GelenKullaniciAdi          =       Guvenlik($_POST["KullaniciAdi"]);
    }else{
        $GelenKullaniciAdi          =       "";
    }
    if (isset($_POST["Sifre"])) {
        $GelenSifre                 =       Guvenlik($_POST["Sifre"]);
    }else{
        $GelenSifre                 =       "";
    }
    if (isset($_POST["IsimSoyisim"])) {
        $GelenIsimSoyisim           =       Guvenlik($_POST["IsimSoyisim"]);
    }else{
        $GelenIsimSoyisim           =       "";
    }
    if (isset($_POST["EmailAdresi"])) {
        $GelenEmailAdresi           =       Guvenlik($_POST["EmailAdresi"]);
    }else{
        $GelenEmailAdresi           =       "";
    }
    if (isset($_POST["TelefonNumarasi"])) {
        $GelenTelefonNumarasi       =       Guvenlik($_POST["TelefonNumarasi"]);
    }else{
        $GelenTelefonNumarasi       =       "";
    }


    $Md5liSifre                     =        md5($GelenSifre);

    if (($GelenKullaniciAdi!="") and ($GelenSifre!="") and ($GelenIsimSoyisim!="") and ($GelenEmailAdresi!="") and ($GelenTelefonNumarasi!="")) {
        //aynı kullanıcı var mı yokmu sorgusu kullanıcı adından yada emailden bakarak yapacağım
        $YoneticiKontrolSorgusu     =       $VeritabaniBaglantisi->prepare("SELECT * FROM yoneticiler WHERE KullaniciAdi = ? OR EmailAdresi = ?");
        $YoneticiKontrolSorgusu->execute([$GelenKullaniciAdi,$GelenEmailAdresi]);
        $YoneticiKontrolSayisi      =       $YoneticiKontrolSorgusu->rowCount();



        if ($YoneticiKontrolSayisi > 0) {
            header("Location:index.php?SKD=0&SKI=74");
            exit();

        }else{
            $YoneticiEklemeSorgusu      =       $VeritabaniBaglantisi->prepare("INSERT INTO yoneticiler (KullaniciAdi, Sifre, IsimSoyisim, EmailAdresi, TelefonNumarasi) values (?,?,?,?,?)");
            $YoneticiEklemeSorgusu->execute([$GelenKullaniciAdi, $Md5liSifre, $GelenIsimSoyisim, $GelenEmailAdresi, $GelenTelefonNumarasi]);
            $YoneticiEklemeSayisi       =       $YoneticiEklemeSorgusu->rowCount();

            if ($YoneticiEklemeSayisi > 0) {
                header("Location:index.php?SKD=0&SKI=72");
                exit();
            }else{
                header("Location:index.php?SKD=0&SKI=73");
                exit();
            }

        }

    }else{
        header("Location:index.php?SKD=0&SKI=73");
        exit();
    }

}else{
    header("Location:index.php?SKD=1");
    exit();
}
?>
