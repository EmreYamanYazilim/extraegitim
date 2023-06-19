<?php

if (isset($_SESSION["Yonetici"])) {

    $GelenBankaLogosu = $_FILES["BankaLogosu"];

    if (isset($_POST["BankaAdi"])) {
        $GelenBankaAdi      =   Guvenlik($_POST["BankaAdi"]);
    }else{
        $GelenBankaAdi      =   "";
    }
    if (isset($_POST["SubeAdi"])) {
        $GelenSubeAdi     =   Guvenlik($_POST["SubeAdi"]);
    }else{
        $GelenSubeAdi      =   "";
    }
    if (isset($_POST["SubeKodu"])) {
        $GelenSubeKodu     =   Guvenlik($_POST["SubeKodu"]);
    }else{
        $GelenSubeKodu      =   "";
    }
    if (isset($_POST["KonumSehir"])) {
        $GelenKonumSehir     =   Guvenlik($_POST["KonumSehir"]);
    }else{
        $GelenKonumSehir      =   "";
    }
    if (isset($_POST["KonumUlke"])) {
        $GelenKonumUlke     =   Guvenlik($_POST["KonumUlke"]);
    }else{
        $GelenKonumUlke      =   "";
    }
    if (isset($_POST["ParaBirimi"])) {
        $GelenParaBirimi     =   Guvenlik($_POST["ParaBirimi"]);
    }else{
        $GelenParaBirimi      =   "";
    }
    if (isset($_POST["HesapSahibi"])) {
        $GelenHesapSahibi     =   Guvenlik($_POST["HesapSahibi"]);
    }else{
        $GelenHesapSahibi      =   "";
    }
    if (isset($_POST["HesapNumarasi"])) {
        $GelenHesapNumarasi     =   Guvenlik($_POST["HesapNumarasi"]);
    }else{
        $GelenHesapNumarasi      =   "";
    }
    if (isset($_POST["IbanNumarasi"])) {
        $GelenIbanNumarasi     =   Guvenlik($_POST["IbanNumarasi"]);
    }else{
        $GelenIbanNumarasi      =   "";
    }




    if (($GelenBankaLogosu["name"]!="") and ($GelenBankaLogosu["type"]!="") and ($GelenBankaLogosu["tmp_name"]!="") and ($GelenBankaLogosu["error"]==0) and ($GelenBankaLogosu["size"]>0) and ($GelenBankaAdi!="") and ($GelenSubeAdi!="")  and ($GelenSubeKodu!="") and ($GelenKonumSehir!="")  and ($GelenKonumUlke!="") and ($GelenParaBirimi!="")  and ($GelenHesapSahibi!="") and ($GelenHesapNumarasi!="")  and ($GelenIbanNumarasi!="")){

        $ResimIcinDosyaAdi		=	ResimAdiOlustur();
        $GelenResminUzantisi	=	substr($GelenBankaLogosu["name"], -4); // gelen isimin son 4 tanesini çıkarıp ver dedik  png gif jpg yada jpeg gelebilir
        if ($GelenResminUzantisi=="jpeg") {
            $GelenResminUzantisi    =   ".".$GelenResminUzantisi; // -4 yaptığımız için jpeg 4 harften olduğu için nokta ekleterek dosya uzantısını belirtiyoruz
        }

        $ResimIcinDosyaAdiUzantili = $ResimIcinDosyaAdi.$GelenResminUzantisi;

        $HesapEklemeSorgusu     =   $VeritabaniBaglantisi->prepare("INSERT INTO bankahesaplarimiz (BankaLogosu,BankaAdi,KonumSehri, KonumUlke, SubeAdi, SubeKodu ,ParaBirimi ,HesapSahibi ,HesapNumarasi ,IbanNumarasi) values (?,?,?,?,?,?,?,?,?,?)");
        $HesapEklemeSorgusu->execute([$ResimIcinDosyaAdiUzantili, $GelenBankaAdi ,$GelenKonumSehir ,$GelenKonumUlke ,$GelenSubeAdi,$GelenSubeKodu,$GelenParaBirimi,$GelenHesapSahibi,$GelenHesapNumarasi,$GelenIbanNumarasi]);
        $HesapEklemeKotnrol     =   $HesapEklemeSorgusu->rowCount();


        if ($HesapEklemeKotnrol>0) {
            $BankaogosuYukle = new \Verot\Upload\Upload($GelenBankaLogosu, "tr-TR");

            if ($BankaogosuYukle->uploaded) {
                $BankaogosuYukle->allowed                   = array("image/*"); // bütün resim dosyalarını kabul et dedik
                $BankaogosuYukle->mime_check                = true; // gelen dosyanın mime türünü image yazan yerdeki mime türüne check ediyor farklı türlerde bişi gelrise onu hataya çeviriyor image dediğim için tüm türler gelsin dedim
                $BankaogosuYukle->file_overwrite            = true; //  aynı isimli dosya geldimi üstüne yaz
                $BankaogosuYukle->image_background_color    = "#FFFFFF"; // arka plan resmini boş bıraktık png falan gelirse arka planı boyamasın
                $BankaogosuYukle->image_convert             = "png";
                $BankaogosuYukle->image_quality             = 100;
                $BankaogosuYukle->image_resize              = true;
                $BankaogosuYukle->image_y                   = 30; //yükseklik
                $BankaogosuYukle->file_new_name_body        = $ResimIcinDosyaAdiUzantili; //isimlendirme
                $BankaogosuYukle->process($VerotIcinKlasorYolu);//klasor yolu fonksiyon.php de birleştirerek aldım
                if ($BankaogosuYukle->processed) {

                    $BankaogosuYukle->clean();
                    header("Location:index.php?SKD=0&SKI=12"); // yükleme gerçekleşti alanı
                    exit();
                } else {
                    header("Location:index.php?SKD=0&SKI=13"); // yükleme gerçekleşmediyse hata alanı
                    exit();
                }
            }
        }else{
            header("Location:index.php?SKD=0&SKI=13"); // yükleme gerçekleşmediyse hata alanı
            exit();
        }

    }else{
    header("Lodation:index.php?SKD=0&SKI=13");
    exit();
    }

}else{
    header("Location:index.php?SKD=1");
    exit();
}



?>