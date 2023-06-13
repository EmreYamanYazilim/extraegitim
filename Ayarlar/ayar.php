<?php

try {
    $VeritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=extraegitim;charset=utf8", "root", "");

} catch (PDOExpception $Hata) {
    //echo "bağlantı hatası <br /> " . $Hata->getMessage(); // bu alanı kapatıyorum çünkü site hata yaparsa kullanıcılar hata değerini görmesin
    die();
}

$AyarlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM ayarlar LIMIT 1 ");
$AyarlarSorgusu->execute();
$AyarlarSayisi = $AyarlarSorgusu->rowCount();
$Ayarlar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if ($AyarlarSayisi>0) {

    $SiteAdi                = $Ayarlar["SiteAdi"];
    $SiteTitle              = $Ayarlar["SiteTitle"];
    $SiteDescription        = $Ayarlar["SiteDescription"];
    $SiteKeywords           = $Ayarlar["SiteKeywords"];
    $SiteCopyrightMetni     = $Ayarlar["SiteCopyrightMetni"];
    $SiteLogosu             = $Ayarlar["SiteLogosu"];
    $SiteLinki				= $Ayarlar["SiteLinki"];
    $SiteEmailAdresi		= $Ayarlar["SiteEmailAdresi"];
    $SiteEmailSifresi		= $Ayarlar["SiteEmailSifresi"];
    $SiteEmailHostAdresi	= $Ayarlar["SiteEmailHostAdresi"];
    $SosyalLinkFacebook     = $Ayarlar["SosyalLinkFacebook"];
    $SosyalLinkTwitter      = $Ayarlar["SosyalLinkTwitter"];
    $SosyalLinkInstegram    = $Ayarlar["SosyalLinkInstegram"];
    $SosyalLinkYoutube      = $Ayarlar["SosyalLinkYoutube"];
    $SosyalLinkLinkedin     = $Ayarlar["SosyalLinkLinkedin"];
    $SosyalLinkPinterest    = $Ayarlar["SosyalLinkPinterest"];
    $DolarKuru              = $Ayarlar["DolarKuru"];
    $EuroKuru               = $Ayarlar["EuroKuru"];
    $UcretsizKargoBaraji    = $Ayarlar["UcretsizKargoBaraji"];
    $ClientID               = $Ayarlar["ClientID"];
    $StoreKey               = $Ayarlar["StoreKey"];
    $ApiKullanicisi           = $Ayarlar["ApiKullanicisi"];
    $ApiSifresi             = $Ayarlar["ApiSifresi"];






} else {
    //echo "site ayar sorgusu hatalı";  // bu alanı kapatıyorum site hata yaparsa kullanıcı görmesin
    die();

}


$MetinlerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sozlesmelervemetinler LIMIT 1");
$MetinlerSorgusu->execute();
$MetinlerSayisi = $MetinlerSorgusu->rowCount();
$Metinler = $MetinlerSorgusu->fetch(PDO::FETCH_ASSOC);

if ($MetinlerSayisi > 0) {
    $HakkimizdaMetni                = $Metinler["HakkimizdaMetni"];
    $UyelikSozlesmeMetni            = $Metinler["UyelikSozlesmeMetni"];
    $KullanimKosullariMetni         = $Metinler["KullanimKosullariMetni"];
    $GizlilikSozlesmesiMetni        = $Metinler["GizlilikSozlesmesiMetni"];
    $MesafeliSatisSozlesmesiMetni   = $Metinler["MesafeliSatisSozlesmesiMetni"];
    $TeslimatMetni                  = $Metinler["TeslimatMetni"];
    $IptalIadeDegisimMetni          = $Metinler["IptalIadeDegisimMetni"];


} else {
    //echo "site ayar sorgusu hatalı";  // bu alanı kapatıyorum site hata yaparsa kullanıcı görmesin
    die();

}




if (isset($_SESSION["Kullanici"])){

    $kullaniciSorgusu       =   $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? LIMIT 1");
    $kullaniciSorgusu->execute([$_SESSION["Kullanici"]]);
    $kullaniciSayisi        =   $kullaniciSorgusu->rowCount();
    $Kullanici              =   $kullaniciSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($kullaniciSayisi>0){
        $KullaniciID    =   $Kullanici["id"];
        $EmailAdresi    =   $Kullanici["EmailAdresi"];
        $Sifre          =   $Kullanici["Sifre"];
        $IsimSoyisim    =   $Kullanici["IsimSoyisim"];
        $TelefonNumarasi=   $Kullanici["TelefonNumarasi"];
        $Cinsiyet       =   $Kullanici["Cinsiyet"];
        $Durumu         =   $Kullanici["Durumu"];
        $KayitTarihi    =   $Kullanici["KayitTarihi"];
        $KayitIpAdresi  =   $Kullanici["KayitIpAdresi"];



    }else{
//            echo "bu sorgu hatalı"; bu alanı kapatıyorum  kulanıcılar hata değerini görmesin
        die();
    }

}


if(isset($_SESSION["Yonetici"])){
    $YoneticiSorgusu		=	$VeritabaniBaglantisi->prepare("SELECT * FROM yoneticiler WHERE KullaniciAdi = ? LIMIT 1");
    $YoneticiSorgusu->execute([$_SESSION["Yonetici"]]);
    $YoneticiSayisi			=	$YoneticiSorgusu->rowCount();
    $Yonetici				=	$YoneticiSorgusu->fetch(PDO::FETCH_ASSOC);

    if($YoneticiSayisi>0){
        $YoneticiID					=	$Yonetici["id"];
        $YoneticiKullaniciAdi		=	$Yonetici["KullaniciAdi"];
        $YoneticiSifre				=	$Yonetici["Sifre"];
        $YoneticiIsimSoyisim		=	$Yonetici["IsimSoyisim"];
        $YoneticiEmailAdresi		=	$Yonetici["EmailAdresi"];
        $YoneticiTelefonNumarasi	=	$Yonetici["TelefonNumarasi"];
    }else{
        //echo "Yönetici Sorgusu Hatalı"; // Bu alanı kapatıyoruz çünkü site hata yaparsa kullanıcılar hata değerini görmesin.
        die();
    }
}



?>


