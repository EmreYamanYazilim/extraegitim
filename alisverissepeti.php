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



    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">

        <tr>
            <td width="800" valign="top">
                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color:#FF9900"><h3>Alışveriş Sepeti</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Alışveriş Sepetine Eklemiş Olduğunuz
                            Urünleri görüntüleyebilirsiniz.
                        </td>
                    </tr>

                    <?php
                    $SepettekiUrunlerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC ");
                    $SepettekiUrunlerSorgusu->execute([$KullaniciID]);
                    $SepettekiUrunSayisi     = $SepettekiUrunlerSorgusu->rowCount();
                    $SepettekiKayitlar       = $SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);


                    if ($SepettekiUrunSayisi>0) {
                        $SepettekiToplamUrunSayisi          = 0; // sepetteki ürün sayısını belirtmediğimiz zamanda hata veriyor o yüzden belirtmemiz gerek
                        $SepettekiToplamFiyat               = 0;
                        foreach ($SepettekiKayitlar as $SepetSatirlari) {
                            // sepet stunu içinde müşteri ismi resim fiyatı vb şeyleri tutmadığımız için  Urunİdsinden ürün bilgilerine erişicez varyant idsinden varyntlara vb
                            $SepetIdsi                      =   $SepetSatirlari["id"];
                            $SepettekiUrununIdsi            =   $SepetSatirlari["UrunId"];
                            $SepettekiUrununVaryantIdsi     =   $SepetSatirlari["VaryantId"];
                            $SepettekiUrununAdedi           =   $SepetSatirlari["UrunAdedi"];

                            $UrunBilgileriSorgusu           =   $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                            $UrunBilgileriSorgusu->execute([$SepettekiUrununIdsi]); // Sepet Urunİdsinden  urunler içine eşleşerek o ürünü bulup onun verilerini altta vermek için
                            $UrunKaydi                      =   $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);


                            $UrununTuru                     =   $UrunKaydi["UrunTuru"];
                            $UrununResmi                    =   $UrunKaydi["UrunResmiBir"];
                            $UrununAdi                      =   $UrunKaydi["UrunAdi"];
                            $UrununFiyati                   =   $UrunKaydi["UrunFiyati"];
                            $UrununParaBirimi               =   $UrunKaydi["ParaBirimi"];
                            $UrununVaryantBasligi           =   $UrunKaydi["VaryantBasligi"];

                            $UrununVaryantBilgisiSorgusu    =   $VeritabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
                            $UrununVaryantBilgisiSorgusu->execute([$SepettekiUrununVaryantIdsi]); //sepet stunundaki varyantid ile urunvaryantlarindaki id eşitleyerek  urun varyantlarindaki bilgileri çektik
                            $VaryantKaydi                   =   $UrununVaryantBilgisiSorgusu->fetch(PDO::FETCH_ASSOC);

                            $UrununVaryantAdi               =   $VaryantKaydi["VaryantAdi"];
                            $UrununStokAdedi                =   $VaryantKaydi["StokAdedi"];

                            if ($UrununTuru=="Erkek Ayakkabısı") {
                                $UrunKlasoru = "Erkek";
                            } elseif ($UrununTuru=="Kadın Ayakkabısı") {
                                $UrunKlasoru = "Kadin";
                            } elseif ($UrununTuru=="Cocuk Ayakkabısı") {
                                $UrunKlasoru = "Cocuk";
                            }


                            if ($UrununParaBirimi=="USD") {
                                $UrunFiyatHesapla        =  $UrununFiyati*$DolarKuru;
                                $UrunFiyatBicimlendir    =  FiyatBicimlendir($UrununFiyati*$DolarKuru);

                            } elseif ($UrununParaBirimi=="EUR") {
                                $UrunFiyatHesapla         =  $UrununFiyati*$EuroKuru;
                                $UrunFiyatBicimlendir     =  FiyatBicimlendir($UrununFiyati*$EuroKuru);
                            } elseif ($UrununParaBirimi=="TRY") {
                                $UrunFiyatHesapla         =  $UrununFiyati;
                                $UrunFiyatBicimlendir     =  FiyatBicimlendir($UrununFiyati);
                            }

                            $UrunToplamFiyatHesapla      =  $UrunFiyatHesapla*$SepettekiUrununAdedi;
                            $UrunToplamFiyatBicimlendir =   FiyatBicimlendir($UrunToplamFiyatHesapla);// adet attırdığında altta toplamı göstermek için

                            $SepettekiToplamUrunSayisi      +=  $SepettekiUrununAdedi; // her geldiğinde sepetteki ürün neyse ona ekleyerek devam eder  toplam kaç adet ürün aldığıın hesaplama
                            $SepettekiToplamFiyat           +=$UrunFiyatHesapla*$SepettekiUrununAdedi;// sağ üstte tüm ürünlerin toplamını hesaplamak için


                        ?>


                        <tr height="100">
                            <td valign="bottom" align="left">
                                <table width="800" align="left" border="0" cellpadding="0" cellspacing="0">
                                    <tr >
                                        <td align="left" width="80" style="border-bottom: 1px dashed #CCCCCC;"><img src="Resimler/UrunResimleri/<?php echo $UrunKlasoru;?>/<?php echo DonusumleriGeriDondur($UrununResmi);?>" alt="" border="0" height="80" width="60"></td>
                                        <td align="left"  width="40" style="border-bottom: 1px dashed #CCCCCC;" align="left"><a href="index.php?SK=95&ID=<?php echo DonusumleriGeriDondur($SepetIdsi); ?>"><img src="Resimler/trash2.png" alt="" style="width: 20px;"></a></td>
                                        <td align="left"  width="530" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $UrununAdi; ?> <br/><?php echo DonusumleriGeriDondur($UrununVaryantBasligi); ?>: <?php echo DonusumleriGeriDondur($UrununVaryantAdi); ?></td>
                                        <td align="left"  width="90" style="border-bottom: 1px dashed #CCCCCC;">
                                            <table width="90" align="left" border="0" cellpadding="0" cellspacing="0">
                                                <tr>

                                                    <?php if ($SepettekiUrununAdedi>1) {
                                                     ?> <td width="30" align="center"><a href="index.php?SK=96&ID=<?php echo DonusumleriGeriDondur($SepetIdsi);?>" style="text-decoration: none; color: #646464;"><img src="Resimler/AzaltDaireli20x20.png" alt="" style="margin-top: 5px;"></a> </td> <?php }else{ ?> <td width="30">&nbsp;</td> <?php } ?>

                                                    <td width="30" align="center" style="line-height: 20px;"><b style="color: darkorange"><?php echo DonusumleriGeriDondur($SepettekiUrununAdedi); ?></b></td>
                                                    <td width="30" align="center"><a href="index.php?SK=97&ID=<?php echo DonusumleriGeriDondur($SepetIdsi);?> " style="margin-top: 5px;" ><img src="Resimler/ArttirDaireli20x20.png"  border="0" style="margin-top: 5px; alt=""></a>
                                                    </td >
                                                </tr>
                                            </table>
                                        </td>
                                        <td align="left"  width="150" style="border-bottom: 1px dashed #CCCCCC;" > <?php echo $UrunFiyatBicimlendir; ?>  <br/> <?php echo $UrunToplamFiyatBicimlendir; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        $SepettekiToplamUrunSayisi          = 0; // sepet boşaldığında hata vermemesi için
                        $SepettekiToplamFiyat               = 0;// sepet boşaldığında  para değeri hata vermemesi için

                        ?>

                        <tr height="30">
                            <td valign="bottom" align="left"><b>Sepette Ürün Bulunmamaktadır</b></td>
                        </tr>

                    <?php } ?>


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
                    <tr><td align="right">Ödenecek Tutar</td></tr>
                    <tr><td align="right" style="font-size: 24px;  font-weight: bold;"><?php echo FiyatBicimlendir($SepettekiToplamFiyat); ?> TL</td></tr>
                    <tr height="5">
                        <td height="5" style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right"><div class="SepetIciDevamEtVeAlisverisiTamamlaButonu"><a href="index.php?SK=98"><img src="Resimler/SepetBeyaz21x20.png" border="0"> <div>DEVAM ET</div></a></div></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php
} else {
    header("Location:index.php");
    exit();
}
?>