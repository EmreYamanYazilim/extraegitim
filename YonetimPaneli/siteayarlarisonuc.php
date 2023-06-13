<?php
if(isset($_SESSION["Yonetici"])){
    if(isset($_POST["SiteAdi"])){
        $GelenSiteAdi				=	Guvenlik($_POST["SiteAdi"]);
    }else{
        $GelenSiteAdi				=	"";
    }
    if(isset($_POST["SiteTitle"])){
        $GelenSiteTitle				=	Guvenlik($_POST["SiteTitle"]);
    }else{
        $GelenSiteTitle				=	"";
    }
    if(isset($_POST["SiteDescription"])){
        $GelenSiteDescription		=	Guvenlik($_POST["SiteDescription"]);
    }else{
        $GelenSiteDescription		=	"";
    }
    if(isset($_POST["SiteKeywords"])){
        $GelenSiteKeywords			=	Guvenlik($_POST["SiteKeywords"]);
    }else{
        $GelenSiteKeywords			=	"";
    }
    if(isset($_POST["SiteCopyrightMetni"])){
        $GelenSiteCopyrightMetni	=	Guvenlik($_POST["SiteCopyrightMetni"]);
    }else{
        $GelenSiteCopyrightMetni	=	"";
    }
    if(isset($_POST["SiteLinki"])){
        $GelenSiteLinki				=	Guvenlik($_POST["SiteLinki"]);
    }else{
        $GelenSiteLinki				=	"";
    }
    if(isset($_POST["SiteEmailAdresi"])){
        $GelenSiteEmailAdresi		=	Guvenlik($_POST["SiteEmailAdresi"]);
    }else{
        $GelenSiteEmailAdresi		=	"";
    }
    if(isset($_POST["SiteEmailSifresi"])){
        $GelenSiteEmailSifresi		=	Guvenlik($_POST["SiteEmailSifresi"]);
    }else{
        $GelenSiteEmailSifresi		=	"";
    }
    if(isset($_POST["SiteEmailHostAdresi"])){
        $GelenSiteEmailHostAdresi	=	Guvenlik($_POST["SiteEmailHostAdresi"]);
    }else{
        $GelenSiteEmailHostAdresi	=	"";
    }
    if(isset($_POST["SosyalLinkFacebook"])){
        $GelenSosyalLinkFacebook	=	Guvenlik($_POST["SosyalLinkFacebook"]);
    }else{
        $GelenSosyalLinkFacebook	=	"";
    }
    if(isset($_POST["SosyalLinkTwitter"])){
        $GelenSosyalLinkTwitter		=	Guvenlik($_POST["SosyalLinkTwitter"]);
    }else{
        $GelenSosyalLinkTwitter		=	"";
    }
    if(isset($_POST["SosyalLinkLinkedin"])){
        $GelenSosyalLinkLinkedin	=	Guvenlik($_POST["SosyalLinkLinkedin"]);
    }else{
        $GelenSosyalLinkLinkedin	=	"";
    }
    if(isset($_POST["SosyalLinkInstegram"])){
        $GelenSosyalLinkInstagram	=	Guvenlik($_POST["SosyalLinkInstegram"]);
    }else{
        $GelenSosyalLinkInstagram	=	"";
    }
    if(isset($_POST["SosyalLinkPinterest"])){
        $GelenSosyalLinkPinterest	=	Guvenlik($_POST["SosyalLinkPinterest"]);
    }else{
        $GelenSosyalLinkPinterest	=	"";
    }
    if(isset($_POST["SosyalLinkYoutube"])){
        $GelenSosyalLinkYouTube		=	Guvenlik($_POST["SosyalLinkYoutube"]);
    }else{
        $GelenSosyalLinkYouTube		=	"";
    }
    if(isset($_POST["DolarKuru"])){
        $GelenDolarKuru				=	Guvenlik($_POST["DolarKuru"]);
    }else{
        $GelenDolarKuru				=	"";
    }
    if(isset($_POST["EuroKuru"])){
        $GelenEuroKuru				=	Guvenlik($_POST["EuroKuru"]);
    }else{
        $GelenEuroKuru				=	"";
    }
    if(isset($_POST["UcretsizKargoBaraji"])){
        $GelenUcretsizKargoBaraji	=	Guvenlik($_POST["UcretsizKargoBaraji"]);
    }else{
        $GelenUcretsizKargoBaraji	=	"";
    }
    if(isset($_POST["ClientID"])){
        $GelenClientID				=	Guvenlik($_POST["ClientID"]);
    }else{
        $GelenClientID				=	"";
    }
    if(isset($_POST["StoreKey"])){
        $GelenStoreKey				=	Guvenlik($_POST["StoreKey"]);
    }else{
        $GelenStoreKey				=	"";
    }
    if(isset($_POST["ApiKullanicisi"])){
        $GelenApiKullanicisi		=	Guvenlik($_POST["ApiKullanicisi"]);
    }else{
        $GelenApiKullanicisi		=	"";
    }
    if(isset($_POST["ApiSifresi"])){
        $GelenApiSifresi			=	Guvenlik($_POST["ApiSifresi"]);
    }else{
        $GelenApiSifresi			=	"";
    }

    $GelenSiteLogosu				=	$_FILES["SiteLogosu"];

    if(($GelenSiteAdi!="") and ($GelenSiteTitle!="") and ($GelenSiteDescription!="") and ($GelenSiteKeywords!="") and ($GelenSiteCopyrightMetni!="") and ($GelenSiteLinki!="") and ($GelenSiteEmailAdresi!="") and ($GelenSiteEmailSifresi!="") and ($GelenSiteEmailHostAdresi!="") and ($GelenSosyalLinkFacebook!="") and ($GelenSosyalLinkTwitter!="") and ($GelenSosyalLinkLinkedin!="") and ($GelenSosyalLinkInstagram!="") and ($GelenSosyalLinkPinterest!="") and ($GelenSosyalLinkYouTube!="") and ($GelenDolarKuru!="") and ($GelenEuroKuru!="") and ($GelenUcretsizKargoBaraji!="") and ($GelenClientID!="") and ($GelenStoreKey!="") and ($GelenApiKullanicisi!="") and ($GelenApiSifresi!="")){
        $AyarlariGuncelle			=	$VeritabaniBaglantisi->prepare("UPDATE ayarlar SET SiteAdi = ?, SiteTitle = ?, SiteDescription = ?, SiteKeywords = ?, SiteCopyrightMetni = ?, SiteLinki = ?, SiteEmailAdresi = ?, SiteEmailSifresi = ?, SiteEmailHostAdresi = ?, SosyalLinkFacebook = ?, SosyalLinkTwitter = ?, SosyalLinkLinkedin = ?, SosyalLinkInstegram = ?, SosyalLinkPinterest = ?, SosyalLinkYoutube = ?, DolarKuru = ?, EuroKuru = ?, UcretsizKargoBaraji = ?, ClientID = ?, StoreKey = ?, ApiKullanicisi = ?, ApiSifresi = ?");
        $AyarlariGuncelle->execute([$GelenSiteAdi, $GelenSiteTitle, $GelenSiteDescription, $GelenSiteKeywords, $GelenSiteCopyrightMetni, $GelenSiteLinki, $GelenSiteEmailAdresi, $GelenSiteEmailSifresi, $GelenSiteEmailHostAdresi, $GelenSosyalLinkFacebook, $GelenSosyalLinkTwitter, $GelenSosyalLinkLinkedin, $GelenSosyalLinkInstagram, $GelenSosyalLinkPinterest, $GelenSosyalLinkYouTube, $GelenDolarKuru, $GelenEuroKuru, $GelenUcretsizKargoBaraji, $GelenClientID, $GelenStoreKey, $GelenApiKullanicisi, $GelenApiSifresi]);

        $GuncellemeSay = $AyarlariGuncelle->rowCount();
        if ($GuncellemeSay > 0){
            echo "tamam";

        }



//        header("Location:index.php?SKD=0&SKI=3");
//        exit();
//    }else{
//        header("Location:index.php?SKD=0&SKI=4");
//        exit();
    }
}else{
    header("Location:index.php?SKD=1");
    exit();
}
?>