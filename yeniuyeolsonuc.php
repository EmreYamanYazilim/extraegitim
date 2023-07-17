<?php
if (isset($_POST["IsimSoyisim"])) {
    $GelenIsimSoyisim = Guvenlik($_POST["IsimSoyisim"]);

} else {
    $GelenIsimSoyisim = "";
}

if (isset($_POST["EmailAdresi"])) {
    $GelenEmailAdresi = Guvenlik($_POST["EmailAdresi"]);

} else {
    $GelenEmailAdresi = "";
}


if (isset($_POST["Sifre"])) {
    $GelenSifre = Guvenlik($_POST["Sifre"]);

} else {
    $GelenSifre = "";
}

if (isset($_POST["SifreTekrar"])) {
    $GelenSifreTekrar = Guvenlik($_POST["SifreTekrar"]);

} else {
    $GelenSifreTekrar = "";
}

if (isset($_POST["TelefonNumarasi"])) {
    $GelenTelefonNumarasi = Guvenlik($_POST["TelefonNumarasi"]);

} else {
    $GelenTelefonNumarasi = "";
}


if (isset($_POST["Cinsiyet"])) {
    $GelenCinsiyet = Guvenlik($_POST["Cinsiyet"]);

} else {
    $GelenCinsiyet = "";
}

if (isset($_POST["SozlesmeOnay"])) {
    $GelenSozlesmeOnay = Guvenlik($_POST["SozlesmeOnay"]);

} else {
    $GelenSozlesmeOnay = "";
}

$MD5liSifre = md5($GelenSifre);

if (($GelenIsimSoyisim != "") and ($GelenEmailAdresi != "") and ($GelenSifre != "") and ($GelenSifreTekrar != "") and ($GelenTelefonNumarasi != "") and ($GelenCinsiyet != "") and ($GelenSozlesmeOnay != "")) {


    if ($GelenSifre != $GelenSifreTekrar) {
        header("Location:index.php?SK=28");
        exit();
    } else {
        $KontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ?");
        $KontrolSorgusu->execute([$GelenEmailAdresi]);
        $KullaniciSayisi = $KontrolSorgusu->rowCount();

        if ($KullaniciSayisi > 0) {
            header("Location:index.php?SK=27");
            exit();

        } else {

            $UyeEklemeSorgusu = $VeritabaniBaglantisi->prepare("INSERT INTO uyeler (IsimSoyisim, EmailAdresi, Sifre, TelefonNumarasi, Cinsiyet, Durumu, KayitTarihi, KayitIpAdresi) values(?, ?, ?, ?, ?, ?, ?, ?)");
            $UyeEklemeSorgusu->execute([$GelenIsimSoyisim, $GelenEmailAdresi, $MD5liSifre, $GelenTelefonNumarasi, $GelenCinsiyet, 0, $ZamanDamgasi, $IPAdresi]); 
            //durumu 0 yaptım  email ile  aktifleştirme hatalı düzeltilmesi gerek o yüzden şimdilik durum 0 olarak devam edicek 
            $KayitKontrol = $UyeEklemeSorgusu->rowCount();


            if ($KayitKontrol > 0) {
                header("Location:index.php?SK=24");
                exit();

            } else {
                header("Location:index.php=SK=25");
                exit();
            }

        }
    }

}


?>
