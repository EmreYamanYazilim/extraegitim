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

    if ($GelenOdemeTuruSecimi!="") {//ilk olarak ödeme seçimini kontrol ediyoruz
        if ($GelenOdemeTuruSecimi=="Banka Havalesi") { // banka havalesi  boş değilse elsede taksitler için if oluşturucaz

            $AlisverisSepetiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? LIMIT 1 ");
            $AlisverisSepetiSorgusu->execute([$KullaniciID]);
            $SepetSayisi            = $AlisverisSepetiSorgusu->rowCount();
            $SepetUrunleri          = $AlisverisSepetiSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if ($SepetUrunleri>0) {
                foreach ($SepetUrunleri as $SepetSatirlari) {

                    $SepetIdsi                  =   $SepetSatirlari["id"];// sepetle alakalı siparisler tablosu ile alakalı tüm stunları değişkene verdik başka yerdede kullanmak için burada kullanmak için rahatlık olsun diye
                    $SepetSepetNumarasi         =    $SepetSatirlari["SepetNumarasi"];
                    $SepettekiUyeId                 =    $SepetSatirlari["UyeId"];
                    $SepettekiUrunId                =    $SepetSatirlari["UrunId"];
                    $SepettekiAdresId               =    $SepetSatirlari["AdresId"];
                    $SepettekiVaryantId             =    $SepetSatirlari["VaryantId"];
                    $SepettekiKargoId               =    $SepetSatirlari["KargoId"];
                    $SepettekiUrunAdedi             =    $SepetSatirlari["UrunAdedi"];
                    $SepettekiOdemeSecimi           =    $SepetSatirlari["OdemeSecimi"];
                    $SepettekiTaksitSecimi          =    $SepetSatirlari["TaksitSecimi"];

                    $UrunBilgileriSorgusu           =   $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                    $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
                    $UrunKaydi                      =   $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                    $UrunTuru        =   $UrunKaydi["UrunTuru"];
                    $UrunResmiBir    =   $UrunKaydi["UrunResmiBir"];
                    $UrunAdi         =   $UrunKaydi["UrunAdi"];
                    $UrunFiyati      =   $UrunKaydi["UrunFiyati"];
                    $ParaBirimi      =   $UrunKaydi["ParaBirimi"];
                    $UrunKdvOrani    =   $UrunKaydi["KdvOrani"];
                    $VaryantBasligi  =   $UrunKaydi["VaryantBasligi"];
                    $UrunKargoUcreti =   $UrunKaydi["KargoUcreti"];

                    $UrunVaryantBilgileriSorgulama =    $VeritabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ?");
                    $UrunVaryantBilgileriSorgulama->execute([$SepettekiVaryantId]);
                    $VaryantKaydi                  =    $UrunVaryantBilgileriSorgulama->fetch(PDO::FETCH_ASSOC);

                    $KargoBilgileriSorgusu         =    $VeritabaniBaglantisi->prepare("SELECT * FROM kargofirmalari WHERE id = ?");
                    $KargoBilgileriSorgusu->execute([$SepettekiKargoId]);
                    $KargoKaydi                    =    $KargoBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                    $KargonunAdi                   =    $KargoKaydi["KargoFirmasiAdi"];




                }






            } else {
                header("Location:index.php");
                exit();
            }



        } else {
            if ($GelenTaksitSecimi!="") {// taksit seçimi için sorgu

                echo "kredikartı işlemleri";
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