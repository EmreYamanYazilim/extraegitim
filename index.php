<?php
session_start();
ob_start();
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");
require_once ("Ayarlar/sitesayfalari.php");
if(isset($_REQUEST["SK"])){
    $SayfaKoduDegeri    =   SayiliIcerikleriFilitrele($_REQUEST["SK"]);   /*  bu  filitredeki amaç urlye rakkam haricindeki yazılacak tüm değerleri hiçe sayıp sadece sayı vermesi */

}else{
    $SayfaKoduDegeri    =   0;
}

if (isset($_REQUEST["SYF"])){
    $Sayfalama = SayiliIcerikleriFilitrele($_REQUEST["SYF"]);
}else{
    $Sayfalama = 1;
}

?>


<!DOCTYPE html>
<html lang="tr-TR">
<head>

    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="revisit-after" content="7 days">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo DonusumleriGeriDondur($SiteTitle); ?></title>
    <link rel="icon" href="Resimler/logo.png">
    <meta name="description" content="<?php echo DonusumleriGeriDondur($SiteDescription);  ?>">
    <meta name="keywords" content="<?php echo DonusumleriGeriDondur($SiteKeywords); ?>">
    <script type="text/javascript" src="Frameworks/JQery/jquery-3.3.1.min.js" language="JavaScript"></script>
    <link type="text/css" rel="stylesheet" href="Ayarlar/stil.css">
    <script type="text/javascript" src="Ayarlar/fonksiyonlar.js"></script>

</head>
<body>
<table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">

    <tr bgcolor="black" height="30" height="1065">
        <td>
            <img src="Resimler/HeaderMesajResmi.png" border="0" alt="">
        </td>
    </tr>

    <tr height="110">
        <td>
            <table width="1065" height="30" align="center" bgcolor="#0088CC" border="0" cellpadding="0" cellspacing="0">
                <tr bgcolor="#0088CC">
                    <td>&nbsp;</td>


                    <?php if (isset($_SESSION["Kullanici"])){ ?>
                        <td width="20"><a href="index.php?SK=50"><img src="Resimler/KullaniciBeyaz16x16.png" alt=""
                                                            style="margin-top: 5px;"></a></td>
                        <td width="70" class="MaviAlanMenusu"><a href="index.php?SK=50"> Hesabım</a></td>
                        <td width="20"><a href="index.php?SK=49"><img src="Resimler/CikisBeyaz16x16.png" alt=""
                                                            style="margin-top: 5px;"></a></td>
                        <td width="85" class="MaviAlanMenusu"><a href="index.php?SK=49"> Çıkış Yap </a></td>



                    <?php }else{  ?>


                        <td width="20"><a href="index.php?SK=31"><img src="Resimler/KullaniciBeyaz16x16.png" alt=""
                                                            style="margin-top: 5px;"></a></td>
                        <td width="70" class="MaviAlanMenusu"><a href="index.php?SK=31"> Giriş Yap</a></td>
                        <td width="20"><a href="index.php?SK=22"><img src="Resimler/KullaniciEkleBeyaz16x16.png" alt=""
                                                            style="margin-top: 5px;"></a></td>
                        <td width="85" class="MaviAlanMenusu"><a href="index.php?SK=22"> Yeni Üye Ol</a></td>

                     <?php } ?>


                    <td width="20"><a href="xxxxx"> <img src="Resimler/SepetBeyaz16x16.png" alt=""
                                                         style="margin-top: 5px;"></a></td>

                    <?php if (isset($_SESSION["Kullanici"])) { ?>
                        <td width="103" class="MaviAlanMenusu"><a href="index.php?SK=94"> Alışveriş Sepeti</a></td>
                    <?php
                    } else { ?>
                        <td width="103" class="MaviAlanMenusu">Alışveriş Sepeti</td>
                        <?php } ?>

                </tr>
            </table>
            <table width="1065" height="80" align="center" bgcolor="white" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="192" height="30"><a href="index.php"><img src="Resimler/<?php echo DonusumleriGeriDondur($SiteLogosu); ?>" border="0"></a></td>
                    <td>
                        <table width="800">
                            <tr>
                                <td width="300">&nbsp;</td>
                                <td width="100" class="AnaMenu"><a href="index.php?SK=0"><b>Anasayfa</b></a></td>
                                <td width="100" class="AnaMenu"><a href="index.php?SK=84"><b>Erkek ayakkabıları</b></a></td>
                                <td width="100" class="AnaMenu"><a href="index.php?SK=85"><b>Kadın Ayakkabıları</b></a></td>
                                <td width="100" class="AnaMenu"><a href="index.php?SK=86"><b>Çocuk Ayakkabıları</b></a></td>
                            </tr>
                        </table>
                </tr>
                </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Body-->
    <tr>
        <td valign="top" align="center" width="1065">
<!--            BANNER - İÇERİK-->

            <?php
            if((!$SayfaKoduDegeri) or ($SayfaKoduDegeri=="") or ($SayfaKoduDegeri==0)){
                include($Sayfa[0]);
            }else{
                include($Sayfa[$SayfaKoduDegeri]);
            }

            ?>

        </td>
        <br>
        <br>
    </tr>

