<?php
if (isset($_SESSION["Kullanici"])) {


    $StokIcinSepettekiUrunlerSorgusu    =      $VeritabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?");
    $StokIcinSepettekiUrunlerSorgusu->execute([$KullaniciID]);
    $StokIcinSepettekiUrunlerSayisi     =      $StokIcinSepettekiUrunlerSorgusu->rowCount();
    $StokIcinSepettekiKayitlar          =      $StokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
    if ($StokIcinSepettekiUrunlerSayisi>0) { //sepetteki urunleri kontrol edip stokta olmaynaı düşürmek için yaptım sepetten id,Varyantid ve ürünadedini çektim
        foreach ($StokIcinSepettekiKayitlar as $StokIcinSepettekiSatirlar) {



        $StokIcinSepetIdsi              =   $StokIcinSepettekiSatirlar["id"];
        $StokIcinSepettekiVaryantIdsi   =   $StokIcinSepettekiSatirlar["VaryantId"];
        $StokIcinSepettekiUrunAdedi     =   $StokIcinSepettekiSatirlar["UrunAdedi"];


        $StokIcinUrununVaryantBilgisiSorgusu    =   $VeritabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE  id = ? LIMIT 1"); // stok içi varyantı aldık çünki stoklarım burda
        $StokIcinUrununVaryantBilgisiSorgusu->execute([$StokIcinSepettekiVaryantIdsi]);
        $StokIcinVaryantKaydi                   =   $StokIcinUrununVaryantBilgisiSorgusu->fetch(PDO::FETCH_ASSOC);
        
            $StokIcinUrunStokAdedi              =   $StokIcinVaryantKaydi["StokAdedi"];

            if ($StokIcinUrunStokAdedi== 0) { // alışverişte stok biterse sepetimizde varsa sildirmek için
                $StokIciYoksaSepettenSil    =   $VeritabaniBaglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
                $StokIciYoksaSepettenSil->execute([$StokIcinSepetIdsi, $KullaniciID]);

            }elseif ($StokIcinSepettekiUrunAdedi>$StokIcinUrunStokAdedi) {  // urunvaryantlari içindeki stoktadedi'de yoksa  ürünleri urun adedini stokiçinurunstok adedinde yani urun varyantlari içindeki stok adetlerine eşitledik
                $StokIcinGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE sepet SET UrunAdedi = ? WHERE id = ? AND UyeId = ? LIMIT 1");
                $StokIcinGuncellemeSorgusu->execute([$StokIcinUrunStokAdedi, $StokIcinSepetIdsi, $KullaniciID]);

            }
        }
    }


    ?>


<form action="index.php?SK=99" method="post">
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">

        <tr>
            <td width="800" valign="top">
                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color:#FF9900"><h3>Alışveriş Sepeti</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC; font-weight: bold" >Kargo seçiminizi burdan yapabilirsiniz .
                        </td>
                    </tr>

                    <tr height="10"><td style="font-size: 10px;">&nbsp;</td></tr>
                    <tr height="40" align="center"><td style="color: #FF9900;  background: #646464; font-weight: bolder;">Adres Seçimi</td></tr>
                    <tr height="30" align="right"><td><a href="index.php?SK=70" style="text-decoration: none; color: #FF9900; font-weight: bolder;">+ Yeni Adres Ekle</a></td></tr>

                    <?php
                    $SepettekiUrunlerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC ");
                    $SepettekiUrunlerSorgusu->execute([$KullaniciID]);
                    $SepettekiUrunSayisi     = $SepettekiUrunlerSorgusu->rowCount();
                    $SepettekiKayitlar       = $SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);


                    if ($SepettekiUrunSayisi>0) {
                        $SepettekiToplamUrunSayisi          = 0; // sepetteki ürün sayısını belirtmediğimiz zamanda hata veriyor o yüzden belirtmemiz gerek
                        $SepettekiToplamFiyat               = 0;
                        $SepettekiToplamKargoFiyati         = 0;
                        $SepettekiToplamKargoFiyatiHesapla  = 0;
                        foreach ($SepettekiKayitlar as $SepetSatirlari) {
                            // sepet stunu içinde müşteri ismi resim fiyatı vb şeyleri tutmadığımız için  Urunİdsinden ürün bilgilerine erişicez varyant idsinden varyntlara vb
                            $SepetIdsi = $SepetSatirlari["id"];
                            $SepettekiUrununIdsi = $SepetSatirlari["UrunId"];
                            $SepettekiUrununVaryantIdsi = $SepetSatirlari["VaryantId"];
                            $SepettekiUrununAdedi = $SepetSatirlari["UrunAdedi"];

                            $UrunBilgileriSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                            $UrunBilgileriSorgusu->execute([$SepettekiUrununIdsi]); // Sepet Urunİdsinden  urunler içine eşleşerek o ürünü bulup onun verilerini altta vermek için
                            $UrunKaydi = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);


                            $UrununFiyati = $UrunKaydi["UrunFiyati"];
                            $UrununParaBirimi = $UrunKaydi["ParaBirimi"];
                            $UrununKargoUcreti = $UrunKaydi["KargoUcreti"];


                            if ($UrununParaBirimi == "USD") {
                                $UrunFiyatHesapla       = $UrununFiyati * $DolarKuru;
                                $UrunFiyatBicimlendir   = FiyatBicimlendir($UrununFiyati * $DolarKuru);

                            } elseif ($UrununParaBirimi == "EUR") {
                                $UrunFiyatHesapla       = $UrununFiyati * $EuroKuru;
                                $UrunFiyatBicimlendir   = FiyatBicimlendir($UrununFiyati * $EuroKuru);
                            } elseif ($UrununParaBirimi == "TRY") {
                                $UrunFiyatHesapla       = $UrununFiyati;
                                $UrunFiyatBicimlendir   = FiyatBicimlendir($UrununFiyati);
                            }

                            $UrunToplamFiyatHesapla     = $UrunFiyatHesapla * $SepettekiUrununAdedi;
                            $UrunToplamFiyatBicimlendir = FiyatBicimlendir($UrunToplamFiyatHesapla);// adet attırdığında altta toplamı göstermek için

                            $SepettekiToplamUrunSayisi += $SepettekiUrununAdedi; // her geldiğinde sepetteki ürün neyse ona ekleyerek devam eder  toplam kaç adet ürün aldığıın hesaplama
                            $SepettekiToplamFiyat      += $UrunFiyatHesapla * $SepettekiUrununAdedi;// sağ üstte tüm ürünlerin toplamını hesaplamak için

                            $SepettekiToplamKargoFiyatiHesapla          =   $UrununKargoUcreti*$SepettekiToplamUrunSayisi;
                            $SepettekiToplamKargoFiyatiBicimlendir      =   FiyatBicimlendir($SepettekiToplamKargoFiyatiHesapla);



                            if ($SepettekiToplamFiyat>=$UcretsizKargoBaraji) {//ayar.php den kargo barajını çektik
                                $SepettekiToplamKargoFiyatiHesapla =0;
                                $SepettekiToplamKargoFiyatiBicimlendir =   FiyatBicimlendir($SepettekiToplamKargoFiyatiHesapla);
                                $OdenecekToplamTutariHesaplaBicimlendir=    FiyatBicimlendir($SepettekiToplamFiyat);
                            } else {
                                $OdenecekToplamTutariHesapla                =   ($SepettekiToplamFiyat+$SepettekiToplamKargoFiyatiHesapla);
                                $OdenecekToplamTutariHesaplaBicimlendir     =   FiyatBicimlendir($OdenecekToplamTutariHesapla);

                            }
                            

                        }



                        $AdreslerSorgusu    = $VeritabaniBaglantisi->prepare("SELECT * FROM adresler WHERE UyeId=? ORDER BY id DESC ");
                        $AdreslerSorgusu->execute([$KullaniciID]);
                        $AdersSayisi        = $AdreslerSorgusu->rowCount();
                        $AdresKayitlari     = $AdreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);


                        if ($AdersSayisi>0) {


                            foreach ($AdresKayitlari as $AdresSatirlari) {


                        ?>

                        <tr height="100">
                            <td  align="left">
                                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="left" width="50" style="border-bottom: 1px dashed #CCCCCC;">
                                            <input type="radio" name="AdresSecimi" checked="checked" value="<?php echo DonusumleriGeriDondur($AdresSatirlari["id"]); ?>"></td>
                                        <td align="left" width="750" style="border-bottom: 1px dashed #CCCCCC;"><?php echo  DonusumleriGeriDondur($AdresSatirlari["AdSoyad"]);  ?>
                                            <br> <?php echo  DonusumleriGeriDondur($AdresSatirlari["Adres"]);  ?><br>  <?php echo  DonusumleriGeriDondur($AdresSatirlari["Ilce"]);  ?>/<?php  echo DonusumleriGeriDondur($AdresSatirlari["Sehir"]); ?>
                                            <br> <?php  echo DonusumleriGeriDondur($AdresSatirlari["TelefonNumarasi"]);  ?> </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    <?php
                            }
                        } else { ?>
                            <tr height="30">
                                <td  align="left">

                                    <b style="color: red">SİSTEME KAYITLI ADRESİNİZ BULUNMAMAKTADIR...</b><br><b><a style="text-decoration: none"
                                                href="index.php?SK=70">Lütfen Adres Eklemek için Lütfen Tıklayın</a> </b>
                                </td>
                            </tr>
                    <?php

                        }?>
                        <tr height="10"><td style="font-size: 10px;">&nbsp;</td></tr>
                        <tr height="40" align="center"><td style="color: #FF9900; background: #646464; font-weight: bolder;"> Kargo Firması Seçimi</td></tr>
                        <tr height="40" align="left"><td>


                                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr><?php
                                        $KargoSorgusu       =   $VeritabaniBaglantisi->prepare("SELECT * FROM kargofirmalari ORDER BY id ASC");
                                        $KargoSorgusu->execute([]);
                                        $KargoSayisi        =   $KargoSorgusu->rowCount();
                                        $KargoKayitlari         =   $KargoSorgusu->fetchAll(PDO::FETCH_ASSOC);



                                        $DonguSayisi		=	1;
                                        $SutunAdetSayisi	=	3;
                                        $SecimicinSayi      =   1;

                                        foreach($KargoKayitlari as $KargoKaydi){
                                            ?>
                                            <td width="260">
                                                <table width="260" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                                    <tr height="">
                                                        <td colspan="4" align="center" >&nbsp;</td>
                                                    </tr>
                                                    <tr height="40">
                                                        <td colspan="4" align="center" ><img src="Resimler/<?php echo DonusumleriGeriDondur($KargoKaydi["KargoFirmasiLogosu"]); ?>" style="width: 150px; height: 30px;" border="0"></td>
                                                    </tr>
                                                    <tr height="25">
                                                        <td width="25" align="center"><input type="radio"  style="height: 30px; " value="<?php echo $KargoKaydi["id"]; ?>" name="KargoSecimi" <?php if ($SecimicinSayi==1) {
                                                             ?> checked="checked"  <?php } ?>      ></td>

                                                    </tr>
                                                    <tr height="">
                                                        <td colspan="4" align="center" >&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <?php
                                            $SecimicinSayi++;

                                            if($DonguSayisi<$SutunAdetSayisi){
                                                ?>
                                                <td width="10">&nbsp;</td>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            $DonguSayisi++;

                                            if($DonguSayisi>$SutunAdetSayisi){
                                                echo "</tr><tr>";
                                                $DonguSayisi	=	1;
                                            }
                                        }
                                        ?>
                                    </tr>
                                </table>


                            </td></tr>
                        <?php
                    } else {
                       header("Location:index.php?SK=94");
                       exit();


                    } ?>


                </table>
            </td>

            <td width="15">&nbsp;</td>

            <td width="250" valign="top">
                <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color:#FF9900" align="right"><h3>Sipariş Özeti</h3></td>
                    </tr>

                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;" align="right">Toplam <b style="color: darkorange"><?php echo $SepettekiToplamUrunSayisi; ?> </b> adet ürün</b></td>
                    </tr>
                    <tr height="5">
                        <td height="5" style="font-size: 5px;">&nbsp;</td>
                    </tr>
                    <tr><td align="right">Ödenecek Toplam Tutar</td></tr>
                    <tr><td align="right" style="font-size: 24px;  font-weight: bold;"><?php echo $OdenecekToplamTutariHesaplaBicimlendir ?> TL</td></tr>
                    <tr height="5">
                        <td height="5" style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="5">
                        <td height="5" style="font-size: 5px;">&nbsp;</td>
                    </tr>
                    <tr><td align="right">Ödenecek Ürün Tutarı</td></tr>
                    <tr><td align="right" style="font-size: 24px;  font-weight: bold;"><?php echo FiyatBicimlendir($SepettekiToplamFiyat) ?> TL</td></tr>
                    <tr height="5">
                        <td height="5" style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <td height="5" style="font-size: 5px;">&nbsp;</td>
                    </tr>
                    <tr><td align="right">Ödenecek Kargo Tutarı</td></tr>
                    <tr><td align="right" style="font-size: 24px;  font-weight: bold;"><?php echo $SepettekiToplamKargoFiyatiBicimlendir; ?> TL</td></tr>
                    <tr height="5">
                        <td height="5" style="font-size: 10px;">&nbsp;</td>
                    </tr>



                    <tr>
                        <td align="left"><input type="submit" class="AlisverisiTamamlaButonu" value="Ödeme Seçimi"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
    <?php
} else {
    header("Location:index.php");
    exit();
}
?>