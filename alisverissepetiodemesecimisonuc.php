<?php
if (isset($_SESSION["Kullanici"])) {

    if (isset($_POST["OdemeTuruSecimi"])) {
        $GelenOdemeTuruSecimi = Guvenlik($_POST["OdemeTuruSecimi"]);
    }else{
        $GelenOdemeTuruSecimi = "";
    }

    if (isset($_POST["TaksitSecimi"])) {
        $GelenTaksitSecimi = Guvenlik($_POST["TaksitSecimi"]);
    }else{
        $GelenTaksitSecimi = "";
    }

    if ($GelenOdemeTuruSecimi!="") {//ilk olarak ödeme seçimini kontrol ediyorum
        if ($GelenOdemeTuruSecimi=="Banka Havalesi") { // banka havalesi  boş değilse elsede taksitler için if oluşturucaz

            $AlisverisSepetiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?  ");
            $AlisverisSepetiSorgusu->execute([$KullaniciID]);
            $SepetSayisi            = $AlisverisSepetiSorgusu->rowCount();
            $SepetUrunleri          = $AlisverisSepetiSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if ($SepetSayisi>0) {
                $UrnunToplamFiyati           = 0;
                $UrununToplamKargoFiyati     = 0;

                foreach ($SepetUrunleri as $SepetSatirlari) {
                    // sepetle alakalı siparisler tablosu ile alakalı tüm stunları değişkene verdik başka yerdede kullanmak için burada kullanmak için rahatlık olsun diye
                    $SepetIdsi = $SepetSatirlari["id"]; // silme işleminde kullanacam
                    $SepetSepetNumarasi = $SepetSatirlari["SepetNumarasi"];
                    $SepettekiUyeId = $SepetSatirlari["UyeId"];
                    $SepettekiUrunId = $SepetSatirlari["UrunId"];
                    $SepettekiAdresId = $SepetSatirlari["AdresId"];
                    $SepettekiVaryantId = $SepetSatirlari["VaryantId"];
                    $SepettekiKargoId = $SepetSatirlari["KargoId"];
                    $SepettekiUrunAdedi = $SepetSatirlari["UrunAdedi"];
                    $SepettekiOdemeSecimi = $SepetSatirlari["OdemeSecimi"];
                    $SepettekiTaksitSecimi = $SepetSatirlari["TaksitSecimi"];

                    $UrunBilgileriSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                    $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
                    $UrunKaydi = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                    $UrunTuru = $UrunKaydi["UrunTuru"];
                    $UrunAdi = $UrunKaydi["UrunAdi"];
                    $UrunFiyati = $UrunKaydi["UrunFiyati"];
                    $UrunParaBirimi = $UrunKaydi["ParaBirimi"];
                    $UrunKdvOrani = $UrunKaydi["KdvOrani"];
                    $VaryantBasligi = $UrunKaydi["VaryantBasligi"];
                    $UrunKargoUcreti = $UrunKaydi["KargoUcreti"];
                    $UrunResmiBir = $UrunKaydi["UrunResmiBir"];


                    $UrunVaryantBilgileriSorgulama = $VeritabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
                    $UrunVaryantBilgileriSorgulama->execute([$SepettekiVaryantId]);
                    $VaryantKaydi = $UrunVaryantBilgileriSorgulama->fetch(PDO::FETCH_ASSOC);

                    $VaryantAdi = $VaryantKaydi["VaryantAdi"];


                    $KargoBilgileriSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
                    $KargoBilgileriSorgusu->execute([$SepettekiKargoId]);
                    $KargoKaydi = $KargoBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                    $KargonunAdi = $KargoKaydi["KargoFirmasiAdi"];

                    $AdresBilgileriSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM adresler WHERE id = ? LIMIT 1");
                    $AdresBilgileriSorgusu->execute([$SepettekiAdresId]);
                    $AdresKaydi = $AdresBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                    $AdresAdSoyad = $AdresKaydi["AdSoyad"];
                    $AdresAdres = $AdresKaydi["Adres"];
                    $AdresIlce = $AdresKaydi["Ilce"];
                    $AdresSehir = $AdresKaydi["Sehir"];
                    $AdresTelefonNumarasi = $AdresKaydi["TelefonNumarasi"];
                    $AdresToparla = $AdresAdres . " " . $AdresSehir . " " . $AdresIlce;

                    if ($UrunParaBirimi == "USD") {
                        $UrunFiyatiHesapla = $UrunFiyati * $DolarKuru;
                    } elseif ($UrunParaBirimi == "EUR") {
                        $UrunFiyatiHesapla = $UrunFiyati * $EuroKuru;
                    } else {
                        $UrunFiyatiHesapla = $UrunFiyati;
                    }

                    $UrnunToplamFiyati       = ($UrunFiyatiHesapla * $SepettekiUrunAdedi);
                    $UrununToplamKargoFiyati = ($UrunKargoUcreti * $SepettekiUrunAdedi);


                    $SiparisEkle = $VeritabaniBaglantisi->prepare("INSERT INTO siparisler (UyeId, SiparisNumarasi, UrunId, UrunTuru, UrunAdi, UrunFiyati, KdvOrani ,UrunAdedi, ToplamUrunFiyati, KargoFirmasiSecimi, KargoUcreti, UrunResmiBir, VaryantBasligi, VaryantSecimi, AdresAdiSoyadi, AdresDetay, AdresTelefon, OdemeSecimi, TaksitSecimi, SiparisTarihi, SiparisIpAdresi, KargoDurumu) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $SiparisEkle->execute([$SepettekiUyeId, $SepetSepetNumarasi, $SepettekiUrunId, $UrunTuru, $UrunAdi, $UrunFiyatiHesapla, $UrunKdvOrani, $SepettekiUrunAdedi, $UrnunToplamFiyati, $KargonunAdi, $UrununToplamKargoFiyati, $UrunResmiBir, $VaryantBasligi, $VaryantAdi, $AdresAdSoyad, $AdresToparla, $AdresTelefonNumarasi, $GelenOdemeTuruSecimi, 0, $ZamanDamgasi, $IPAdresi, 0]);
                    $EklemeKontrol = $SiparisEkle->rowCount();




//                 sipariş işleme  ve sepetten silme bölümü
                    if($EklemeKontrol>0){
                        $SepettenSilmeSorgusu	=	$VeritabaniBaglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
                        $SepettenSilmeSorgusu->execute([$SepetIdsi, $SepettekiUyeId]);
//                        toplam satış sayısı düzenleme ve stok adedi eksiltme bölümü
                        $UrunSatisiArttirmaSorgusu	=	$VeritabaniBaglantisi->prepare("UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi + ? WHERE id = ?");
                        $UrunSatisiArttirmaSorgusu->execute([$SepettekiUrunAdedi, $SepettekiUrunId]);

                        $StokGuncellemeSorgusu	=	$VeritabaniBaglantisi->prepare("UPDATE urunvaryantlari SET StokAdedi=StokAdedi - ? WHERE id = ? LIMIT 1");
                        $StokGuncellemeSorgusu->execute([$SepettekiUrunAdedi, $SepettekiVaryantId]);
                    }else{
                        header("Location:index.php?SK=102");
                        exit();
                    }

                }



                // kargo ücretini sildirmek için sorgu
                $KargoFiyatiIcınSiparislerSorgusu = $VeritabaniBaglantisi->prepare("SELECT SUM(ToplamUrunFiyati) AS ToplamUcret FROM siparisler WHERE UyeId = ?  AND SiparisNumarasi= ?");
                $KargoFiyatiIcınSiparislerSorgusu->execute([$KullaniciID, $SepetSepetNumarasi]);
                $KargoFiyatiKaydi                 = $KargoFiyatiIcınSiparislerSorgusu->fetch(PDO::FETCH_ASSOC);
                $ToplamUcretimiz                  = $KargoFiyatiKaydi["ToplamUcret"];

                if ($ToplamUcretimiz>=$UcretsizKargoBaraji){
                    $SiparisGuncelle = $VeritabaniBaglantisi->prepare("UPDATE siparisler SET KargoUcreti = ? WHERE UyeId = ? AND SiparisNumarasi = ?");
                    $SiparisGuncelle->execute([0,$KullaniciID ,$SepetSepetNumarasi]);
                }

                header("Location:index.php?SK=101");
                exit();

            } else {
                header("Location:index.php");
                exit();
            }

        } else {
//               kredi kartı taksit seçimi için sorgu
            if ($GelenTaksitSecimi!="") {


                $SepetiGuncelle = $VeritabaniBaglantisi->prepare("UPDATE sepet SET OdemeSecimi = ? , TaksitSecimi = ? WHERE UyeId = ? ");
                $SepetiGuncelle->execute([$GelenOdemeTuruSecimi, $GelenTaksitSecimi, $KullaniciID]);
                $SepetKaydi     = $SepetiGuncelle->rowCount();



                if ($SepetKaydi>0) {

                    header("Location:index.php?SK=103");
                    exit();
                } else {
                    header("Location:index.php");
                    exit();
                }

            } else {
                header("Location:index.php");
                exit();
            }

        }



    } else {
        header("Location:index.php");
        exit();
    }

}else{
    header("Location:index.php");
    exit();
}








?>