<!-- footer -->
    <tr height="100">
        <td>

            <table width="1065" height="210" align="center" bgcolor="#F9F9F9" border="0" cellpadding="0"
                   cellspacing="0">
                <tr>
                    <td>
                        <table width="1065">
                            <tr height="30">
                                <td width="250"><b>Kurumsal</b></td>
                                <td width="22"><b>&nbsp;</b></td>
                                <td width="250"><b>Üyelik Hizmetleri</b></td>
                                <td width="22"><b>&nbsp;</b></td>
                                <td width="250"><b>Sözleşmeler</b></td>
                                <td width="21"><b>&nbsp;</b></td>
                                <td width="250"><b>Bizi Takip Edin</b></td>
                            </tr>

                            <tr height="30">
                                <td><a href="index.php?SK=1"><b>Hakkımızda</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <?php
                                if (isset($_SESSION["Kullanici"])){ ?>

                                    <td><a href="index.php?SK=49"><b>Çıkış Yap</b></a></td>
                                    <td><a href="xxxxx"><b>&nbsp;</b></a></td>

                                <?php  }else{  ?>


                                    <td><a href="index.php?SK=31"><b>Giriş Yap</b></a></td>
                                    <td><a href="xxxxx"><b>&nbsp;</b></a></td>

                                <?php } ?>


                                <td><a href="index.php?SK=2"><b>Üyelik sözleşmesi</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkFacebook); ?>" target="_blank"><img src="Resimler/Facebook16x16.png" alt="">Facebook</a></td>
                            </tr>
                            <tr height="30">
                                <td><a href="index.php?SK=8"><b>Banka Hesaplarımız</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>

                                <?php  if (isset($_SESSION["Kullanici"])){ ?>



                                    <td><a href="index.php?SK=50"><b>Hesabım</b></a></td>
                                    <td><a href="index.php?SK=50"><b>&nbsp;</b></a></td>
                                <?php }else{ ?>

                                    <td><a href="index.php?SK=49"><b>Çıkış Yap</b></a></td>
                                    <td><a href="index.php?SK=49"><b>&nbsp;</b></a></td>

                                <?php } ?>

                                <td><a href="index.php?SK=3"><b>Kullanım Koşulları</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkTwitter); ?>" target="_blank"><img src="Resimler/Twitter16x16.png" alt="">Twitter</a></td>
                            </tr>
                            <tr height="30">
                                <td><a href="index.php?SK=9"><b>Havale Bildirim</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="index.php?SK=21"><b>Sık Sorulan Sorular</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="index.php?SK=4"><b>Gizlilik sözleşmesi</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkLinkedin); ?>" target="_blank"><img src="Resimler/LinkedIn16x16.png" alt="">Linked</a></td>
                            </tr>
                            <tr height="30">
                                <td><a href="index.php?SK=14"><b>Kargom Nerede ?</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="xxxxx"><b></b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="index.php?SK=5"><b>Mesafeli Sözleşmeler</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkYoutube); ?>" target="_blank"><img src="Resimler/YouTube16x16.png" alt="">youtube</a></td>
                            </tr height="30">
                            <td><a href="index.php?SK=16"><b>İletişim</b></a></td>
                            <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                            <td><a href="xxxxx"><b></b></a></td>
                            <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                            <td><a href="index.php?SK=6"><b>Teslimat</b></a></td>
                            <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                            <td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkİnstegram);  ?>" target="_blank"><img src="Resimler/Instagram16x16.png" alt="">instagram</a></td>
                            </tr>
                            <tr>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="xxxxx"><b></b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="index.php?SK=7"><b>İptal İade Değişim</b></a></td>
                                <td><a href="xxxxx"><b>&nbsp;</b></a></td>
                                <td><a href="<?php echo DonusumleriGeriDondur($SosyalLinkPinterest); ?>" target="_blank"><img src="Resimler/Pinterest16x16.png" alt="">pinterest</a></td>
                            </tr>


                        </table>
                    </td>
                </tr>
            </table>

        </td>


        </td>

    </tr>
    <tr height="10px;"><td align="center"> <?php echo DonusumleriGeriDondur($SiteCopyrightMetni); ?></td>
    </tr>

    <tr height="30">
        <td>
            <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center"><img src="Resimler/RapidSSL32x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/InternetteGuvenliAlisveris28x12.png" border="0"
                                style="margin-right: 5px;"><img src="Resimler/3DSecure14x12.png" border="0"
                                                                style="margin-right: 5px;"><img
                                src="Resimler/BonusCard41x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/MaximumCard46x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/WorldCard48x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/CardFinans78x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/AxessCard46x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/ParafCard19x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/VisaCard37x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/MasterCard21x12.png" border="0" style="margin-right: 5px;"><img
                                src="Resimler/AmericanExpiress20x12.png" border="0"></td>
                </tr>
            </table>
        </td>
    </tr>

</table>

</body>
</html>

<?php

$VeritabaniBaglantisi = null;
ob_end_flush();

?>
