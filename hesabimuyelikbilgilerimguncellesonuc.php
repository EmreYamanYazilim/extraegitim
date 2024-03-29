<?php
if ($_SESSION["Kullanici"]) {


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


    $MD5liSifre = md5($GelenSifre);

    if (($GelenIsimSoyisim != "") and ($GelenEmailAdresi != "") and ($GelenSifre != "") and ($GelenSifreTekrar != "") and ($GelenTelefonNumarasi != "") and ($GelenCinsiyet != "")) {

        if ($GelenSifre != $GelenSifreTekrar) {
            header("Location:index.php?SK=57");// uyuşmayan şifre
            exit();
        } else {
            if ($GelenSifre == "EskiSifre") {
                $SifreDegistirmeDurumu = 0;
            } else {
                $SifreDegistirmeDurumu = 1;
            }

            if ($EmailAdresi != $GelenEmailAdresi) {

                $KontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ?");
                $KontrolSorgusu->execute([$GelenEmailAdresi]);
                $KullaniciSayisi = $KontrolSorgusu->rowCount();

                if ($KullaniciSayisi > 0) {
                    header("Location:index.php?SK=55");// tekraralanan alan
                    exit();
                }
            }

            if ($SifreDegistirmeDurumu == 1) {
                $KullaniciGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE uyeler SET IsimSoyisim = ?,Sifre = ?, EmailAdresi = ?, TelefonNumarasi = ?, Cinsiyet = ?  WHERE id = ? LIMIT 1");
                $KullaniciGuncellemeSorgusu->execute([$GelenIsimSoyisim, $MD5liSifre, $GelenEmailAdresi, $GelenTelefonNumarasi, $GelenCinsiyet, $KullaniciID]);

            } else {
                $KullaniciGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE uyeler SET IsimSoyisim = ?, EmailAdresi = ?, TelefonNumarasi = ?, Cinsiyet = ?  WHERE id = ? LIMIT 1");
                $KullaniciGuncellemeSorgusu->execute([$GelenIsimSoyisim, $GelenEmailAdresi, $GelenTelefonNumarasi, $GelenCinsiyet, $KullaniciID]);

            }
            $KayitKontrol = $KullaniciGuncellemeSorgusu->rowCount();



            if ($KayitKontrol > 0) {

                $_SESSION["Kullanici"] = $GelenEmailAdresi; //  e mail değişikliği yapınca sistemin atmaması için tekrar session istemek lazım
                header("Location:index.php?SK=53");// tamam
                exit();

            } else {
                header("Location:index.php=SK=54");// hata
                exit();
            }

        }


    } else {
        header("Location:index.php?SK=56");// eksik alan
        exit();
    }


} else {
    header("Location:index.php");
    exit();
}

?>
