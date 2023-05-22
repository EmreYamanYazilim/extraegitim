<?php
if (isset($_GET["ID"])) {
    $GelenID = SayiliIcerikleriFilitrele(Guvenlik($_GET["ID"]));


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


        ?>


        <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="350" valign="top">
                    <table width="350" border="0" cellpadding="0" cellspacing="0">

                        <tr>
                            <td align="center" style="border: 1px solid darkorange;"><img id="BuyukResim"src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo $UrunSorgusuKaydi["UrunResmiBir"]; ?> "
                            alt="" width="330" height="440">
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td>
                                <table width="350" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="78" style="border: 1px solid darkorange;"><img
                                                    src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo $UrunSorgusuKaydi["UrunResmiBir"] ?>"
                                                    height="104" width="78" alt=""
                                                    onclick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>', '<?php echo $UrunSorgusuKaydi["UrunResmiBir"]; ?>');">
                                        </td>
                                        <td width="10">&nbsp;</td>
                                        <td width="78" style="border: 1px solid darkorange;"><img
                                                    src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo $UrunSorgusuKaydi["UrunResmiiki"] ?>"
                                                    height="104" width="78" alt=""
                                                    onclick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>', '<?php echo $UrunSorgusuKaydi["UrunResmiiki"]; ?>');">
                                        </td>
                                        <td width="10">&nbsp;</td>
                                        <td width="78" style="border: 1px solid darkorange;"><img
                                                    src="Resimler/UrunResimleri/<?php echo $ResimKlasoru ?>/<?php echo $UrunSorgusuKaydi["UrunResmiUc"] ?>"
                                                    height="104" width="78" alt=""
                                                    onclick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>','<?php echo $UrunSorgusuKaydi["UrunResmiUc"]; ?>');">
                                        </td>
                                        <td width="10">&nbsp;</td>
                                        <td width="78" style="border: 1px solid darkorange;"><img
                                                    src="Resimler/UrunResimleri/<?php echo $ResimKlasoru ?>/<?php echo $UrunSorgusuKaydi["UrunResmiDort"] ?> "
                                                    height="104" width="78" alt=""
                                                    onclick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru ?>','<?php echo $UrunSorgusuKaydi["UrunResmiDort"] ?>');">
                                        </td>
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
                                            <img src="Resimler/<?php echo $BannerKaydi["BannerResmi"]; ?>" alt="">
                                        </td>
                                    </tr>

                                    <?php
                                    $BannerGuncelle = $VeritabaniBaglantisi->prepare("UPDATE bannerlar SET GosterimSayisi=GosterimSayisi+1 WHERE id = ? limit 1");
                                    $BannerGuncelle->execute([$BannerKaydi["id"]]);
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
                <td valign="top" width="705" >
                    <table width="705" align="center" border="0" cellspacing="0" cellpadding="0">
                        <tr >
                            <td style="text-align: left; font-size: 19px; font-weight: bold;" >
                                <?php echo $UrunSorgusuKaydi["UrunAdi"];?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <form action="index.php?SK=91&ID=<?php echo $UrunSorgusuKaydi["id"] ?>" method="post"></form>
                                <table width="705" align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr height="40">
                                        <td width="30"><a href="<?php echo DonusumleriGeriDondur($SosyalLinkFacebook); ?>" target="_blank" ><img
                                                        src="Resimler/Facebook24x24.png" alt=""></a></td>
                                        <td width="30"><a href="<?php echo DonusumleriGeriDondur($SosyalLinkTwitter); ?>" target="_blank" ><img
                                                        src="Resimler/Twitter24x24.png" alt=""></a></td>
                                         <td width="30">
                                        <?php
                                        if(isset($_SESSION["Kullanici"])){ ?>
                                        <a href="index.php?SK=87&ID=<?php echo $UrunSorgusuKaydi["id"];?>" ><img src="Resimler/KalpKirmiziDaireliBeyaz24x24.png" alt=""></a></td>
                                        <?php } else { ?>
                                              <img src="Resimler/KalpKirmiziDaireliBeyaz24x24.png" alt="">
                                        <?php } ?>


                                        <td width="10">&nbsp;</td>
                                        <td><input type="submit"  value="Sepete Ekle" class="SepeteEkleButonu"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    
                                </table>
                                </td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>


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