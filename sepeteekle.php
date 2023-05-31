<?php

if (isset($_SESSION["Kullanici"])) {

    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    } else {
        $GelenID = "";
    }
    if (isset($_POST["Varyant"])) {
        $GelenVaryantID = Guvenlik($_POST["Varyant"]);
    } else {
        $GelenVaryantID = "";
    }

    if (($GelenID!="") and ($GelenVaryantID!="")) {


        $KullanicininSepetKontrolSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sepet where UyeId = ?  ORDER BY id DESC  LIMIT 1");
        $KullanicininSepetKontrolSorgusu->execute([$KullaniciID]);
        $KullanicininSepetSayisi = $KullanicininSepetKontrolSorgusu->rowCount();


        if ($KullanicininSepetSayisi > 0) {

            $UrunSepetKontroluSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? AND UrunId = ? AND VaryantId = ? LIMIT 1");
            $UrunSepetKontroluSorgusu->execute([$KullaniciID, $GelenID, $GelenVaryantID]);
            $UrunSepetSayisi = $UrunSepetKontroluSorgusu->rowCount();
            $UrunSepetKaydi = $UrunSepetKontroluSorgusu->fetch(PDO::FETCH_ASSOC);


            if ($UrunSepetSayisi > 0) {

                $UrunIDsi = $UrunSepetKaydi["id"];
                $UrununSepettekiMecutAdedi = $UrunSepetKaydi["UrunAdedi"];
                $YeniUrunAdedi = $UrununSepettekiMecutAdedi + 1;

                $UrunGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE sepet SET UrunAdedi = ? WHERE id = ? AND UyeId =? AND UrunId = ? LIMIT 1 ");
                $UrunGuncellemeSorgusu->execute([$YeniUrunAdedi, $UrunIDsi, $KullaniciID, $GelenID]);
                $UrunGuncellemeSayisi = $UrunGuncellemeSorgusu->rowCount();

                if ($UrunGuncellemeSayisi>0) {
                    header("Location:index?SK=94");
                    exit();
                }else{
                    header("Location:index?SK=92");
                    exit();
                }

            } else {
                $UrunEklemeSorgusu = $VeritabaniBaglantisi->prepare("INSERT INTO sepet (UyeId, UrunId, SepetNumarasi, AdresId, VaryantId, UrunAdedi, KargoFirmaSecimi, OdemeSecimi, TaksitSecimi) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $UrunEklemeSorgusu->execute([$KullaniciID, $GelenID, 1, 0, $GelenVaryantID, 1, 0, 0, 0]);
                $UrunEklemeSayisi = $UrunEklemeSorgusu->rowCount();
                $SonidDegeri = $VeritabaniBaglantisi->lastInsertId();


                if ($UrunEklemeSayisi > 0) {
                    $SiparisNumarasiGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE sepet SET SepetNumarasi = ? WHERE UyeId = ? ");
                    $SiparisNumarasiGuncellemeSorgusu->execute([$SonidDegeri, $KullaniciID]);
                    $SiparisNumarasiGuncellemeSayisi = $SiparisNumarasiGuncellemeSorgusu->rowCount();

                    if ($SiparisNumarasiGuncellemeSayisi>0){
                        header("Location:index?SK=94");
                        exit();
                    }else{
                        header("Location:index?SK=92");
                        exit();
                    }

                }


            }

        } else {


            $UrunEklemeSorgusu = $VeritabaniBaglantisi->prepare("INSERT INTO sepet (UyeId, UrunId, SepetNumarasi, AdresId, VaryantId, UrunAdedi, KargoFirmaSecimi, OdemeSecimi, TaksitSecimi) values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $UrunEklemeSorgusu->execute([$KullaniciID, $GelenID, 1, 0, $GelenVaryantID, 1, 0, 0, 0]);
            $UrunEklemeSayisi = $UrunEklemeSorgusu->rowCount();
            $SonidDegeri = $VeritabaniBaglantisi->lastInsertId();

            if ($UrunEklemeSayisi > 0) {
                $SiparisNumarasiGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE sepet SET SepetNumarasi = ? WHERE UyeId = ? ");
                $SiparisNumarasiGuncellemeSorgusu->execute([$SonidDegeri, $KullaniciID]);
                $SiparisNumarasiGuncellemeSayisi = $SiparisNumarasiGuncellemeSorgusu->rowCount();

                if ($SiparisNumarasiGuncellemeSayisi>0){
                    header("Location:index?SK=94");
                    exit();
                }else{
                    header("Location:index?SK=92");
                    exit();
                }


            }else{
                header("Location:index?SK=92");
                exit();
            }


        }

    } else {
        header("Location:index.php");
        exit();

    }


} else {
    header("Location:index.php?SK=92");
    exit();
}




?>