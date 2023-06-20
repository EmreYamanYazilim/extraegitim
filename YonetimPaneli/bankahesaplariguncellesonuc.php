<?php

if (isset($_SESSION["Yonetici"])) {

    if (isset($_GET["ID"])){
        $GelenID    =   Guvenlik($_GET["ID"]);
    }else{
        $GelenID    =   "";
    }
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
    if (isset($_POST["KonumSehri"])) {
        $GelenKonumSehir     =   Guvenlik($_POST["KonumSehri"]);
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

    if (($GelenID!="") and ($GelenBankaAdi!="") and ($GelenSubeAdi!="")  and ($GelenSubeKodu!="") and ($GelenKonumSehir!="")  and ($GelenKonumUlke!="") and ($GelenParaBirimi!="")  and ($GelenHesapSahibi!="") and ($GelenHesapNumarasi!="")  and ($GelenIbanNumarasi!="")) {

        $BankaGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE bankahesaplarimiz SET BankaAdi=?,KonumSehri=?,KonumUlke=?, SubeAdi=?, SubeKodu=? ,ParaBirimi=? ,HesapSahibi=? ,HesapNumarasi=? ,IbanNumarasi=? WHERE id = ? LIMIT 1");
        $BankaGuncellemeSorgusu->execute([$GelenBankaAdi, $GelenKonumSehir, $GelenKonumUlke, $GelenSubeAdi, $GelenSubeKodu, $GelenParaBirimi, $GelenHesapSahibi, $GelenHesapNumarasi, $GelenIbanNumarasi, $GelenID]);
        $BankaGuncellemeKotnrol = $BankaGuncellemeSorgusu->rowCount();

        if(($GelenBankaLogosu["name"]!="") and ($GelenBankaLogosu["type"]!="") and ($GelenBankaLogosu["tmp_name"]!="") and ($GelenBankaLogosu["error"]==0) and ($GelenBankaLogosu["size"]>0)){
            $BankaResmiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM bankahesaplarimiz WHERE id = ? LIMIT 1");
            $BankaResmiSorgusu->execute([$GelenID]);
            $ResimKontrol = $BankaResmiSorgusu->rowCount();
            $ResimBilgisi = $BankaResmiSorgusu->fetch(PDO::FETCH_ASSOC);

            $SilinecekDosyaYolu		=	"../Resimler/".$ResimBilgisi["BankaLogosu"];
             unlink($SilinecekDosyaYolu);


             $ResimIcinDosyaAdi = ResimAdiOlustur();
             $GelenResminUzantisi = substr($GelenBankaLogosu["name"], -4); // gelen isimin son 4 tanesini çıkarıp ver dedik  png gif jpg yada jpeg gelebilir
             if ($GelenResminUzantisi == "jpeg") {
                $GelenResminUzantisi = ".".$GelenResminUzantisi; // -4 yaptığımız için jpeg 4 harften olduğu için nokta ekleterek dosya uzantısını belirtiyoruz
            }

            $ResimIcinDosyaAdiUzantili = $ResimIcinDosyaAdi.$GelenResminUzantisi;

            $BankaLogosuYukle = new \Verot\Upload\Upload($GelenBankaLogosu, "tr-TR");

            if ($BankaLogosuYukle->uploaded) {
                $BankaLogosuYukle->allowed = array("image/*"); // bütün resim dosyalarını kabul et dedik
                $BankaLogosuYukle->mime_magic_check = true; // gelen dosyanın mime türünü image yazan yerdeki mime türüne check ediyor farklı türlerde bişi gelrise onu hataya çeviriyor image dediğim için tüm türler gelsin dedim
                $BankaLogosuYukle->file_overwrite = true; //  aynı isimli dosya geldimi üstüne yaz
                $BankaLogosuYukle->image_background_color = "#FFFFFF"; // arka plan resmini boş bıraktık png falan gelirse arka planı boyamasın
                $BankaLogosuYukle->image_quality = 100;
                $BankaLogosuYukle->image_resize = true;
                $BankaLogosuYukle->image_y = 35; //yükseklik
                $BankaLogosuYukle->file_new_name_body = $ResimIcinDosyaAdiUzantili; //isimlendirme
                $BankaLogosuYukle->process($VerotIcinKlasorYolu);//klasor yolu fonksiyon.php de birleştirerek aldım
                if ($BankaLogosuYukle->processed) {

                    $BankaResmiGuncelleme = $VeritabaniBaglantisi->prepare("UPDATE bankahesaplarimiz SET BankaLogosu = ? WHERE id = ? LIMIT 1");
                    $BankaResmiGuncelleme->execute([$ResimIcinDosyaAdiUzantili, $GelenID]);
                    $BankaResimGuncellemeKontrol = $BankaResmiGuncelleme->rowCount();

                    if ($BankaResimGuncellemeKontrol < 1) {
                        header("Location:index.php?SKD=0&SKI=17"); // yükleme gerçekleşmediyse hata alanı
                        exit();
                    }

                    $BankaLogosuYukle->clean();
                } else {
                    header("Location:index.php?SKD=0&SKI=17"); // yükleme gerçekleşmediyse hata alanı
                    exit();
                }
            }

        }

        if (($BankaGuncellemeKotnrol>0) or ($BankaResimGuncellemeKontrol>0)) {
            header("Location:index.php?SKD=0&SKI=16"); // yükleme tamam alanı
            exit();
        }else{
            header("Location:index.php?SKD=0&SKI=17"); // yükleme gerçekleşmediyse hata alanı
            exit();
        }


    }else{
    header("Lodation:index.php?SKD=0&SKI=17");// yükleme gerçekleşmediyse hata alanı
    exit();
    }

}else{
    header("Location:index.php?SKD=1");
    exit();
}



?>