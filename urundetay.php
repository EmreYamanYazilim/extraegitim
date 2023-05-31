<?php
if (isset($_GET["ID"])) {
    $GelenID = SayiliIcerikleriFilitrele(Guvenlik($_GET["ID"]));

    $UrunHitiGuncellemeSorgusu      =       $VeritabaniBaglantisi->prepare("UPDATE urunler SET   GoruntulenmeSayisi=GoruntulenmeSayisi+1 WHERE id = ? AND Durumu = ? ");
    $UrunHitiGuncellemeSorgusu->execute([$GelenID, 1]);


    $UrunSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? AND Durumu = ? LIMIT 1");
    $UrunSorgusu->execute([$GelenID, 1]);
    $UruynSayisi = $UrunSorgusu->rowCount();
    $UrunSorgusuKaydi = $UrunSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($UruynSayisi > 0) {
        $UrunTuru = $UrunSorgusuKaydi["UrunTuru"];

        if ($UrunTuru == "Erkek Ayakkabısı") {
            $ResimKlasoru = "Erkek";
        } elseif ($UrunTuru == "Kadın Ayakkabısı") {
            $ResimKlasoru = "Kadin";
        } elseif ($UrunTuru == "Cocuk Ayakkabısı") {
            $ResimKlasoru = "Cocuk";
        }



        $UrunFiyati = DonusumleriGeriDondur($UrunSorgusuKaydi["UrunFiyati"]);

        $UrunParaBirimi = DonusumleriGeriDondur($UrunSorgusuKaydi["ParaBirimi"]);

        if ($UrunParaBirimi == "USD") {
            $UrunFiyatHesapla = $UrunFiyati * $DolarKuru;
        } elseif ($UrunParaBirimi == "EUR") {
            $UrunFiyatHesapla = $UrunFiyati * $EuroKuru;
        } else {
            $UrunFiyatHesapla = $UrunFiyati;
        }







        ?>


        <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="350" valign="top">
                    <table width="350" border="0" cellpadding="0" cellspacing="0">

                        <tr>
                            <td align="center"><img style="border: 1px solid darkorange;" id="BuyukResim"
                                                    src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo $UrunSorgusuKaydi["UrunResmiBir"]; ?> "
                                                    alt="" width="350" height="440">
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td>
                                <table width="350" align="" border="0" cellpadding="0" cellspacing="0">
                                    <tr>


                                        <?php if (DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiBir"]) != "") { ?>
                                            <td width="78" align="left"><img style="border: 1px solid darkorange;"
                                                                             src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiBir"]); ?>"
                                                                             height="104" width="78" alt=""
                                                                             onclick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>', '<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiBir"]); ?>');">
                                            </td>  <?php } else { ?>
                                            <td width="78">&nbsp;</td><?php } ?>

                                        <td width="10">&nbsp;</td>

                                        <?php if (DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiiki"]) != "") { ?>
                                            <td width="78"><img style="border: 1px solid darkorange;"
                                                                src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiiki"]); ?>"
                                                                height="104" width="78" alt=""
                                                                onclick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>', '<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiiki"]); ?>');">
                                            </td> <?php } else { ?>
                                            <td width="78"></td>  <?php } ?>

                                        <td width="10">&nbsp;</td>

                                        <?php if (DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiUc"]) != "") { ?>
                                            <td width="78"><img style="border: 1px solid darkorange;"
                                                                src="Resimler/UrunResimleri/<?php echo $ResimKlasoru ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiUc"]); ?>"
                                                                height="104" width="78" alt=""
                                                                onclick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>','<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiUc"]); ?>');">
                                            </td> <?php } else { ?>
                                            <td width="78">&nbsp;</td> <?php } ?>

                                        <td width="10">&nbsp;</td>

                                        <?php if (DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiDort"]) != "") { ?>
                                            <td width="78"><img style="border: 1px solid darkorange;"
                                                                src="Resimler/UrunResimleri/<?php echo $ResimKlasoru ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiDort"]); ?> "
                                                                height="104" width="78" alt=""
                                                                onclick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru ?>','<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiDort"]);  ?>');">
                                            </td> <?php } else { ?>
                                            <td width="10">&nbsp;</td> <?php } ?>

                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="350" align="center" border="0" cellspacing="0" cellpadding="0">

                                    <tr height="50">
                                        <td bgcolor="#F1F1F1"><b>&nbsp;Reklamlar</b></td>
                                    </tr>
                                    <?php
                                    $BannerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM bannerlar where BannerAlani = 'Ürün Detay' order by GosterimSayisi ASC limit 1");
                                    $BannerSorgusu->execute();
                                    $BannerSayisi = $BannerSorgusu->rowCount();
                                    $BannerKaydi = $BannerSorgusu->fetch(PDO::FETCH_ASSOC);

                                    ?>

                                    <tr>
                                        <td>
                                            <img src="Resimler/<?php echo DonusumleriGeriDondur($BannerKaydi["BannerResmi"]); ?>" alt="">
                                        </td>
                                    </tr>

                                    <?php
                                    $BannerGuncelle = $VeritabaniBaglantisi->prepare("UPDATE bannerlar SET GosterimSayisi=GosterimSayisi+1 WHERE id = ? limit 1");
                                    $BannerGuncelle->execute([DonusumleriGeriDondur($BannerKaydi["id"])]);
                                    ?>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table></table>
                            </td>
                        </tr>
                        </td>


                        <td width="" valign="top">&nbsp;</td>


                        <td width="785" valign="top"></td>
                        </tr>

                    </table>

                </td>
                <td valign="top" width="705">
                    <table width="705" align="center" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="text-align: left; font-size: 19px; font-weight: bold;">
                                <?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunAdi"]); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <form action="index.php?SK=91&ID=<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["id"]); ?>"
                                      method="POST">
                                <table width="705" align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr height="45">
                                        <td width="30"><a
                                                    href="<?php echo DonusumleriGeriDondur($SosyalLinkFacebook); ?>"
                                                    target="_blank"><img
                                                        src="Resimler/Facebook24x24.png" alt=""></a></td>
                                        <td width="30"><a
                                                    href="<?php echo DonusumleriGeriDondur($SosyalLinkTwitter); ?>"
                                                    target="_blank"><img
                                                        src="Resimler/Twitter24x24.png" alt=""></a></td>
                                        <td width="30">
                                            <?php
                                            if (isset($_SESSION["Kullanici"])){ ?>
                                            <a href="index.php?SK=87&ID=<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["id"]); ?>"><img
                                                        src="Resimler/KalpKirmiziDaireliBeyaz24x24.png" alt=""></a></td>
                                        <?php } else { ?>
                                            <img src="Resimler/KalpKirmiziDaireliBeyaz24x24.png" alt="">
                                        <?php } ?>


                                        <td width="10">&nbsp;</td>
                                        <td width="900"><input type="submit" value="Sepete Ekle"
                                                               class="SepeteEkleButonu"></td>

                                    </tr>


                                    <tr height="45">
                                        <td colspan="5">
                                            <table width="705" align="center" border="0" cellspacing="0"
                                                   cellpadding="0">
                                                <tr>
                                                    <td width="500" align="left"><select name="Varyant" class="SelectAlanlari" required="">
                                                            <option value="">Lütfen <?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["VaryantBasligi"]); ?> Seçiniz</option>
                                                            <?php

                                                            $VaryantSorgusu		=	$VeritabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE UrunId = ? AND StokAdedi > ? ORDER BY VaryantAdi ASC");
                                                            $VaryantSorgusu->execute([DonusumleriGeriDondur($UrunSorgusuKaydi["id"]), 0]);
                                                            $VaryantSayisi		=	$VaryantSorgusu->rowCount();
                                                            $VaryantKayitlari	=	$VaryantSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                                            foreach($VaryantKayitlari as $VaryantSecimi){
                                                                ?>
                                                                <option value="<?php echo $VaryantSecimi["id"]; ?>"><?php echo DonusumleriGeriDondur($VaryantSecimi["VaryantAdi"]); ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select></td>
                                                    <td width="205" align="right" style="font-size: 24px; font-weight: bold; color: darkorange"><?php echo FiyatBicimlendir($UrunFiyatHesapla); ?>TL </td>
                                                </tr>
                                            </table>

                                        </td>

                                    </tr>

                                </table></form>
                            </td>
                        </tr>
                        <tr>
                            <td> <hr/> </td>
                        </tr>
                        <tr>
                            <td> <table width="705" align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr height="30">
                                        <td><img src="Resimler/SaatEsnetikGri20x20.png" border="0" alt=""></td>
                                        <td>Siparişiniz <?php echo UcGunIleriTarihi(); ?> Tarihine kadar kargoya verilecektir</td>
                                    </tr>
                                    <tr height="30">
                                        <td><img src="Resimler/SaatHizCizgiliLacivert20x20.png" border="0" alt=""></td>
                                        <td>İlgili Ürün  hızlı kargo İle Daha hızlı şekilde elinize ulaştırılacaktır...</td>
                                    </tr>
                                    <tr height="30">
                                        <td><img src="Resimler/KrediKarti20x20.png" border="0" alt=""></td>
                                        <td>Tüm bankaların kartları ile peşin  veya taksitli  ödeme seçeneği</td>
                                    </tr>
                                    <tr height="30">
                                        <td><img src="Resimler/Banka20x20.png" border="0" alt=""></td>
                                        <td>Tüm bankalardan havale ve EFT ile ödeme seçeneği</td>
                                    </tr>


                                </table>
                            </td>
                        </tr>
                        <tr><td> <hr /></td></tr>
                        <tr height="30">
                            <td style="text-align: center; background: darkorange; color: white; font-weight: bold; font-size: 17px;">ÜRÜN AÇIKLAMASI</td></tr>
                        <tr><td style=" font-weight: bold"><?php echo $UrunSorgusuKaydi["UrunAciklamasi"]; ?></td></tr>
                        <tr><td> <hr /></td></tr>
                        <tr height="30">
                            <td style="text-align: center; background: #0088cc; color: white; font-weight: bold; font-size: 17px;">ÜRÜN YORUMLARI</td></tr>
                        <tr><td>
                                <div style=" width: 705px; max-width: 705px; height: 300px; max-height: 300px; overflow-y: scroll;  ">
                                    <table width="685" align="left" border="0" cellspacing="0" cellpadding="0">
                                        <?php
                                        $YorumlarSorgusu        =       $VeritabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE UrunId = ?  ORDER BY YorumTarihi DESC");
                                        $YorumlarSorgusu->execute([DonusumleriGeriDondur($UrunSorgusuKaydi["id"])]);
                                        $yorumSayisi            =       $YorumlarSorgusu->rowCount();
                                        $YorumKayitlari         =       $YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($YorumKayitlari as $YorumSatirlari){
                                            $YorumPuani         =       DonusumleriGeriDondur($YorumSatirlari["Puan"]);

                                            if ($YorumPuani==1){
                                                $YorumPuanResmi =   "YildizBirDolu.png";
                                            }elseif ($YorumPuani==2){
                                                $YorumPuanResmi =   "YildizIkiDolu.png";
                                            }elseif ($YorumPuani==3){
                                                $YorumPuanResmi =   "YildizUcDolu.png";
                                            }elseif($YorumPuani==4){
                                                $YorumPuanResmi =   "YildizDortDolu.png";
                                            }elseif($YorumPuani==5){
                                                $YorumPuanResmi =   "YildizBesDolu.png";
                                            }

                                            $YorumIcinUyeSorgusu        =       $VeritabaniBaglantisi->prepare("SELECT * FROM  uyeler WHERE id = ? limit 1");
                                            $YorumIcinUyeSorgusu->execute([DonusumleriGeriDondur($YorumSatirlari["UyeId"])]);
                                            $YorumIciUyeKaydi           =       $YorumIcinUyeSorgusu->fetch(PDO::FETCH_ASSOC);


                                        ?>

                                        <tr height="30">
                                            <td width="64"><img src="Resimler/<?php echo $YorumPuanResmi ?>" alt=""></td>
                                            <td width="10">&nbsp;</td>
                                            <td width="451" ><?php echo DonusumleriGeriDondur($YorumIciUyeKaydi["IsimSoyisim"]); ?></td>
                                            <td width="10">&nbsp;</td>
                                            <td width="150"><?php echo TarihBul(DonusumleriGeriDondur($YorumSatirlari["YorumTarihi"])); ?></td>
                                        </tr>


                                        <tr>
                                            <td colspan="5" style="border-bottom: 1px dashed #0088cc" > <?php echo DonusumleriGeriDondur($YorumSatirlari["YorumMetni"]); ?> </td>

                                        </tr>
                                        <?php } ?>
                                    </table>


                                </div>
                            </td></tr>



                    </table>
                </td>

            </tr>
        </table>


        <?php

    } else {

        header("Location:index.php");
        exit();
    }

} else {
    header("Location:index.php");
    exit();
}
?>